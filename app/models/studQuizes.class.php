<?php

class studQuizes extends Model
{
    public Stud $student;
    public Quizes $quiz;
    public function __construct()
    {
        parent::__construct();
        $this->student = new Stud();
        $this->quiz = new Quizes();
    }

    public function checkStudentCanPerformQuiz($student_data,$quiz_id,$course_id):bool{
        if($student_data->rank == "student" && $this->student->DoesStudentEnrolledInThisCourse($course_id,$student_data->id)){
            if($this->checkStudentAttempts($student_data->id,$quiz_id)){
                if($this->quiz->checkQuizTime($quiz_id) == "available"){
                    return true;
                }
            }
        }
        return false;
    }
    public function getNumberOfAttemptsForStudent(int $student_id,int $quiz_id):int{
        $query = "SELECT count(id) as student_attempts FROM student_quiz WHERE student_id = :student_id AND quiz_id = :quiz_id";
        $data = $this->db->read($query,
        [
            "student_id"=>$student_id,
            "quiz_id"=>$quiz_id
        ]);
        if($data){
            return $data[0]->student_attempts;
        }
        return 0;
    }
    private function checkStudentAttempts($student_id, $quiz_id):bool
    {
        $student_attempts = $this->getNumberOfAttemptsForStudent($student_id,$quiz_id);
        $quiz_max_attempts = $this->quiz->getMaxAttempts($quiz_id);
        if($quiz_max_attempts){
            if($student_attempts < $quiz_max_attempts){
                return true;
            }
        }
        return false;
    }

    public function performQuiz(int $student_id, int $quiz_id):int
    {
        $data["attempt_number"] = $this->getNumberOfAttemptsForStudent($student_id,$quiz_id) + 1;
        $data["student_id"] = $student_id;
        $data["quiz_id"] = $quiz_id;
        $data["start_time"] = date("y-m-d h:i:s");
        $data["end_time"] = date("y-m-d h:i:s",strtotime("+15 minutes", strtotime($data["start_time"])));
        $query = "INSERT INTO student_quiz (student_id,quiz_id,attempt_number,start_time,end_time) VALUES(:student_id,:quiz_id,:attempt_number,:start_time,:end_time)";
        $this->db->write($query,$data);
        $student_quiz_id = $this->getStudentQuizId($student_id,$quiz_id,$data["attempt_number"]);
        $this->getAllQuestionForThisStudentQuiz($student_quiz_id,$quiz_id);
        return $student_quiz_id;
    }

    private function getStudentQuizId(int $student_id, int $quiz_id,int $attempt_number):int
    {
        $query = "SELECT id FROM student_quiz WHERE student_id = :student_id AND quiz_id = :quiz_id AND attempt_number = :attempt_number LIMIT 1";
        $data = $this->db->read($query,
        [
           "student_id"=>$student_id,
           "quiz_id"=>$quiz_id,
           "attempt_number"=>$attempt_number
        ]);
        return $data[0]->id;
    }

    private function getAllQuestionForThisStudentQuiz(int $student_quiz_id,int $quiz_id):bool
    {
        $is_random_generated = $this->quiz->isRandom($quiz_id);
        $numberOfQuestions = $this->quiz->getNumberOfQuestions($quiz_id);
        $query = $this->getQuestionsQuery($is_random_generated,$numberOfQuestions,$student_quiz_id);
        return $this->db->write($query,[
           "quiz_id"=>$quiz_id
        ]);
    }

    private function getQuestionsQuery(bool $is_random_generated,int $numberOfQuestions,int $student_quiz_id):string
    {
        if($is_random_generated){
            $query = "INSERT INTO student_quiz_question (question_id,student_quiz) SELECT question_id,{$student_quiz_id} FROM quiz_questions WHERE quiz_id = :quiz_id ORDER BY RAND() LIMIT {$numberOfQuestions}";
        }
        else{
            $query = "INSERT INTO student_quiz_question (question_id,student_quiz) SELECT question_id,{$student_quiz_id} FROM quiz_questions WHERE quiz_id = :quiz_id LIMIT {$numberOfQuestions}";
        }
        return $query;
    }

    public function getProperPageNumber(int $page,int $student_quiz)
    {
        $expectedPageNumber = $this->getExpectedPageNumber($student_quiz);
        if($page <= 0){
            return $expectedPageNumber;
        }
        $maximumPageNumber = $this->getMaxiumPageNumber($student_quiz);
        if($page > $maximumPageNumber){
            return $expectedPageNumber;
        }
        $quiz_id = $this->getQuizIdFromStudentQuiz($student_quiz);
        $is_recursive = $this->quiz->isRecursive($quiz_id);
        if(!$is_recursive){
            if($page <= $expectedPageNumber){
                return $expectedPageNumber + 1;
            }
        }
        return $page;
    }

    private function getExpectedPageNumber(int $student_quiz):int
    {
        $query = "SELECT count(question_id)/3 as expectedPageNumber FROM student_quiz_question where student_quiz = :student_quiz AND is_solved = 1";
        $data = $this->db->read($query,
        [
            "student_quiz"=>$student_quiz
        ]);
        $pageNumber =  $data[0]->expectedPageNumber;
        if($pageNumber < 1){
            return 1;
        }
        return $pageNumber;
    }

    private function getMaxiumPageNumber(int $student_quiz)
    {
        $query = "SELECT count(question_id)/3 as maxPageNumbers FROM student_quiz_question WHERE student_quiz = :student_quiz";
        $data = $this->db->read($query,
        [
           "student_quiz"=>$student_quiz
        ]);
        return $data[0]->maxPageNumbers;
    }

    private function getQuizIdFromStudentQuiz(int $student_quiz):int
    {
        $query = "SELECT quiz_id FROM student_quiz WHERE id = :student_quiz";
        $data = $this->db->read($query,
        [
           "student_quiz"=>$student_quiz
        ]);
        return  $data[0]->quiz_id;
    }

    public function getQuestionsForPage(int $pageNumber, int $student_quiz_id):array
    {
        $offset = 3 * ($pageNumber - 1);
        $query = "SELECT q.id as id,question,question_type as type,photo,mark_value FROM student_quiz_question JOIN question q ON(question_id = q.id) WHERE student_quiz = :student_quiz_id LIMIT 3 OFFSET {$offset}";
        $data = $this->db->read($query,
        [
           "student_quiz_id"=>$student_quiz_id
        ]);
        return $this->addChoicesToThisQuestions($data);
    }

    public function getAllStudentAttempts(int $stud_id, int $quiz_id):array | bool
    {
        $query = "SELECT grade,end_time FROM student_quiz WHERE student_id = :student_id AND quiz_id = :quiz_id AND grade ORDER BY (id) ASC";
        $data =  $this->db->read($query,
        [
           "student_id"=>$stud_id,
           "quiz_id"=>$quiz_id
        ]);
        if(is_array($data)){
            $data = $this->getAllDatesRight($data);
        }
        return $data;
    }

    private function getAllDatesRight(array $data):array
    {
        foreach($data as $attempt){
            $attempt->end_time = $this->quiz->getTimeFormattedNicely($attempt->end_time);
        }
        return $data;
    }

    public function checkRightQuizForStudent(int $student_id,int $student_quiz_id):bool
    {
        $query = "SELECT id FROM student_quiz WHERE student_id = :student_id AND id = :student_quiz_id LIMIT 1";
        $data = $this->db->read($query,
        [
           "student_id"=>$student_id,
           "student_quiz_id"=>$student_quiz_id
        ]);
        if($data){
            return true;
        }
        return false;
    }

    private function addChoicesToThisQuestions(bool|array $data)
    {
        $query = "SELECT choice,is_right_answer FROM question_choice WHERE question_id = :question_id";
        $count = 1;
        foreach ($data as $question){
            $question->name = "answerer" . $count++;
            if($question->type != "essayQuestion"){
                $question->choices = $this->db->read($query,
                [
                    "question_id"=>$question->id
                ]);
                $question->CanHaveMultiableAnswers = $this->questionCanHaveMultiableAnswer($question);
            }
        }
        return $data;
    }

    private function questionCanHaveMultiableAnswer(mixed $question):bool
    {
        $count = 0;
        $counter = 0;
        $array = ["one","two","three","four"];
        foreach ($question->choices as $choice){
            if($question->type == "trueOrFalse"){
                $choice->name = "choice" . "-" .  $choice->choice;
            }
            else{
                $choice->name = "choice" . "-" .  $array[$counter++];
            }
            if($choice->is_right_answer == 1){
                $count++;
            }
        }
        if($count > 1){
            return true;
        }
        return false;
    }

}
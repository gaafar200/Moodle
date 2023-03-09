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
            if($this->checkStudentAttempts($student_data[0]->id,$quiz_id)){
                return true;
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

    public function performQuiz(int $student_id, int $quiz_id):void
    {
        $data["attempt_number"] = $this->getNumberOfAttemptsForStudent($student_id,$quiz_id) + 1;
        $data["student_id"] = $student_id;
        $data["quiz_id"] = $quiz_id;
        $data["start_time"] = date("Y-M-D h:i:s");
        $data["end_time"] = strtotime("+15 minutes", strtotime($data["start_time"]));
        $query = "INSERT INTO student_quiz (student_id,quiz_id,attempt_number,start_time,end_time) VALUES(:student_id,:quiz_id,:attempt_number,:start_time,:end_time)";
        $this->db->write($query,$data);
        $student_quiz_id = $this->getStudentQuizId($student_id,$quiz_id,$data["attempt_number"]);
        $this->getAllQuiestionForThisStudentQuiz();
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

    private function getAllQuiestionForThisStudentQuiz()
    {
    }

}
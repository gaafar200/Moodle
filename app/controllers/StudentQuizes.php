<?php

class StudentQuizes extends Controller
{
    public studQuizes $studQuizes;
    public function __construct()
    {
        parent::__construct();
        $this->studQuizes = new studQuizes();
    }

    public function perform(int $quiz_id,int $course_id){
        if($this->studQuizes->checkStudentCanPerformQuiz($this->data["user"],$quiz_id,$course_id)){
            $student_quiz_id = $this->studQuizes->performQuiz($this->data["user"]->id,$quiz_id);
            $this->redirect("StudentQuizes/quiz/" . $student_quiz_id . "?page=" . 1);
        }
        else{
            $this->forbidden();
        }

    }
    public function finish(int $student_quiz_id){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->studQuizes->solveThisGroupOfQuestions($_POST,$student_quiz_id);
            $result = $this->studQuizes->FinishThisAttempt($student_quiz_id);
            if($result){
                $quiz_id = $this->studQuizes->getQuizIdFromStudentQuiz($student_quiz_id);
                $quiz = new Quizes();
                $course_id = $quiz->getCourseId($quiz_id);
                $this->redirect("Quiz/quizDisplay/" . $course_id . "/"  . $quiz_id);
            }
        }
    }
    public function quiz(int $student_quiz_id){
        $quiz_id = $this->studQuizes->getQuizIdFromStudentQuiz($student_quiz_id);
        $quiz = new Quizes();
        $course_id = $quiz->getCourseId($quiz_id);
        if($this->studQuizes->checkRightQuizForStudent($this->data["user"]->id,$student_quiz_id)){
            $this->data["pageName"] = "quiz";
            if($_GET["page"] > 1){
                echo "yes";
            }
            $pageNumber = $this->studQuizes->getProperPageNumber($_GET["page"],$student_quiz_id);
            if($pageNumber != $_GET["page"]){
                $this->redirect("StudentQuizes/quiz/" . $student_quiz_id . "?page=" . $pageNumber);
            }
            $this->data["number_of_quiz_questions"] = $this->studQuizes->getNumberOfQuizQuestions($student_quiz_id);
            if($pageNumber == $this->studQuizes->getNumberOfPages($student_quiz_id)){
                $this->data["Finish"] = true;
            }
            else{
                $this->data["Finish"] = false;
            }
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $this->studQuizes->solveThisGroupOfQuestions($_POST,$student_quiz_id,$_FILES);
                if($this->data["Finish"]){
                    $result = $this->studQuizes->FinishThisAttempt($student_quiz_id);
                    if($result){
                        $quiz_id = $this->studQuizes->getQuizIdFromStudentQuiz($student_quiz_id);
                        $quiz = new Quizes();
                        $course_id = $quiz->getCourseId($quiz_id);
                        $this->redirect("Quiz/quizDisplay/" . $course_id . "/"  . $quiz_id);
                    }
                }
                $pageNumber = $pageNumber + 1;
                $this->redirect("StudentQuizes/quiz/" . $student_quiz_id . "?page=" . $pageNumber);
            }
            $this->data["questions"] = $this->studQuizes->getQuestionsForPage($pageNumber,$student_quiz_id);

            $this->data["quiz_time"] = $this->studQuizes->getQuizTimeRemaining($student_quiz_id);
            if($this->data["quiz_time"] === false){
                $this->redirect("Quiz/quizDisplay/" . $course_id . "/"  . $quiz_id);
            }
            $this->view("quizzes-attempt",$this->data);
        }

        else{
            $this->forbidden();
        }
    }
    public function marks(int $quiz_id,int $course_id){
        $this->data["pageName"] = "quiz marks";
        $this->data["course_id"] = $course_id;
        $this->data["students_marks_in_quiz"] = $this->studQuizes->getStudentMarksInQuiz($quiz_id,$course_id);
        $this->view("students-marks-list",$this->data);
    }
    public function reviewQuiz(){
        $this->data["pageName"] = "Review Quiz";
        $this->view("quiz-attempt-review",$this->data);
    }
    public function markQuiz(int $student_quiz_id){
        $this->data["pageName"] = "mark quiz";
        $this->data["student_quiz_details"] = $this->studQuizes->getStudentQuizDetails($student_quiz_id);
        $this->view("quiz-attempt-mark",$this->data);
    }

    private function getStudentQuizDetails()
    {
    }


}
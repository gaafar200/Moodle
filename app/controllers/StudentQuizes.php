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
    public function quiz(int $student_quiz_id){
        if($this->studQuizes->checkRightQuizForStudent($this->data["user"]->id,$student_quiz_id)){
            $this->data["pageName"] = "quiz";
            $pageNumber = $this->studQuizes->getProperPageNumber($_GET["page"],$student_quiz_id);
            if($pageNumber != $_GET["page"]){
                $this->redirect("StudentQuizes/quiz/" . $student_quiz_id . "?page=" . $pageNumber);
            }
            $this->data["questions"] = $this->studQuizes->getQuestionsForPage($pageNumber,$student_quiz_id);
            $this->view("quizzes-attempt",$this->data);
        }

        else{
            $this->forbidden();
        }
    }


}
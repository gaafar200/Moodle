<?php

class Quiz extends Controller
{
    public Quizes $quiz;
    public function __construct()
    {
        parent::__construct();
        $this->quiz = new Quizes();
    }

    public function index(int $id){
        $this->data["pageName"] = "Quizes";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->quiz->deleteQuiz($_POST["quiz_id"]);
        }
        $this->data["course_id"] = $id;
        $this->data["quizes_data"] = $this->quiz->getAllQuizes($id);
        $this->view("quizzes-list",$this->data);
    }
    public function set(int $id){
        $this->data["pageName"] = "Set Quiz";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $result = $this->quiz->setQuiz($_POST,$id);
            if($result === true){
                $this->redirect("Quiz/" . $id);
            }
            $this->data["errors"] = $result;
        }
        $this->view("set-quiz",$this->data);
    }
    public function edit(int $quiz_id,int $courseId){
        $this->data["pageName"] = "Edit Quiz";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $result = $this->quiz->editQuiz($_POST,$quiz_id);
            if($result === true){
                $this->redirect("Quiz/" . $courseId);
            }
            $this->data["errors"] = $result;
         }
        $this->data["quiz_date"] = $this->quiz->getQuizData($quiz_id);
        $this->view("edit-quiz",$this->data);
    }
    public function activate(int $quiz_id,int $course_id){
        $this->quiz->activateQuiz($quiz_id);
        $this->redirect("Quiz/"  . $course_id);
    }
    public function deactivate(int $quiz_id,int $course_id){
        $this->quiz->deactivateQuiz($quiz_id);
        $this->redirect("Quiz/"  . $course_id);
    }


}
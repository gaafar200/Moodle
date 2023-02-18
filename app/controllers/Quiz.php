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
    public function delete(int $id){
        $this->data["pageName"] = "Quizes";
        $this->quiz->deleteQuiz($id);
        $this->view("quizzes-list",$this->data);
    }

}
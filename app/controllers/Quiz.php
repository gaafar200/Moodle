<?php

class Quiz extends Controller
{
    public Quizes $quiz;
    public function __construct()
    {
        parent::__construct();
        $this->quiz = new Quizes();
    }

    public function index(){
        $this->data["pageName"] = "Quizes";
        $this->view("quizzes-list",$this->data);
    }
    public function addQuiz(int $id){
        $this->data["pageName"] = "Set Quiz";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $result = $this->quiz->setQuiz($_POST,$id);
            if($result === true){
                $this->redirect("Quiz");
            }
            $this->data["errors"] = $result;
        }
        $this->view("set-quiz",$this->data);
    }

}
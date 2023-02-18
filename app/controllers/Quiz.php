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
    public function edit(int $quizId,int $courseId){
        $this->data["pageName"] = "Edit Quiz";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $result = $this->quiz->editQuiz($_POST,$quizId);
            if($result === true){
                $this->redirect("Quiz/" . $courseId);
            }
            $this->data["errors"] = $result;
         }
        $this->data["quiz_date"] = $this->quiz->getQuizData($quizId);
        $this->view("edit-quiz",$this->data);
    }


}
<?php

class Quiz extends Controller
{
    public Quizes $quiz;
    public IQuestionFactory $questionFactory;
    public Questions $question;
    public function __construct()
    {
        parent::__construct();
        $this->questionFactory = new NormalQuestionFactory();
        $this->question = $this->questionFactory->getQuestion();
        $this->quiz = new Quizes();
    }

    public function index(int $id){
        if($this->data["user"]->rank == "lecturer") {
            $this->data["pageName"] = "Quizes";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $this->quiz->deleteQuiz($_POST["quiz_id"]);
            }
            $this->data["course_id"] = $id;
            $this->data["quizes_data"] = $this->quiz->getAllQuizes($id);
            $this->view("quizzes-list", $this->data);
        }
        else{
            $this->forbidden();
        }
    }
    public function set(int $id){
        if($this->data["user"]->rank == "lecturer"){
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
        else{
            $this->forbidden();
        }
    }
    public function edit(int $quiz_id,int $courseId){
        if($this->data["user"]->rank == "lecturer"){
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
        else{
            $this->forbidden();
        }
    }
    public function activate(int $quiz_id,int $course_id){
        if($this->data["user"]->rank == "lecturer"){
            $this->quiz->activateQuiz($quiz_id);
            $this->redirect("Quiz/"  . $course_id);
        }
        else{
            $this->forbidden();
        }

    }
    public function deactivate(int $quiz_id,int $course_id){
        if($this->data["user"]->rank == "lecturer"){
            $this->quiz->deactivateQuiz($quiz_id);
            $this->redirect("Quiz/"  . $course_id);
        }
        else{
            $this->forbidden();
        }

    }
    public function quizDisplay(int $course_id,int $quiz_id){
        if($this->Auth->checkCanDisplayCourseMaterials($course_id)){
            $this->data["quiz_display"] = $this->quiz->getQuizDisplayData($quiz_id);
            if($this->data["quiz_display"]){
                $this->data["pageName"] = $this->data["quiz_display"][0]->name;
            }
            $this->view("quizzes-details",$this->data);
        }
        else{
            $this->forbidden();
        }
    }


}
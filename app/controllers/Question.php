<?php

class Question extends Controller
{
    public IQuestionFactory $questionFactory;
    public Questions $question;
    public function addQuestionsToCourse(int $course_id,int $quiz_id){
        $this->data["course_id"] = $course_id;
        $this->data["quiz_id"] = $quiz_id;
        $this->data["pageName"] = "add Questions";
        $this->view("questions-list",$this->data);
    }
    public function set(int $course_id,int $quiz_id){
        $this->data["pageName"] = "Set Question";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->questionFactory = new SpecialQuestionFactory();
            $this->question = $this->questionFactory->getQuestion($_POST["question_type"]);
            var_dump($this->question);
            $result = $this->question->addQuestion($_POST,$course_id,$_FILES);
            var_dump($result);
            if($result === true){
                $this->redirect("Question/addQuestionsToCourse/". $course_id . "/" . $quiz_id);
            }
        }
        $this->view("add-question",$this->data);
    }


}
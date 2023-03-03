<?php

class Question extends Controller
{
    public IQuestionFactory $questionFactory;
    public Questions $question;
    public function addQuestionsToCourse(int $course_id,int $quiz_id){
        $this->data["course_id"] = $course_id;
        $this->data["quiz_id"] = $quiz_id;
        $this->data["pageName"] = "add Questions";
        $this->question = $this->getQuestion();
        $this->data["questions"] = $this->question->getAllQuestions($course_id);
        $quiz = new Quizes();
        $quiz_data = $quiz->getQuizData($quiz_id);
        $this->data["quiz_mark"] = $quiz_data[0]->mark_value;
        $this->data["number_of_questions"] = $quiz_data[0]->number_of_questions;
        $this->view("questions-list",$this->data);
    }
    public function set(int $course_id,int $quiz_id){
        $this->data["pageName"] = "Set Question";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->question = $this->getQuestion($_POST["question_type"]);
            $result = $this->question->addQuestion($_POST,$course_id,$_FILES);
            if($result === true){
                $this->redirect("Question/addQuestionsToCourse/". $course_id . "/" . $quiz_id);
            }
        }
        $this->view("add-question",$this->data);
    }
    private function getQuestion($question_type = ""){
        if($question_type == ""){
            $this->questionFactory = new NormalQuestionFactory();
            return $this->questionFactory->getQuestion();
        }else{
            $this->questionFactory = new SpecialQuestionFactory();
            return $this->questionFactory->getQuestion($question_type);
        }
    }

}
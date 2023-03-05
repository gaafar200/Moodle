<?php
class QuizQuestions extends SQuestion{
    public Questions $question;
    public function index(int $course_id,int $quiz_id){
        $this->data["pageName"] = "Quiz Questions";
        $this->question = $this->getQuestion();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $result = $this->question->addQuestionToTheQuiz($_POST["question_id"],$quiz_id);
        }
        $this->data["questions"] = $this->question->getAllQuestionsNotInTheQuiz($course_id,$quiz_id);
        $this->view("quiz-questions",$this->data);
    }
    public function enrolledQuestions(int $course_id,int $quiz_id){
        $this->data["pageName"] = "Quiz Questions";
        $this->question = $this->getQuestion();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //todo
        }
        $this->data["questions"] = $this->question->getAllQuestionsInTheQuiz($course_id,$quiz_id);
        $this->view("quiz-enrolled-questions",$this->data);
    }
}
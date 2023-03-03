<?php

class MultibaleTypeQuestion extends Questions
{
    public function validateMaxNumberOfFiles($max_number): bool | array{
        if($max_number > 10 || $max_number < 1){
            return ["MaxNumberOfFiles"=>"The Question number of files must be between 1 & 10"];
        }
        return true;
    }
    public function maxSizeAllowed($maxSize) : bool | array{
        if($maxSize <= 0.0 && $maxSize > 10.0){
            return ["size allowed must be between 0.0 & 10.0"];
        }
        return true;
    }
    function validateSpecificTypeData($data): bool|array
    {
        $check = $this->isValidMultipleAnswer($data["multiple_answer"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateChoices($data);
        if(is_array($check)){
            return $check;
        }
        $multipleAnswersAllowed = $data["multiple_answer"] == "yes";
        $check = $this->isValidCorrectAnswer($data["correct_answers"],$multipleAnswersAllowed);
        if(is_array($check)){
            return $check;
        }
        return true;
    }

    function addAnswersToTheQuestion($data):bool
    {
        $question_id = $this->getQuestionId($data["question"],$data["course_id"]);
        $query = "INSERT INTO question_choice (choice,is_right_answer,question_id) VALUES(:choice,:is_right_answer,:question_id)";
        $correct_Answers = explode("&",$data["correct_answers"]);
        $count = 0;
        for($i = 1;$i <= 4;$i++){
            $name = "choice" . $i;
            $choice = $data[$name];
            $is_correct = 0;
            if(isset($correct_Answers[$count])){
                if($correct_Answers[$count] == $i){
                    $is_correct = 1;
                    $count++;
                }
            }
            if(!$this->db->write($query,[
               "choice"=>$choice,
               "is_right_answer"=>$is_correct,
               "question_id"=>$question_id
            ])){
                return false;
            }
        }
        return true;
    }

    private function isValidMultipleAnswer($multiple_answer):array | bool
    {
        $array = ["yes","no"];
        if(!in_array($multiple_answer,$array)){
            return ["multiple Answer"=>"please specify multiple answer field probably"];
        }
        return true;
    }

    private function isValidChoice($choice,$choice_id = ""):bool | array
    {
        if(strlen($choice) <= 0){
            $choice_name = "choice" . $choice_id;
            return [$choice_name=>"choice is specified"];
        }
        return true;
    }

    private function validateChoices($data)
    {
        for($i = 1;$i <= 4;$i++){
            $name = "choice" . $i;
            $check = $this->isValidChoice($data[$name],$i);
            if(is_array($check)){
                return $check;
            }
        }
        return true;
    }

    private function isValidCorrectAnswer($correct_answer,$multipleAnswersAllowed = false)
    {
        if($multipleAnswersAllowed){
            if(strlen($correct_answer) <= 0 || strlen($correct_answer) > 5){
                return ["correct answer"=>"please Enter A valid Correct Answer"];
            }
            if(!preg_match("/^[1-4&]+$/",$correct_answer)){
                return ["correct answer"=>"Correct answer must be digit separated by &"];
            }
        }
        else{
            if(strlen($correct_answer) != 1){
                return ["correct answer"=>"please Enter A valid Correct Answer"];
            }
            if(!preg_match("/^[1-4]$/",$correct_answer)){
                return ["correct answer"=>"correct answer must be a digit from one to four"];
            }
        }

        return true;
    }
}
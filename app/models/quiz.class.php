<?php

class quiz extends model
{
    public description $description;
    public function __construct(){
        parent::__construct();
        $this->description = new description();
    }
    public function setQuiz(array $data,int $id)
    {
        $check = $this->validateQuizData($data);
        if(is_array($check)){
            return $check;
        }
        $data = $this->setDataReadyForTheQuery($data,$id);
        show($data);
        $query = "INSERT INTO quiz(name,created_date,quiz_date,end_time,start_time,desciption,is_auto_correct,number_of_questions,max_attempts,time,course_id,status,is_shuffled,is_recursive,is_disclosed)
                   VALUES(:quiz_name,:created_date,:date,:end_time,:start_time,:description,:is_auto_correct,:number_of_questions,:max_attempts,:time,:course_id,:status,:is_shuffled,:is_recursive,:is_disclosed)";
        echo $query;
        return $this->db->write($query,$data);
    }

    private function validateQuizData(array $data) :bool | array
    {
        foreach ($data as $key => $value){
            $$key = $value ?? false;
        }
        $check = $this->validateQuizName($quiz_name);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateDate($date);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateEndTime($start_time,$end_time);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateNumberOfQuestions($number_of_questions);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateQuizTime($time);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateNumberOfAttempts($max_attempts);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateBooleanField($is_recursive,"recursive");
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateBooleanField($is_auto_correct,"auto_correct");
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateBooleanField($is_shuffled,"is_shuffled");
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateBooleanField($is_disclosed,"is_disclosed");
        if(is_array($check)){
            return $check;
        }
        $check = $this->description->isValidDescription($description);
        if(is_array($check)){
            return $check;
        }
        return true;
    }

    private function validateQuizName($name):bool | array
    {
        if(strlen($name) < 3 || strlen($name) > 25){
            return ["quiz_name"=>"quiz name length must be between 3 and 25 characters"];
        }
        if(!preg_match("/^[a-zA-Z1-9 #]+$/",$name)){
            return ["quiz_name"=>"quiz name only consist of numbers,characters and ampersand"];
        }
        return true;
    }
    private function validateEndTime(string $start_time, string $end_time): bool | array
    {
        if(strtotime($end_time) < strtotime("+15 minutes", strtotime($start_time))){
            return ["endTime"=>"The time available for the quiz must be at least 15 minutes"];
        }
        return true;
    }

    private function validateNumberOfQuestions($number_of_questions): bool | array
    {
        if($number_of_questions <= 0){
            return ["number_of_question"=>"The number of question must be greater than 0"];
        }
        return true;
    }
    private function validateDate($date):bool | array
    {
        if(strtotime($date) <= strtotime(date(date('y-m-d h:i:s')))){
            return ["date"=>"The start date must be in the future"];
        }
        return true;
    }

    private function validateQuizTime($time):bool | array
    {
        if($time < 15){
            return ["number_of_question"=>"The Quiz Time must be greater than or equal to 15 minutes"];
        }
        return true;
    }

    private function validateNumberOfAttempts($number_of_attempts):bool | array
    {
        if($number_of_attempts <= 0 || $number_of_attempts > 5){
            return ["numberOfAttempts"=>"number of attempts must be between 1 and 5"];
        }
        return true;

    }

    private function validateBooleanField($is_recursive,$name):bool | array
    {
        $array = ["yes","no"];
        if(in_array($is_recursive,$array)){
            return true;
        }
        return [$name=>"value must be either true or false"];
    }

    private function setDataReadyForTheQuery(array $data,int $id):array
    {
        $data["created_date"] = date('y-m-d h:i');
        $data["course_id"] = $id;
        $data["status"] = "active";
        return $data;
    }




}
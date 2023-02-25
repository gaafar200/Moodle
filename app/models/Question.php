<?php

class Question
{
    public Image $image;
    public function __construct(){
        $this->image = new Image();
    }
    public function ValidateQuestionData($data):bool | array{
        foreach ($data as $key => $value){
            $$key = $value ?? false;
        }
        $check = $this->ValidateQuestionType($questionType);
        if(is_array($check)){
            return $check;
        }
        $check = $this->ValidateQuestion($question);
        if(is_array($check)){
            return $check;
        }
        $check = $this->ValidateMarkValue($mark);
        if(is_array($check)){
            return $check;
        }
        return true;
    }
    public function ValidateQuestionType($type):bool |array{
        //todo
    }
    public function ValidateQuestion($question):bool | array{
        if(strlen($question) <= 5){
            Return ["question"=>"any Question must be at least more than 5 characters"];
        }
        return true;
    }
    public function ValidateMarkValue($mark_value): bool | array{
        if($mark_value <= 0){
            return ["question"=>"any question must be at least have a one mark"];
        }
        return true;
    }



}
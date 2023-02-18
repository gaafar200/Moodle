<?php

class Question extends Controller
{
    public function addQuestionsToCourse(int $id){
        $this->data["pageName"] = "add Questions";
        $this->view("questions-list",$this->data);
    }
    public function set(){
        $this->data["pageName"] = "Set Question";
        $this->view("add-question",$this->data);
    }


}
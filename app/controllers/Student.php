<?php

class Student extends  Controller
{
    public function index(){
        $this->view("all-students",$this->data);
    }
    public function edit(){
        $this->view("edit-student",$this->data);
    }
    public function profile(){
        $this->view("student-profile",$this->data);
    }
    public function add(){
        $this->view("add-student",$this->data);
    }

}
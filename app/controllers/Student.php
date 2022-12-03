<?php

class Student extends  Controller
{
    public function index(){
        $this->view("all-students");
    }
    public function edit(){
        $this->view("edit-student");
    }
    public function profile(){
        $this->view("student-profile");
    }
    public function add(){
        $this->view("add-student");
    }

}
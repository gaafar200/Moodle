<?php
class Course extends Controller
{
    public function index(){
        $this->view("all-courses",$this->data);
    }
    public function edit(){
        $this->view("edit-course",$this->data);
    }
    public function Info(){
        $this->view("course-info",$this->data);
    }
    public function add(){
        $this->view("add-course",$this->data);
    }

}
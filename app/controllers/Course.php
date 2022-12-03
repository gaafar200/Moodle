<?php
class Course extends Controller
{
    public function index(){
        $this->view("all-courses");
    }
    public function edit(){
        $this->view("edit-course");
    }
    public function Info(){
        $this->view("course-info");
    }
    public function add(){
        $this->view("add-course");
    }

}
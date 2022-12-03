<?php

class Professor extends Controller
{
    public function index(){
        $this->view("all-professors");
    }
    public function edit(){
        $this->view("edit-professor");
    }
    public function profile(){
        $this->view("professor-profile");
    }
    public function add(){
        $this->view("add-professor");
    }

}
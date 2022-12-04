<?php

class Professor extends Controller
{
    public function index(){
        $this->view("all-professors",$this->data);
    }
    public function edit(){
        $this->view("edit-professor",$this->data);
    }
    public function profile(){
        $this->view("professor-profile",$this->data);
    }
    public function add(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            var_dump($_POST);
            var_dump($_FILES);
            die;
        }
        $this->view("add-professor",$this->data);
    }

}
<?php

class Professor extends Controller
{
    public lecturer $prof;
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
            $this->prof = new lecturer();
            $result = $this->prof->validateProfData($_POST,$_FILES);
            if($result === true){
                $result = $this->prof->registerNewProfessor($_POST,$_FILES,$this->data["user"]);
            }
        }
        $this->view("add-professor",$this->data);
    }

}
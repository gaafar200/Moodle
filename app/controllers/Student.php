<?php

class Student extends  Controller
{
    public Stud $student;
    public function __construct(){
        parent::__construct();
        $this->student = new Stud();
    }
    public function index(){
        $this->data["students"] = $this->student->getAllStudent();
        $this->view("all-students",$this->data);
    }
    public function edit($username = ""){
        if($username != ""){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!empty($_FILES)){
                    $this->student->changePhoto($username,$_FILES["image"]);
                }
            }
        }

        $this->view("edit-student",$this->data);
    }
    public function profile($username = ""){
        $this->data["studProfile"] = $this->user->getUserDataFromUsername($username);
        $this->view("student-profile",$this->data);
    }
    public function add(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $isValidData = $this->student->validateStudentData($_POST,$_FILES);
            if($isValidData === true){
                $isCreatedSuccessfully = $this->student->registerNewStudent($_POST,$_FILES,$this->data["user"]);
            }
            else{
                $this->data["errors"] = $isValidData;
            }
        }
        $this->view("add-student",$this->data);
    }
    public function delete($username = ""){
        if($username != ""){
            $data = $this->user->getUserDataFromUsername($username);
            if($data[0]->rank === "student"){
                $this->student->deleteStudentFromSystem($username);
            }
        }
        $this->data["students"] = $this->student->getAllStudent();
        $this->view("all-students",$this->data);
    }

}
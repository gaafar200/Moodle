<?php

class Student extends  Controller
{
    public Stud $student;
    public function __construct(){
        parent::__construct();
        $this->student = new Stud();
    }
    public function index(){
        $this->data["pageName"] = "All Students";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->data["students"] = $this->student->searchForStudents($_POST["search"]);
        }
        else{
            $this->data["students"] = $this->student->getAllStudent();
        }
        $this->view("all-students",$this->data);
    }
    public function edit($username = ""){
        $this->data["pageName"] = "Edit Student";
        if($username != ""){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if($_FILES["image"]["full_path"] !== ""){
                    $isPhotoChanged = $this->student->changePhoto($username,$_FILES);
                    if($isPhotoChanged !== true){
                        $this->data["errors"] = $isPhotoChanged;
                    }
                }
                $check =  $this->student->checkForEditData($_POST);
                if($check === true){
                    $isEdited = $this->student->editStudentData($_POST);
                    if($isEdited){
                        $this->redirect("student");
                    }
                }
            }
            $this->data["studData"] = $this->student->getUserDataFromUsername($username);
        }

        $this->view("edit-student",$this->data);
    }
    public function profile($username = ""){
        $this->data["pageName"] = "Student Profile";
        $this->data["studProfile"] = $this->user->getUserDataFromUsername($username);
        $this->view("student-profile",$this->data);
    }
    public function add(){
        $this->data["pageName"] = "Add Student";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $isValidData = $this->student->validateStudentData($_POST,$_FILES);
            if($isValidData === true){
                $isCreatedSuccessfully = $this->student->registerNewStudent($_POST,$_FILES,$this->data["user"]);
                $this->redirect("Student");
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
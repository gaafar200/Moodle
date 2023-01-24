<?php

class Professor extends Controller
{
    public lecturer $prof;
    public array $messages;
    public function __construct(){
        parent::__construct();
        $this->prof = new lecturer();
    }
    public function index(){
        $this->data["pageName"] = "All Professors";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->data["lecturers"] = $this->prof->searchForProfessors($_POST["search"]);
        }
        else{
            $this->getMissingData();
        }

        $this->view("all-professors",$this->data);
    }
    public function edit($username = ""){
        $this->data["pageName"] = "edit Professor";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_FILES["image"]["full_path"] !== ""){
                $imageChangedSuccessfully = $this->prof->changePhoto($username,$_FILES);
                if($imageChangedSuccessfully !== true){
                    $this->data["errors"] = $imageChangedSuccessfully;
                }

            }
            $check =  $this->prof->checkForEditData($_POST);
            if($check !== true){
                $this->data["errors"] = $check;
            }
            if(!isset($this->data["errors"])){
                if($this->prof->EditProfessorData($_POST)){
                    $this->redirect("Professor");
                }
            }

        }
        $this->data["lectData"] = false;
        if($username !== ""){
            $this->data["lectData"] = $this->prof->getUserDataFromUsername($username);
        }
        $this->view("edit-professor",$this->data);
    }
    public function profile($username = ""){
        $this->data["pageName"] = "Professor Profile";
        $this->data["ProfProfile"] = $this->user->getUserDataFromUsername($username);
        $this->view("professor-profile",$this->data);
    }
    public function add(){
        $this->data["pageName"] = "add Professor";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $result = $this->prof->validateProfData($_POST,$_FILES);
            if($result === true){
                $result = $this->prof->registerNewProfessor($_POST,$_FILES,$this->data["user"]);
            }
            else{
                $this->data["errors"] = $result;
            }
        }
        $this->view("add-professor",$this->data);
    }
    public function delete($username = ""){
        if($username != ""){
            $result = $this->prof->deleteProfessor($username);
            if($result === true){
                $this->data["success"] = ["lecturer"=> "Lecturer Deleted Successfully"];
            }
        }
        $this->getMissingData();
        $this->view("all-professors",$this->data);
    }
    public function getMissingData(){
        $lecturers = $this->prof->getAllLecturers();
        $this->data["lecturers"] = $lecturers;
    }
}
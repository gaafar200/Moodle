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
        $this->getMissingData();
        $this->view("all-professors",$this->data);
    }
    public function edit(){
        $this->view("edit-professor",$this->data);
    }
    public function profile($username = ""){
        $this->data["ProfProfile"] = $this->user->getUserDataFromUsername($username);
        $this->view("professor-profile",$this->data);
    }
    public function add(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $result = $this->prof->validateProfData($_POST,$_FILES);
            if($result === true){
                $result = $this->prof->registerNewProfessor($_POST,$_FILES,$this->data["user"]);
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
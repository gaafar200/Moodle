<?php

class Employee extends Controller
{
    public Employees $employee;
    public function __construct(){
        parent::__construct();
        $this->employee = new Employees();
    }
    public function index(){
        $this->data["pageName"] = "All Employees";
        $this->data["technicals"] = $this->employee->getAllTechnicals();
        $this->view("all-employees",$this->data);
    }
    public function add(){
        $this->data["pageName"] = "Add Employee";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $check = $this->employee->ValidateData($_POST,$_FILES);
            if($check === true){
                $result = $this->employee->registerUser($_POST,$_FILES);
                if($result){
                    $this->redirect("Employee");
                }
            }
        }
        $this->view("add-employee",$this->data);

    }
    public function edit($username = ""){
        if($username != ""){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if($_FILES["image"]["full_path"] !== ""){
                    $isPhotoChanged = $this->employee->image->changePhoto($username,$_FILES);
                    if($isPhotoChanged !== true){
                        $this->data["errors"] = $isPhotoChanged;
                    }
                }
                $check = $this->employee->validateEditBaseData($_POST);
                if($check === true){
                    $isEdited = $this->employee->editUserData($_POST);
                    if($isEdited){
                        $this->redirect("Employee");
                    }
                }
            }
        }
        $this->data["EmployeeData"] = $this->employee->getUserDataFromUsername($username);
        $this->data["pageName"] = "Edit Employee";
        $this->view("edit-employee",$this->data);
    }

    public function delete($username = ""){
        $this->data["pageName"] = "All Employees";
        if($username != ""){
            $result = $this->employee->deleteUser($username);
            if($result === true){
                $this->data["success"] = ["Employee"=> "employee Deleted Successfully"];
            }
        }
        $this->data["technicals"] = $this->employee->getAllTechnicals();
        $this->view("all-employees",$this->data);
    }
    public function profile($username){
        $this->data["EmployeeData"] = $this->employee->getUserDataFromUsername($username);
        $this->data["pageName"] = "Employee Profile";
        $this->view("employee-profile",$this->data);
    }

}
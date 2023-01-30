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
                $this->employee->registerUser($_POST,$_FILES);
            }
        }
        $this->view("add-employee",$this->data);

    }
    public function edit(){
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
        $this->view("all-employees",$this->data);
    }
    public function profile(){
        $this->data["pageName"] = "Employee Profile";
        $this->view("employee-profile",$this->data);
    }

}
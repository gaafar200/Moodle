<?php

class Employee extends Controller
{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->data["pageName"] = "All Employees";
        $this->view("all-employees",$this->data);
    }
    public function add(){
        $this->data["pageName"] = "Add Employee";
        $this->view("add-employee",$this->data);

    }
    public function edit(){
        $this->data["pageName"] = "Edit Employee";
        $this->view("edit-employee",$this->data);
    }

    public function delete(){
        $this->data["pageName"] = "All Employees";
        $this->view("all-employee");
    }
    public function profile(){
        $this->data["pageName"] = "Employee Profile";
        $this->view("employee-profile",$this->data);
    }

}
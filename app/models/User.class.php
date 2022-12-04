<?php

class User extends Model
{
    public database $db;
    public function __construct(){
        $this->db = new database();
    }

    public function validateLoginData($data)
    {
        if(isset($data["username"])){
            $isValidUser = $this->validateusername($data["username"]);
        }
        else{
            return ["username","Please Enter Your username or id"];
        }
        if(isset($data["password"])){
            $isValidPassword = $this->validatePassword($data["password"]);
        }
        else{
            return ["password","Please Enter Your password"];
        }
        return true;
    }

    private function validateusername($username)
    {
        if(preg_match("/^[0-9a-zA-Z]+$/",$username) && strlen($username) > 4){
            return true;
        }
        return ["username","username is not valid"];
    }

    private function validatePassword($password)
    {
        if(strlen($password) > 6){
            return true;
        }
        return ["password"=>"password is not valid"];

    }









}
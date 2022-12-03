<?php

class User
{
    public database $db;
    public function __construct(){
        $this->db = new database();
    }
    public function is_logged_in(){
        if(isset($_SESSION["User"])){
            return true;
        }
        return false;
    }
    public function validateLogin($data)
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
        if($isValidPassword && $isValidUser){
            return true;
        }
        return is_array($isValidPassword) ? $isValidPassword : $isValidUser;

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

    public function login($data)
    {
        $arr["username"] = $data["username"];
        $arr["password"] = sha1($data["password"]);
        $remember = isset($data["remember"]) ? true : false;
        $query = "SELECT * FROM users WHERE (username = :username || university_id = :username) && password = :password LIMIT 1";
        $userdata =  $this->db->read($query,$arr);
        if($userdata === false){
            return false;
        }
        $this->log_in($userdata);
        if($remember == true){
            //todo
        }
        return $userdata;
    }

    private function log_in($userdata)
    {
        $_SESSION["User"] = $userdata;
    }
    public function getUserData(){
        if(isset($_SESSION["User"])){
            return $_SESSION["User"];
        }
        return false;
    }


}
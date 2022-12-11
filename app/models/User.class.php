<?php

class User extends Model
{
    public database $db;
    public  $Auth;
    public function __construct(){
        $this->db = new database();
        $this->Auth = new Auth();
    }

    public function validateLoginData($data)
    {
        $username = isset($data["username"]) ? $data["username"] : false;
        $password = isset($data["password"]) ? $data["password"] : false;
        $check = $this->validateusername($username);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validatePassword($password);
        if(is_array($check)){
            return $check;
        }

        return true;
    }

    protected function validateusername($username)
    {
       if($username === false){
            return ["username"=>"The UserName is Required"];
       }
       if(strlen($username) < 6){
            return ["username"=>"username must be at least 6 characters"];
       }
       if(!preg_match("/^[0-9A-Za-z]+$/",$username)){
           return ["username"=>"username must only consist of characters and numbers"];
       }
        return true;
    }

    protected function validatePassword($password)
    {
        if(!$password){
            return ["password"=>"The password is Required"];
        }
        if(strlen($password) <= 4){
            return["password"=>"password is too short"];
        }
        return true;
    }

    protected function isVaildName($name){
        if(!$name){
            return ["name"=>"the firstname can't be empty"];
        }
        if(!preg_match("/^[a-zA-Z]+$/",$name)){
            return ["name"=>"firstname must consist of chars only"];
        }
        return true;
    }
    protected function isValidAddress($address){
        if(!$address){
            return ["address"=>"The Address can't be empty"];
        }
        if(!preg_match("/^[A-Za-z0-9 -_|]+$/",$address)){
            return ["name"=>"this is not a valid address"];
        }
        return true;
    }
    protected function isValidMobilNo($mobileNo){
        if(!$mobileNo){
            return ["mobile"=>"Mobile number can't be empty"];
        }
        if(!preg_match("//",$mobileNo) && strlen($mobileNo) < 9 || strlen($mobileNo) > 12){
            return ["mobile"=>"Mobile Number is not valid"];
        }
        return true;
    }
    protected function isValidEmail($email){
        if(!$email){
            return ["email"=>"email can't be empty"];
        }
        $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        if(!preg_match("/^[a-zA-Z0-9-.]+@[a-z]+.[a-z]+$/",$email)){
            return ["email"=>"email is not valid"];
        }
        return true;
    }
    protected function validateThePasswords($password,$password2){
        if($password !== $password2){
            return ["passwords"=>"passwords doesn't match"];
        }
        return true;
    }
    protected function isValidUserName($username){
        $check = $this->validateusername($username);
        if(is_array($check)){
            return $check;
        }
        if($this->userNameAlreadyExists($username)){
            return ["username"=>"username already exists"];
        }
        return true;
    }

    private function userNameAlreadyExists($username)
    {
        $query = "SELECT username FROM users WHERE username = :username LIMIT 1";
        $data = $this->db->read($query,[
            "username"=>$username
        ]);
        if(is_array($data) && !empty($data)){
            return true;
        }
        return false;
    }
    protected function isValidImage($image){
        if ($image['image']['error'] !== UPLOAD_ERR_OK) {
            return ["image"=>"Upload failed with error code " . $image['image']['error']];
        }        $info = getimagesize($image['image']['tmp_name']);
        if ($info === FALSE) {
            return ["image"=>"please upload an image"];
        }
        return true;
    }
    protected function getFileSystemReady()
    {
        if(!file_exists($this->getImagePath())){
            $check = $this->createImagePath();
            if($check !== true){
                return ["file-System" => "<div class='fail'>File System Error</div>"];
            }
        }
        return true;
    }
    protected function getImagePath(){
        return  $_SERVER["DOCUMENT_ROOT"] . "/model/public/assets/data/users/";
    }
    protected function createImagePath(){
        $check = mkdir($this->getImagePath(),0777);
        return $check;
    }
    private function getImageFinalDestination($image){
        $imagePath = "";
        $imageParts = explode(".",$image["image"]["name"]);
        $imageName = $imageParts[0];
        $ext = $imageParts[1];

        $check = true;
        while($check){
            $imagePath = $this->getImagePath() . $imageName . $this->generateRandomString(4) . "." . $ext;
            $query = "SELECT photo FROM users WHERE photo = :photo LIMIT 1";
            $check = $this->db->read($query,
            [
                "photo"=>$imagePath
            ]);
        }
        return $imagePath;
    }
    protected function getImageServerPath($image){
        $image_path = $this->getImageFinalDestination($image);
        $replacement_part = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"];
        return str_replace($_SERVER["DOCUMENT_ROOT"],$replacement_part,$image_path);
    }


    protected function getCreatorId()
    {
        $Auth = new Auth();
        $data = $Auth->is_logged_in();
        return $data[0]->id;
    }

    protected function storeImageInTheFileSystem($username,$image)
    {
        $query = "SELECT photo FROM users WHERE username = :username LIMIT 1";
        $destinationPath = $this->db->read($query,[
            "username"=>$username
        ]);
        $destinationPath = $this->alterPathToSuitFileSystem($destinationPath[0]->photo);
        $check =  move_uploaded_file($image["image"]["tmp_name"],$destinationPath);
        if(!$check){
            return ["file-system"=>"<div class='fail'>failed to write to file system</div>"];
        }
        return true;
    }

    private function alterPathToSuitFileSystem($path)
    {
        $replacement_parts = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"];
        return str_replace($replacement_parts,$_SERVER["DOCUMENT_ROOT"],$path);
    }
    protected function getUserDataFromUsername($username){
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $data = $this->db->read($query,[
            "username"=>$username
        ]);
        return $data;
    }


}
<?php

class lecturer extends User
{
    public function validateProfData($data,$image)
    {
        foreach ($data as $key => $value){
            $$key = $value ?? false;
        }
        $image = isset($image) ? $image : false;
        $check = $this->isVaildName($firstname);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isVaildName($lastname);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidAddress($address);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidMobilNo($mobileno);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidEmail($email);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidUserName($username);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validatePassword($password);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateThePasswords($password,$confirmpassword);
        if(is_array($check)) {
            return $check;
        }
        if(!$this->isValidImage($image)){
            return ["image"=>"please upload an image"];
        }
        return true;
    }

    public function registerNewProfessor($data,$image,$creator_data){
        $check = $this->getFileSystemReady();
        $result = $this->storeImageInTheFileSystem($image);
        unset($data["confirmpassword"]);
        $result = $this->addToDataBase($image,$data,$creator_data);

    }

    protected function addToDataBase($image,$data,$creator_data)
    {
        $data["photo"] = $this->getImageServerPath($image);
        $data["password"] = sha1($data["password"]);
        $data["created_by"] = $this->getCreatorId();
        $data["rank"] = "admin";
        $query = "INSERT INTO users (f_name,l_name,address,phone_number,username,password,email,photo,rank,created_by) VALUES(:firstname,:lastname,:address,:mobileno,:username,:password,:email,:photo,:rank,:created_by)";
        if($this->db->write($query,$data)){
            return true;
        }
        return false;
    }

    private function storeImageInTheFileSystem($image)
    {
        $destinationPath = $this->getImageFinalDestination($image);
        $check =  move_uploaded_file($image["image"]["tmp_name"],$destinationPath);
        if(!$check){
            return ["file-system"=>"<div class='fail'>failed to write to file system</div>"];
        }

    }

    private function getFileSystemReady()
    {
        if(!file_exists($this->getImagePath())){
            $check = $this->createImagePath();
            if($check !== true){
                return ["file-System" => "<div class='fail'>File System Error</div>"];
            }
        }
        return true;
    }
    private function getImagePath(){
        return  $_SERVER["DOCUMENT_ROOT"] . "/model/public/assets/data/users/";
    }
    private function createImagePath(){
        $check = mkdir($this->getImagePath(),0777);
        return $check;
    }
    private function getImageFinalDestination($image){
        $imageParts = explode(".",$image["image"]["name"]);
        $imageName = $imageParts[0];
        $ext = $imageParts[1];
        return  $this->getImagePath() . $imageName . $this->generateRandomString(4) . "." . $ext;
    }
    private function getImageServerPath($image){
        $imagePath = $this->getImageFinalDestination($image);
        $replacementValue = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"];
        return str_replace($_SERVER["DOCUMENT_ROOT"],$replacementValue,$imagePath);
    }
    private function getDestianationPath($image){
        $serverDestination = $this->getImageServerPath($image);
        $query = "SELECT photo FROM users WHERE photo = :path LIMIT 1";
        $check = $this->db->read($query,[
            "path"=>$serverDestination,
        ]);
        while($check){
            $this->getImageFinalDestination($image);
            $serverDestination = $this->getImageServerPath($image);
            $check = $this->db->read($query,[
                "path"=>$serverDestination,
            ]);
        }
        return $serverDestination;
    }

    private function getCreatorId()
    {
        $Auth = new Auth();
        $data = $Auth->is_logged_in();
        return $data[0]->id;
    }


}
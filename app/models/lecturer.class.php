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
        $check = $this->validteDescription($description);
        if(is_array($check)){
            return $check;
        }
        if(!$this->isValidImage($image)){
            return ["image"=>"please upload an image"];
        }

        return true;
    }

    public function registerNewProfessor($data,$image,$creator_data){
        if($this->Auth->hasRightPrivilege("techEmployee")){
            unset($data["confirmpassword"]);
            $result = $this->addToDataBase($image,$data,$creator_data);
            $check = $this->getFileSystemReady();
            $result = $this->storeImageInTheFileSystem($data["username"],$image);
            return true;
        }
    }

    protected function addToDataBase($image,$data,$creator_data)
    {
        $data["photo"] = $this->getImageServerPath($image);
        $data["password"] = sha1($data["password"]);
        $data["created_by"] = $this->getCreatorId();
        $data["rank"] = "lecturer";
        $query = "INSERT INTO users (f_name,l_name,address,phone_number,username,password,email,photo,rank,description,created_by) VALUES(:firstname,:lastname,:address,:mobileno,:username,:password,:email,:photo,:rank,:description,:created_by)";
        if($this->db->write($query,$data)){
            return true;
        }
        return false;
    }

    public function getAllLecturers()
    {
        $query = "SELECT * FROM users WHERE rank = :rank";
        return $this->db->read($query,[
            "rank"=>"lecturer"
        ]);
    }

    private function validteDescription($description)
    {
        if(strlen($description) < 6 && !preg_match("/^[a-zA-Z0-9 ]+$/",$description)){
            return ["description"=>"description must only contains characters and numbers"];
        }
        return true;
    }

    public function deleteProfessor($username)
    {
        if($this->Auth->hasRightPrivilege("techEmployee")){
            $checkIfProfessorExists = $this->checkIfProfessorExists($username);
            if($checkIfProfessorExists === false){
                return ["lecturer"=>"lecturer does not exists"];
            }
            $photoDeleted = $this->deletephoto($checkIfProfessorExists[0]->photo);
            $result = $this->delete($username);
            if($result !== true){
                return ["lecturer"=>"failed to delete lecturer"];
            }
            return true;
        }
        return ["lecturer"=>"you don't have the right Privilege to perform this action"];
    }

    private function checkIfProfessorExists($username)
    {
        $data = $this->getUserDataFromUsername($username);
        if($data){
            if($data[0]->rank == "lecturer"){
                return $data;
            }
        }
        return false;
    }

    private function delete($username)
    {
        $query = "DELETE FROM users WHERE username = :username";
        return $this->db->write($query,[
            "username"=>$username
        ]);
    }

    public function checkForEditData($data)
    {
        foreach ($data as $key => $value){
            $$key = $value ?? false;
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
        $check = $this->validategender($gender);
        if(is_array($check)){
            return $check;
        }
        return true;
    }

    public function EditProfessorData($data)
    {
        $query = "UPDATE users SET f_name = :firstname,
                 l_name = :lastname,
                 address = :address,
                 phone_number = :mobileno,
                 email = :email WHERE username = :username";
        $this->db->write($query,$data);
        return true;
    }


}
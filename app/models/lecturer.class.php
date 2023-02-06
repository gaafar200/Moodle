<?php

class lecturer extends User implements Description
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validateProfData($data,$image)
    {
        $check = $this->validateBasicData($data,$image);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidDescription($data["description"]);
        if(is_array($check)){
            return $check;
        }
        return true;
    }

    /**
     * @override
     */
    public function handleDataBase($data,$image):bool
    {
        $query = "INSERT INTO users (f_name,l_name,address,phone_number,gender,username,password,email,photo,rank,description,created_by) VALUES(:firstname,:lastname,:address,:mobileno,:gender,:username,:password,:email,:photo,:rank,:description,:created_by)";
        return $this->db->write($query,$data);
    }

    /**
     * @override
     */
    function getDataReady(array $data,string $image): array
    {
        $data = parent::getDataReady($data,$image);
        $data["rank"] = "lecturer";
        return $data;
    }

    public function getAllLecturers()
    {
        return $this->getAllUsersWithRank("lecturer");
    }

    public function isValidDescription($description): array | bool
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
            $photoDeleted = $this->image->deletephoto($checkIfProfessorExists[0]->photo);
            $result = $this->delete($username);
            if($result !== true){
                return ["lecturer"=>"failed to delete lecturer"];
            }
            return true;
        }
        return ["lecturer"=>"you don't have the right Privilege to perform this action"];
    }

    public function checkIfProfessorExists($username)
    {
        $data = $this->getUserDataFromUsername($username);
        if($data){
            if($data[0]->rank == "lecturer"){
                return $data;
            }
        }
        return false;
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

    public function searchForProfessors($search)
    {
        $query = "SELECT * FROM users WHERE (f_name LIKE :name OR l_name LIKE :name OR username LIKE :name) AND rank = :rank ";
        $search = '%' . $search . '%';
        return $this->db->read($query,[
           "name"=>$search,
            "rank"=>"lecturer"
        ]);
    }



}
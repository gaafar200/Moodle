<?php
class Stud extends User
{
    public const RANK = "student";
    public function validateStudentData($data,$image)
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
        $check = $this->validateGender($gender);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidImage($image);
        if(is_array($check)){
            return $check;
        }
        return true;
    }

    public function registerNewStudent($data,$image,$creator)
    {
        if($this->Auth->hasRightPrivilege("techEmployee")){
            unset($data["confirmpassword"]);
            $check = $this->addToDataBase($image,$data,$creator);
            $check = $this->getFileSystemReady();
            $result = $this->storeImageInTheFileSystem($data["username"],$image);
            return $check;
        }


    }

    private function addToDataBase($image, $data, $creator)
    {
        $data["photo"] = $this->getImageServerPath($image);
        $data["password"] = sha1($data["password"]);
        $data["created_by"] = $this->getCreatorId();
        $data["university_id"] = $this->createUniqueUniversityId($data["gender"]);
        $data["rank"] = self::RANK;
        echo "<pre>";
        print_r($data);
        echo "<pre>";
        $query = "INSERT INTO users (university_id,f_name,l_name,address,phone_number,username,password,gender,email,photo,rank,created_by) VALUES(:university_id,:firstname,:lastname,:address,:mobileno,:username,:password,:gender,:email,:photo,:rank,:created_by)";
        if($this->db->write($query,$data)){
            return true;
        }
        return false;
    }

    private function createUniqueUniversityId($gender)
    {
        $universityid = "";
        $universityid .= $gender == "male" ? 1 : 2;
        $universityid .= date("Y");
        $universityid .= $this->generateRandomString(4,"numbersOnly");
        return $universityid;
    }

    public function getAllStudent()
    {
        return $this->getAllUsersWithRank(self::RANK);
    }

    public function deleteStudentFromSystem($username)
    {
        $query = "SELECT photo FROM users WHERE username = :username";
        $data = $this->db->read($query,
        [
            "username"=>$username
        ]);
        $this->deletephoto($data[0]->photo);
        $this->deleteStudentFromDataBase($username);
    }

    private function deleteStudentFromDataBase($username)
    {
        $query = "DELETE FROM users WHERE username = :username";
        $this->db->write($query,
        [
           "username"=>$username
        ]);
    }

    public function replacePhoto()
    {
    }


}
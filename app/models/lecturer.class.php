<?php

class lecturer extends User
{
    public function validateProfData($data,$image)
    {
        foreach ($data as $key => $value){
            $$key = $value ?? false;
        }
        $image = isset($image) ? $image : false;
        $check = $this->isVaildName($first_name);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isVaildName($last_name);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidAddress($address);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidMobilNo($mobileNo);
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
        $check = $this->validateThePasswords($password,$confirmPassword);
        if(is_array($check)) {
            return $check;
        }
        if(!$this->isValidImage($image)){
            return ["image"=>"please upload an image"];
        }
        return true;
    }

}
<?php

function show($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
/* start Edit Lecturer Info part */
function checkVaildData($lecturerData){
    if(isset($lecturerData) && is_array($lecturerData) && !empty($lecturerData)){
        return true;
    }
    return false;
}
function displayFirstName($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->f_name;
}
function displayLastName($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->l_name;
}
function displayAddress($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->address;
}
function displayMobileNumber($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->phone_number;
}
function displayEmailAddress($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->email;
}
function displayUserName($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->username;
}

function setUserName($lecturerData){
    if(checkVaildData($lecturerData) === false){
        return "";
    }
    return "readonly";
}
function displayGender($data,$gender){
    if(checkVaildData($data) === false){
        return "";
    }
    if($data[0]->gender == $gender){
        return "selected";
    }
}
function displayLecturerDiscription($data){
    if(checkVaildData($data) === false){
        return "";
    }
    return $data[0]->description;
}

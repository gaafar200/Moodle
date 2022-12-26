<?php

function show($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
/* start Edit Lecturer Info part */
function checkVaildLecturerData($lecturerData){
    if(isset($lecturerData) && is_array($lecturerData) && !empty($lecturerData)){
        return true;
    }
    return false;
}
function displayLecturerFirstName($lecturerData){
    if(checkVaildLecturerData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->f_name;
}
function displayLecturerLastName($lecturerData){
    if(checkVaildLecturerData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->l_name;
}
function displayLecturerAddress($lecturerData){
    if(checkVaildLecturerData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->address;
}
function displayLecturerMobileNumber($lecturerData){
    if(checkVaildLecturerData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->phone_number;
}
function displayEmailAddress($lecturerData){
    if(checkVaildLecturerData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->email;
}
function displayUserName($lecturerData){
    if(checkVaildLecturerData($lecturerData) === false){
        return "";
    }
    return $lecturerData[0]->username;
}

function setUserName($lecturerData){
    if(checkVaildLecturerData($lecturerData) === false){
        return "";
    }
    return "readonly";
}
function displayGender($data,$gender){
    if(checkVaildLecturerData($data) === false){
        return "";
    }
    if($data[0]->gender == $gender){
        return "selected";
    }
}

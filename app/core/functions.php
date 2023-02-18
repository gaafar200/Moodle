<?php

function show($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * start User Info part
 */
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
/**
 * end user Info Part
 */

/**
 * start Course Info part
 */
function checkValidCourseData($data){
    if(is_array($data) && !empty($data)){
        return true;
    }
    return false;
}
function displayCourseName($data){
    if(checkValidCourseData($data)){
        return $data[0]->name;
    }
    return "";
}
function displayCourseDescription($data){
    if(checkValidCourseData($data)){
        return $data[0]->description;
    }
    return "";
}
function displayCourseLecturerUsername($data){
    if(checkValidCourseData($data)){
        return $data[0]->username;
    }
    return "";
}
/**
 * Authorization Section
 */
function checkAuthorization($requiredAuthoriztion){
    $Auth = new Auth();
    return $Auth->hasRightPrivilege($requiredAuthoriztion);
}

/**
 * Quiz Data Section
 */
function checkQuizDataIsValid($data){
    if(is_array($data)){
        return true;
    }
    return false;
}
function displayQuizName($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->name;
    }
    return " ";
}
function displayQuizDate($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->quiz_date;
    }
    return " ";
}
function displayQuizStartTime($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->start_time;
    }
    return " ";
}
function displayQuizEndTime($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->end_time;
    }
    return " ";
}
function displayQuizNumberOfQuestions($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->number_of_questions;
    }
    return " ";
}
function displayQuizTime($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->time;
    }
    return " ";
}
function displayQuizMark($data){
    
}
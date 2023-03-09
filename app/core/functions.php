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
    if(checkQuizDataIsValid($data)){
        return $data[0]->mark_value;
    }
    return " ";
}
function displayQuizMaxAttempts($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->max_attempts;
    }
    return " ";
}
function checkQuizMoveBetweenQuestions($data,$value){
    if(checkQuizDataIsValid($data)){
        if($data[0]->is_recursive == $value){
            return "selected";
        }
    }
    return " ";
}
function checkQuizAutoCorrect($data,$value){
    if(checkQuizDataIsValid($data)){
        if($data[0]->is_auto_correct == $value){
            return "selected";
        }
    }
    return " ";
}
function checkQuizShuffled($data,$value){
    if(checkQuizDataIsValid($data)){
        if($data[0]->is_shuffled == $value){
            return "selected";
        }
    }
    return " ";
}
function checkQuizDisclosed($data,$value){
    if(checkQuizDataIsValid($data)){
        if($data[0]->is_disclosed == $value){
            return "selected";
        }
    }
    return " ";
}
function DisplayQuizDescription($data){
    if(checkQuizDataIsValid($data)){
        return $data[0]->description;
    }
    return " ";
}
/**
 * Questions Section
 */
function checkFieldOkay($data,$type = ""):bool{
    if(isset($data)){
        if($type == ""){
            return true;
        }
        else{
            if($type == $data[0]->question_type){
                return true;
            }
        }
    }
    return false;
}
 function displayQuestion($data){
    if(checkFieldOkay($data)){
        return $data[0]->question;
    }
    return "";
 }

 function displayQuestionMark($data){
    if(checkFieldOkay($data)){
        return $data[0]->mark_value;
    }
    return "";
 }
 function checkIfQuestionIsOfThisType($data,$type){
    if(checkFieldOkay($data)){
        if($type == "One" && $data[0]->question_type == "trueOrFalse"){
            return "Selected";
        }
        else if($type == "Two" && $data[0]->question_type == "multiableChoice"){
            return "Selected";
        }
        else if($type == "Three" && $data[0]->question_type == "essayQuestion"){
            return "Selected";
        }
    }
    return "";
 }
 function checkIfThisIsRightAnswer($question_data, $choice,$type):string{
    if(checkFieldOkay($question_data,$type)){
        if($choice->is_right_answer == 1){
            return "Selected";
        }
    }
    return "";
 }
 function checkIfQuestionHaveMultibleAnswer($data,$choice,$type,$value){
    if(checkFieldOkay($data,$type)){
        $count = 0;
        foreach ($choice as $c){
            if($c->is_right_answer == 1){
                $count++;
            }
        }
        if($count > 1 && $value == "yes"){
            return "Selected";
        }
        else if($count == 1 && $value == "no"){
            return "Selected";
        }
    }
    return "";
 }

 function displayQuestionChoice($data,$choice,$type){
     if(checkFieldOkay($data,$type)){
         return $choice->choice;
     }
     return "";
 }
 function displayQuestionCorrectAnswers($data,$choice,$type){
    if(checkFieldOkay($data,$type)){
        $count = 0;
        $correctAnswer = "";
        for($i = 0;$i < sizeof($choice);$i++){
            if($choice[$i]->is_right_answer == 1){
                if($count == 0){
                    $correctAnswer = "" . ($i + 1);
                    $count++;
                }
                else{
                    $correctAnswer .= "&" . ($i + 1);
                }
            }
        }
        return $correctAnswer;
    }
    return "";
 }

/**
 * @return string
 *
 */
 function checkCanAddMoreQuestions($question_mark,$marks_left,$number_of_questions_left):string{
     if($question_mark > $marks_left){
         return "disabled";
     }
     if($number_of_questions_left == 0){
         return "disabled";
     }
     return "";
 }
 function isActiveButtonActive($quiz_status):string{
     if($quiz_status == "inactive"){
         return "disabled";
     }
     return "";
 }
function displayCourseSideBar():string{

}
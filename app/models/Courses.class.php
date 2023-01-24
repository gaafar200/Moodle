<?php
class Courses{

    public function validateData($data,$image)
    {
        foreach ($data as $key => $value){
            $$key = $value ?? false;
        }
        $check = $this->isValidName($coursename);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidDescription($description);
        if(is_array($check)){
            return $check;
        }
        $check = $this->isValidLecturer($professorusername);
        if(is_array($professorusername)){
            return $check;
        }
        $check = $this->validateImage($image);
        if(is_array($check)){
            return $check;
        }
        return true;

    }

    private function isValidName($coursename)
    {
        if(strlen($coursename) < 3){
            return ["coursename"=>"Course Name can not be less than 3 characters"];
        }
        if(!preg_match("/^[A-Za-z0-9 ]+$/",$coursename)){
            return["coursename"=>"Course Name must only consist of Characters and numbers"];
        }
        return true;
    }

    private function isValidDescription($description)
    {
        if(strlen($description) < 3){
            return ["description"=>"Description can not be less than 3 characters"];
        }
        if(!preg_match("/^[A-Za-z0-9 ]+$/",$description)){
            return["coursename"=>"Course Name must only consist of Characters and numbers"];
        }
        return true;
    }

    private function isValidLecturer($professorusername)
    {
        $lect = new lecturer();
        $check = $lect->isValidUserName($professorusername);
        if(is_array($check)){
            return $check;
        }
        $check = $lect->checkIfProfessorExists($professorusername);
        if($check == false){
            return ["username"=>"this professor does not exists"];
        }
        return true;
    }

    private function validateImage($image)
    {
        if ($image['image']['error'] !== UPLOAD_ERR_OK) {
            return ["image"=>"Upload failed with error code " . $image['image']['error']];
        }
        $info = getimagesize($image['image']['tmp_name']);
        if ($info === FALSE) {
            return ["image"=>"please upload an image"];
        }
        return true;
    }

    public function addCourse($data,$image,$creator_data)
    {
       $courseData["lecturer_id"] = $this->getLecturerId($data["professorusername"]);
       $courseData["date"] = date("y-m-d h:i:s");
       $courseData["status"] = "active";
       $courseData["language"] = "English";
       $courseData["created_by"] = $creator_data->id;
       $courseData["name"] = $data["coursename"];
       $query = "INSERT INTO course (name,date,status,language,lecturer_id,created_by) VALUES(:name,:date,:status,:language,:lecturer_id,:created_by)";
       $db = new database();
       $result = $db->write($query,$courseData);
       return $result;
    }

    private function getLecturerId(mixed $professorusername)
    {
        $lect = new Lecturer();
        $data = $lect->checkIfProfessorExists($professorusername);
        return $data[0]->id;
    }
}
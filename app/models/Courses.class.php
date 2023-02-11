<?php
class Courses extends Model{
    public Image $image;
    public lecturer $lecturer;
    public function __construct(){
        parent::__construct();
        $this->image = new Image();
        $this->lecturer = new lecturer();
    }

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
        $check = $this->image->isValidImage($image);
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
        $check = $this->lecturer->isValidUserName($professorusername);
        if(is_array($check)){
            return $check;
        }
        $check = $this->lecturer->checkIfProfessorExists($professorusername);
        if($check){
            return ["username"=>"this professor does not exists"];
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
       $courseData["description"] = $data["description"];
       $courseData["photo"] = $this->image->uploadToFileSystem($image,"course");
       $query = "INSERT INTO course (name,date,status,language,lecturer_id,created_by,photo,description) VALUES(:name,:date,:status,:language,:lecturer_id,:created_by,:photo,:description)";
       return $this->db->write($query,$courseData);
    }

    private function getLecturerId($username)
    {
        $data = $this->lecturer->checkIfProfessorExists($username);
        return $data[0]->id;
    }

    public function getCoursesData()
    {
        $query = "SELECT u.username,u.f_name,u.l_name,c.name,c.id,c.photo,c.id From users u join course c ON(c.lecturer_id = u.id)";
        $db = new database();
        $data = $db->read($query);
        if(!is_array($data) || empty($data)){
            return false;
        }
        foreach ($data as $course){
            $course->students = $this->getNumberOfStudentInACourse($course->id);
        }
        return $data;
    }
    //todo
    private function getNumberOfStudentInACourse($id): int
    {
        $query = "SELECT count(student_id) as count FROM student_courses WHERE course_id = :id";
        $data = $this->db->read($query,
        [
           "id"=>$id
        ]);
        if(is_array($data) && !empty($data)){
            return $data[0]->count;
        }
        return 0;
    }


    public function getCourseData($id)
    {
        $query = "SELECT u.username,u.f_name,u.l_name,c.name,c.id,c.photo,c.id,c.description From users u join course c ON(c.lecturer_id = u.id) WHERE c.id = :id";
        return $this->db->read($query,
        [
           "id" => $id
        ]);
    }

    public function delete($id): bool | array
    {
        $check = $this->DoesCourseExists($id);
        if(!$check){
            return ["course"=>"course is not found"];
        }
        $this->removeAllStudentsFromThisCourse($id);
        $query = "DELETE FROM course WHERE id = :id";
        return $this->db->write($query,
        [
           "id"=>$id
        ]);
    }

    public function DoesCourseExists($id): bool
    {
        $query = "SELECT id FROM course WHERE id = :id";
        $data = $this->db->read($query,
        [
           "id"=>$id
        ]);
        if(is_array($data) && !empty($data)){
            return true;
        }
        return false;
    }

    private function removeAllStudentsFromThisCourse($id)
    {
        $query = "DELETE FROM student_courses WHERE course_id = :id";
        return $this->db->write($query,
        [
           "id"=>$id
        ]);
    }

    public function editCourseData($id)
    {

    }
}
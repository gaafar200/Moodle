<?php
class Course extends Controller
{
    public courses $course;
    public $errors;
    public function __construct()
    {
        parent::__construct();
        $this->course = new courses();
    }

    public function index(){
        $this->data["pageName"] = "All Courses";
        $this->data["coursesData"] = $this->course->getCoursesData();
        $this->view("all-courses",$this->data);
    }
    public function edit(){
        $this->data["pageName"] = "Edit Course";
        $this->view("edit-course",$this->data);
    }
    public function Info($id){
        $this->data["pageName"] = "Course Info";
        $this->data["courseDetails"] = $this->course->getCourseData($id);
        $this->view("course-info",$this->data);
    }
    public function add(){
        $this->data["pageName"] = "add Course";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->errors = $this->course->validateData($_POST,$_FILES);
            if($this->errors === true){
                $result = $this->course->addCourse($_POST,$_FILES,$this->data["user"]);
                if($result){
                    $this->redirect("Course");
                }
            }
            else{
                $this->data["errors"] = $this->errors;
            }
        }
        $this->view("add-course",$this->data);
    }
    public function delete($id){
        $this->data["pageName"] = "All Courses";
        $result = $this->course->delete($id);
        if($result){
            $this->errors = $result;
        }
        $this->data["coursesData"] = $this->course->getCoursesData();
        $this->data["errors"] = $this->errors;
        $this->view("all-courses",$this->data);
    }
    public function addStudents($id){
        $this->data["pageName"] = "add students";
        //$this->view("add-students-list",$this->data);
    }
    public function removeStudents($id){
        $this->data["pageName"] = "remove students";
       //$this->view("remove-students-list",$this->data);
    }

}
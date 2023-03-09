<?php

class StudentQuizes extends Controller
{
    public studQuizes $studQuizes;
    public function __construct()
    {
        parent::__construct();
        $this->studQuizes = new studQuizes();
    }

    public function perform(int $quiz_id,int $course_id){
        if($this->studQuizes->checkStudentCanPerformQuiz($this->data["user"],$quiz_id,$course_id)){
            $this->studQuizes->performQuiz($this->data["user"],$quiz_id);
        }
        else{
            $this->forbidden();
        }

    }

}
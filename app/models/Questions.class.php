<?php

Abstract class Questions extends Model
{
    public Image $image;
    public function __construct(){
        parent::__construct();
        $this->image = new Image();
    }
    public function ValidateBasicQuestionData($data,$course_id,$image = ""):bool | array{
        $course = new Courses();
        $check = $course->DoesCourseExists($course_id);
        if(!$check){
            return["course"=>"course does not exists"];
        }
        $check = $this->ValidateQuestionType($data["question_type"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->ValidateQuestion($data["question"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->ValidateMarkValue($data["mark"]);
        if(is_array($check)) {
            return $check;
        }
        $check = $this->ValidateQuestionUnique($data["question"],$course_id);
        if(is_array($check)){
            return $check;
        }
        if($image != ""){
            $check = $this->image->isValidImage($image);
            if(is_array($check)){
                return $check;
            }
        }
        return true;
    }
    public function ValidateQuestionType($type):bool |array{
        $types = ["One","Two","Three"];
        if(!in_array($type,$types)){
            return ["question_type"=>"please Enter Valid Question Type"];
        }
        return true;
    }
    public function ValidateQuestion($question):bool | array{
        if(strlen($question) <= 5){
            Return ["question"=>"any Question must be at least more than 5 characters"];
        }
        return true;
    }
    public function ValidateMarkValue($mark_value): bool | array{
        if($mark_value <= 0 || $mark_value >= 99){
            return ["question"=>"question mark must be reasonable"];
        }
        return true;
    }

    public function getAllQuestionTypes():array
    {
        $sql = "SELECT name FROM question_type";
        return $this->db->read($sql);
    }
    function validateQuestionData($data,$course_id,$image = ""):array | bool{
        $check = $this->ValidateBasicQuestionData($data,$course_id,$image);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateSpecificTypeData($data);
        if(is_array($check)){
            return $check;
        }
        return true;
    }
    abstract function validateSpecificTypeData($data):bool | array;
    public function addQuestion(array $data,int $course_id,$image){
        if(!is_uploaded_file($image["image"]["tmp_name"])){
            $image = "";
        }
        $check = $this->validateQuestionData($data,$course_id,$image);
        if(is_array($check)){
            return $check;
        }
        $data = $this->getDataReady($data,$course_id,$image);
        return  $this->addQuestionToOurCourse($data);
    }
    public function addQuestionToOurCourse($data):bool{
        $query = "INSERT INTO question (question_type,question,mark_value,course_id,photo) VALUES(:question_type,:question,:mark,:course_id,:image)";
        $question =   $this->db->write($query,
            [
                "question_type"=>$data["question_type"],
                "question"=>$data["question"],
                "mark"=>$data["mark"],
                "course_id"=>$data["course_id"],
                "image"=>$data["image"]
            ]);
        $choices = $this->addAnswersToTheQuestion($data);
        return $question && $choices;
    }
    abstract function addAnswersToTheQuestion($data);
    public function getDataReady($data,$course_id,$image = ""){
        $data["course_id"] = $course_id;
        if($image != ""){
            $data["image"] = $this->image->uploadToFileSystem($image,"question");
        }
        else{
            $data["image"] = $image;
        }
        $data["question_type"] = $this->setQuestionTypeProbably($data["question_type"]);
        return $data;
    }

    private function setQuestionTypeProbably($question_type):string
    {
        switch($question_type){
            case "One": return "trueOrFalse";
            case "Two": return "multiableChoice";
            case "Three": return "essayQuestion";
            default: return $question_type;
        }
    }
    public function getQuestionData($question,$course_id){
        if(is_numeric($question)){
            $query = "SELECT * FROM question WHERE id = :question AND course_id = :course_id LIMIT 1";
        }
        else{
            $query = "SELECT * FROM question WHERE question = :question AND course_id = :course_id LIMIT 1";
        }
        return $this->db->read($query,[
            "question"=>$question,
            "course_id"=>$course_id
        ]);
    }
    public function getQuestionId($question,$course_id) : int{
        $data = $this->getQuestionData($question,$course_id);
        if($data){
            return $data[0]->id;
        }
        return -1;
    }

    private function ValidateQuestionUnique($question, $course_id): bool | array
    {
        $query = "SELECT question_type FROM question WHERE question = :question AND course_id = :course_id LIMIT 1";
        $result = $this->db->read($query,[
            "question"=>$question,
            "course_id"=>$course_id
        ]);
        if($result){
            return ["question"=>"The Question must be unique within the course"];
        }
        return true;
    }

    public function getAllQuestions(int $course_id)
    {
        $query = "SELECT id,question,question_type as type,mark_value as mark FROM question WHERE course_id = :course_id";
        return $this->db->read($query,[
           "course_id"=>$course_id
        ]);
    }

    public function deleteQuestion(int $course_id, int $question_id):void
    {
        $query = "DELETE FROM question WHERE course_id = :course_id AND id = :question_id";
        $this->db->write($query,
        [
           "question_id"=>$question_id,
           "course_id"=>$course_id
        ]);
        $this->deleteQuestionChoices($question_id);
        $this->deleteQuestionFromCourses($question_id);
    }

    private function deleteQuestionChoices(int $question_id):void
    {
        $query = "DELETE FROM question_choice WHERE question_id = :question_id";
        $this->db->write($query,
        [
           "question_id"=>$question_id
        ]);
    }

    private function deleteQuestionFromCourses(int $question_id)
    {
        //todo
    }

    public function editQuestion(int $course_id, int $question_id, array $data):bool | array
    {
        $check = $this->validateEditData($data,$course_id);
        if(is_array($check)){
            return $check;
        }
        $data = $this->getDataReady($data,$course_id);
        $data = $this->getDataReadyForEdit($data,$question_id);
        return $this->editData($data);
    }

    public function getQuestionChoices(int $question_id):bool | array
    {
        $query = "SELECT choice,is_right_answer FROM question_choice WHERE question_id = :question_id";
        return $this->db->read($query,
        [
            "question_id"=>$question_id
        ]);
    }

    private function getDataReadyForEdit($data, int $question_id)
    {
        unset($data["image"]);
        $data["question_id"] = $question_id;
        return $data;
    }

    private function editData($data)
    {
        $query = "UPDATE question SET question_type = :question_type,
        question = :question,
        mark_value = :mark
        WHERE id = :question_id AND course_id = :course_id";
        $check1 = $this->db->write($query,[
            "question_type"=>$data["question_type"],
            "question"=>$data["question"],
            "mark"=>$data["mark"],
            "question_id"=>$data["question_id"],
            "course_id"=>$data["course_id"]
        ]);
        $check2  = $this->editChoices($data);
        return $check1 && $check2;
    }
    public abstract function editChoices(array $data):bool;

    private function validateBasicEditData(array $data, int $course_id)
    {
        $course = new Courses();
        $check = $course->DoesCourseExists($course_id);
        if(!$check){
            return["course"=>"course does not exists"];
        }
        $check = $this->ValidateQuestionType($data["question_type"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->ValidateQuestion($data["question"]);
        if(is_array($check)){
            return $check;
        }
        $check = $this->ValidateMarkValue($data["mark"]);
        if(is_array($check)) {
            return $check;
        }
        return true;
    }

    private function validateEditData(array $data, int $course_id)
    {
        $check = $this->validateBasicEditData($data,$course_id);
        if(is_array($check)){
            return $check;
        }
        $check = $this->validateSpecificTypeData($data);
        if(is_array($check)){
            return $check;
        }
        return true;
    }

    public function getAllQuestionsNotInTheQuiz(int $course_id,int $quiz_id):array | bool
    {
        $query = "SELECT id,question,question_type as type,mark_value as mark FROM question WHERE course_id = :course_id AND id NOT IN(SELECT question_id FROM quiz_questions WHERE quiz_id = :quiz_id)";
        return $this->db->read($query,[
            "course_id"=>$course_id,
            "quiz_id"=>$quiz_id
        ]);
    }

    public function getAllQuestionsInTheQuiz(int $course_id, int $quiz_id):array | bool
    {
        $query = "SELECT id,question,question_type as type,mark_value as mark FROM question INNER JOIN quiz_questions ON (id = question_id)WHERE course_id = :course_id AND quiz_id = :quiz_id";
        return $this->db->read($query,[
           "course_id"=>$course_id,
           "quiz_id"=>$quiz_id
        ]);
    }

    public function addQuestionToTheQuiz(mixed $question_id, int $quiz_id):bool | array
    {
        $query = "INSERT INTO quiz_questions (question_id,quiz_id) VALUES(:question_id,:quiz_id)";
        return $this->db->write($query,
        [
            "question_id"=>$question_id,
            "quiz_id"=>$quiz_id
        ]);
    }

}
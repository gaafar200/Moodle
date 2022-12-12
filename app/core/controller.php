<?php

class Controller
{
    public Auth $Auth;
    public User $user;
    public array $data = array();
    public function __construct()
    {
        $this->user = new User();
        $this->Auth = new Auth();
        $result = $this->Auth->is_logged_in();
        if($result){
            $this->data["user"] = $result[0];
       }
        else{
            $this->redirect("Login");
        }
    }

    public function view($path , $data = [])
    {
        extract($data);
        if(file_exists("../app/views/" . $path . ".view.php"))
        {
            include "../app/views/" . $path . ".view.php";
        }
    }
    public function redirect($path = ""){
        header("Location: " . ROOT . $path);
        die;
    }

}
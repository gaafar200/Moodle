<?php

class Login extends Controller
{
    public function index(){
        $data = array();
        $user = new User();
        if(isset($_POST)){
             $check = $user->validateLogin($_POST);
             if($check === true){
                $login = $user->login($_POST);
                if($login !== false){
                    header("Location: " . ROOT . "Home");
                    exit(0);
                }
             }
        }
        $this->view("login");
    }

}
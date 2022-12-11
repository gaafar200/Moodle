<?php

class Login extends Controller
{
    public function index(){
        $data = array();
        $user = new User();
        $Auth = new Auth();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
             $check = $user->validateLoginData($_POST);
             if($check === true){
                $login = $Auth->login($_POST);
                if($login !== false){
                    $this->redirect("Home",$login);
                }
             }
        }
        $this->view("login");
    }

}
<?php

class Home extends Controller
{

    public function index()
    {
        $user = new User();
        if($user->is_logged_in()){
            $this->view("index");
        }
        else{
            header("Location: " . ROOT . "Login");
        }

    }
}
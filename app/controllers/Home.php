<?php

class Home extends Controller
{
    public function index()
    {
         $this->data["user"] = $this->Auth->is_logged_in();
        if($this->data["user"]){
            $this->view("index",$this->data);
        }
        else{
            $this->redirect("Login");
        }

    }
}
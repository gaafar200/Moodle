<?php

class Admin extends Controller
{
    public function profile(){
        $this->view("Admin-profile",$this->data);
    }

}
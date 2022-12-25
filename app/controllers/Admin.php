<?php

class Admin extends Controller
{
    public function profile(){
        $this->view("admin-profile",$this->data);
    }

}
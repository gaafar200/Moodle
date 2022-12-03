<?php

class Controller
{
    public function view($path , $data = [])
    {
        if(file_exists("../app/views/" . $path . ".view.php"))
        {
            include "../app/views/" . $path . ".view.php";
        }
    }

    public function load_model($model)
    {
        if(file_exists("../app/models/" . strtolower($model) . ".class.php"))
        {
            include "../app/models/" . strtolower($model) . ".class.php";
            return $a = new $model();
        }
        return false;
    }

}
<?php

class MultibaleTypeQuestion extends Question
{
    public function validateMaxNumberOfFiles($max_number): bool | array{
        if($max_number > 10 || $max_number < 1){
            return ["MaxNumberOfFiles"=>"The Question number of files must be between 1 & 10"];
        }
        return true;
    }
    public function maxSizeAllowed($maxSize) : bool | array{
        if($maxSize <= 0.0 && $maxSize > 10.0){
            return ["size allowed must be between 0.0 & 10.0"];
        }
        return true;
    }
}
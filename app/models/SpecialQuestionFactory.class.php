<?php

class SpecialQuestionFactory implements IQuestionFactory
{

    public function getQuestion(string $type = "none"): Questions
    {
        if($type == "Two"){
            return new MultibaleTypeQuestion();
        }
        else if($type == "Three"){
            return new EassyTypeQuestion();
        }
        else{
            return new YesNoTypeQuestion();
        }
    }
}
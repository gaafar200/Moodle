<?php

class EassyTypeQuestion extends Questions
{

    function validateSpecificTypeData($data): bool|array
    {
        return true;
    }

    function addAnswersToTheQuestion($data): bool
    {
        return true;
    }
}
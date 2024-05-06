<?php

//This function validates name to find if it has any numbers, only allows alphabets.
function validName($StringName) {
    return preg_match('/^[a-zA-Z]+$/', $StringName) === 1;
}

function validGithub($url) {
    return strpos($url, 'https://github.com/') === 0;
}

//This will validate if the years of experience value is matching the array which defined it.
function validExperience($experiencevalue) {
    return array_search($experiencevalue, getExperience());
}

function validPhone($phoneNum) {

    $phoneNum = preg_replace('/[^0-9]/', '', $phoneNum);

    return strlen($phoneNum) === 10; //ensures there are only 10 digits in the number
}

function validEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
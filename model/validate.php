<?php

//Validates a name to ensure it contains only alphabetic characters.
function validName($StringName) {
    return preg_match('/^[a-zA-Z]+$/', $StringName) === 1;
}

//Validates a GitHub URL.
function validGithub($url) {


    return filter_var($url, FILTER_VALIDATE_URL);
}

//Validates a years of experience value against a predefined array which is used to fill the radio options.
function validExperience($experiencevalue) {
    return array_search($experiencevalue, getExperience());
}

//Validates a phone number to ensure it contains only numeric characters and has a length of 10 digits.
function validPhone($phoneNum) {

    $phoneNum = preg_replace('/[^0-9]/', '', $phoneNum);

    return strlen($phoneNum) === 10; //ensures there are only 10 digits in the number
}

//Validates an email address.
function validEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Validates a mailing job against a predefined array.
function validMailingJobs($mailingJob) {
    $validJobs = getJobs();
    // If it's an array, validate each element
    if (is_array($mailingJob)) {
        foreach ($mailingJob as $job) {
            if (!in_array($job, $validJobs)) {
                return false;
            }
        }
        return true;
    } else {
        // If it's a single value, validate it directly
        return in_array($mailingJob, $validJobs) || $mailingJob == "";
    }
}

// Validates a mailing vertical against a predefined array.
function validMailingVerticals($mailingVertical) {
    $validVerticals = getMailingList();
    // If it's an array, validate each element
    if (is_array($mailingVertical)) {
        foreach ($mailingVertical as $vertical) {
            if (!in_array($vertical, $validVerticals)) {
                return false;
            }
        }
        return true;
    } else {
        // If it's a single value, validate it directly
        return in_array($mailingVertical, $validVerticals) || $mailingVertical == "";
    }
}

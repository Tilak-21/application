<?php

//This function validates name to find if it has any numbers, only allows alphabets.
function validName($StringName) {
    return preg_match('/^[a-zA-Z]+&/',$StringName);
}

function validGithub($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false && strpos($url, 'github.com') !== false;
}


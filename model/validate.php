<?php
/**
 * Validates a name to ensure it contains only alphabetic characters.
 *
 * @param string $StringName The name to validate
 * @return bool Returns true if the name is valid, false otherwise
 */
function validName($StringName)
{
    return preg_match('/^[a-zA-Z]+$/', $StringName) === 1;
}

/**
 * Validates a GitHub URL.
 *
 * @param string $url The GitHub URL to validate
 * @return mixed Returns the filtered URL if valid, false otherwise
 */
function validGithub($url)
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

/**
 * Validates a years of experience value against a predefined array.
 *
 * @param string $experiencevalue The years of experience value to validate
 * @return mixed Returns the index of the experience value if valid, false otherwise
 */
function validExperience($experiencevalue)
{
    // Allowed experiences
    $allowedExperiences = array('0-2 years', '2-5 years', '5-10 years', '10+ years');

    // Check if the selected experience is in the list of allowed experiences
    return in_array($experiencevalue, $allowedExperiences);
}

/**
 * Validates a phone number to ensure it contains only numeric characters and has a length of 10 digits.
 *
 * @param string $phoneNum The phone number to validate
 * @return bool Returns true if the phone number is valid, false otherwise
 */
function validPhone($phoneNum)
{
    $phoneNum = preg_replace('/[^0-9]/', '', $phoneNum);
    return strlen($phoneNum) === 10;
}

/**
 * Validates an email address.
 *
 * @param string $email The email address to validate
 * @return mixed Returns the filtered email address if valid, false otherwise
 */
function validEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Validates a mailing job against a predefined array.
 *
 * @param mixed $mailingJob The mailing job(s) to validate
 * @return bool Returns true if the mailing job(s) are valid, false otherwise
 */
function validMailingJobs($mailingJob)
{
    $validJobs = getJobs();
    if (is_array($mailingJob)) {
        foreach ($mailingJob as $job) {
            if (!in_array($job, $validJobs)) {
                return false;
            }
        }
        return true;
    } else {
        return in_array($mailingJob, $validJobs) || $mailingJob == "";
    }
}

/**
 * Validates a mailing vertical against a predefined array.
 *
 * @param mixed $mailingVertical The mailing vertical(s) to validate
 * @return bool Returns true if the mailing vertical(s) are valid, false otherwise
 */
function validMailingVerticals($mailingVertical)
{
    $validVerticals = getMailingList();
    if (is_array($mailingVertical)) {
        foreach ($mailingVertical as $vertical) {
            if (!in_array($vertical, $validVerticals)) {
                return false;
            }
        }
        return true;
    } else {
        return in_array($mailingVertical, $validVerticals) || $mailingVertical == "";
    }
}


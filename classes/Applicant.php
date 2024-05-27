<?php

/**
 * Class Applicant - Represents an applicant for a job.
 *
 * This class encapsulates the information about a job applicant including
 * their personal details, experience, and preferences.
 *
 *
 * @package  Applicant
 * @author   Tilak K Chudasama
 */


class Applicant
{
    private $_fname;
    private $_lname;
    private $_email;
    private $_state;
    private $_phone;
    private $_github;
    private $_experience;
    private $_relocate;
    private $_bio;


    /**
     * Constructor to initialize an Applicant object.
     *
     * @param string $fname  First name of the applicant
     * @param string $lname  Last name of the applicant
     * @param string $email  Email address of the applicant
     * @param string $state  State of residence of the applicant
     * @param string $phone  Phone number of the applicant
     *
     * @return void
     */
    public function __construct($fname, $lname, $email, $state, $phone)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_email = $email;
        $this->_state = $state;
        $this->_phone = $phone;
    }

    // Getters

    /**
     * Get the first name of the applicant.
     *
     * @return string First name of the applicant
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Get the last name of the applicant.
     *
     * @return string Last name of the applicant
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Get the email address of the applicant.
     *
     * @return string Email address of the applicant
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Get the state of residence of the applicant.
     *
     * @return string State of residence of the applicant
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Get the phone number of the applicant.
     *
     * @return string Phone number of the applicant
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Get the GitHub username of the applicant.
     *
     * @return string GitHub username of the applicant
     */
    public function getGithub()
    {
        return $this->_github;
    }

    /**
     * Get the experience details of the applicant.
     *
     * @return string Experience details of the applicant
     */
    public function getExperience()
    {
        return $this->_experience;
    }

    /**
     * Get the relocation preference of the applicant.
     *
     * @return string Relocation preference of the applicant
     */
    public function getRelocate()
    {
        return $this->_relocate;
    }

    /**
     * Get the biography of the applicant.
     *
     * @return string Biography of the applicant
     */
    public function getBio()
    {
        return $this->_bio;
    }

    // Setters

    /**
     * Set the first name of the applicant.
     *
     * @param string $fname First name of the applicant
     *
     * @return void
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * Set the last name of the applicant.
     *
     * @param string $lname Last name of the applicant
     *
     * @return void
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * Set the email address of the applicant.
     *
     * @param string $email Email address of the applicant
     *
     * @return void
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Set the state of residence of the applicant.
     *
     * @param string $state State of residence of the applicant
     *
     * @return void
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * Set the phone number of the applicant.
     *
     * @param string $phone Phone number of the applicant
     *
     * @return void
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Set the GitHub username of the applicant.
     *
     * @param string $github GitHub username of the applicant
     *
     * @return void
     */
    public function setGithub($github)
    {
        $this->_github = $github;
    }

    /**
     * Set the experience details of the applicant.
     *
     * @param string $experience Experience details of the applicant
     *
     * @return void
     */
    public function setExperience($experience)
    {
        $this->_experience = $experience;
    }

    /**
     * Set the relocation preference of the applicant.
     *
     * @param string $relocate Relocation preference of the applicant
     *
     * @return void
     */
    public function setRelocate($relocate)
    {
        $this->_relocate = $relocate;
    }

    /**
     * Set the biography of the applicant.
     *
     * @param string $bio Biography of the applicant
     *
     * @return void
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}

<?php



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

    public function __construct($fname, $lname, $email, $state, $phone)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_email = $email;
        $this->_state = $state;
        $this->_phone = $phone;
    }

    // Getters
    public function getFname()
    {
        return $this->_fname;
    }

    public function getLname()
    {
        return $this->_lname;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getState()
    {
        return $this->_state;
    }

    public function getPhone()
    {
        return $this->_phone;
    }

    public function getGithub()
    {
        return $this->_github;
    }

    public function getExperience()
    {
        return $this->_experience;
    }

    public function getRelocate()
    {
        return $this->_relocate;
    }

    public function getBio()
    {
        return $this->_bio;
    }

    // Setters
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setState($state)
    {
        $this->_state = $state;
    }

    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    public function setGithub($github)
    {
        $this->_github = $github;
    }

    public function setExperience($experience)
    {
        $this->_experience = $experience;
    }

    public function setRelocate($relocate)
    {
        $this->_relocate = $relocate;
    }

    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}

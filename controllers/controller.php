<?php

require_once ("model/data-layer.php");
require_once ("model/validate.php");
require_once ("classes/Applicant.php");
require_once ("classes/Applicant_SubscribedToLists.php");

class controller
{
    private $_f3;

    /**
     * Controller constructor.
     *
     * @param $f3
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
        session_start();
    }

    /**
     * Displays the home page.
     */
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /**
     * Handles personal information submission.
     */
    function personalInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if any field is empty
            if (!empty($_POST['firstName']) && !empty($_POST['phoneNumber']) && !empty($_POST['lastName']) && !empty($_POST['emailAddress'])) {
                // Assign variables from POST data
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $emailAddress = $_POST['emailAddress'];
                $phoneNumber = $_POST['phoneNumber'];
                $state = $_POST['state'];
                $mailingCheckbox = isset($_POST['mailingLists']) ? true : false;

                // Validation checks
                if (validName($firstName)) {
                    $this->_f3->set('SESSION.firstName', $firstName);
                } else {
                    $this->_f3->set('errors["firstName"]', 'Please enter a valid first name');
                }

                if (validName($lastName)) {
                    $this->_f3->set('SESSION.lastName', $lastName);
                } else {
                    $this->_f3->set('errors["lastName"]', 'Please enter a valid last name');
                }

                if (validEmail($emailAddress)) {
                    $this->_f3->set('SESSION.emailAddress', $emailAddress);
                } else {
                    $this->_f3->set('errors["emailAddress"]', 'Please enter a valid email address');
                }

                if (validPhone($phoneNumber)) {
                    $this->_f3->set('SESSION.phoneNumber', $phoneNumber);
                } else {
                    $this->_f3->set('errors["phoneNumber"]', 'Please enter a valid phone number');
                }

                $this->_f3->set('SESSION.Mailings', $mailingCheckbox);

                if ($mailingCheckbox) {
                    $applicantSub = new Applicant_SubscribedToLists(
                        $this->_f3->get('SESSION.firstName'),
                        $this->_f3->get('SESSION.lastName'),
                        $this->_f3->get('SESSION.emailAddress'),
                        $this->_f3->get('SESSION.state'),
                        $this->_f3->get('SESSION.phoneNumber')
                    );
                    $this->_f3->set('SESSION.applicantSubscribed', $applicantSub);
                }
                else {
                        $applicant = new Applicant(
                            $this->_f3->get('SESSION.firstName'),
                            $this->_f3->get('SESSION.lastName'),
                            $this->_f3->get('SESSION.emailAddress'),
                            $this->_f3->get('SESSION.state'),
                            $this->_f3->get('SESSION.phoneNumber')
                        );
                    $this->_f3->set('SESSION.applicant', $applicant);

                    }




                // Redirect to the next page if no errors
                if (empty($this->_f3->get('errors'))) {
                    $this->_f3->reroute('/experience');
                }
            } else {
                echo "<div class='text-center'>Please complete the form in its entirety</div>";
            }
        }

        $view = new Template();
        echo $view->render('views/personalInfo.html');
    }

    /**
     * Handles experience information submission.
     */
    function experience()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if any field is empty
            if (!empty($_POST['experience'])) {
                // Assign variables from POST data
                $biography = $_POST['biography'];
                $githubLink = $_POST['githubLink'];
                $experience = implode(", ", $_POST['experience']);
                $relocate = !empty($_POST['relocate']) ? $_POST['relocate'] : "No";

                // Add to session array
                if (validExperience($experience)) {
                    $this->_f3->set('SESSION.experience', $experience);
                } else {
                    $this->_f3->set('errors["experience"]', 'Please select a valid option.');
                }

                if (validGithub($githubLink)) {
                    $this->_f3->set('SESSION.githubLink', $githubLink);
                } else {
                    $this->_f3->set('errors["githubLink"]', 'Please enter a valid GitHub URL');
                }



                // Check if the applicant is subscribed to mailing lists
                $mailingCheckbox = $_SESSION['Mailings'];







                if ($mailingCheckbox) {
                    $this->_f3->get('SESSION.applicantSubscribed')->setGithub($githubLink);
                    $this->_f3->get('SESSION.applicantSubscribed')->setExperience($experience);
                    $this->_f3->get('SESSION.applicantSubscribed')->setBio($biography);
                    $this->_f3->get('SESSION.applicantSubscribed')->setRelocate($relocate);


                } else {


                    $this->_f3->get('SESSION.applicant')->setGithub($githubLink);
                    $this->_f3->get('SESSION.applicant')->setExperience($experience);
                    $this->_f3->get('SESSION.applicant')->setBio($biography);
                    $this->_f3->get('SESSION.applicant')->setRelocate($relocate);


                }


                // Redirect based on errors and mailing checkbox
                if ($mailingCheckbox) {
                    $this->_f3->reroute('/openings');
                } elseif (empty($this->_f3->get('errors'))) {
                    $this->_f3->reroute('/summary');
                } else {
                    echo "<div class='text-center'>Please complete the form in its entirety</div>";
                }
            }
        }

        // Adding from DataModel
        $yearsOfExperience = getExperience();
        $this->_f3->set('experiences', $yearsOfExperience);

        $view = new Template();
        echo $view->render('views/experience.html');
    }

    /**
     * Handles job openings information submission.
     */
    function openings()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Add to session array
            $listLang = !empty($_POST['listLang']) ? $_POST['listLang'] : array();
            $listVerticals = !empty($_POST['listVerticals']) ? $_POST['listVerticals'] : array();

            // Check if the selected values are valid
            if (validMailingJobs($listLang)) {
                $this->_f3->set('SESSION.language', $listLang);
            } else {
                $this->_f3->set('errors["languages"]', 'Please select a valid job mailing option');
            }

            if (validMailingVerticals($listVerticals)) {
                $this->_f3->set('SESSION.vertical', $listVerticals);
            } else {
                $this->_f3->set('errors["verticals"]', 'Please select a valid vertical mailing option');
            }

            $mailingCheckbox = $_SESSION['Mailings'];



            if($mailingCheckbox) {
                $applicant = $this->_f3->get("SESSION.applicantSubscribed");

            }
            else {
                $applicant = $this->_f3->get("SESSION.applicant");
            }

            $firstName = $applicant->getFname();
            $lastName = $applicant->getLname();
            $email = $applicant->getEmail();
            $state = $applicant->getState();
            $phone = $applicant->getPhone();
            $github = $applicant->getGithub();
            $experience = $applicant->getExperience();
            $relocate = $applicant->getRelocate();
            $bio = $applicant->getBio();

            if($mailingCheckbox) {
                $this->_f3->get('SESSION.applicantSubscribed') -> setSelectionsVerticals($listVerticals);
                $this->_f3->get('SESSION.applicantSubscribed') -> setSelectionsJobs($listLang);
                $this->_f3->get('SESSION.applicantSubscribed') -> setFname($firstName);
                $this->_f3->get('SESSION.applicantSubscribed') -> setLname($lastName);
                $this->_f3->get('SESSION.applicantSubscribed') -> setEmail($email);
                $this->_f3->get('SESSION.applicantSubscribed') -> setState($state);
                $this->_f3->get('SESSION.applicantSubscribed') -> setPhone($phone);
                $this->_f3->get('SESSION.applicantSubscribed') -> setGithub($github);
                $this->_f3->get('SESSION.applicantSubscribed') -> setExperience($experience);
                $this->_f3->get('SESSION.applicantSubscribed') -> setRelocate($relocate);
                $this->_f3->get('SESSION.applicantSubscribed') -> setBio($bio);




                $this->_f3->reroute('/summary');
            } else {
                echo "<div class='text-center'>Please correct the errors in the form</div>";
            }

        }

        // Using GET response to display the page.
        $mailingList = getJobs();
        $this->_f3->set('mailingList', $mailingList);

        $mailingListVerticals = getMailingList();
        $this->_f3->set('mailingListVerticals', $mailingListVerticals);

        $view = new Template();
        echo $view->render('views/jobOpenings.html');
    }

    /**
     * Summary of the entire form submitted.
     */
    function summary()
    {
//        var_dump($_SESSION);
        $mailingCheckbox = $_SESSION['Mailings'];
        $this->_f3->set('Mail', $mailingCheckbox);

        $this->_f3->set('app', $mailingCheckbox ? $_SESSION['applicantSubscribed'] : $_SESSION['applicant']);

        $view = new Template();
        echo $view->render('views/summary.html');

        // Clear the applicant session
        unset($_SESSION['applicantSubscribed']);
        unset($_SESSION['applicant']);
        unset($_SESSION['Mailings']);

        // Destroy the session
        echo session_unset(); // Unset all session variables
        echo session_destroy(); // Destroy the session
//        var_dump($_SESSION);

        // Start a new session for future use
        session_start();
    }


}

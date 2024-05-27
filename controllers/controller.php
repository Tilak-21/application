<?php

require_once ('model/data-layer.php');
require_once ('model/validate.php');
require_once ('classes/Applicant.php');
require_once ('classes/Applicant_SubscribedToLists.php');

/**
 * Controller Class
 *
 * This class handles the control flow of the application.
 */
class controller
{
    /** @var object The instance of the Fat-Free Framework */
    private $_f3;

    /**
     * Controller constructor.
     *
     * @param object $f3 The instance of the Fat-Free Framework
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }
    /**
     * Home Page
     *
     * Renders the home page.
     */
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }
    /**
     * Personal Information Page
     *
     * Handles the personal information form submission.
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

                if (validName($firstName) && validName($lastName) && validEmail($emailAddress) && validPhone($phoneNumber)) {
                    if ($mailingCheckbox) {
                        $applicant = new Applicant_SubscribedToLists($firstName, $lastName, $emailAddress, $state, $phoneNumber);
                    } else {
                        $applicant = new Applicant($firstName, $lastName, $emailAddress, $state, $phoneNumber);
                    }
                    $this->_f3->set('SESSION.applicant', $applicant);
                }

                $this->_f3->set('SESSION.Mailing', $mailingCheckbox);

                // Add state to session array
                $this->_f3->set('SESSION.state', $state);

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
     * Experience Page
     *
     * Handles the experience form submission.
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

                if (empty($_POST['relocate'])) {
                    $relocate = "No";

                } else {
                    $relocate = $_POST['relocate'];
                }

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

                $this->_f3->set('SESSION.biography', $biography);


                $this->_f3->set('SESSION.relocate', $relocate);


                $applicant = new Applicant(
                    $this->_f3->get('SESSION.firstName'),
                    $this->_f3->get('SESSION.lastName'),
                    $this->_f3->get('SESSION.emailAddress'),
                    $this->_f3->get('SESSION.state'),
                    $this->_f3->get('SESSION.phoneNumber')
                );

                // Set experience-related fields using setter methods
                $applicant->setGithub($githubLink);
                $applicant->setExperience($experience);
                $applicant->setBio($biography);
                $applicant->setRelocate($relocate);

                // Set the updated Applicant object in the session
                $this->_f3->set('SESSION.applicant', $applicant);


                if (empty($this->_f3->get('errors')) && !$this->_f3->get('SESSION.Mailing')) {
                    $this->_f3->reroute('/summary');
                } else if (empty($this->_f3->get('errors'))) {
                    $this->_f3->reroute('/openings');
                } else {
                    echo "<div class='text-center'>Please complete the form in its entirety</div>";
                }
            }
        }
        //adding from DataModel
        $yearsOfExperience = getExperience();
        $this->_f3->set('experiences', $yearsOfExperience);

        $view = new Template();
        echo $view->render('views/experience.html');

    }
    /**
     * Openings Page
     *
     * Handles the job openings form submission.
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

            // Create an instance of Applicant_SubscribedToLists class
            $applicant = new Applicant_SubscribedToLists(
                $this->_f3->get('SESSION.firstName'),
                $this->_f3->get('SESSION.lastName'),
                $this->_f3->get('SESSION.emailAddress'),
                $this->_f3->get('SESSION.state'),
                $this->_f3->get('SESSION.phoneNumber')
            );

            // Set job openings-related fields using setter methods
            $applicant->setSelectionsJobs($listLang);
            $applicant->setSelectionsVerticals($listVerticals);

            // Set the updated Applicant_SubscribedToLists object in the session
            $this->_f3->set('SESSION.applicant', $applicant);

            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('/summary');
            } else {
                echo "<div class='text-center'>Please correct the errors in the form</div>";
            }


            // Using GET response to display the page.
            $mailingList = getJobs();
            $this->_f3->set('mailingList', $mailingList);

            $mailingListVerticals = getMailingList();
            $this->_f3->set('mailingListVerticals', $mailingListVerticals);

            $view = new Template();
            echo $view->render('views/jobOpenings.html');
        }
    }
    /**
     * Summary Page
     *
     * Renders the summary page.
     */

    function summary()
    {
        $view = new Template();
        echo $view->render('views/summary.html');


        echo "<pre>";
        var_dump($_SESSION['applicant']);
        echo "</pre>";
    }
}

<?php
session_start();
//    author: Tilak K Chudasama
//    file name: index.php
//    file description: This is the controller file


//This is my CONTROLLER!


// Error Reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// Require the Autoload File
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validate.php');

//instantiate the F3 Base Class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/home.html');

});

//route to home page when we click the website logo in navbar
$f3->route('GET /home', function() {

    $view = new Template();
    echo $view->render('views/home.html');

});

//personalInfo page routing with validation
$f3->route('GET|POST /personalInfo', function($f3) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Check if any field is empty
        if (!empty($_POST['firstName']) && !empty($_POST['phoneNumber']) && !empty($_POST['lastName']) && !empty($_POST['emailAddress'])) {

            // Assign variables from POST data
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $emailAddress = $_POST['emailAddress'];
            $phoneNumber = $_POST['phoneNumber'];
            $state = $_POST['state'];

            // Validation checks
            if (validName($firstName)) {
                $f3->set('SESSION.firstName', $firstName);
            } else {
                $f3->set('errors["firstName"]', 'Please enter a valid first name');
            }

            if (validName($lastName)) {
                $f3->set('SESSION.lastName', $lastName);
            } else {
                $f3->set('errors["lastName"]', 'Please enter a valid last name');
            }

            if (validEmail($emailAddress)) {
                $f3->set('SESSION.emailAddress', $emailAddress);
            } else {
                $f3->set('errors["emailAddress"]', 'Please enter a valid email address');
            }

            if (validPhone($phoneNumber)) {
                $f3->set('SESSION.phoneNumber', $phoneNumber);
            } else {
                $f3->set('errors["phoneNumber"]', 'Please enter a valid phone number');
            }

            // Add state to session array
            $f3->set('SESSION.state', $state);

            // Redirect to the next page if no errors
            if (empty($f3->get('errors'))) {
                $f3->reroute('/experience');
            }
        } else {
            echo "<div class='text-center'>Please complete the form in its entirety</div>";
        }
    }

    $view = new Template();
    echo $view->render('views/personalInfo.html');
});


//experience page routing with validation
$f3->route('GET|POST /experience', function($f3) {



    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Check if any field is empty
        if (!empty($_POST['experience'])) {


        // Assign variables from POST data
            $biography= $_POST['biography'];
            $githubLink = $_POST['githubLink'];


            $experience = implode(", ", $_POST['experience']);

            if(empty($_POST['relocate'])) {
                $relocate = "Yes";

            }
            else {
                $relocate = $_POST['relocate'];
            }

            // Add to session array

            if (validExperience($experience)) {
                $f3->set('SESSION.experience', $experience);;
            } else {
                $f3->set('errors["experience"]', 'Please select a valid option.');
            }

            if (validExperience($githubLink)) {
                $f3->set('SESSION.githubLink', $githubLink);
            } else {
                $f3->set('errors["githubLink"]', 'Please select valid URL');
            }

            $f3->set('SESSION.biography', $biography);


            $f3->set('SESSION.relocate', $relocate);



            // Redirect to the next page
            if (empty($f3->get('errors'))) {
                $f3->reroute('/openings');
            }
        }
        else {
            echo "<div class='text-center'>Please complete the form in its entirety</div>";
        }

    }
    //adding from DataModel
    $yearsOfExperience = getExperience();
    $f3->set('experiences', $yearsOfExperience);

    $view = new Template();
    echo $view->render('views/experience.html');

});

//openings page routing with validation
$f3->route('GET|POST /openings', function($f3) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {










            // Add to session array
        if(isset($_POST['listLang']) && isset($_POST['listVerticals']) ) {
            // Assign variables from POST data
            $listLang = $_POST['listLang'];
            $listVerticals = $_POST['listVerticals'];

            $f3->set('SESSION.languages', $listLang);
            $f3->set('SESSION.verticals', $listVerticals);
        }



            // Redirect to the next page
            $f3->reroute("/summary");


    }



    $mailingList = getJobs();
    $f3->set('mailingList', $mailingList);

    $mailingListVerticals = getMailingList();
    $f3->set('mailingListVerticals', $mailingListVerticals);



    $view = new Template();
    echo $view->render('views/jobOpenings.html');

});

//summary page routing
$f3->route('GET|POST /summary', function() {

    $view = new Template();
    echo $view->render('views/summary.html');

});


//Run Fat-Free
$f3->run();

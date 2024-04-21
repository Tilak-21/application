<?php
session_start();
//This is my CONTROLLER!


// Error Reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// Require the Autoload File
require_once ('vendor/autoload.php');

//instantiate the F3 Base Class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/home.html');

});

$f3->route('GET /home', function() {

    $view = new Template();
    echo $view->render('views/home.html');

});

$f3->route('GET|POST /personalInfo', function($f3) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {


        // Check if any field is empty
        if (!empty($_POST['firstName']) && !empty($_POST['phoneNumber']) && !empty($_POST['lastName']) && !empty($_POST['emailAddress']) && !empty($_POST['state'])) {


        // Assign variables from POST data
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $emailAddress = $_POST['emailAddress'];
            $phoneNumber = $_POST['phoneNumber'];
            $state = $_POST['state'];




            // Add to session array
            $f3->set('SESSION.firstName', $firstName);
            $f3->set('SESSION.lastName', $lastName);
            $f3->set('SESSION.phoneNumber', $phoneNumber);
            $f3->set('SESSION.emailAddress', $emailAddress);
            $f3->set('SESSION.state', $state);

            // Redirect to the next page
            $f3->reroute("/experience");
        }
        else {
            echo "<div class='text-center'>Please complete the form in its entirety</div>";
        }

    }

    $view = new Template();
    echo $view->render('views/personalInfo.html');

});



$f3->route('GET|POST /experience', function($f3) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Check if any field is empty
        if (!empty($_POST['biography']) && !empty($_POST['githubLink']) && !empty($_POST['experience']) && !empty($_POST['relocate'])) {


        // Assign variables from POST data
            $biography= $_POST['biography'];
            $githubLink = $_POST['githubLink'];
            $experience = $_POST['experience'];
            $relocate = $_POST['relocate'];


            // Add to session array
            $f3->set('SESSION.biography', $biography);
            $f3->set('SESSION.githubLink', $githubLink);
            $f3->set('SESSION.experience', $experience);
            $f3->set('SESSION.relocate', $relocate);


            // Redirect to the next page
            $f3->reroute("/openings");
        }
        else {
            echo "<div class='text-center'>Please complete the form in its entirety</div>";
        }

    }

    $view = new Template();
    echo $view->render('views/experience.html');

});

$f3->route('GET|POST /openings', function($f3) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Check if any field is empty
        if (!empty($_POST['languages']) && !empty($_POST['verticals'])) {

        // Assign variables from POST data
            $languages= $_POST['languages'];
            $verticals = $_POST['verticals'];




            // Add to session array
            $f3->set('SESSION.languages', $languages);
            $f3->set('SESSION.verticals', $verticals);



            // Redirect to the next page
            $f3->reroute("/summary");
        }
        else{
            echo "<div class='text-center'>Please complete the form in its entirety</div>";
        }

    }

    $view = new Template();
    echo $view->render('views/jobOpenings.html');

});

$f3->route('GET|POST /summary', function() {

    $view = new Template();
    echo $view->render('views/summary.html');

});


//Run Fat-Free
$f3->run();

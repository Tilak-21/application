<?php
//    author: Tilak K Chudasama
//    file name: index.php
//    file description: This is the controller file


// Error Reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// Require the Autoload File
require_once ('vendor/autoload.php');




//instantiate the F3 Base Class
$f3 = Base::instance();
$con = new controller($f3);

//Define a default route
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/home.html');

});

//route to home page when we click the website logo in navbar
$f3->route('GET /home', function() {

    $GLOBALS['con']->home();

});

//personalInfo page routing with validation
$f3->route('GET|POST /personalInfo', function($f3) {

    $GLOBALS['con']->personalInfo();
});


//experience page routing with validation
$f3->route('GET|POST /experience', function($f3) {
    $GLOBALS['con']->experience();
});

//openings page routing with validation
$f3->route('GET|POST /openings', function($f3) {
    $GLOBALS['con']->openings();
});

//summary page routing
$f3->route('GET|POST /summary', function($f3) {

    $GLOBALS['con']->summary();

});


//Run Fat-Free
$f3->run();

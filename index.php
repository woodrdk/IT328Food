<?php

// start a session
session_start();

// THIS IS OUR CONTROLLER

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the autoload file
require_once ('vendor/autoload.php');

// Create an instance of the base class
$f3 = Base::instance();

// define a default route
$f3 -> route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');

});

$f3 -> route('GET /order', function(){
    $view = new Template();
    echo $view->render('views/form1.html');
});
$f3 -> route('POST /order2', function(){
    // var_dump($_POST);
    $_SESSION['food'] = $_POST['food'];
    $view = new Template();
    echo $view->render('views/form2.html');
});

$f3 -> route('POST /order3', function(){
    // var_dump($_POST);
    $_SESSION['meal'] = $_POST['meal'];

    $view = new Template();
    echo $view->render('views/form3.html');
});

$f3 -> route('POST /summary', function(){
    var_dump($_POST);
    var_dump($_SESSION);
    $_SESSION['drink'] = $_POST['drink'];
    $view = new Template();
    echo $view->render('views/results.html');
});

$f3 -> route('GET /breakfast', function(){
    var_dump($_POST);

    $view = new Template();
    echo $view->render('views/breakfast.html');
});

$f3 -> route('GET /lunch', function(){
    $view = new Template();
    echo $view->render('views/lunch.html');
});

$f3 -> route('GET /dinner', function(){
    $view = new Template();
    echo $view->render('views/dinner.html');
});

$f3 -> route('GET /@item', function($f3, $params){
    // var_dump($params);
    $item = $params['item'];
    echo "<p>You ordered $item </p>";

    $foodWeServe = array("tacos", "pizza", "lumpia");
    if(!in_array($item, $foodWeServe)){
        echo "<p>Sorry.. we dont serve $item </p>";
    }

    switch($item){
        case 'tacos':
            echo "<p>We serve tacos on Tuesdays</p>";
            break;
        case 'pizza':
            echo "<p>We serve pizza on Fridays</p>";
            break;
        case 'lumpia';
            $f3 -> reroute("/breakfast");
        default:
            $f3 -> error(404);
    }
});


// Run Fat Free
$f3 -> run();
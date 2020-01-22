<?php

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

$f3 -> route('GET /breakfast', function(){
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
<?php
/*
 * Amanda Williams
 * January 14, 2019
 * 328/food/index.php
 */

#Error Reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

#require autoload
require_once ('vendor/autoload.php');

#create an instance of the Base class
$f3 = Base::instance();

#Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

#define a default route
$f3->route('GET /', function() {
    echo '<h1>My Fav Foods</h1>';
    /*
    $view = new View;
    echo $view->render('views/home-page.html');
    */
});

#run fat free
$f3->run();
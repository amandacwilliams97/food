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
    //echo '<h1>My Fav Foods</h1>';

    $view = new View();
    echo $view->render('views/home.html');

});

#-----------------------------------------------------------
#Define a breakfast route
$f3->route('GET /breakfast', function() {
   $view = new View();
   echo $view->render('views/breakfast.html');
});

#Define a breakfast/pancakes route
$f3->route('GET /breakfast/pancakes', function() {
    $view = new View();
    echo $view->render('views/pancakes.html');
});

#----------------------------------------------------------
#Define a lunch route
$f3->route('GET /lunch', function() {
   $view = new View();
   echo $view->render('views/lunch.html');
});

#-----------------------------------------------------------
#Define a Dinner route
$f3->route('GET /dinner', function() {
   $view = new View();
   echo $view->render('views/dinner.html');
});

#Define a dinner/meatloaf route
$f3->route('GET /dinner/meatloaf', function() {
   $view = new View();
   echo $view->render('views/meatloaf.html');
});

#Define a dinner/steak_potatoes route
$f3->route('GET /dinner/steak_potatoes', function() {
   $view = new View();
   echo $view->render('views/steak_potatoes.html');
});

#Define a dinner/tuna_caserole route
$f3->route('GET /dinner/tuna_caserole', function() {
   $view = new View();
   echo $view->render('views/tuna_caserole.html');
});

#-------------------------------------------------------------
#Define a route with a parameter
$f3->route('GET /@food', function($f3, $params) {
    print_r($params);
    echo"<h3>I like ".$params['food']."</h3>";
});

#Define a route with multiple parameters
$f3->route('GET /@meal/@food', function($f3, $params) {
    print_r($params);
    echo"<h3>I like ".$params['food']." for "
        .$params['meal']."</h3>";
});

#Define a route with multiple parameters part 2
$f3->route('GET /@meal/@food', function($f3, $params) {
    print_r($params);

    $validmeals =['breakfast', 'lunch', 'dinner'];
    $meal = $params['meal'];

    #check validity
    if(!in_array($meal, $validmeals)) {
        echo "<h3>Sorry, we don't serve $meal</h3>";
    }
    else {
        switch($meal) {
            case 'breakfast':
                $time = " in the morning"; break;

            case 'lunch':
                $time = " at noon"; break;

            case 'dinner':
                $time = " in the evening"; //break;
                                    #unnecessary as its the last case

        }
        echo"<h3>I like ".$params['food']." $time</h3>";
    }
});

#-------------------------------------------------------------
#route to order form
$f3->route('GET /order', function() {
    $view = new View();
    echo $view->render('views/form1.html');
});

#route that processes the form
$f3->route('POST /order-process', function($f3) { //$f3, $params

    print_r($_POST);

    $food = $_POST['food'];
    echo"<h3>Processing order...</h3>";
    echo"<h3>You orderd $food</h3>";
    if($food=='pancakes') {
        #reroute to pizza page
        $f3->reroute("breakfast/pancakes");
    }
    else if($food == 'sushi') {
        #reroute toparameter page
        $f3->reroute("sushi");
    }
    else {
        #reroute to home page
        $f3->reroute("");

        #display a 404 error
        //$f3->reroute(404);
    }
});

#--------------------------------------------------------------
#Define a route /dessert/@param
$f3->route('GET /dessert/@dessert', function($f3, $params) {
    $dessert = $params['dessert'];

    switch ($dessert) {
        case 'pie':
            $view = new View();
            echo $view->render('views/pie.html'); break;
        case 'cake':
            echo "<h3>I like cake.</h3>"; break;
        case 'cookies':
            echo "<h3>I like cookies.</h3>"; break;
        case 'brownies':
            echo "<h3>I like brownies.</h3>"; break;
        default :
            $f3->error(404);
    }
});

#--------------------------------------------------------------
#run fat free
$f3->run();
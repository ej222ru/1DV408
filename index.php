<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/UserController.php');
require_once('model/User.php');


        
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// enable use of $_SESSION variables
session_start();

//CREATE OBJECTS OF THE VIEWS
$v      = new LoginView();       
$dtv    = new DateTimeView();
$lv     = new LayoutView();

$uc = new UserController($lv,$v, $dtv);
$uc->startLoginApplikation();


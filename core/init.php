<?php
//Start Session
session_start(); // this is iclude in every page

//Include Configuration
require_once('config/config.php');

//Include Helper Function Files
require_once('helpers/system_helper.php');
require_once('helpers/format_helper.php');
require_once('helpers/db_helper.php');


//Autoloader Classes
function __autoload($class_name){
     require_once('libraries/'.$class_name .".php");
}

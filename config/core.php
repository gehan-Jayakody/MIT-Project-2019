<?php
// show error reporting
error_reporting(E_ALL);
 
// start php session
session_set_cookie_params('10800');
session_name("NDBS");
session_start();

//default time-zone
date_default_timezone_set('Asia/Colombo');
 
// home page url
$home_url="http://localhost:8000";

?>
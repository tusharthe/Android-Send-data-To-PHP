<?php

require 'lib/Dbconfig.php';
require 'lib/functions.php';
require "lib/session.php";	

$session  = new Session();


function base_url() {
    $root = "http://".$_SERVER['HTTP_HOST'];
    $root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    return $root; 
}


define('BASE_URL', 'http://192.168.43.23');


?>
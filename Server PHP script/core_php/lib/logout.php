<?php
include_once '../require.php';
$session  = new Session();
session_destroy();
header('location:../index.php');
?>
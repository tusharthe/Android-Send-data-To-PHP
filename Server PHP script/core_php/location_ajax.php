<?php

include_once 'require.php';
$functions = new Functions();


    $json = file_get_contents('php://input');
   // $obj = json_decode($json);

	/// ALTER TABLE `location_ajax` CHANGE `text` `text` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
	
$functions->run("INSERT INTO `location_ajax`(`text`) VALUES ('$json')");

?>
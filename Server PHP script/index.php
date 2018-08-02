<?php

require 'require.php';

$function = new Functions();
if(isset($_POST['name'])) {
 $name = $_POST['name'];
 $email = $_POST['email'];


 $Sql_Query = "insert into getdatatable (name,email) values ('$name','$email')";
 
 if($function->run($Sql_Query)){
 
 echo 'Data Submit Successfully';
 
 }
 else{
 
 echo 'Try Again';
 
 }
 
}
 

?>
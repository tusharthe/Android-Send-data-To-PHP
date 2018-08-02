<?php

include_once 'require.php';
$functions = new Functions();


if(isset($_POST['submit']) AND $_POST['submit'] == 'customer' ) {
    $data = [];
    $username = $_POST['username'];
    $password = $_POST['password'];


    $username = $functions->cleanInput($username);
    $password = $functions->cleanInput($password);


    $stmt = "Select * from `customer` where (`customer_username` = '$username' or `customer_email` = '$username' ) AND `customer_password` = '$password'";


    $res = $functions->run($stmt);
    if ($res->num_rows > 0) {
        $_SESSION['is_customer_login'] = true;
        $_SESSION['login_details'] = mysqli_fetch_assoc($res);
        $data = true;
    } else {
        $data = false;
    }

    echo $data;

}


if(isset($_POST['submit']) AND $_POST['submit'] == 'barber' ) {
    $data = [];
    $username = $_POST['username'];
    $password = $_POST['password'];


    $username = $functions->cleanInput($username);
    $password = $functions->cleanInput($password);


    $stmt = "Select * from `barber` where (`barber_username` = '$username' or `barber_email` = '$username' ) AND `barber_password` = '$password'";


    $res = $functions->run($stmt);
    // print_r($res);
    if ($res->num_rows > 0) {
        $_SESSION['is_barber_login'] = true;
        $_SESSION['login_details'] = mysqli_fetch_assoc($res);
        $data = true;
    } else {
        $data = false;
    }

    echo $data;

}



?>

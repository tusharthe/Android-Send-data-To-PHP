<?php

include_once 'require.php';
$functions = new Functions();



if(isset($_POST)) {
    $data['success'] = false;
    $_SESSION['phone_number'] = '';
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['Phone'];
    $gender = $_POST['gender'];
    $full = $first_name . ' ' . $last_name;

//    print_r($phone_number);die();
    $stmt = "SELECT * FROM `customer` WHERE `customer_username` = '$username' ";

    $res = $functions->run($stmt);

    if ($res->num_rows != 0) {
        $data['messg'] = 'Sorry! Username is already exits.Try Again';
        $data['success'] = false;
        echo json_encode($data);
        exit;
    }

    $stmt = "SELECT * FROM `customer` WHERE `customer_contact` = $phone_number ";
    $res = $functions->run($stmt);
//    print_r($stmt);die();



    if ($res->num_rows != 0) {
        $data['messg'] = 'Sorry! Phone is already registered. Try Again';
        $data['success'] = false;
        echo json_encode($data);
        exit;
    }

    if(!$data['success']) {
        $otp = generate_otp(6);
        $total = 0;


        $stmt = "INSERT INTO `customer`(`customer_name`, `customer_username`, `customer_gender`,`customer_contact` ,`customer_password`,`customer_otp_password`) VALUES ('$full','$username','$gender','$phone_number','$password','$otp')";
        $res = $functions->run($stmt);
        if ($res) {
            $messg = 'Hello, Your OTP is  ' . $otp ;
            send_otp($total ,$otp,$phone_number,$messg,false) ;
            $data['messg'] = 'Successfully registered! OTP was send to registered mobile.';
            $data['success'] = true;
            $_SESSION['phone_number'] = $phone_number;
            echo json_encode($data);
            exit;
        }
    }

}

function generate_otp($length) {

    function RandomString($length) {
        $keys = array_merge(range(0,9),range('0','9'));
        $key ='';
        for($i=0;$i < $length; $i++){
            $key .= $keys[mt_rand(0,count($keys) - 1 )];

        }
        return $key;
    }

    $value = RandomString($length);
    return $value;
}



function send_otp ($total = null,$otp = null,$phone, $messg , $process = false) {
    if($total  < 1000 && $process == true) {


        //Your authentication key
        $authKey = "33f82c77852fa4bf0d06d8e8bd210939";
        //Multiple mobiles numbers separated by comma

        $mobileNumber = $phone;

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = "AWSLOG";
        //Your message to send, Add URL encoding here.
        $message = $messg;
        //Define route
        $route = "4";
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );
        //API URL
        $url = "http://sms.bulksmsserviceproviders.com/api/send_http.php";
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //get response
        $output = curl_exec($ch);
        //Print error if any
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);

//insert


//        $stmt = 'INSERT INTO `message`(`cantact`, `message`) VALUES ("' . $_POST['contact'] . '","' . $message . '")';
//        $stmt = $functions->run($stmt);

    }
}


?>
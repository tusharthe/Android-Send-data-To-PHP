<?php
include_once 'require.php';
$functions = new Functions();



if(isset($_POST['register'])) {

    if($_POST['phone'] == $_SESSION['phone_number']) {
        $data['success'] = false;
        $otp = $_POST['otp'];
        $phone = $_SESSION['phone_number'];

        $stmt = "select * from customer where `customer_contact` = $phone AND customer_otp_password =  '$otp' ";
        $res = $functions->run($stmt);


        if ($res->num_rows > 0) {

            $_SESSION['is_customer_login'] = true;
            $_SESSION['login_details'] = mysqli_fetch_assoc($res);
//            $data = true;



            $stmt = "UPDATE `customer` SET `customer_otp_password` = 0 , `customer_number_register` = 'Y' where `customer_contact`  = $phone";
            $res = $functions->run($stmt);
            $data['messg'] = 'Phone Number is Successfully Verified';
            $data['success'] = true;
            echo json_encode($data);
            exit;
        }else {

            $res = $functions->run($stmt);
            $data['messg'] = 'Ops! Enter OTP was Wrong.<br /> Try Again...';
            $data['success'] = false;
            echo json_encode($data);

        }


    }


}
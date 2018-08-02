<?php

include_once 'require.php';
$functions = new Functions();


if(isset($_POST['submit']) AND $_POST['submit'] == 'booking' ) {
    $data = [];
    // $username = $_POST['username'];
    // $password = $_POST['password'];
      $_SESSION['booking_submit'] = $_POST;
      $_SESSION['booking_on'] = true;

      $data = [];

      if(!isset($_SESSION['is_customer_login'])) {
        $data['not_login'] =  true; echo json_encode($data);exit;
      }else {
          $data['login_details']  = $user = $_SESSION['login_details'];

      /*

          0 = oder placed
          1 = oder accepted
          2 = oder processing
          3 = oder completed

      */
          $time = $_POST['time'];
          $date = $_POST['date'];
          $shop_id = $_POST['shop_id'];
          $barber_id = $_POST['barber_id'];
          $amount = $_POST['amount'];
          $services_id = $_POST['services_id'];
          $customer_id = $user['customer_id'];
          $order_status = '0';

          $stmt = "INSERT INTO `order_tbl`(`shop_id`, `customer_id`, `barber_id`, `service_id`, `amount`, `order_status`, `selected_time`, `selected_date`) VALUES ('$shop_id','$customer_id','$barber_id','$services_id','$amount','$order_status','$time','$date')";
          $run = $functions->run($stmt);
          if($run) {
            $data['oder_book'] = 'success';
          }else {
            $data['oder_book'] = 'error';
          }
          echo json_encode($data);
      }

    // $username = $functions->cleanInput($username);
    // $password = $functions->cleanInput($password);
}

?>

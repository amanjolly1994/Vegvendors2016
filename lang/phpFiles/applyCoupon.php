<?php

  session_start();
  require_once("dbConfig.php");
  require_once("../resource/couponFn.php");

  $coupon_code = $_POST['coupon'];
  $total = $_POST['total'];

  $coupon = new coupon();

  $detail = $coupon->couponDetail($coupon_code);

  if( $detail == "Wrong Code" )
  {
    echo "Invalid Coupon Code. Try Again.";
  }
  else {

    if( !is_array($detail) )
    {
      $detail = json_decode($detail,true);
    }

    // CHECKING COUPON

    $uid = $_SESSION['uid'];


    if( $coupon->couponCheck($coupon_code,$total) )
    {
      if( $coupon->couponAvailable($uid,$coupon_code) )
      {
        $discount = $detail['discount'];

        $cal_max = $total*($discount/100);

        if( $cal_max <= $detail['max'] )
        {
          $newTotal = $total - $cal_max;
        }
        else {
          $newTotal = $total - $detail['max'];
        }
        $_SESSION['coupon'] = $coupon_code;
        echo (float) $newTotal;   //discounted total
      }
      else {
        echo "You have already used this coupon";
      }
    }
    else {
      echo "Coupon either expired or is not valid on your total.";
    }
  }


?>

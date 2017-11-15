<?php

require_once("dbConfig.php"); //dB include only once

#Functions of Coupons..
#couponDetail -- takes coupon code and returns details in JSON
#couponCheck -- Checks whether coupon is valid or not -- returns Boolean
#couponAvailable -- checks whether coupon is avilable for a user or not -- returns boolean
#couponUseEntry -- Enters coupon used in coupon_user dB table -- returns boolean

#Function TESTING.. remove comments to test..
// echo couponDetail("SALE50");
// echo couponCheck("SALE50",85);
// echo couponAvailable(1,"SALE50");
// echo couponUseEntry(1,"SALE50");
$test = new coupon();
echo $test->couponCalucate("SALE50",180,1);

class coupon
{       //class Begins

  function couponDetail($code) //takes coupon code and returns details in JSON
  {
    GLOBAL $db_con;

    try {

      $query = "SELECT * FROM default_promo_table WHERE Promo_code=:code";
      $stmt = $db_con->prepare($query);
      $stmt->execute(array(":code"=>$code));

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();

      if( $count > 0 )    //if the coupon exists
      {
        $discount = $row["discount"];
  			$min = $row["minimum"];
  			$max = $row["maximum"];
        $description = $row["description"];
        $origin = $row["orign_date"];   //Coupon origin date
        $expiry = $row["expiry_date"];  //Coupon expiry date

        $coupon = array(
            "discount" => "$discount",
            "min" => "$min",
            "max" => "$max",
            "description" => "$description",
            "origin" => "$origin",
            "expiry" => "$expiry"
        );

        $coupon_detail = json_encode($coupon);  //contains JSON of the coupon detail

        return $coupon_detail;
      }
      else {              //coupon doesn't exist
        return "Wrong Code";
      }

    } catch (PDOException $e) {
      return $e->getMessage();
    }


  }

  function couponCheck($code,$min)     //Checks whether coupon is valid or not -- returns Boolean
  {
    GLOBAL $db_con;
    try {

      $query = "SELECT * FROM default_promo_table WHERE Promo_code=:code";
      $stmt = $db_con->prepare($query);
      $stmt->execute(array(":code"=>$code));

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();

      if( $count > 0 )    //if the coupon exists
      {
  			$c_min = $row["minimum"];
  			$c_max = $row["maximum"];
        $origin = $row["orign_date"];   //Coupon origin date
        $expiry = $row["expiry_date"];  //Coupon expiry date

        if( date('Y-m-d H:i:s') > $origin && date('Y-m-d H:i:s') < $expiry )    //checks coupon origin and expiry date
        {
          if( $min < $c_min )
            return false;     // coupon not valid of total cost less than min value

          else
            return true;      // coupon code is valid
        }
        else {              //coupon expired or not yet started
          return false;
        }
      }
      else {              //coupon doesn't exist
        return false;
      }

    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  function couponAvailable($uid,$coupon)  //checks whether coupon is avilable for a user or not -- returns boolean
  {
    GLOBAL $db_con;
    GLOBAL $db;
    try {
      $q3 = $db->query("SELECT * FROM default_promo_table WHERE Promo_code='$coupon'");
      $row = $q3->fetch_assoc();
      $coupon_code = $row['Psno'];

      $query = "SELECT * FROM coupon_user WHERE user_id=:uid AND coupon_id=:coupon_code";
      $stmt = $db_con->prepare($query);
      $stmt->bindParam(":uid",$uid);
      $stmt->bindParam(":coupon_code",$coupon_code);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();

      if( $count == 0 )    //if no entry in dB for the uid
      {
        return 1;       //no entry in dB -- means it is available
      }
      else if( $count > 0 ){              //coupon used by the user
        $used = $row["used"];     //no of times coupon used by user

        if( $used == 0 )        // if 0 times used then available else not available
          return 1;
        else
          return 0;
      }

    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  function couponUseEntry($uid,$coupon)     //Enters coupon used in coupon_user dB table -- returns boolean
  {
    GLOBAL $db_con;
    GLOBAL $db;
    try {
      $q3 = $db->query("SELECT * FROM default_promo_table WHERE Promo_code='$coupon'");
      $row = $q3->fetch_assoc();
      $coupon_code = $row['Psno'];

      $query = "SELECT * FROM coupon_user WHERE user_id=:uid AND coupon_id=:coupon_code";
      $stmt = $db_con->prepare($query);
      $stmt->bindParam(":uid",$uid);
      $stmt->bindParam(":coupon_code",$coupon_code);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();

      if( $count > 0 )
      {
        $used = $row["used"];
        if( $used == 0 )
        {
          $q1 = "UPDATE coupon_user SET used=1 WHERE user_id='$uid' AND coupon_id='$coupon_code'";
          if( $db->query($q1) )
            return 1;
          else
            return 0;
        }
        else
          return 0;
      }
      else {
        $q2 = "INSERT INTO coupon_user SET user_id='$uid', coupon_id='$coupon_code', used=1";
        if( $db->query($q2) )
          return 1;
        else
          return 0;
      }

    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  function couponCalucate($coupon,$total,$uid)     //Calculates the coupon and returns the discounted value
  {
    GLOBAL $db_con;
    GLOBAL $db;

    $detail = $this->couponDetail($coupon);

    $detailDec = json_decode($detail,true);

    if( $this->couponCheck($coupon,$total) )
    {
      if( $this->couponAvailable($uid,$coupon) )
      {
        $discount = $detailDec['discount'];

        $cal_max = $total*($discount/100);

        if( $cal_max <= $detailDec['max'] )
        {
          $newTotal = $total - $cal_max;
        }
        else {
          $newTotal = $total - $detailDec['max'];
        }
        if( $this->couponUseEntry($uid,$coupon) )
        {
          return $newTotal;
        }
        else {
          return $total;
        }

      }
      else {
        return $total;
      }
    }
    else {
      return $total;
    }
  }

} //class coupon closed

?>

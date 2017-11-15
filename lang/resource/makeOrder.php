<?php

//session_start();
require_once("dbConfig.php");
require_once("sabzi.php");

//$test = new order();
//echo json_encode($test->reOrder("467","4"));
//$testOrder = '[{"category":"1","count":3,"image":"sabzi-pics\/tomato.gif","name":"Tomato (\u091f\u092e\u093e\u091f\u0930)","price":30,"rate":0.5,"total":60}]';
//$testOrder = $test->prepareOrder($testOrder,"4");
//echo $test->totalCost($testOrder);

class order
{

  function prepareOrder($orderArray,$place_code)      //takes order array+place_code and checks price and returns new array -- returns Array
  {
    //order array should be json decoded and ass array
    GLOBAL $db_con;
    GLOBAL $db;

    if( !is_array($orderArray) )
      $orderArray = json_decode($orderArray,true);

    $sabzi = new sabzi();

    foreach ($orderArray as $key => $value) {
      $sname = $value["name"];
      $mass = $value["count"];

      $sabziDetail = $sabzi->sabziDetail("",$sname);
      $sid = $sabziDetail['id'];

      $scost = $sabzi->sabziPrice($sid,$place_code);
      $subtotal = $mass*$scost;

      #suborder Sending

      $orderArray[$key]["price"] = $scost;
      $orderArray[$key]["total"] = $subtotal;

    }

    return $orderArray;

  }

  function totalCost($orderArray)         //takes order array and returns total price of the order -- returns float
  {
    GLOBAL $db_con;
    GLOBAL $db;

    if( !is_array($orderArray) )
       $orderArray = json_decode($orderArray,true);

    $total = 0;
    foreach ($orderArray as $key => $value) {
      $subtotal = $value["total"];
      $total = $total + $subtotal;
    }
    return (float) $total;
  }

  function slotConfirm($slot)             //takes the slot and check if its eligible or not -- returns boolean
  {
    $slot = (int) $slot;
    $slot1_time = "08:30:00";
    $slot2_time = "12:30:00";
    $slot3_time = "17:30:00";

    // Switch Case
    switch ($slot) {
      case 1:
        if( time() > strtotime($slot1_time) )
          return false;
        else
          return true;
        break;

      case 2:
        if( time() > strtotime($slot2_time) )
          return false;
        else
          return true;
        break;

      case 3:
        if( time() > strtotime($slot3_time) )
          return false;
        else
          return true;
        break;

      case 4:
        return true;
        break;

      case 5:
        return true;
        break;

      case 6:
        return true;
        break;

      default:
        return false;
        break;
    }
  }

  function orderConfirm($orderArray,$uid,$place_code,$slot,$coupon)             //Process and confirm order and apply coupon -- returns new order id
  {
    GLOBAL $db_con;
    GLOBAL $db;

    $slot = (int) $slot;
    $slot1_time = "08:30:00";
    $slot2_time = "12:30:00";
    $slot3_time = "19:30:00";

    //Prepare order for price hack

    if( !is_array($orderArray) )
       $orderArray = json_decode($orderArray,true);

    $orderArray = $this->prepareOrder($orderArray,$place_code);       //Checks for order price hack
    $totalCost = $this->totalCost($orderArray);

    if( !$this->slotConfirm($slot) )                                  //Checks for slot time hack
    {
      if( time() < strtotime($slot1_time) )
        $slot = 1;
      else if( time() < strtotime($slot2_time) )
        $slot = 2;
      else if( time() < strtotime($slot3_time) )
        $slot = 3;
      else
        $slot = 4;
    }

    # Main Order Entry in dB
    $stmt = $db_con->prepare("INSERT INTO main_orders(uid,total_price,timeslot_id,order_date) VALUES(:uid, :total_price,:slot,:order_date)");
    $stmt->bindParam(":uid",$uid);
    $stmt->bindParam(":total_price",$totalCost);
    $stmt->bindParam(":slot",$slot);
    $time_date=date('Y-m-d H:i:s');
    $stmt->bindParam(":order_date",$time_date);
    $stmt->execute();

    $order_id=$db_con->lastInsertId();

    # Sub Order Entry in dB
    foreach ($orderArray as $key => $value) {

     	$stmt = $db_con->prepare("INSERT INTO sub_orders(order_id, sabziz, qty_in_kg, price, svid) VALUES(:order_id, :sabziz, :qty_in_kg, :price, :svid)");
      $stmt->bindParam(":order_id",$order_id);
      $stmt->bindParam(":sabziz",$value["name"]);
      $stmt->bindParam(":qty_in_kg",$value["count"]);
      $stmt->bindParam(":price",$value["total"]);

      $category = $value['category'];

      if( $category == 1 )
      	$vendorId = $_SESSION['cat1vendor'];
      if( $category == 2 )
      	$vendorId = $_SESSION['cat2vendor'];
      if( $category == 3 )
      	$vendorId = $_SESSION['cat3vendor'];
      if( $category == 4 )
      	$vendorId = $_SESSION['cat4vendor'];

      $stmt->bindParam(":svid",$vendorId);
      $stmt->execute();
    }

    return (int) $order_id;

  }

  function reOrder($order_id,$place_code)
  {
    GLOBAL $db_con;
    GLOBAL $db;

    $fullOrder = array();

    $sabzi = new sabzi();

    $q = $db->query("SELECT * FROM sub_orders WHERE order_id='$order_id'");
    while( $row = $q->fetch_assoc() )
    {
      $sname = $row["sabziz"];
      $qty = $row["qty_in_kg"];

      $sabziDetail = $sabzi->sabziDetail("",$sname);

      $sabzi_id = $sabziDetail['id'];
      $sprice = $sabzi->sabziPrice($sabzi_id,$place_code);

      $totalPrice = $qty*$sprice;

      $suborder = new stdClass();
      $suborder->category=$sabziDetail['category'];
      $suborder->count=(float) $qty;
      $suborder->image=$sabziDetail['pic'];
      $suborder->name=$sname;
      $suborder->price=(float) $sprice;
      $suborder->rate=(float) $sabziDetail['rate'];
      $suborder->total=$totalPrice;

      array_push($fullOrder,$suborder);

    }

    return $fullOrder;

  }

}   //class closes

?>

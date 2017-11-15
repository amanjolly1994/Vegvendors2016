<?php

  include('dbConfig.php');
  session_start();

  $uid = $_SESSION['uid'];

  if(!isset($_POST['order_id']))
  {
    redirect('/');
  }

  $order_id = $_POST['order_id'];

  $main = $db->query("SELECT * FROM main_orders WHERE order_id='$order_id'");
  $mainRow = $main->fetch_assoc();

  $current_slot = 0;

  $total_price = $mainRow['total_price'];
  $date = $mainRow['order_date'];
  $slot = $mainRow['timeslot_id'];
  $status = $mainRow['delivery_status'];
  $time_slot = $mainRow['timeslot_id'];

  if($time_slot == 1)
    $current_slot = "07 AM - 10 AM";
  else if($time_slot == 2)
    $current_slot = "01 PM - 02 PM";
  else if($time_slot == 3)
    $current_slot = "06 PM - 09 PM";
  else if($time_slot == 4)
    $current_slot = "07 AM - 10 AM (Tom.)";
  else if($time_slot == 5)
    $current_slot = "01 PM - 02 PM (Tom.)";
  else if($time_slot == 6)
    $current_slot = "06 PM - 09 PM (Tom.)";

  $dateArray = explode(' ', $date, 2);

  if( $status == 0 )
    $d_s = "Processing";
  else if( $status == 1 )
    $d_s = "Completed";
  else if( $status == -1 )
  {
    $d_s = "Failed";
    $d_c = "fail-box";
  }

?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="/theme/css/fonts.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/header.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/home.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/style.css" />
  <link rel="stylesheet" type="text/css" href="/theme/css/order.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width:800px)" href="/theme/css/medium_size.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width:500px)" href="/theme/css/small_size.css" />

</head>

<body>

  <div class="orderBoxHead">

		<div class="mainOrderInfo <?php echo $d_s; ?>">
      <p class="mainOrderIdInfo">Order Id: #<?php echo $order_id; ?> | <?php echo $dateArray[0]; ?> | Delivery on: <?php echo $current_slot; ?> </p>
      <p class="mainPriceInfo">Total: ₹<?php echo $total_price; ?> | Status: <?php echo $d_s; ?></p>
      <div class="clear"></div>
    </div>

    <div class="orderButtonHolder">

      <?php
      if( $status == 0 )
      {
      ?>
  			<button class="cancelOrderButton" data-order="<?php echo $order_id; ?>">Cancel</button>

  			<button class="slotChangeButton" data-order="<?php echo $order_id; ?>">Change Delivery Slot</button>
      <?php }
      else { ?>
        <button class="cancelOrderButton disabledButton" disabled data-order="<?php echo $order_id; ?>">Cancel</button>

  			<button class="slotChangeButton disabledButton" disabled data-order="<?php echo $order_id; ?>">Change Slot</button>
      <?php }
      ?>

      <button class="reorderButton" data-order="<?php echo $order_id; ?>">Reorder</button>

			<button class="complaintButton" data-order="<?php echo $order_id; ?>">Complaint</button>
		</div>
	</div>

	<div class="subOrderBox">
    <div class="subOrderTable" style="display: block;">
  		<table class="sub-orders">
  			<thead>
  				<tr>
  					<td>Vegetable</td>
  					<td>Qty(Kg)</td>
  					<td>Price(Rs)</td>
  					<td>Vendor</td>
  				</tr>
  			</thead>

  			<tbody>
  				<?php
          $q = "SELECT s.order_id, s.sabziz, s.qty_in_kg, s.price, s.delivery_status, m.order_date, sv.name
                FROM `sub_orders` s
                INNER JOIN `main_orders` m ON s.order_id = m.order_id
                INNER JOIN `sabzi_wala` sv ON sv.svid = s.svid
                WHERE s.order_id = '$order_id'
                ORDER BY `m`.`order_date` DESC
                ";

          $sub = $db->query($q);
          while( $row = $sub->fetch_assoc() )
          { ?>
            <tr>
              <td><?php echo $row['sabziz']; ?></td>
              <td><?php echo $row['qty_in_kg'].' Kg'; ?></td>
              <td><?php echo '₹'.$row['price']; ?></td>
              <td><?php echo $row['name']; ?></td>
            </tr>
          <?php
          }
          ?>
  			</tbody>
  		</table>
    </div>

    <div id="changeSlotBox" class="changeSlotBox" style="width: 100%; display: none;">
      <div class="doneMsgShow" style="text-align: center;background: #e67e22;padding: 4px 0px;color: #fff;">
        <span></span>
        <span class="mls">Delivery Slot Selection</span>
      </div>

      <form id="slot-selection" name="slot-change" method="POST" encrypt="multipart/form-data" >
        <div style="float: left;">
          <p>Today</p>
          <?php
            $slot1_active = "";
            $slot2_active = "";
            $slot3_active = "";

            $slot1_time = "06:30:00";
            $slot2_time = "12:30:00";
            $slot3_time = "17:30:00";
            if( time() > strtotime($slot1_time) )
              $slot1_active = "disabled";

            if( time() > strtotime($slot2_time) )
              $slot2_active = "disabled";

            if( time() > strtotime($slot3_time) )
              $slot23_active = "disabled";
          ?>
          <input type="radio" name="slot-selection" <?php echo $slot1_active ?> value="1"><label>07 AM - 10 AM</label><br>
          <input type="radio" name="slot-selection" <?php echo $slot2_active ?> value="2"><label>01 PM - 02 PM</label><br>
          <input type="radio" name="slot-selection" <?php echo $slot3_active ?> value="3"><label>06 PM - 09 PM</label><br>

        </div>

        <div style="float: left; margin-left: 50px;">
          <p>Tomorrow</p>
          <input type="radio" name="slot-selection" value="4"><label>07 AM - 10 AM</label><br>
          <input type="radio" name="slot-selection" value="5"><label>01 PM - 02 PM</label><br>
          <input type="radio" name="slot-selection" value="6"><label>06 PM - 09 PM</label><br>
        </div>

        <div style="float: left; margin-left: 50px; text-align: center;">
          <p>Current Delivery Slot: <br><span><?php echo $current_slot; ?></span></p>
        </div>

        <div class="clear"></div>

      </form>

      <div style="">
        <button class="slot-back" style="float: left; padding: 5px 10px; background: #27ae60; margin-top: 10px; color: #fff;">Back</button>
        <button class="changeSlotButton slot-back" style="float: right; margin-right: 20px; padding: 5px 10px; background: #27ae60; margin-top: 10px; color: #fff;">Confirm Change</button>
      </div>
    </div>
	</div>

</body>
</html>

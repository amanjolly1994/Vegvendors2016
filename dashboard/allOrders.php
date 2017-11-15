<?php
include('../dbConfig.php');
session_start();
$uid=$_SESSION['uid'];
?>

<html>
<head>

	<!-- Style Links -->

	<link rel="stylesheet" type="text/css" href="/theme/css/fonts.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/header.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/home.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/style.css" />
  <link rel="stylesheet" type="text/css" href="/theme/css/order.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width:800px)" href="/theme/css/medium_size.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width:500px)" href="/theme/css/small_size.css" />

	<!-- [if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- JavaScript Links -->
	<script type="text/javascript" src="/lang/js/jquery-1.11.1.min.js" ></script>
	<script type="text/javascript" src="/lang/js/h-theme-all-01.js" ></script>
	<script type="text/javascript" src="/lang/js/h-tunnel.js" ></script>
	<script type="text/javascript" src="/lang/js/h-valid-v1.1.vvg.js" ></script>
	<script type="text/javascript" src="/lang/js/rating.js" ></script>

	<!-- AJAX FILES -->

	<script type="text/javascript"></script>

</head>

<body>

	<div class="inSize">
		<div class="allOrders" id="allOrders">

      <?php
        $allOrder = $db->query("SELECT * FROM main_orders WHERE uid='$uid' ORDER BY order_date DESC");

        $count = $allOrder->num_rows;

        if( $count>0 )
        {
          while( $row = $allOrder->fetch_assoc() )
          {
            if( $row['delivery_status'] == 0 )
              $background_class = "asphaltBack";
            else if( $row['delivery_status'] == 1 )
              $background_class = "emeraldBack";
            else if( $row['delivery_status'] == -1 )
              $background_class = "alizarinBack";

            $dateArray = explode(' ', $row['order_date'], 2);
      ?>
            <div class="orderBox <?php echo $background_class; ?>" id="orderBox" data-order="<?php echo $row['order_id']; ?>">
              <div class="orderBox-left">Order Id: #<?php echo $row['order_id']; ?> | <?php echo $dateArray[0]; ?></div>

              <div class="orderBox-centre">

                <?php
                  $order_id = $row['order_id'];
                  $forTit = $db->query("SELECT * FROM sub_orders WHERE order_id='$order_id'");
                  $subTitle = "";
                  while( $tit = $forTit->fetch_assoc() )
                  {
                    $subTitle = $subTitle.$tit['sabziz'].", ";
                    $sabzi = $tit['sabziz'];
                    $breakArray = explode(' ', $sabzi, 2);
                    $qty = $tit['qty_in_kg'];
                    // $forSab = $db->query("SELECT sabzi_pic FROM sabziz WHERE sabzi_name='$sabzi'");
                    // $sab = $forSab->fetch_assoc();
                    // $sabImg = $sab['sabzi_pic'];
                ?>
                  <div class="sabzi-img" title="<?php echo $qty." Kg"; ?>">
                    <span class="mls"><?php echo $breakArray[0].', '; ?></span>
                  </div>
                <?php
                  }
                ?>

                <div class="clear"></div>

              </div>

              <div class="orderBox-right">Total Price: ₹ <?php echo $row['total_price']; ?></div>
              <div class="clear"></div>
            </div>
      <?php
          }
        }
      ?>

    </div>
	</div>

</body>
</html>

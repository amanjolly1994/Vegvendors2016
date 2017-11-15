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
		<div class="orderPage" id="orderPage">
			<form name="rate-orders" class="rate-orders" method="POST">

				<!-- FETCHING ORDERS FROM DATABASE -->
				<?php
					$uid = $_SESSION['uid'];

					$q = "SELECT s.order_id, s.sabziz, s.qty_in_kg, s.price, s.delivery_status, m.order_date, sv.name
FROM `sub_orders` s
INNER JOIN `main_orders` m ON s.order_id = m.order_id
INNER JOIN `sabzi_wala` sv ON sv.svid = s.svid
WHERE m.uid ='$uid'
ORDER BY `m`.`order_date` DESC ";

					$res = $db->query($q);

				?>

				<table class="your-orders">

					<tr>
						<td>Order Id</td>
						<td>Vegetable</td>
						<td>Qty</td>
						<td>Price</td>
						<td>Vendor</td>
						<td>Date</td>
						<td>Status</td>
						<td>Rating</td>
					</tr>

					<?php
					while( $orders = $res->fetch_assoc() )
					{
						if( $orders["delivery_status"] == 0 )
							$del = "Pending";
						else if( $orders["delivery_status"] == 1 )
							$del = "Delivered";
					?>
					<tr>
						<td><?php echo $orders["order_id"]; ?></td>
						<td><?php echo  $orders["sabziz"]; ?></td>
						<td><?php echo  $orders["qty_in_kg"]; ?></td>
						<td><?php echo  $orders["price"]; ?></td>
						<td><?php echo  $orders["name"]; ?></td>
						<td><?php echo  $orders["order_date"]; ?></td>
						<td class="<?php echo $del; ?>"><?php echo $del; ?></td>
						<td>
							<div id="stars-default">
								<input type="hidden" name="rating" />
							</div>
						</td>
					</tr>
					<?php
					}
					?>

				</table>

			</form>
		</div>
	</div>

</body>
</html>

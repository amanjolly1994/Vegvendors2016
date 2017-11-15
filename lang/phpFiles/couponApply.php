<?php

	session_start();
	require_once "dbConfig.php";

	$code = "";

	if($_POST)
	{
		$code = $_POST['couponcode'];
		$total = $_POST['totalAmount'];
	}

	// Promo Code Checking 

	try
	{
		$q = "SELECT * FROM default_promo_table WHERE Promo_code=:code";
		$stmt = $db_con->prepare($q);
		$stmt->execute(array(":code"=>$code));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$count = $stmt->rowCount();

		if( $count > 0 )
		{
			$discount = $row["discount"];
			$min = $row["minimum"];
			$max = $row["maximum"];

			if( $total >= $min )
			{
				$newTotal = $total - ( $total*($discount/100) );
				if( $newTotal <= $max )
				{
					$_SESSION["discount"] = $discount;
					$_SESSION["newTotal"] = $newTotal;

					echo "done";
				}
				else
					echo "not";
			}
			else
					echo "not";
		}
		else
					echo "not";
	}

	catch (PDOException $e)
	{
		echo $e->getMessage();
	}



?>
<?php

	require_once "dbConfig.php";

	$code = "";
	$status = "not";

	if($_POST)
	{
		$code = $_POST["code"];
	}

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
			$status = "ok";

			$cup[] = array(
					 "status" => "$status",
					 "discount" => "$discount",
					 "min" => "$min",
					 "max" => "$max"
					 );

			$json = json_encode($cup);

			echo $json;

		}
		else
		{
			echo "not";
		}

	}

	catch (PDOException $e)
	{
		echo $e->getMessage();
	}


?>
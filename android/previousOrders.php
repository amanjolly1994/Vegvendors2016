<?php

	require_once 'dbConfig.php';

	if( $_POST )
	 $uid = $_POST['uid'];
	  //$uid =246;
	echo previous_orders($uid);
	function previous_orders($uid)
	{
			global $db;
		$q = "SELECT sz.sabzi_id, s.order_id, s.sabziz, s.qty_in_kg, s.price, m.delivery_status, m.order_date, sv.name, m.order_rating
FROM `sub_orders` s
INNER JOIN `main_orders` m ON s.order_id = m.order_id
INNER JOIN `sabzi_wala` sv ON sv.svid = s.svid
INNER JOIN `sabziz` sz ON sz.sabzi_name = s.sabziz
WHERE m.uid = '$uid'
ORDER BY `m`.`order_date` DESC";

		$res = $db->query($q);

		$list=array();

		$same = 0;

		$sub = array();

		$count = $res->num_rows;

		if( $count > 0 )
		{

		$status = "ok";

		array_push($list,$status);

		while( $row = $res->fetch_assoc() )
		{

			if( $same == $row['order_id'] )
			{
				$subdata = new stdClass();
				$subdata->vegetableId=$row['sabzi_id'];
				$subdata->qty=$row['qty_in_kg'];
				$subdata->price=$row['price'];
				
				
				array_push($sub,$subdata);
				$data->order=$sub;
			}
			else
			{
				$data = new stdClass();
				$sub = array();
				$data->id=$row['order_id'];
				$data->status=$row['delivery_status'];
				if($row['order_rating'] == null)
					$data->rating=0;
				else
					$data->rating=$row['order_rating'];


				$subdata = new stdClass();
				$subdata->vegetableId=$row['sabzi_id'];
				$subdata->qty=$row['qty_in_kg'];
				$subdata->price=$row['price'];
				
				
				array_push($sub,$subdata);
				$data->order=$sub;
				array_push($list,$data);
			}



			$same = $row['order_id'];

		}

		return json_encode($list);

		}

		else
		{
			$status = "not";

			array_push($list,$status);

			return json_encode($list);
		}

}


?>

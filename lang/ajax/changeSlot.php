<?php
	require_once ('dbConfig.php');

//$Orderid=10;
//$timeslot=6;
$Orderid=$_POST['order_id'];
$timeslot=$_POST['slot-selection'];


changeSlot($Orderid,$timeslot);
function changeSlot($Orderid,$timeslot)
{
global $db;
$Orderid=$Orderid;
$timeslot=$timeslot;



	if ($res=$db->query("SELECT * FROM `main_orders` WHERE `order_id` ='$Orderid'"))
	{
	 	 while( $row = $res->fetch_assoc() )
        {
            if ($timeslot!=$row['timeslot_id'] && ($row['timeslot_change_counter'] == 0))
            {

							if($db->query("UPDATE `main_orders` SET `timeslot_id` = '$timeslot', `timeslot_change_counter` = 1 WHERE `order_id` ='$Orderid'"))
							{

							  echo "ok";

                        	if( $timeslot == 1 )
                        	 	$slot_value = "Today 07 AM - 10 AM";
                        	 if( $timeslot == 2 )
                        	 	$slot_value = "Today 01 PM - 02 PM";
                        	 if( $timeslot == 3 )
                        	 	$slot_value = "Today 06 PM - 09 PM";
                        	 if( $timeslot == 4 )
                        	 	$slot_value = "Tomorrow 07 AM - 10 AM";
                        	 if( $timeslot == 5 )
                        	 	$slot_value = "Tomorrow 01 PM - 02 PM";
                        	 if( $timeslot == 6 )
                        	 	$slot_value = "Tomorrow 06 PM - 09 PM";
                        	 if( $timeslot == 99 )
                        	 	$slot_value = "Immidiate Delivery - + ₹20";

							  include('../../smtp.php');


												$user_name="Master Vender";
							                    $user_email="mvpitampura@gmail.com";

							                    //mvpitampura@gmail.com
												$subject="Vegvendor User slot changed ";
											 $body ="Vegvendor user with Order id ".$Orderid." has changed the delivery slot to ".$timeslot."slot value".$slot_value;
							                    send_mail($user_email, $user_name, $body, $subject);


							}
							else
							{
							    echo "Error: "  . "<br>" . $db->error;
							}
				}
				else
				{
					echo "same timeslot";
				}

        }

	 }










}

?>

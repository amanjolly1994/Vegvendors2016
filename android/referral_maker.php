<?php
	require_once 'dbConfig.php';



//$uid = $_POST['uid'];
$uid=3;
echo $uid;
echo referral($uid);


function referral ( $uid ){
    
		global $db;
        
		
        $uid=$uid;
        
		$q = "SELECT * FROM `registered_users` WHERE `uid`='$uid' " ;

		$res = $db->query($q);

	

		$count = $res->num_rows;

		if( $count > 0 )
		{    
        
			$row = $res->fetch_assoc();
			
			$referralc =$row['referral_code'];

			if( $referralc == null || $referralc == '' )
			{
				$referralNew= "VV".mt_rand( 100,999 ).$uid;

                 
               $q2 = "UPDATE `registered_users` SET `referral_code` = '$referralNew' WHERE `uid` =`$uid`";
                   
               if ( $res2 = $db->query($q2) )
	           {

	           	  return $referralNew;
	           }
			}		             
        	else
            	return $referralc;
        }        
        



}


?>
<?php
	require_once 'dbConfig.php';

$uid = $_POST['uid'];
//$uid=15;
echo referral($uid);


function referral ( $uid ){
    
		global $db;
        
		
        $uid=$uid;
        
		$q = "SELECT * FROM `referral_code` WHERE `uid`='$uid' " ;

		$res = $db->query($q);

	

		$count = $res->num_rows;

		if( $count > 0 )
		{
            


        
		while( $row = $res->fetch_assoc() )
		{
				
				
				$referralc =$row['referral code'];
                
                
                
      	}
        
            return $referralc;
        }
        else
        {
         
       
                 $referralNew= "VV".mt_rand( 100,999 ).$uid;
                 
                 $q2 = "INSERT INTO `referral_code` (`uid` ,`referral code` ,`credit`)VALUES ('$uid', '$referralNew', '0')";
                   
                    $res2 = $db->query($q2);
            
       
       
        return $referralNew;
        }
        
        



}


?>
<?php
	require_once 'dbConfig.php';

$r=$_POST['referral'];
$suid=$_POST['uid'];
//$r="VV55915";
//$suid="11";
echo credit_maker($r,$suid);


function credit_maker( $referral,$suid ){
    
		global $db;
        $status = 0;
        $suid=$suid;
		
        $referral=$referral;
        
		$q = "SELECT * FROM `referral_code` WHERE `referral code`='$referral' " ;

		$res = $db->query($q);

	

		$count = $res->num_rows;

		if( $count > 0 )
		{



        
		while( $row = $res->fetch_assoc() )
		{
				
				
				
                $uid=$row['uid'];
                
                  		
			
		}
        
        
        
        
         $q2 = "INSERT INTO `referral_parent` (`uid_child`, `parent_id`, `count`) VALUES ('$suid', '$uid', '0')" ;
                   
                    $res2 = $db->query($q2);
                    
          $q3 = "UPDATE `registered_users` SET `credit` = '1' WHERE `uid` ='$suid';" ;
                   
                 if ($res3 = $db->query($q3))
                    
                    { 
                        $status = "referral applied sucessfully";
        
        
                    }
        }
        
        
        else
        {
                    $status = "referral was not found";
            
        }


	return $status;
}


?>
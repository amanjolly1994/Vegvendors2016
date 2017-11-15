<?php

require_once 'dbConfig.php';

$suid = $_POST['suid'];

//$suid="11";

echo parent_credit($suid);

function parent_credit($suid){

$suid=$suid;

	global $db;
        
		$q = "SELECT * FROM `referral_parent` WHERE `uid_child`='$suid'" ;

		$res = $db->query($q);

	

		$count = $res->num_rows;

		if( $count > 0 )
		{



        
		while( $row = $res->fetch_assoc() )
		{
				
				
				
                $puid=$row['parent_id'];
                $counter=$row['count'];
                  		
			
		}
                $counter++;
                if ($counter>5)
                
                {
                    //delete records
                    
                    	$q3 = "DELETE FROM `referral_parent` WHERE `uid_child`='$suid'" ;

	                   	$res3 = $db->query($q3);

                    
                }
                else
                {
                    //inserting records
                    
                    
                    
                    $q4 = "UPDATE `referral_parent` SET `count` = '$counter' WHERE `uid_child` ='$suid'" ;

	                  if ($res4 = $db->query($q4))
                    {
                        //if inserted then add credit to the parent referral
                        
                           	$q1 = "SELECT * FROM `registered_users` WHERE `uid`='$puid'" ;
                    
                    		
                            
                            
                    	
                    
                    		if( $res1 = $db->query($q1) )
                    		{
                    
                    
                    
                            
                    		while( $row1 = $res1->fetch_assoc() )
                    		{
                    				
                    				
                    				
                                    $credit=$row1['credit'];
                                    
                                      		
                    			
                    		}
                            
                            $credit++;
                            
                    $q2 = "UPDATE `registered_users` SET `credit` = '$credit' WHERE `uid`='$puid' " ;
                   
                    $res2 = $db->query($q2);
                            
                    	
                    }
                                            
                        
                    }
                    
                    
                }


return (1);       

 }
 else
 return (0);
        
}
?>
<?php
//session_start();
	//include "time.php";
	require_once ('../dbConfig.php');
	
	

CrashReporter();
function CrashReporter()
{
global $db;
	
	

	if($_POST)
	{
		$uid=$_POST["uid"];
		$data=$_POST["data"];

	}
	else
	 {
		$uid=0;
	}	
  
  // //$uid=$_POST["uid"];
  // $uid=1;
  // $data="bla bla";
  
  $decoded=base64_decode($data);


   
   $dir = "CrashReports/$uid/";

		
		if(!file_exists($dir))
		{
			echo $dir;
			mkdir($dir,0777, true);
		}

		$location=$dir.date('Y-m-d_H-i-s').".txt";
		
		if (file_put_contents($location, $decoded))
        {		echo date('Y-m-d_H-i-s'); 
    					echo "</br>";
    			echo date('Y-m-d H:i:s'); 
              $t=date('Y-m-d_H-i-s'); 
              echo "<br>your report has been submitted";
             
              global $db_con;
            $stmt = $db_con->prepare("INSERT INTO `crashreport`(`userId`,`timestamp`,`path`) VALUES(:uid, :time, :location)");
			$stmt->bindParam(":uid",$uid);
			$stmt->bindParam(":time", date('Y-m-d H:i:s'));
			$stmt->bindParam(":location",$location);


			if($stmt->execute())
				{

					require_once '../smtp.php';
					echo "registered in db";
					  //mail for admin vendor
						$user_name="crash monitor";
						$admin_vendor_email="rashanjyot@yahoo.com";
						$admin_vendor_email2="vegvendorsindia@gmail.com";
						$subject="Crash Report notification for vegvendor app";
						$body = "<p>Hello <b>Admin</b>, <br><br>
						              A crash report has been generated for user Id: <b>$uid</b>.
						              <br>
						              at indian standard time $t
						              <br>
						              You can check the report at $location
						            <br><br>
						            Sincerely<br>
						            <b>Veg Vendors development Team</b></br>
						            <p>here is the link of crash report<p></br> http://www.vegvendors.in/android/$location
						          </p>";
						send_mail($admin_vendor_email, $user_name, $body, $subject);
						send_mail($admin_vendor_email2, $user_name, $body, $subject);
        		}
       
    
    
    






		
		
}
 else
        {
            echo "report not submitted";
        }
}
?>

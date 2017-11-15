<?php
	require_once ('../dbConfig.php');


 CrashReporter();
function CrashReporter()
{
global $db;

  
 
   
   $dir = "cReport/";

		
		if(!file_exists($dir))
		{
			echo $dir;
			mkdir("cReport/",0777, true);
		}

		$target_Path = "cReport/";
		
		if (move_uploaded_file( $_FILES['crash']['tmp_name'], $target_Path.$_FILES['crash']["name"] )
        {
              echo "your report has been submitted";
        }
        else
        {
            echo "report not submitted";
        }
    
    
    






		
		//return json_encode($outercover);
}

?>

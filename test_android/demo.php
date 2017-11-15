<?php
	require_once '../dbConfig.php';
        echo "page access";
        echo $_POST["flag"];

if ($stmt = $db_con->prepare("INSERT INTO bug_testing(post) VALUES(:post)"))
				{
					$stmt->bindParam(":post",$_POST["flag"]);

					if($stmt->execute())
				{

					echo "done in db";

				}
				else
				{
					echo $db_con->error;
				
				}	
				
				}
				else
				{
					echo $db_con->error;
				}	



		try{
		if (($_POST["flag"]))
		{

				echo "data exist".$_POST["flag"];


			

		}	


else
{

	echo "posting error";
	// 	   foreach ($_POST as $key => $value) 
	// {
 //        echo "<tr>";
 //        echo "<td>";
 //        echo $key;
 //        echo "</td>";

 //        echo "<td>";
 //        echo $value;
 //        echo "</td>";
 //        echo "</tr>";
 //    }

}	
}
catch(Exception $e){
			//echo $response["status"]="error";
			//echo $e;
			echo "error in catch";
		}
?>
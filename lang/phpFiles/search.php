<?php
include("dbConfig.php");
if($_POST)
{
	$q=$_POST['search'];
	if( !($res = $db->query("SELECT * FROM sabziz WHERE sabzi_name like '%$q%' OR hindi_name like '%$q%' order by sabzi_id LIMIT 5")) )
	{
		echo "error";
	}
	else{
		$rowCount = $res->num_rows;
		if( $rowCount > 0 )
		{
			while( $row=$res->fetch_assoc() )
			{
				$sabzi_name=$row['sabzi_name'];

				$b_sabzi_name='<strong>'.$q.'</strong>';

				$final_name = str_ireplace($q, $b_sabzi_name, $sabzi_name);

			?>

			<a href="pcveg.php?cat=<?php echo $row['sabzi_category']; ?>&sc=<?php echo $row['sabzi_id']; ?>">
			<div class="search-show" align="left">
				<div class='search-image'>
					<img src='<?php echo '/'.$row['sabzi_pic']; ?>' />
				</div>
				<span class="search-show-name"><?php echo $final_name; ?></span>
				<div class='clear'></div>
			</div></a>
			<?php
			}
		}
		else{
			echo "not";
		}
	}
}
?>

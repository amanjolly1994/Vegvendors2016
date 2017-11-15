<?php
	session_start();

	$cat = $_POST['cat'];
	$vendor = $_POST['id'];

	// echo "vendor is ".$vendor;
	// echo "id is ".$cat;

	if( $cat == 1 )
	{
		ob_start();
		$_SESSION['cat1vendor'] = $vendor;
		?>
		<script type="text/javascript">
		var cat1vendor = <?php echo $vendor; ?>;
		</script>
		<?php
		ob_end_clean();
		echo "ok";
	}
	else if( $cat == 2 )
	{
		ob_start();
		$_SESSION['cat2vendor'] = $vendor;
		?>
		<script type="text/javascript">
		var cat2vendor = <?php echo $_SESSION['cat2vendor']; ?>;
		</script>
		<?php
		ob_end_clean();
		echo "ok";
	}
	else if( $cat == 3 )
	{
		ob_start();
		$_SESSION['cat3vendor'] = $vendor;
		?>
		<script type="text/javascript">
		var cat3vendor = <?php echo $_SESSION['cat3vendor']; ?>;
		</script>
		<?php
		ob_end_clean();
		echo "ok";
	}
	else if( $cat == 4 )
	{
		ob_start();
		$_SESSION['cat4vendor'] = $vendor;
		?>
		<script type="text/javascript">
		var cat4vendor = <?php echo $_SESSION['cat4vendor']; ?>;
		</script>
		<?php
		ob_end_clean();
		echo "ok";
	}
	else
		echo "not";

?>

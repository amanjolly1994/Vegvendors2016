<?php 
include('dbconfig1.php'); 
$ss=("SELECT * FROM areas");
$query_parent = mysqli_query($con,$ss);

if($query_parent)
	
	{
		echo"done";
	}
	else {
 echo "Query failed: ".mysqli_error($con);
	}
?>


<html>
<head>
<meta charset="utf-8">
<title>Dependent DropDown List</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
 
	$("#parent_cat").change(function() {
		$(this).after('<div id="loader"><img src="img/loading.gif" alt="loading subarea" /></div>');
		$.get('dropdown1.php?parent_cat=' + $(this).val(), function(data) {
			$("#sub_cat").html(data);
			$('#loader').slideUp(200, function() {
				$(this).remove();
			});
		});	
    });
 
});
</script>
</head>
 
<body>
<form method="get" action="dropdown1.php">
	<label for="area">area</label>
    <select name="parent_cat" id="parent_cat">
        <?php while($row = mysqli_fetch_array($query_parent)): ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['areas']; ?></option>
        <?php endwhile; ?>
    </select>
    <br/><br/>
 
    <label>Sub area</label>
    <select name="sub_cat" id="sub_cat"></select>
</form>
</body>
</html>
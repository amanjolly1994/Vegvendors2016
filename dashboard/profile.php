<?php
	include('../dbConfig.php');
	session_start();
?>

<html>
<head>
<title>Profile</title>
	<!-- Style Links -->

	<link rel="stylesheet" type="text/css" href="/theme/css/fonts.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/global.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/header.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/home.css" />
	<link rel="stylesheet" type="text/css" href="/theme/css/style.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:501px) and (max-width:800px)" href="/theme/css/medium_size.css" />
	<link rel="stylesheet" type="text/css" media="only screen and (min-width:50px) and (max-width:500px)" href="/theme/css/small_size.css" />

	<!-- [if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- JavaScript Links -->
	<script type="text/javascript" src="/lang/js/jquery-1.11.1.min.js" ></script>
	<script type="text/javascript" src="/lang/js/h-theme-all-01.js" ></script>
	<script type="text/javascript" src="/lang/js/h-tunnel.js" ></script>
	<script type="text/javascript" src="/lang/js/h-valid-v1.1.vvg.js" ></script>

	<!-- AJAX FILES -->

	<script type="text/javascript" src="/lang/ajax/dashboard-ajax.js"></script>

</head>

<body>
	<?php
		$uid = $_SESSION['uid'];

		$userImage = "/theme/images/icons/default-pic.png";
		$userGender = "";
		$userFav = "";
		$userAddress = "";


		$qq = $db->query(" SELECT * FROM registered_users WHERE uid='$uid' ");
		while( $userInfo = $qq->fetch_assoc() )
		{
			$userName = $userInfo["user_name"];
			if( $userInfo["pic"] != null || $userInfo["pic"] != "" )
				$userImage = $userInfo["pic"];
			$userGender = $userInfo["gender"];
			
			$userEmail = $userInfo["email"];
			$userAddress = $userInfo["delivery_address"];
			$userFav = $userInfo["favourite"];
		}
	?>

	<div class="inSize">
		<div class="profilePage" id="profilePage">

			<div class="imageChangeBox">
				<div class="photoPreviewWrapper">
					<img src="<?php echo $userImage; ?>" class="previewHolder" />
				</div>

				<div class="changePhotoButtons">
					<form method="POST" action="/lang/phpFiles/updateProfile.php" id="uppy" class="uppy" name="uppy" enctype="multipart/form-data" >
						<div class="btn-upload">
							<span>Choose Image</span>
							<input type="file" name='photo' id="uploadPhotoBtn" class="uploadPhotoBtn" />
							
						</div>
						<div>
							<input type="submit" name="removePhoto" id="removePhoto" class="removePhoto" value="Save Image" />
												
						</div>
					</form>
				</div>

				<div class="clear"></div>
			</div>

			<div class="row profileEditBox">

				<form name="editProfile" class="editProfile" id="editProfile" method="POST" enctype="multipart/form-data" >

					<div class="no-clear">
						<label for="username">Your Name</label>
						<input type="text" class="editUsername" name="username" value="<?php echo $userName; ?>" />
					</div>

					<div class="no-clear">
						<label for="gender">Gender</label>
						<select class="genderSelection" name="gender">
							<option value="">Select Gender</option>
							<option value="male" <?php if($userGender=="male") echo "selected"; ?>>Male</option>
							<option value="female" <?php if($userGender=="female") echo "selected"; ?>>Female</option>
						</select>
		
					</div>

					<div class="no-clear">
						<label for="email">Email</label>
						<input type="text" class="noEditEmail" title="Email cannot be changed" name="email" disabled value="<?php echo $userEmail; ?>" />			
					</div>

					<div class="no-clear">
						<label for="fav-veg">Favourite Vegetable</label>
						<input type="text" name="fav-veg" value="<?php echo $userFav; ?>" />
					</div>

					<div class="no-clear">
						<label for="address">Address</label>
						<input type="text" name="address" value="<?php echo $userAddress; ?>" />
					</div>

					<div class="no-clear">						
						<input type="submit" value="Make Changes" />
					</div>

					<div class="clear"></div>

				</form>

			</div>

		</div>
	</div>
	
</body>
</html>
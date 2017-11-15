<?php
	include('../dbConfig.php');
	session_start();
?>

<html>
<head>

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
	<script type="text/javascript" src="/lang/js/rating.js" ></script>

	<!-- AJAX FILES -->

	<script type="text/javascript" src="/lang/ajax/dashboard-ajax.js"></script>

</head>

<body>

	<div class="inSize">

		<div class="settingsPage" id="settingsPage">
			<ul class="settingTabs">
				<li class="general-li active">General</li>
				<li class="pass-li">Change Password</li>
				<li class="cont-li">Change Contact</li>
				<div class="clear"></div>
			</ul>

			<div class="settingContent">

				<?php
					$uid = $_SESSION['uid'];

					$genderPref = "";
					$invoice = "";

					$qq = $db->query(" SELECT * FROM registered_users WHERE uid='$uid' ");
					while( $userInfo = $qq->fetch_assoc() )
					{
						$genderPref = $userInfo["gender_preference"];
						$invoice = $userInfo["send_invoice"];
					}
				?>

				<div class="generalContent" id="generalContent">
					<form class="generalForm" name="generalForm" id="generalForm" method="POST" >

						<div>
							<div class="label-left">
								<label for="genderPref">Gender Preference</label>
							</div>

							<div class="radio-right">
								<div>
									<input type="radio" name="genderPref" value="female" <?php if($genderPref == "female") echo "checked"; ?>>Female</input>
								</div>
								<div>
									<input type="radio" name="genderPref" value="male" <?php if($genderPref == "male") echo "checked"; ?>>Male</input>
								</div>
								<div class="default-child">
									<input type="radio" name="genderPref" value="both" <?php if($genderPref == "both") echo "checked"; ?>>Default(Any)</input>
								</div>

								<div class="clear"></div>
							</div>

							<div class="clear"></div>
						</div>


						<div>
							<div class="label-left">
								<label for="sendEmail">Send Invoice via</label>
							</div>

							<div class="radio-right">
								<div>
									<input type="radio" name="sendEmail" value="2" <?php if($invoice == "2") echo "checked"; ?>>SMS</input>
								</div>
								<div>
									<input type="radio" name="sendEmail" value="1" <?php if($invoice == "1") echo "checked"; ?>>Email</input>
								</div>
								<div class="default-child">
									<input type="radio" name="sendEmail" value="0" <?php if($invoice == "0") echo "checked"; ?>>Default(Both)</input>
								</div>

								<div class="clear"></div>
							</div>

							<div class="clear"></div>
						</div>

						<div class="save-button-holder">
							<input type="submit" value="Save Changes" />
						</div>

					</form>


					<div>
						<p><label>Linked Accounts</label></p>

						<ul class="linkedAccounts">
							<li class="vegvendors">
								<span class="icon-vegvendors">v</span>
								<span class="mls">Veg Vendors</span>
							</li>
							<li class="facebook">
								<span class="icon-social-facebook"></span>
								<span class="mls">Facebook</span>
							</li>
							<li class="google">
								<span class="icon-google"></span>
								<span class="mls">Google</span>
							</li>
						</ul>
					</div>

				</div>
				<!-- GENERAL CONTENT ENDS -->

				<div class="changePasswordContent" id="changePasswordContent">

					<form class="changePasswordForm" id="changePasswordForm" name="changePasswordForm" method="POST">
						<div>
							<p for="currentPassword">Current Password</p>
							<input type="password" name="currentPassword" />
						</div>

						<div>
							<p for="newPassword">New Password</p>
							<input type="password" name="newPassword" />
						</div>

						<div>
							<p for="rePassword">Re-type New Password</p>
							<input type="password" name="rePassword" />
						</div>

						<div>
							<input type="submit" value="Change Password" />
						</div>
					</form>

				</div>
				<!-- CHANGE PASSWORD CONTENT ENDS -->

				<div class="changeContactContent" id="changeContactContent">

					<form class="changeContactForm" id="changeContactForm" name="changeContactForm" method="POST">
						<div>
							<p for="newPhone">Enter a new Phone number (10 digit)</p>
							<input type="text" name="newPhone" />
							<button type="submit" class="otpSendButton">Get OTP</button>
						</div>
					</form>

					<form class="changeOtp confirmPhone" name="confirmPhone" method="POST">
						<div>
							<p for="otp">Enter the recieved one time password (OTP)</p>
							<input type="text" name="otp" />
							<input type="submit" class="otpCheckButton disabledButton" value="Submit OTP" disabled />
						</div>
					</form>

				</div>
				<!-- CHANGE CONTACT CONTENT ENDS -->

			</div>
		</div>

	</div>

</body>
</html>

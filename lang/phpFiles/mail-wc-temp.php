<html>
<head>

	<title>Email Verification</title>

	<link href='https://fonts.googleapis.com/css?family=Droid+Sans|Arimo|Noto+Sans|Ubuntu' rel='stylesheet' type='text/css'>

</head>


<body style="box-sizing: border-box;height: 100% !important; margin: 0; padding: 0; width: 100% !important; font-family: Helvetica;">

	<div class="mail-page" style="max-width: 600px; margin: 80px auto;">

		<div class="logo-mail" style="text-align: left;">
			<img src="http://www.vegvendors.in/theme/images/logos/full-logo.png" style="width: 200px;" />
		</div>

		<div class="content-box" style="margin-top: 50px;border: 1px #bdbdbd solid;">

			<div class="mail-heading" style="padding: 20px; font-family: 'Droid Sans', sans-serif;" >
				<h1 style="font-size: 28px;color: #182432;">Welcome <?php echo $user_name; ?></h1>
				<p style="color: #676D76;font-size: 16px;font-weight: 400;">We provide a platform to connect with your local vendors.</p>
			</div>

			<div class="graphic" style="width: 100%;height: 300px;background: url('http://www.vegvendors.in/theme/images/pictures/email-back-purple.png') no-repeat;background-size: 100%;text-align: center;">
				<img src="http://www.vegvendors.in/theme/images/icons/sample-anime.gif" />
			</div>

			<div class="mail-content" style="text-align: center;margin-top: 0px;padding: 0px 40px 30px 40px;">
				<p style="text-align: left;font-size: 16px;color: #676D76;line-height: 25px;">We need to verify your registered email address. If you see this please click the verify button and start shopping.</p>

				<a href="<?php echo $ver_url; ?>"><button style="font-family: ubuntu;font-size: 16px;background: #2ecc71;color: #fff;padding: 10px 40px;border: none;margin-top: 20px;cursor: pointer;">Verify Email</button></a>
			</div>

		</div>

		<div class="footer" style="margin-top: 40px;text-align: center;font-family: Arimo;font-size: 14;color: #bdbdbd;">
			<p>You are currently logged in as: <span style="color: #64b5f6;text-decoration: none;"><?php echo $user_email; ?></span><br>
				Visit us at: <a href="vegvendors.in" style="color: #64b5f6;text-decoration: none;">vegvendors.in</a>
			</p>

		</div>

	</div>

</body>
</html>

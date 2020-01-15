<?php
function getCPUUsage(){
    $stat1 = file('/proc/stat');
    sleep(1);
    $stat2 = file('/proc/stat');
    $info1 = explode(" ", preg_replace("!cpu +!", "", $stat1[0]));
    $info2 = explode(" ", preg_replace("!cpu +!", "", $stat2[0]));
    $dif = array();
    $dif['user'] = $info2[0] - $info1[0];
    $dif['nice'] = $info2[1] - $info1[1];
    $dif['sys'] = $info2[2] - $info1[2];
    $dif['idle'] = $info2[3] - $info1[3];
    $total = array_sum($dif);
    $cpu = array();
    foreach($dif as $x=>$y) $cpu[$x] = round($y / $total * 100, 1);
    return $cpu['user'];
}
function getFreeRAM(){
    $fh = fopen('/proc/meminfo','r');
    $mem = 0;
    while ($line = fgets($fh)) {
        $pieces = array();
        if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
            $mem = $pieces[1];
            break;
        }
    }
    fclose($fh);

    return $mem;
}
date_default_timezone_set('UTC');
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 500000000000);
libxml_use_internal_errors(true);
$launcher = $argv[1];
$worker = $argv[2];
$pid = $argv[3];
$fold = $argv[4];
$checkGrepLauncher = shell_exec("ps ax|grep $launcher.php");
if($checkGrepLauncher){
    $psaux = explode(PHP_EOL, $checkGrepLauncher);
    $running = 0;
    foreach($psaux  as $one) {
        if(strpos($one, $fold.'/'.md5($fold).'.php') !== false){
            if(strpos($one, 'grep') === false) {
                $running++;
            }
        }
    }
    if($running>1){
        file_put_contents(getcwd().'/'.$fold.'/relaucnh222.txt',$fold.'/'.md5($fold).'.php'." Running $running ".$checkGrepLauncher.PHP_EOL,FILE_APPEND);
        exit;
    }
}else{
    file_put_contents(getcwd().'/'.$fold.'/relaucnh333.txt',$fold.'/'.md5($fold).'.php'." Running $running ".$checkGrepLauncher.PHP_EOL,FILE_APPEND);
    exit;

}
$resultJSON = json_decode(file_get_contents(getcwd().'/'.$fold.'/results.txt'), true);
$timeDiff = time() - $resultJSON['time'];
if($timeDiff < 300 and $pid != $resultJSON['pid'] and $resultJSON['state']!='Finished'){
    file_put_contents(getcwd().'/'.$fold.'/results1.txt',2);

    exit;
}
if($pid == $resultJSON['pid'] and $resultJSON['state']!='Finished'){
    $start = $resultJSON['start'];
    $end  = $resultJSON['end'];
}else{
    if($resultJSON['state']=='Finished'){
        file_put_contents(getcwd().'/'.$fold.'/results1.txt',3);

        exit;
    }
    $start = 0;
    $end  = 20;
}
$step = 20;
file_put_contents(getcwd().'/'.$fold.'/results1.txt',4);

$linecount = 0;
$handle = fopen(getcwd().'/'.$fold.'/task.txt', "r");
while(!feof($handle)){
    $line = fgets($handle);
    $linecount++;
}
fclose($handle);
file_put_contents(getcwd().'/'.$fold.'/results654.txt',$linecount);

while($start < $linecount){
    $cpu = getCPUUsage();
    $ram = getFreeRAM();
    while(($cpu < 50) and ($ram>200000) and ($start < $linecount)){
        exec('php '.getcwd().'/'.$fold.'/'.$worker.'.php \''.$start.'\' \''.$end.'\' \''.$fold.'\' > /dev/null & echo $!');
        $start += $step;
        $end += $step;
        //exec('php '.getcwd().'/'.$fold.'/'.$worker.'.php \''.$start.'\' \''.$end.'\' \''.$fold.'\' > /dev/null & echo $!');
        //$start += $step;
        //$end += $step;


        $cpu = getCPUUsage();
        $ram = getFreeRAM();
        $log = array('start'=>$start,'end'=>$end,'cpu'=>$cpu,'ram'=>$ram,'pid'=>$pid,'state'=>'Running','time'=>time());
        file_put_contents(getcwd().'/'.$fold.'/'.'results.txt',json_encode($log));
    }
    $log = array('start'=>$start,'end'=>$end,'cpu'=>$cpu,'ram'=>$ram,'pid'=>$pid,'state'=>'Sleeping','time'=>time());
    file_put_contents(getcwd().'/'.$fold.'/'.'results.txt',json_encode($log));
    sleep(5);
}
$log = array('start'=>$start,'end'=>$end,'cpu'=>$cpu,'ram'=>$ram,'pid'=>$pid,'state'=>'Finished','time'=>time());
file_put_contents(getcwd().'/'.$fold.'/'.'results.txt',json_encode($log));

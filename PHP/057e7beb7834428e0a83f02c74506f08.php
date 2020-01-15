<?php
$launcher = $argv[1];
$worker = $argv[2];
$pid = $argv[3];
$fold = $argv[4];
/*
$output = shell_exec('crontab -l');
if (strpos($output, $launcher) !== false) {
    file_put_contents(getcwd().'/crontab.txt', $output.'* * * * * php '.getcwd().'/'.$launcher.'.php '.$launcher.' '.$worker.' '.$pid.' '.$fold.PHP_EOL);
    echo exec('crontab '.getcwd().'/crontab.txt');
}
*/
file_put_contents(getcwd().'/'.$fold.'/crontab.txt', '* * * * * usr/bin/php '.getcwd().'/'.$launcher.'.php \''.$launcher.'\' \''.$worker.'\' \''.$pid.'\' \''.$fold.'\''.PHP_EOL);
echo exec('crontab '.getcwd().'/crontab.txt');

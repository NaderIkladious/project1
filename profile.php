<?php

session_start();

require 'blog.php';

// if ($_GET['id'] === user_id($_SESSION['username'], $conn)){
	
// }else {
// 	 header("Location: views/profile.php?id=<?= {$_GET['id']}; 
// }

if ($_GET['id'] === user_id($_SESSION['username'], $conn)){
	$mine = true;
}else {
	$mine = false;
}

if( isset($_POST['name'])) {
	change_name($_POST['name'], $_GET['id'], $conn);
}

if( isset($_POST['bioSave'])) {
	change_bio($_POST['bio'], $_GET['id'], $conn);
}

if( isset($_POST['chgPass'])) {
	if(empty($_POST['old']) || empty($_POST['first']) || empty($_POST['second'])){
		$pwd = "all fields are required!";
	} else {
		if(valid($_SESSION['username'], $_POST['old'], $conn)){
			if($_POST['first'] === $_POST['second']){
				change_pass($_POST['old'], $_POST['first'], $_POST['second'], $conn);
			}else {
				$pwd = "New Password don't match!";
			}
		}else {
			$pwd = "Wrong Old Password!";
		}
	}
}

// $posts = user_posts($_GET['id'], $conn);

$pageCount  = ceil((int)post_count($conn, "WHERE author_id = {$_GET['id']}") / 3 );

if (!isset($_GET['page']) || $_GET['page'] < 0 || $_GET['page'] > $pageCount) {
	$_GET['page'] = 1;
	$posts = get('posts', $conn,"*","WHERE author_id = {$_GET['id']}" , "ORDER BY id DESC", 0, 3);
}else {
	$edge = $_GET['page'] * 3;
	$posts = get('posts', $conn,"*", "WHERE author_id = {$_GET['id']}", "ORDER BY id DESC", (int)$edge-3, 3);
}


require 'views/profile.layout.php';
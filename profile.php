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

$posts = user_posts($_GET['id'], $conn);


require 'views/profile.layout.php';
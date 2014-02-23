<?php

require 'blog.php';

session_start();

$post = get_by_id($_GET['id'], $conn);
$comments = comments($_GET['id'], $conn);


if (isset($_POST['newCmt'])){
	$new = array('user' => $_SESSION['username'],
					 'post' => $_GET['id'],
					 'subject' => $_POST['test'],
					 'cmt'     => $_POST['comment'],
					 'date'    => date("d, m, Y \a\\t H:i"));

	new_comment($new, $conn);
	header("Location: single.php?id={$_GET['id']}");
}

if($post){
	$post = $post[0];
	if ($comments){
		view('single', array(
		'post' 		=> $post,
		'comments'  => $comments,
		'conn' 		=> $conn));		
	} else {
		view('single', array(
		'post' 		=> $post,
		'comments'  => false,
		'conn' 		=> $conn));		
	}
}else {
	header('Location:index.php');
}


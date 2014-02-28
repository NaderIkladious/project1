<?php

session_start();

require 'blog.php';


$pageCount  = ceil((int)post_count($conn) / 3 );

if (!isset($_GET['page']) || $_GET['page'] < 0 || $_GET['page'] > $pageCount) {
	$_GET['page'] = 1;
	$posts = get('posts', $conn,"*","" , "ORDER BY id DESC", 0, 3);
}else {
	$edge = $_GET['page'] * 3;
	$posts = get('posts', $conn,"*", "", "ORDER BY id DESC", (int)$edge-3, 3);
}

view('index', array(
	'posts' 	=> $posts,
	'pageCount' => $pageCount,
	'conn' 		=> $conn,
	));


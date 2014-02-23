<?php

session_start();

require 'blog.php';
$search = "%{$_GET['search']}%";

$posts = search($search, $conn);
$search = substr($search, 1, -1);

if ( $posts ){
	view('index', array(
		'posts' => $posts,
		'conn'	 => $conn));
}else{
	view('no-result', array(
		'term' => $search,
		'conn' => $conn));
}
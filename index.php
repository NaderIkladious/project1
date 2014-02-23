<?php

session_start();

require 'blog.php';

$posts = get('posts', $conn,"*","ORDER BY id DESC", 0, 5);

view('index', array(
	'posts' => $posts,
	'conn' => $conn,
	));


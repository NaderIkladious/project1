<?php 

session_start();

require 'blog.php';

$catagories = catagory($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$data =array('title' 	 => $_POST['title'],
				 'categ' 	 => $_POST['categ'],
				 'body'  	 => $_POST['body'],
				 'date'  	 => date("d, m, Y \a\\t H:i"),
				 'author_id' => $_SESSION['username']);

	if ( empty($data['title']) || $data['categ'] === "default" || empty($data['body'])) {
		$status = "All Fields are required";
	}else {
		new_post($data, $conn);
	}

}
view('new-post',array(
	'catagories' => $catagories,
	'conn' => $conn));
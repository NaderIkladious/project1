<?php


require 'blog.php';

session_start();

if ( is_logged_in()) {
	header("Location: index.php");
}

if( $_SERVER['REQUEST_METHOD'] == 'POST'){

	$username  = $_POST['username'];
	$password  = $_POST['password'];


	if ( empty($username) || empty($password)){
		$status = "Please provide a username and your password!";
	}else {

		if(isset($_POST['new'])){
			// Create new account

			if(user_exists($username, $conn)){
				$status = "username already EXISTS, Please pick another.";
			}else{
				create_user($username, $password, $conn);
				$_SESSION['username'] = $username;
				header('Location: index.php');
			}

		}else {

			// Validate user + set session
			if(valid($username, $password, $conn)){
				$_SESSION['username'] = $username;
				header('Location: index.php');
			}else {
				$status = "Wrong Username or Password!";
			}
		}
	}
}
require 'views/login.view.php';


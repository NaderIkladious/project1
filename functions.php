<?php

function view($path, $data = null)
{
	if($data){
		extract($data);
	}
	$path = $path . ".view.php";
	include "views/layout.php";	
}

function is_logged_in(){
	return isset($_SESSION['username']);
}	

function old($key, $checkbox = null)
{	
	if (!empty($_REQUEST[$key])){
		return htmlspecialchars($_REQUEST[$key]);
	}
	
	return '';
}

function checked($key)
{
	if (isset($_REQUEST[$key])){
		return "checked='checked'";
	}

	return '';
}

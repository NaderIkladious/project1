<?php

require '../blog.php';

$all = get('posts', $conn);
$users = all_users($conn);

if( isset($_POST['delete'])) {
	remove_post($_POST['id'], $conn);
	header("Location: index.php");
}

if( isset($_POST['deleteU'])) {
	remove_user($_POST['userId'], $conn);
	header("Location: index.php");
}

if( isset($_POST['mkAdmin'])) {
	admin($_POST['userId'], !($_POST['Admin']), $conn);
	header("Location: index.php");
	echo $Scroll_Pos;
}

$path = '../views/admin/users.view.php';
require '../views/admin/admin.tmpl.php';


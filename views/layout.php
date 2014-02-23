<?php 

// session_start(); 

if ( !is_logged_in()) {
	header("Location: login.php");
	die();
}
?>
<html>
<head>
	<title>Blog Me</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
	
	</style>
</head>
<body>
	<div class="side-left">
		<h1 class="logo">Blog Me</h1>
		<div class="block">
			<p class="side-title pos">Search:</p>
			<form class="search" action="search.php" method="get">
					<input type="text" name="search" placeholder="search"/>
					<input src="img/Search.png" type="image">					
			</form>
		</div>
		<div class="latest">
			<p class="side-title">latest topics:</p>
			<?php include 'latest.php'; include 'views/latest.view.php'; ?>
		</div>
		<div class="nav-menu size block">
			<ul>
				<li><a href="index.php">Catagories</a></li>
				<li><a href="">Latest Topics</a></li>
				<!-- <li><a href="">Logout</a></li>
				<li><a href="">New Post!!</a></li> -->
			</ul>
		</div>
	</div>
	<div class="main">
		<p>Welcome <?= htmlspecialchars($_SESSION['username']);?></p>
		<div id="menu" class="nav-menu">
			<ul>
				<li><a class="active" href="index.php">Home</a></li>
				<li><a href="profile.php?id=<?=user_id($_SESSION['username'], $conn); ?>">My Profile</a></li>
			<?php if(is_admin($_SESSION['username'], $conn)): ?>
				 <li><a href="admin/index.php">Admin</a></li>
			<?php endif; ?>
				<li><a href="logout.php">Logout</a></li>
				<li><a class="post-it"href="new-post.php">New Post</a></li>
			</ul>
		</div>
		<div class="slider">
			<img src="img/blog.jpg">
		</div>

		<?php include($path); ?>
		<div class="footer">

		</div>
	</div>


</body>
</html>
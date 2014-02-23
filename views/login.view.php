<?php 
// session_start();

// if( $_SERVER['REQUEST_METHOD'] == 'POST'){
// 	if(isset($_POST['new'])){
// 		$username = $_POST['username'];
// 		$password = $_POST['password'];
// 	}else {
// 		$username = $_POST['username'];
// 		$password = $_POST['password'];
// 	}
// }

?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="body">
	<h1 class="logo center">BLOG ME</h1>
	<form class="login" action"login.php" method="POST">
			
			<input class="bar" type="text" name="username" id="username" placeholder="Username" value="<?= old('username');?>"/><br>
			<input class="bar bar2" type="password" name="password" id="password" placeholder="Password"/>
			<input class="button" name="login" type="image" type="submit" src="img/go.png" />
			<!-- Squared FOUR -->
			<div class="squaredFour">
				<input type="checkbox" value="" id="squaredFour" name="new" <?= checked('new');?> />
				<label for="squaredFour"></label>
			</div>
			<span class="checkLabel">Not a user yet!</span>
			<?php if (isset($status)) : ?>
				<p style="color: orange; position: relative; top: -15px; left: 867px; width: 190px;"><?php echo $status; ?></p>
			<?php endif; ?>
			
	</form>
</body>
</html>
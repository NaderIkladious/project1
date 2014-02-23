<?php 
if(!(is_admin($_SESSION['username'], $conn))){
	header("Location: ../index.php");
}

?>
<html>
<head>
	<title>Admin Page</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="body">
	
	<div class="overlay">
		<h1 class="logo ad-logo">BLOG ME</h1>
		<div class="box">
			<?php include($path); ?>
		</div>
	</div>

</body>
</html>
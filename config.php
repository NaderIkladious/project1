<?php if(user($_GET['id'], $conn)): ?>
	<title><?= user($_GET['id'], $conn);?>'s Profile | Blog Me</title>
<?php endif; ?>
<?php if (!user($_GET['id'], $conn)) :?>
	<title>No User Found</title>
	<?php $status = "No User Found"; ?>
<?php endif; ?>

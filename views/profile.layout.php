<html>
<head>
	<?php require 'config.php'; ?>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style><?php require 'config2.php' ?></style>
</head>


<body <?php if (!isset($status)) { echo 'class="body"';} else {echo "";} ?>>

	<?php if (isset($status)) : ?>
		<h1><?= $status; ?></h1>
		<?php die(); ?>
	<?php endif; ?>

	<div class="ppicture">

	</div>

	<div class="biog">
			<?php if($mine){ ?>
				<form method="POST">
					<label class="bio-lb" for="bio">Biography</label>
					<textarea class="bio" type="text" name="bio" id="bio")/><?= htmlspecialchars(bio($_GET['id'], $conn)); ?></textarea>
					<input class="post-it bio-save" type="submit" value="save" name="bioSave">
				</form>
			<?php }else { ?>
				<label class="bio-lb" for="bio">Biography</label>
				<p class="bio"><?= htmlspecialchars(bio($_GET['id'], $conn)); ?></p>
			<?php } ?>
	</div>

	<div class="name">
			<?php if($mine){ ?>
				<form action="" method="POST">
					<input style="width:200px;" class="prof-name" type="text" name="name" value="<?=htmlspecialchars(name(user($_GET['id'], $conn),$conn)); ?>">
				</form>	
			<?php }else { ?>
				<label style="width:200px;" class="prof-name"><?=htmlspecialchars(name(user($_GET['id'], $conn),$conn)); ?></label>
			<?php } ?>
	</div>

	
	<div class="container">
		<?php include 'index.view.php'; ?>
	</div>
	
<?php if($mine) : ?>
	<div class="pass">
		<p>Change Password</p>
	<?php if(isset($pwd)): ?>
		<span class="notice" style="padding-left:25px;" style="float:left;"><?=$pwd; ?></span>
	<?php endif ; ?>
		<form action="" method="POST">
			<input class="pass-put" type="password" name="old" placeholder="Old Password">
			<input class="pass-put" type="password" name="first" placeholder="New Password">
			<input class="pass-put" type="password" name="second" placeholder="Verify Password">
			<input class="post-it change-p" type="submit" value="Change" name="chgPass">
		</form>	
	</div>
<?php endif; ?>

</body>
</html>
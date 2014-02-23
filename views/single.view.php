
<article>
	<h2 class="title">
			<?= $post['title'];?>
	</h2>
	<p>On <?= $post['date']; ?>, In <a href=""><?= $post['catagory'];?></a>,
		By <a href="profile.php?id=<?= $post['author_id']; ?>"><?= user($post['author_id'], $conn); ?></a>
	</p>
	<div class="post-body"><?= $post['body'];?></div>
</article>


<div class="comments">
	<?php if ($comments): ?>
		<?php foreach ($comments as $comment): ?>
				<h3 class="commenter"><?= user($comment['uid'], $conn);?></h3>
				<span class="commenter"> <?= $comment['date'];?></span>
				<div class="comment">
					<h4><?= $comment['subject']; ?></h4>
					<p> <?= $comment['body']; ?></p>
				</div>
		<?php endforeach; ?>
	<?php else : ?>
		<h4><?= "No Comments Yet." ?></h4>
	<?php endif ; ?>
</div>

<div class="new-comment">
		<h4>Leave your Comment</h4>
		<h3 class="commenter"><?=$_SESSION['username'];?></h3>
		<div class="comment">
			<form method="POST">
				<input class="subject" type="text" name="test" placeholder="Subject"><br><br>
				<textarea class="cmt" name="comment" placeholder="Your Comments..."></textarea><br><br>
				<input style="float:right" class="post-it" type="submit" value="Post" name="newCmt"><br>
			</form>
		</div>
</div>
<!-- <p><a href="">Back</a></p> -->
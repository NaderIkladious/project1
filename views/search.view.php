<?php foreach ($result as $post) : ?>

	<article>
		<h2 class="title">
			<a href="single.php?id=<?= $post['id']; ?>">
				<?= $post['title'];?>
			</a>
		</h2>
		<p>On <?= $post['date']; ?>, In <a href=""><?= $post['catagory'];?></a>,
			By <a href=""><?= user($post['author_id'], $conn); ?></a>
		</p>
		<div class="post-body"><?= $post['body'];?></div>
	</article>
<?php endforeach; ?>

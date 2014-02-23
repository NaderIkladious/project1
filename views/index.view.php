<?php foreach ($posts as $item) : ?>
	
	<article>
		<h2>
			<a href="single.php?id=<?= $item['id']; ?>" class="title">
				<?= $item['title'];?>
			</a>
		</h2>
		<p>On <?= $item['date']; ?>, In <a href=""><?= $item['catagory'];?></a>,
			By <a href="profile.php?id=<?= $item['author_id']; ?>"><?= user($item['author_id'], $conn); ?></a>
		</p>
		<div class="post-body"><?= $item['body'];?></div>
	</article>
<?php endforeach; ?>	
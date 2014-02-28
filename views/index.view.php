<?php if($posts) : ?>
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


	<ul id="page">
		<li><a <?php if($_GET['page'] <= 1){ echo 'style="pointer-events:none;"' ;} ?> href="index.php?page=<?=$_GET['page'] - 1 ;?>">Previous</a></li>
<?php for ($i=1; $i <= $pageCount; $i++) :  ?>
		<li><a href="?<?php if(isset($_GET['id'])) {echo "id=" . $_GET['id'] . "&"; } ?>page=<?=$i?>"><?=$i?></a></li>
<?php endfor; ?>
		<li><a <?php if($_GET['page'] >= $pageCount){ echo 'style="pointer-events:none;"' ;} ?> href="index.php?page=<?=$_GET['page'] + 1 ;?>">Next</a></li>
	</ul>
<? else : ?>
	<p>NO POSTS YET!</p>
<? endif ; ?>
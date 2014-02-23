<?php foreach ($latest as $elem) : ?>
	<a href="single.php?id=<?= $elem['id'];?>">
		<p class="last"><?= $elem['title'];?></p>
	</a>
<?php endforeach ;?>
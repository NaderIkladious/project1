<div class="table">
	<table class="cnt">
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Body</th>
			<th>Author</th>
			<th>date</th>
			<th>Operations</th>
		</tr>
	<?php $i = 0; ?>
	<?php foreach ($all as $one):?>
	<?php $i++; ?>
		<tr <?php if($i % 2 == 0) { echo 'class="eventr"';} ?>>
			<td><?=$i;?></td>
			<td><?= substr($one['title'], 0, 25) . "..."; ?></td>
			<td><?= substr($one['body'],0 , 30) . "..."; ?></td>
			<td><?= user($one['author_id'], $conn); ?></td>
			<td><?= $one['date']; ?></td>
			<td><form method="POST"><input style="display:none" name="id" value="<?= $one['id'];?>"><input class="btn-link" type="submit" value="Delete" name="delete"></form></td>
		</tr>
	<?php endforeach; ?>
	</table>
</div>
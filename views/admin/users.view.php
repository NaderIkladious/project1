<div class="table">
	<table class="cnt">
		<tr>
			<th>#</th>
			<th>User</th>
			<th>Name</th>
			<th>Operations</th>
		</tr>
	<?php $i = 0; ?>
	<?php foreach ($users as $one):?>
	<?php $i++; ?>
		<tr <?php if($i % 2 == 0) { echo 'class="eventr"';} ?>>
			<td><?=$i;?></td>
			<td><?= $one['username']; ?></td>
			<td><?= name(user($one['user_id'], $conn), $conn);?></td>
			<td>
				<form method="POST">
					<input style="display:none" name="userId" value="<?= $one['user_id'];?>">				
					<input style="display:none" name="Admin" value="<?= $one['is_admin'];?>">
					<input class="btn-link" style="width:110px" type="submit" value="<?php if(!$one['is_admin']){ echo 'Make Admin';} else { echo 'Remove Admin';} ?>" name="mkAdmin">
				
					 || 
					<input class="btn-link" type="submit" value="Delete User" name="deleteU">
				</form>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
</div>
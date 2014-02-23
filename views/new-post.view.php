<h3>Create a New Post</h3>

<form action="" method="POST">
	<ul class="form">
		<li>
			<label for="title">Title: </label>
			<input type="text" name="title" id="title" value="<?=old('title');?>"/>
		</li>
		
		<li>
			<label>Catagory: </label>
			<span class="lt-select-wrapper">
				<select class="lt-select" name="categ">
					<option value="default">Select a catagory</option>

					<?php foreach ($catagories as $catagory):?>
						<option value="<?= $catagory['catagory'];?>"><?= $catagory['catagory'];?></option>
					<?php endforeach; ?>

				</select>
			</span>
		</li>

		<li>
			<label for="body">Body</label><br>
			<textarea name="body"?><?= old('body');?></textarea>
		</li>
			
		<li>
			<input class="post-it" type="submit" name="postIt">
		</li>
			
	</ul>
</form>
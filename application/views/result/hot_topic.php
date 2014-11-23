<div class="row marketing">
	<?php echo form_open('in/selected/'.$logid); ?>
	<div class="col-sm-10">
		<h3 class="text-muted">Top 50 word</h3>
		<p>Improve your findings. Remove meaningless words.</p>
		<p>
			<button type="submit" class="btn btn-xs btn-danger" onclick="ShowProgressAnimation();">
				<i class="fa fa-check-square"> </i> Remove selected words
			</button>
		</p>
		<p>&nbsp;</p>
	</div>
	<div class="col-sm-2">
		<p>
			<a href="<?php echo base_url('out/graph/'.$logid); ?>" class="btn btn-xs btn-default"  onclick="ShowProgressAnimation();">
			Active Users
			</a>
		</p>
		<p>
			<a href="<?php echo base_url('out/filtered/'.$logid); ?>" class="btn btn-xs btn-default"  onclick="ShowProgressAnimation();">
			Top 50 words
			</a>
		</p>
		<p>
			<a href="<?php echo base_url('out/timeline/'.$logid); ?>" class="btn btn-xs btn-default"  onclick="ShowProgressAnimation();">
			Timeline
			</a>
		</p>
	</div>
	<div class="col-sm-6">
		<table class="table table-hover">
			<thead>
				<th>#</th>
				<th>Word</th>
				<th>Frequency</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</thead>
		<?php 
		if($word) { 
			$x = 1;
			foreach($word as $w) {
		?>
			<tr>
				<td><?php echo $x; ?>.</td>
				<td><?php echo $w->word; ?></td>
				<td><?php echo $w->count; ?></td>
				<td><a class="btn btn-xs btn-danger" href="<?php echo base_url('in/discard/'.$logid.'/'.$w->word); ?>">
					<i class="fa fa-trash-o"></i></a></td>
				<td><input type="checkbox" name="w[]" value="<?php echo $w->word; ?>"></td>
			</tr>
		
		<?php $x++; } } ?>
		</table>
	</div>
	<div class="col-sm-6">
		<table class="table table-hover">
			<thead>
				<th>#</th>
				<th>Word</th>
				<th>Frequency</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</thead>
		<?php 
		if($word2) { 
			$x = 26;
			foreach($word2 as $w2) {
		?>
			<tr>
				<td><?php echo $x; ?>.</td>
				<td><?php echo $w2->word; ?></td>
				<td><?php echo $w2->count; ?></td>
				<td><a class="btn btn-xs btn-danger" href="<?php echo base_url('in/discard/'.$logid.'/'.$w2->word); ?>">
					<i class="fa fa-trash-o"></i></a></td>
				<td><input type="checkbox" name="w[]" value="<?php echo $w2->word; ?>"></td>
			</tr>
		
		<?php $x++; } } ?>
		</table>
	</div>
	<?php echo form_close(); ?>
</div>



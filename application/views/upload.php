<div class="jumbotron">
	<h1>insight <i class="fa fa-cog fa-spin"></i></h1>
	<?php echo form_open_multipart('in/upload');?>
	<p>&nbsp;</p>
	<p class="lead">
		<input type="file" name="userfile" size="20" data-filename-placement="inside" />
	</p>
	<p><input type="submit" class="btn btn-sm btn-success" onclick="ShowProgressAnimation();" value="upload" /></p>
	<small>
		<span class="label label-danger">.txt</span>&nbsp;<span class="label label-danger">2048 bytes</span>
	</small>
	<?php echo form_close(); ?>
</div>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>insight</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
	
    <!-- font Awesome -->
    <link href="<?php echo base_url('assets/fa/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/bootstrap/css/'); ?>/jumbotron-narrow.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		
	<style>
	.a-c {
		text-align:center;
	}
	</style>
	
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="<?php echo base_url(); ?>">Home</a></li>
		  <li><a href="<?php echo base_url('info/how'); ?>">How it works</a></li>
          <li class="active"><a href="<?php echo base_url('info/about'); ?>">About</a></li>
          <li><a href="<?php echo base_url('info/contact'); ?>">Contact</a></li>
        </ul>
        <h3 class="text-muted"><i class="fa fa-cogs"></i> insight <small><span class="label label-danger"><?php echo version; ?></span></small></h3>
      </div>

	 <div class="jumbotron">
	 	<h3>About Insight</h3>
		<p>&nbsp;</p>
		<p>
			Currently, this project is running on a very limited resource server. At this moment, we allowed a maximum of 2048 bytes of txt file to be uploaded as it will affect our server performance and time taken to process every file. However, you can send your request to upload bigger file to us. With that in mind, users should expect some unpredictable performance from our service.
		</p>
		<p>&nbsp;</p>
		<p>From devel<i class="fa fa-code"></i>per to community</p>

	 </div>

      <div class="footer">
        <p>
			<samp><i class="fa fa-database"></i> Opendata MY &copy; 2014</samp> &nbsp; 
			<small><samp><i class="fa fa-line-chart"></i>&nbsp;Page loaded in <?php echo $this->benchmark->elapsed_time();?>s&nbsp;using <?php echo $this->benchmark->memory_usage();?></samp></small>
		</p>
      </div>

    </div> <!-- /container -->

	<script src="<?php echo base_url('assets/bootstrap/js/'); ?>/jquery.js"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/'); ?>/bootstrap.file-input.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('assets/bootstrap/js/'); ?>/ie10-viewport-bug-workaround.js"></script>
		
	<script type="text/javascript">
		$('input[type=file]').bootstrapFileInput();
		$('.file-inputs').bootstrapFileInput();
	</script>
	
  </body>
</html>

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
	
	<!-- jQuery -->
	<script src="<?php echo base_url('assets/bootstrap/js/'); ?>/jquery.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		
	<style>
	.a-c {
		text-align:center;
	}
	
	#loading-div-background {
        display:none;
        position:fixed;
        top:0;
        left:0;
        background:black;
        width:100%;
        height:100%;
     }
	 
	 #loading-div {
          width: 300px;
          height: 200px;
          background-color: #0c0b0b;
          text-align:center;
          position:absolute;
          left: 50%;
          top: 50%;
          margin-left:-150px;
          margin-top: -100px;
      }
	
	</style>
	
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
		  <li><a href="<?php echo base_url('info/how'); ?>">How it works</a></li>
          <li><a href="<?php echo base_url('info/about'); ?>">About</a></li>
          <li><a href="<?php echo base_url('info/contact'); ?>">Contact</a></li>
        </ul>
        <h3 class="text-muted"><i class="fa fa-cogs"></i> insight <small><span class="label label-danger"><?php echo version; ?></span></small></h3>
      </div>
	 <div
	   class="fb-like"
	   data-share="true"
	   data-width="450"
	   data-show-faces="false">
	 </div>
	  <?php 
	  $err = $this->session->flashdata('err');
	  	if($err) { 
	  ?>
	  <div class="alert alert-warning alert-dismissible fade in" role="alert">
	    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	    <strong>Ooppss!</strong><br/>
		<?php foreach($err as $e) { ?>
				<p><?php echo $e; ?></p>
		<?php } ?>
	  </div>
	  <?php } ?>
	  
	  <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>','</div>');?>

	 <?php $this->load->view($pg); ?>
	 
      <div class="footer">
        <p>
			<samp><i class="fa fa-database"></i> Opendata MY &copy; 2014</samp> &nbsp; 
			<small><samp><i class="fa fa-line-chart"></i>&nbsp;Page loaded in <?php echo $this->benchmark->elapsed_time('code_start', 'code_end');?>s&nbsp;using <?php echo $this->benchmark->memory_usage();?></samp></small>
		</p>
      </div>
	  
	  <div id="disqus_thread"></div>
	  
	  <div id="loading-div-background">
	      <div id="loading-div" class="ui-corner-all" >
	        <img style="height:80px;margin:30px;" src="<?php echo base_url('assets/img/spinner.gif'); ?>" alt="Loading.."/>
	        <h2 style="color:gray;font-weight:normal;">processing</h2>
	       </div>
	  </div>

    </div> <!-- /container -->

	<script src="<?php echo base_url('assets/bootstrap/js/'); ?>/bootstrap.js"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/'); ?>/bootstrap.file-input.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('assets/bootstrap/js/'); ?>/ie10-viewport-bug-workaround.js"></script>
		
	<script type="text/javascript">
		$('input[type=file]').bootstrapFileInput();
		$('.file-inputs').bootstrapFileInput();
	</script>
	
	<script type="text/javascript">
	        $(document).ready(function () {
	            $("#loading-div-background").css({ opacity: 0.8 });
           
	        });

	        function ShowProgressAnimation() {
         
	            $("#loading-div-background").show();

	        }

	</script>
	
 <script>
   window.fbAsyncInit = function() {
     FB.init({
       appId      : '692357604179276',
       xfbml      : true,
       version    : 'v2.1'
     });
   };

   (function(d, s, id){
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {return;}
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
 </script>
 
 <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'insightodmy'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	
  </body>
</html>

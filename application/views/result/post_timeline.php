<link href="<?php echo base_url('assets/bootstrap/css/timeline.css'); ?>" rel="stylesheet">
<div class="row marketing">
	<div class="col-sm-10">
		<h3 class="text-muted">Conversation Timeline</h3>
		<p>chit chat chit</p>
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
	
	<div class="col-sm-12 wrap">
		<hr/>
		<ul class="timeline">
		       <?php 
			   if($data) { 
			    ?>
  		        
				<?php
				   $x = 1;
				   foreach($data as $post) {
					   if($x & 1) {
				?>
		        <li class="timeline post">
		          <div class="timeline-badge warning"><i class="glyphicon glyphicon-chevron-left"></i></div>
		          <div class="timeline-panel">
		            <div class="timeline-heading">
		              <h4 class="timeline-title"><?php echo $post->postuser; ?></h4>
					  <p>
						 <small class="text-muted"><i class="glyphicon glyphicon-time"></i>
					  	 <?php echo date('j M Y',strtotime($post->postdate)); ?></small>
					  </p>
		            </div>
		            <div class="timeline-body">
		              <p><?php echo $post->postcomment; ?></p>
		            </div>
		          </div>
		        </li>
				<?php } else { ?>
		        <li class="timeline-inverted post">
		          <div class="timeline-badge warning"><i class="glyphicon glyphicon-chevron-right"></i></div>
		          <div class="timeline-panel">
		            <div class="timeline-heading">
		              <h4 class="timeline-title"><?php echo $post->postuser; ?></h4>
					  <p>
						 <small class="text-muted"><i class="glyphicon glyphicon-time"></i>
					  	 <?php echo date('j M Y',strtotime($post->postdate)); ?></small>
					  </p>
		            </div>
		            <div class="timeline-body">
		              <p><?php echo $post->postcomment; ?></p>
		            </div>
		          </div>
		        </li>
				<?php 
						}
						$x++;
					} 
				}
				?>
		        
		    </ul>
	</div>
	<?php if($next) { ?>
	<div id="loadmore" class="col-sm-12 a-c">
		<!--<a href='index.php?p=<?php echo $next?>'>Next</a>-->
		<a href="<?php echo base_url('out/timeline/'.$logid.'/'.$next); ?>" class="next">Load more</a>
	</div>
	<?php } ?>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/ias/jquery-ias.min.js'); ?>"></script>
<!--
<script type="text/javascript" src="<?php echo base_url('assets/ias/callbacks.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/ias/extension/history.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/ias/extension/noneleft.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/ias/extension/paging.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/ias/extension/spinner.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/ias/extension/trigger.js'); ?>"></script>
-->
<script type="text/javascript">
  $(document).ready(function() {
    // Infinite Ajax Scroll configuration
    var ias = jQuery.ias({
      container : '.wrap', // main container where data goes to append
      item: '.post', // single items
      pagination: '#loadmore', // page navigation
      next: '.next', // next page selector
	  loader: '<img src="<?php echo base_url('assets/img/ajax-loader.gif'); ?>"/>', // optionally
      triggerPageThreshold: 3 // show load more if scroll more than this
    });
	/*
	// Adds a link which has to be clicked to load the next page
	ias.extension(new IASTriggerExtension({
	    text: 'Load more items', // optionally
		html: '<div class="col-sm-12 a-c"><a href="" class="btn btn-info">{text}</a></div>'
	}));

	// Adds a loader image which is displayed during loading
	ias.extension(new IASSpinnerExtension({
	    src: '<img src="<?php echo base_url('assets/img/ajax-loader.gif'); ?>"/>', // optionally
		html: '<div class="col-sm-12 a-c"><img src="{src}"/></div>'
	}));

	// Adds a text when there are no more pages left to load
	ias.extension(new IASNoneLeftExtension({
	    text: 'You reached the end.', // optionally
	}));
	*/
  });
</script>
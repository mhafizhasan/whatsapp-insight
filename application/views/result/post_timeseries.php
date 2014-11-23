<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/d3'); ?>/d3LineChart.css">
<script src="<?php echo base_url('assets/d3/d3.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url('assets/d3'); ?>/jquery.tipsy.js"></script>
<link href="<?php echo base_url('assets/d3'); ?>/tipsy.css" rel="stylesheet" type="text/css" />
<?php //print_r($data); ?>
<script>
function generateData() {
	
	var data = [];
	
	data = <?php echo json_encode($data); ?>;
	//var days = <?php //echo sizeof($data); ?>;

	//var i = Math.max(Math.round(Math.random()*100), 3);
	 var i = 1;
 	while (i < 3) {
 		var date = new Date();
 		date.setDate(date.getDate() - i);
 		date.setHours(0, 0, 0, 0);
 		data.push({'value' : Math.round(Math.random()*1200), 'date' : date});
		alert(date);
// 		data.push({'value' : <?php //echo $data[i]; ?>, 'date' : date});
 		i++;
 	}

	
	/*
	<?php
	
	//if($data) {
		
		//foreach($data as $dot) {
			
	?>
	
		data.push({'value' : <?php //echo $dot->freq; ?>, 'date' : <?php //echo date('j M Y', strtotime($dot->postdate)); ?>});
	
	<?php
	//	}
	//}
	
	?>
	*/

	return data;
}
</script>

<div class="row marketing">
	<div class="col-sm-10">
		<h3 class="text-muted">Conversation Timeseries</h3>
		<p>Up and down of conversation</p>
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
		<p>
			<a href="<?php echo base_url('out/timeseries/'.$logid); ?>" class="btn btn-xs btn-default"  onclick="ShowProgressAnimation();">
			Timeseries
			</a>
		</p>
	</div>
	
	<div class="col-sm-12 wrap">
		<div id="chart"></div>
		<script src="<?php echo base_url('assets/d3'); ?>/d3LineChart.js" type="text/javascript"></script>
	</div>
</div>


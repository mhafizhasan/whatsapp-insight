<!-- d3.js -->
<script src="<?php //echo base_url('assets/d3/d3.js'); ?>"></script>
<script src="<?php echo base_url('assets/d3/d3.min.js'); ?>"></script>
<div class="row marketing">
	<div class="col-sm-10">
		<h3 class="text-muted">Active users</h3>
		<p>Based on posts made</p>
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
	
	<div id="graph" class="col-sm-12">
	</div>
</div>
<!--
<div class="row marketing">
	<div class="col-sm-12">
		<?php 
		if($data) { 
			foreach($data as $usr) {
		?>
		<div class="progress">
		  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $usr['count']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $usr['sum']; ?>" style="width: <?php echo $usr['percent']; ?>%;">
		    <?php echo $usr['percent']; ?> %
		  </div>
		</div>	
		
		<?php } } ?>
	</div>
</div>
-->
<style>
circle {
  color: black;
}
</style>
<script>

var diameter = 900,
    format = d3.format(",d"),
    color = d3.scale.category20c();

var bubble = d3.layout.pack()
    .sort(null)
    .size([diameter, diameter])
    .padding(1.5);

var svg = d3.select("#graph").append("svg")
    .attr("width", diameter)
    .attr("height", diameter)
    .attr("class", "bubble");

d3.json("<?php echo base_url('out/json_data/'.$logid); ?>", function(error, root) {
  var node = svg.selectAll(".node")
      .data(bubble.nodes(classes(root))
      .filter(function(d) { return !d.children; }))
    .enter().append("g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

  node.append("title")
      .text(function(d) { return d.className + ": " + format(d.value) + " posts"; });

  node.append("circle")
      .attr("r", function(d) { return d.r; })
      .style("fill", function(d) { return color(d.packageName); });

  node.append("text")
      .attr("dy", ".3em")
      .style("text-anchor", "middle")
      .text(function(d) { return d.className.substring(0, d.r / 3); });
});

// Returns a flattened hierarchy containing all leaf nodes under the root.
function classes(root) {
  var classes = [];

  function recurse(name, node) {
    if (node.children) node.children.forEach(function(child) { recurse(node.name, child); });
    else classes.push({packageName: name, className: node.name, value: node.size});
  }

  recurse(null, root);
  return {children: classes};
}

d3.select(self.frameElement).style("height", diameter + "px");

</script>


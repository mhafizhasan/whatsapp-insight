<?php

class Mtimeline extends CI_Model {
	
	function __construct() {
		
		parent::__construct();

	}
	
	////////////////////////////
	// conversation
	////////////////////////////
	
	function get_conversation($logid="", $page=1) {
		
		$offset = 50; // display 10 row
		
		$start = ($page * $offset) - $offset;
		
		$tbl_name = 'post_'.$logid;
		
		//$this->db->order_by('timestamp','ASC');
		$rs = $this->db->get($tbl_name, $offset, $start);
		
		$data = null;
		$next = 0;
		
		// assign next page
		$rsx = $this->db->get($tbl_name);
		
		if($rsx->num_rows() > ($page * $offset)) {
			
			$next = ++$page;
			//echo $next;
		}
		
		if($rs->num_rows() > 0) {
			
			foreach($rs->result() as $row) {
				
				$data[] = $row;
				//print_r($row);
			}
			
		} 
		
		$bulk = array($data, $next);
		
		return $bulk;
		
	}
	
}
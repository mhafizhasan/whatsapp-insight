<?php

class Mtimeseries extends CI_Model {
	
	function __construct() {
		
		parent::__construct();

	}
	
	////////////////////////////
	// Post date
	////////////////////////////
	
	function post_date($logid="") {
		
		$tbl_name = 'post_'.$logid;
		
		$sql = "SELECT 
				postdate,
				COUNT(id) AS freq
				FROM $tbl_name
				GROUP BY postdate
				ORDER BY postdate ASC";
				
		$rs = $this->db->query($sql);
		
		$data = null;
		
		if($rs->num_rows() > 0) {
			
			foreach($rs->result() as $row) {
				
				$data[] = $row;
			}
		}
		
		return $data;
	
	}
	
}
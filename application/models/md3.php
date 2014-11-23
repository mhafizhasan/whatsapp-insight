<?php

class Md3 extends CI_Model {
	
	function __construct() {
		
		parent::__construct();

	}
	
	function get_active_user($logid="") {
		
		$tbl_name = 'post_'.$logid;
		
		$sql = "SELECT
				id,
				postuser,
				COUNT(id) AS count
				FROM $tbl_name
				WHERE postuser NOT LIKE ('%joined')
				AND postuser NOT LIKE ('%left')
				GROUP BY postuser
				HAVING COUNT(id) > 1 ORDER BY count ASC";
				
		$rs = $this->db->query($sql);
		
		$data = '{"name":"analytic","children":[';
		
		if($rs->num_rows() > 0) {
			
			foreach($rs->result() as $row) {
				
				$data = $data.'{"name":"user'.$row->id.'","children":[{"name":"'.$row->postuser.'", "size":'.$row->count.'}]},';
			}
			
		}
		$data = substr($data,0,-1);
		$data = $data.']}';
		
		echo $data;
		
	}
	
	
}
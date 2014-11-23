<?php

class Mtbl extends CI_Model {
	
	function __construct() {
		
		parent::__construct();

	}
	
	////////////////////////////
	// user_post
	////////////////////////////
	
	function get_active_user($logid="") {
		
		$tbl_name = 'post_'.$logid;
		
		// count all post
		$sql = "SELECT
				COUNT(id) as count
				FROM $tbl_name
				WHERE postuser NOT LIKE ('%joined')
				AND postuser NOT LIKE ('%left')
				HAVING COUNT(id) > 1 ";
		
		$rs = $this->db->query($sql);
		
		$sum = $rs->row()->count;
			
		// count user post
		$sql = "SELECT
				id,
				postuser,
				COUNT(id) as count
				FROM $tbl_name
				WHERE postuser NOT LIKE ('%joined')
				AND postuser NOT LIKE ('%left')
				GROUP BY postuser
				HAVING COUNT(id) > 1 ORDER BY count DESC";
				
		$rs = $this->db->query($sql);
		
		$data = null;
		
		if($rs->num_rows() > 0) {
			
			foreach($rs->result() as $row) {
				
				$data[] = array(
					'id' => $row->id,
					'postuser' => $row->postuser,
					'count' => $row->count,
					'sum' => $sum,
					'percent' => round(($row->count/$sum)*100)
				); 
			}
			
		}
		return $data;
		
	}
	
	////////////////////////////
	// hot_topic
	////////////////////////////
	
	function get_word($logid="") {
		
		// get top 25 word
		
		$tbl_word = 'word_'.$logid;
		
		$sql = "SELECT
				id,
				word,
				COUNT(id) as count
				FROM $tbl_word
				GROUP BY word
				ORDER BY count DESC
				limit 0,25";
				
		$rs = $this->db->query($sql);
		
		$data = null;
		if($rs->num_rows() > 0) {
			
			foreach($rs->result() as $r) {
				
				$data[] = $r;
			}
		}
		
		return $data;
	}
	
	function get_word2($logid="") {
		
		// get top 26-50 word
		
		$tbl_word = 'word_'.$logid;
		
		$sql = "SELECT
				id,
				word,
				COUNT(id) as count
				FROM $tbl_word
				GROUP BY word
				ORDER BY count DESC
				limit 25,25";
				
		$rs = $this->db->query($sql);
		
		$data = null;
		if($rs->num_rows() > 0) {
			
			foreach($rs->result() as $r) {
				
				$data[] = $r;
			}
		}
		
		return $data;
	}
	
	////////////////////////////
	// discard word
	////////////////////////////
	
	function discard($logid="", $word="") {
		
		$tbl_word = 'word_'.$logid;
		
		// delete from word_{logid}
		
		$this->db->where('word', $word);
		$this->db->delete($tbl_word);
		
		// update master_blacklist
		
		$this->db->where('word', $word);
		$rs = $this->db->get('master_blacklist');
		
		if($rs->num_rows() > 0) {
			// do nothing
		} else {
			// insert
			$data = array(
				'word' => $word
			);
			$this->db->insert('master_blacklist', $data);
		}
		
		// remove all blacklist words from word_{logid}
		
		$rs = $this->db->get('master_blacklist');
		
		if($rs->num_rows() > 0) {
			
			foreach($rs->result() as $row) {
				
				$this->db->where('word', $row->word);
				$this->db->delete($tbl_word);
			}
			
		}
	}
	
}
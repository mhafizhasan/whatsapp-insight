<?php

class Mdb extends CI_Model {
	
	function __construct() {
		
		parent::__construct();
		
		$this->load->dbforge();

	}
	
	function create_table($tbl="", $logid="") {
		
		$tbl_name = $tbl.$logid;
		
		// set table engine
		$this->db->query('SET storage_engine=MYISAM;');
					
		if($tbl == "post_") {
			
			// create table
			$fields = array(
				'id' => array(
					'type' => 'BIGINT',
					'unsigned' => TRUE,
					'auto_increment' => TRUE,
				),
				'postid' => array(
					'type' => 'VARCHAR',
					'constraint' => 13
				),
				'postdate' => array(
					'type' => 'DATE'
				),
				'posttime' => array(
					'type' => 'TIME'
				),
				'postuser' => array(
					'type' => 'VARCHAR',
					'constraint' => 500
				),
				'postcomment' => array(
					'type' => 'LONGTEXT'
				),
				'timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
			);
			
		} else if($tbl == "word_") {
			
			$fields = array(
				'id' => array(
					'type' => 'BIGINT',
					'unsigned' => TRUE,
					'auto_increment' => TRUE
				),
				'word' => array(
					'type' => 'TEXT'
				),
				'timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
			);
			
		} 
		
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table($tbl_name, TRUE);	
		

	}
	
}
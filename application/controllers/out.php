<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Out extends CI_Controller {

	
	//////////////////////////////
	// Actice user
	//////////////////////////////
		
	function graph($logid="") {
		
		$this->benchmark->mark('code_start');
		
		// output #1
		// - 
		$obj['logid'] = $logid;
		$obj['data'] = $this->mtbl->get_active_user($logid);
		$obj['pg'] = 'result/user_post';
		
		$this->benchmark->mark('code_end');
		
		$this->load->view('tpl', $obj);
		
	}
	
	function json_data($logid="") {
		
		echo $this->md3->get_active_user($logid);
	}
	
	//////////////////////////////
	// Top words
	//////////////////////////////
	
	function topic($logid="") {
		
		if($this->db->table_exists('word_'.$logid)) {
			
			$obj['logid'] = $logid;
			$obj['word'] = $this->mtbl->get_word($logid);
			$obj['word2'] = $this->mtbl->get_word2($logid);
			$obj['pg'] = 'result/hot_topic';
		
			$this->load->view('tpl', $obj);
			
		} else {
			
			$this->benchmark->mark('code_start');
			
			// create table word_{logid}
			$this->mdb->create_table('word_', $logid);
		
			// scrapping word
			$this->mscraper->wa_word_scraper($logid);
			
			$this->benchmark->mark('code_end');
			
			$obj['logid'] = $logid;
			$obj['word'] = $this->mtbl->get_word($logid);
			$obj['word2'] = $this->mtbl->get_word2($logid);
			$obj['pg'] = 'result/hot_topic';
		
			$this->load->view('tpl', $obj);
		}	
		
		
	}
	
	function filtered($logid="") {
		
		if($this->db->table_exists('word_'.$logid)) {
			
			$this->benchmark->mark('code_start');
			
			$obj['logid'] = $logid;
			$obj['word'] = $this->mtbl->get_word($logid);
			$obj['word2'] = $this->mtbl->get_word2($logid);
			$obj['pg'] = 'result/hot_topic';
			
			$this->benchmark->mark('code_end');
		
			$this->load->view('tpl', $obj);
			
		} else {
			
			//$this->topic($logid);
			redirect('out/topic/'.$logid, 'refresh');
		}
		
		
	}
	
	
	//////////////////////////////
	// Conversation Timeline
	//////////////////////////////
	
	function timeline($logid="") {
		
		$page = $start = $this->uri->segment(4,1);

		$bulk = $this->mtimeline->get_conversation($logid, $page);
			
		$obj['data'] = $bulk[0];
		$obj['next'] = $bulk[1];
		$obj['logid'] = $logid;

		$obj['pg'] = 'result/post_timeline';
		
		$this->load->view('tpl', $obj);
	}
	
	//////////////////////////////
	// Conversation Timeseries
	//////////////////////////////
	
	function timeseries($logid="") {
		
		$obj['logid'] = $logid;
		$obj['data'] = $this->mtimeseries->post_date($logid);
		
		$obj['pg'] = 'result/post_timeseries';
		
		$this->load->view('tpl',$obj);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
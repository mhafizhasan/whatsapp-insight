<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bcs extends CI_Controller {


	function index()
	{
		$obj['pg'] = 'upload';	
		$this->load->view('tpl', $obj);
	}
	
	
	function tbl($logid="") {
		
		// create table post_{logid}
		$this->mdb->create_table('post_', $logid);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
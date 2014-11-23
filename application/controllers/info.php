<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller {

	function index() {
		redirect('in');
	}
	
	function how() {
		$this->load->view('how');
	}
	
	function about() {
		$this->load->view('about');
	}
	
	function contact() {
		$this->load->view('contact');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class In extends CI_Controller {


	function index()
	{
		$this->benchmark->mark('code_start');
		
		$obj['pg'] = 'upload';	
		$this->load->view('tpl', $obj);
		
		$this->benchmark->mark('code_end');
	}
	
	
	function upload() {
		
		$this->benchmark->mark('code_start');
		
		if(!empty($_FILES['userfile']['name'])) {
		
			$file_name = $_FILES['userfile']['name'];
			
			//$file_name = preg_replace('/[\. ](?=.*\.)/', '', $file_name);
			$logid = uniqid();
			$file_name = $logid;
			
			$config = array(
						'file_name' => $file_name,
						'allowed_types' => 'txt',
						'upload_path' => FCPATH."/repos/whatsapp/",
						'remove_spaces' => TRUE,
						'max_size' => '2048'
					);
		
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload()) {
				
				// update wa_log tbl
				
				$uploaded_data = $this->upload->data();
				
				//$logid = uniqid();
				
				$data = array(
					"logid" => $logid,
					"logfile" => $uploaded_data['file_name']
				);

				$this->db->insert('wa_log', $data);
				
				// create table post_{logid}
				$this->mdb->create_table('post_', $logid);
				// processing post
				$this->mscraper->wa_post_scraper($logid);
				
				$this->benchmark->mark('code_end');
				
				redirect("out/graph/$logid",'refresh');
				
				
			} else {
			
				// upload error
				//$error = array('error' => $this->upload->display_errors());
				$error = $this->upload->data();
				//$this->session->set_flashdata('code',"error");
				$this->session->set_flashdata('err',$error);
				
				$this->benchmark->mark('code_end');
				
				redirect('/','refresh');
			}
			
			
			
		} else {
			
			$error = array('error' => 'Nothing to upload');
			$this->session->set_flashdata('err',$error);
			
			$this->benchmark->mark('code_end');
			
			redirect('/','refresh');
			
		}
	}

	function discard($logid="", $word="") {
		
		$this->benchmark->mark('code_start');
		
		$this->mtbl->discard($logid,$word);
		
		$this->benchmark->mark('code_end');
		
		redirect('out/filtered/'.$logid,'refresh');
	}
	
	function selected($logid="") {
		
		$this->benchmark->mark('code_start');
		
		if($this->input->post('w')) {
			
			$wordlist = $this->input->post('w');
			
			foreach($wordlist as $w ) {
				
				$this->mtbl->discard($logid, $w);
			}
			
		} else {
			// nothing selected
		}
		
		$this->benchmark->mark('code_end');
		
		redirect('out/filtered/'.$logid,'refresh');
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
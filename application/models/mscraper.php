<?php

class Mscraper extends CI_Model {
	
	function __construct() {
		
		parent::__construct();
		
		ini_set("auto_detect_line_endings", true);

	}
	
	
	function wa_post_scraper($logid="") {
		
		$tbl_post = 'post_'.$logid;
		
		// looking for uploaded file
		$this->db->where('logid',$logid);
		$rs = $this->db->get('wa_log');
		
		if($rs->num_rows() > 0) {
		
			$filename = $rs->row()->logfile;
			
			// read source txt file
			$file = base_url('repos/whatsapp/'.$filename);
			
			$file_reader = fopen($file, "r");
			
			if($file_reader) {
				
				while(($line = fgets($file_reader, 4096)) !== false) {
					
					
					// filter condition #1 {day/month/year - time - user - comment}
					preg_match('|^([0-9]{1,2})\s(\w{3})\s([0-9]{4})\s([0-9]{2}):([0-9]{2})\s(-)\s(.*)$|', $line, $matches1);
					
					// filter condition #2 {day/month - time - user - comment}
					preg_match('|^([0-9]{1,2})\s(\w{3})\s([0-9]{2}):([0-9]{2})\s(-)\s(.*)$|', $line, $matches2);
					
					// filter condition #3 {time, day month year - comment}
					preg_match('|^([0-9]{2}):([0-9]{2}),\s([0-9]{1,2})\s(\w{3})\s([0-9]{4})\s(-)\s(.*)$|', $line, $matches3);
					
					// filter condition #4 {time, day month - user - comment}
					preg_match('|^([0-9]{2}):([0-9]{2}),\s([0-9]{1,2})\s(\w{3})\s(-)\s(.*)$|', $line, $matches4);
					
					// filter condition #5 {time, month day - user - comment}
					preg_match('|^([0-9]{1,2}):([0-9]{1,2})(\w{2}),\s(\w{3})\s([0-9]{1,2})\s(-)\s(.*)$|', $line, $matches5);
					
					  if($matches1) {
						  
						  // condition #1 : 31 Dec 2013 09:50 - user : post
					  
						  // store current uniqid for possible next update operation						  
					  
			  				list($segment, $d, $m, $y, $h, $mm , $f, $content)=$matches1;

			  				$month = array(
			  					"Jan" => "01",
			  					"Feb" => "02",
			  					"Mar" => "03",
			  					"Apr" => "04",
			  					"May" => "05",
			  					"Jun" => "06",
			  					"Jul" => "07",
			  					"Aug" => "08",
			  					"Sep" => "09",
			  					"Oct" => "10",
			  					"Nov" => "11",
			  					"Dec" => "12"
			  				);

			  				$date = $y."-".$month[$m]."-".str_pad($d, 2, '0', STR_PAD_LEFT); ;

			  				$time = $h.":".$mm.":00";

			  				$user_comment = explode(":", $content);

			  				$user = array_shift($user_comment);
							$user = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $user);
							
			  				$comment = implode("", $user_comment);
							$comment = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $comment);

			  				$uniqid = uniqid();
							$previous_uniqid = $uniqid;
							
							$data = array(
								'postid' => $uniqid,
								'postdate' => $date,
								'posttime' => $time,
								'postuser' => $user,
								'postcomment' => $comment
							);
							$this->db->insert($tbl_post, $data);
							
						
					  
					  } else if($matches2) {

						  // condition #2 : 1 Jan 05:54 - user: post

						  // store current uniqid for possible next update operation
					  
			  				list($segment, $d, $m, $h, $mm , $f, $content)=$matches2;
							
			  				$month = array(
			  					"Jan" => "01",
			  					"Feb" => "02",
			  					"Mar" => "03",
			  					"Apr" => "04",
			  					"May" => "05",
			  					"Jun" => "06",
			  					"Jul" => "07",
			  					"Aug" => "08",
			  					"Sep" => "09",
			  					"Oct" => "10",
			  					"Nov" => "11",
			  					"Dec" => "12"
			  				);
							
							$y = date('Y');

			  				$date = $y."-".$month[$m]."-".str_pad($d, 2, '0', STR_PAD_LEFT); ;

			  				$time = $h.":".$mm.":00";

			  				$user_comment = explode(":", $content);
							
			  				$user = array_shift($user_comment);
							$user = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $user);
							
			  				$comment = implode("", $user_comment);
							$comment = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $comment);
							
			  				$uniqid = uniqid();
							$previous_uniqid = $uniqid;
			  				
							$data = array(
								'postid' => $uniqid,
								'postdate' => $date,
								'posttime' => $time,
								'postuser' => $user,
								'postcomment' => $comment
							);
							$this->db->insert($tbl_post, $data);

							
					  } else if($matches3) {

						  // condition #3 : 09:50, 31 Dec 2013  - post
					  
						  // store current uniqid for possible next update operation	
						  
			  				list($segment, $h, $mm, $d, $m, $y, $f, $content)=$matches3;

			  				$month = array(
			  					"Jan" => "01",
			  					"Feb" => "02",
			  					"Mar" => "03",
			  					"Apr" => "04",
			  					"May" => "05",
			  					"Jun" => "06",
			  					"Jul" => "07",
			  					"Aug" => "08",
			  					"Sep" => "09",
			  					"Oct" => "10",
			  					"Nov" => "11",
			  					"Dec" => "12"
			  				);
							
							// echo "<p>matches 3</p>";
// 							echo "<p>$h</p>";
// 							echo "<p>$mm</p>";
// 							echo "<p>$d</p>";
// 							echo "<p>$m</p>";
// 							echo "<p>$y</p>";
// 							echo "<p>$f</p>";
// 							echo "<p>$content</p>";

			  				$date = $y."-".$month[$m]."-".str_pad($d, 2, '0', STR_PAD_LEFT); ;

			  				$time = $h.":".$mm.":00";

			  				$user_comment = explode(":", $content);

			  				$user = array_shift($user_comment);
							$user = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $user);
							
			  				$comment = implode("", $user_comment);
							$comment = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $comment);

			  				$uniqid = uniqid();
							$previous_uniqid = $uniqid;
							
							// echo "<p>matches 3</p>";
// 							echo "<p>$date</p>";
// 							echo "<p>$time</p>";
// 							echo "<p>$content</p>";
							
							$data = array(
								'postid' => $uniqid,
								'postdate' => $date,
								'posttime' => $time,
								'postuser' => $user,
								'postcomment' => $comment
							);
							$this->db->insert($tbl_post, $data);
						
					  } else if($matches4) {

						  // condition #4 : 09:50, 31 Dec - user : post
					  
						  // store current uniqid for possible next update operation						  
					  
			  				list($segment, $h, $mm, $d, $m, $f, $content)=$matches4;

			  				$month = array(
			  					"Jan" => "01",
			  					"Feb" => "02",
			  					"Mar" => "03",
			  					"Apr" => "04",
			  					"May" => "05",
			  					"Jun" => "06",
			  					"Jul" => "07",
			  					"Aug" => "08",
			  					"Sep" => "09",
			  					"Oct" => "10",
			  					"Nov" => "11",
			  					"Dec" => "12"
			  				);

							$y = date('Y');

			  				$date = $y."-".$month[$m]."-".str_pad($d, 2, '0', STR_PAD_LEFT); ;

			  				$time = $h.":".$mm.":00";

			  				$user_comment = explode(":", $content);
							
			  				$user = array_shift($user_comment);
							$user = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $user);
							
			  				$comment = implode("", $user_comment);
							$comment = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $comment);
							
			  				$uniqid = uniqid();
							$previous_uniqid = $uniqid;
							
							// echo "<p>matches 4</p>";
// 							echo "<p>$date</p>";
// 							echo "<p>$time</p>";
// 							echo "<p>$user_comment</p>";
			  				
							$data = array(
								'postid' => $uniqid,
								'postdate' => $date,
								'posttime' => $time,
								'postuser' => $user,
								'postcomment' => $comment
							);
							$this->db->insert($tbl_post, $data);
							
  					  } else if($matches5) {

  						  // condition #4 : 9:50AM, May 5 - user : post
					  
  						  // store current uniqid for possible next update operation						  
					  
  			  				list($segment, $h, $mm, $am, $m, $d, $f, $content)=$matches5;

  			  				$month = array(
  			  					"Jan" => "01",
  			  					"Feb" => "02",
  			  					"Mar" => "03",
  			  					"Apr" => "04",
  			  					"May" => "05",
  			  					"Jun" => "06",
  			  					"Jul" => "07",
  			  					"Aug" => "08",
  			  					"Sep" => "09",
  			  					"Oct" => "10",
  			  					"Nov" => "11",
  			  					"Dec" => "12"
  			  				);

  							$y = date('Y');

  			  				$date = $y."-".$month[$m]."-".str_pad($d, 2, '0', STR_PAD_LEFT); ;

  			  				$time = $h.":".$mm.":00";

  			  				$user_comment = explode(":", $content);
							
  			  				$user = array_shift($user_comment);
  							$user = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $user);
							
  			  				$comment = implode("", $user_comment);
  							$comment = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $comment);
							
  			  				$uniqid = uniqid();
  							$previous_uniqid = $uniqid;
							
  							// echo "<p>matches 4</p>";
  // 							echo "<p>$date</p>";
  // 							echo "<p>$time</p>";
  // 							echo "<p>$user_comment</p>";
			  				
  							$data = array(
  								'postid' => $uniqid,
  								'postdate' => $date,
  								'posttime' => $time,
  								'postuser' => $user,
  								'postcomment' => $comment
  							);
  							$this->db->insert($tbl_post, $data);
						  
						  
					  } else {
				  	
						  // continue from previous post, update previous post - {comment}
						  $line = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $line);
						  
						  // update previous comment
						  $this->db->where('postid', $previous_uniqid);
						  $rs = $this->db->get($tbl_post);
					  
						  if($rs->num_rows() > 0) {
						  
		  					  $line = preg_replace("/[^a-zA-Z0-9\s\-\+]/", " ", $line);
					  	
							  $comment = $rs->row()->postcomment.' '.$line;
						
							  $data = array(
								  'postcomment' => $comment
							  );
							  $this->db->where('postid', $previous_uniqid);
							  $this->db->update($tbl_post, $data);

						  }

					  }
					
				}
				fclose($file_reader);

			}
		}
		
	}
	
	function wa_word_scraper($logid="") {
		
		$tbl_post = 'post_'.$logid;
		$tbl_word = 'word_'.$logid;
		
		// looking for uploaded file
		$rs = $this->db->get($tbl_post);
		
		if($rs->num_rows() > 0) {
			
			// read postcomment
			foreach($rs->result() as $row) {
				
				// break into word
				$words = preg_split('/[\s,.;":!()?\'\-\[\]]+/', $row->postcomment, -1, PREG_SPLIT_NO_EMPTY);
				$words = array_map("StrToLower", $words);
				
				// insert into db
				foreach($words as $w) {
					
					$w = trim($w);
					$w = substr($w,0,45);
							
					// insert into word_{logid}
					$data = array(
						'word' => $w 
					);
					$this->db->insert($tbl_word, $data);
							
				}
				
			}
			
		}
		
	}
	
	function wa_scraper($logid="") {
		
		// looking for uploaded file
		$this->db->where('logid',$logid);
		$rs = $this->db->get('wa_file');
		
		if($rs->num_rows() > 0) {
			
			$filename = $rs->row()->logfile;
			
			// read source txt file
			$file = base_url('repos/whatsapp/'.$filename);
			
			$filecontent = file_get_contents($file);
			
			// break into per user post
			$line = preg_split('/$\R?^/m', $filecontent);
			
			// break into per user post
			//$line = preg_split('/\r?\n|\r/', $filecontent);
		
			foreach($line as $key => $value) {
				
				// remove newline +
				//$value = preg_replace("/[^a-zA-Z0-9\s\-\+\:]/", " ", $value);
				echo $value."<br/>";
				// preg_match('|^([0-9]{1,2})\s(\w{3})\s([0-9]{4})\s([0-9]{2}):([0-9]{2})\s(-)\s(.*)$|', $value, $matches);
// 				list($segment, $d, $m, $y, $h, $mm , $f, $content)=$matches;
//
// 				$month = array(
// 					"Jan" => "01",
// 					"Feb" => "02",
// 					"Mar" => "03",
// 					"Apr" => "04",
// 					"May" => "05",
// 					"Jun" => "06",
// 					"Jul" => "07",
// 					"Aug" => "08",
// 					"Sep" => "09",
// 					"Oct" => "10",
// 					"Nov" => "11",
// 					"Dec" => "12"
// 				);
//
// 				$date = $y."-".$month[$m]."-".str_pad($d, 2, '0', STR_PAD_LEFT); ;
// 				echo "$date <br/>";
//
// 				$time = $h.":".$mm.":00";
// 				echo "$time <br/>";
//
// 				$user_comment = explode(":", $content);
// 				$user = array_shift($user_comment);
// 				$comment = implode("", $user_comment);
//
// 				$user = preg_replace("/[^a-zA-Z0-9\s\-\+]/", "", $user);
// 				echo "$user <br/>";
// 				echo "$comment <br/>";
		
				echo '<br/>#################################################<br/>';
			
			}
			
		}
			
	}
	
}
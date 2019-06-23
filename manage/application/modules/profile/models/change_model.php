<?php
	
	Class Change_model extends CI_Model{

		public function isLoggedIn(){

			return $this->session->userdata("Logged_in");
		}

		public function member_page(){

			if($this->isLoggedIn()){
				return true;
			}
			else
			{
				//redirect(base_url(), "refresh");
			}

		}
		 

		public function check_user($user_id, $password)
    	{
    		
    		
        	$sql = $this->db->query("select user_id, password from igc_users where 
        		user_id = '$user_id' and password = '$password'");

        	$result = $sql->result_array();
        	return $result;
        }



	}


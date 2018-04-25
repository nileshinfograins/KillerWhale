<?php

	if(!function_exists('_is_admin_login'))
	{
	 	function _is_admin_login()
		{
			$CI =& get_instance();

			if($CI->session->userdata('admin_id') == '')
			{
				$next = current_url();
			  	redirect('admin/login?next='.$next);
				exit();
			}

		}
	}


	if(!function_exists('adminUserName'))
	{
	 	function adminUserName()
		{
			$CI =& get_instance();

			$data = $CI->db->get('admin_login');
			$result = $data->row();
			
			return $result->username;	
		}

	}

	if(!function_exists('adminEmail'))
	{
	 	function adminEmail()
		{
			$CI =& get_instance();

			$data = $CI->db->get('admin_login');
			$result = $data->row();
			
			return $result->email;	
		}

	}

	if(!function_exists('getCountryName'))
	{
	 	function getCountryName($id)
		{
			$CI =& get_instance();

			$CI->db->where(array('id'=>$id));
			$data = $CI->db->get('countries');
			$result = $data->row();
			
			return $result->name;	
		}

	}	

?>
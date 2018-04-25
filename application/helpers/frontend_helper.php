<?php

	if(!function_exists('_is_user_login'))
	{
	 	function _is_user_login()
		{
			$CI =& get_instance();

			if($CI->session->userdata('user_id') == '')
			{
				$next = current_url();
			  	redirect('login?next='.$next);
				exit();
			}
			else
			{
				$CI->load->model('users');

				if( ! $CI->users->is_active_undeleted($CI->session->userdata('user_id')) )
				{
					$CI->session->unset_userdata('user_id');
					$next = current_url();
				  	redirect('login?next='.$next);
					exit();
				}
			}

		}
	}

/**
	 * Checks if the given string is an address
	 *
	 * @method isAddress
	 * @param {String} $address the given HEX adress
	 * @return {Boolean}
	*/
	function _isAddress($address)
	{
	    if (!preg_match('/^(0x)?[0-9a-f]{40}$/i',$address))
	    {
	        // check if it has the basic requirements of an address
	        return false;
	    }
	    elseif (!preg_match('/^(0x)?[0-9a-f]{40}$/',$address) || 
	    		preg_match('/^(0x)?[0-9A-F]{40}$/',$address))
	    {
	        // If it's all small caps or all all caps, return true
	        return true;
	    }
	    else
	    {
	        // Otherwise check each case
	        return _isChecksumAddress($address);
	    }
	}
	/**
	 * Checks if the given string is a checksummed address
	 *
	 * @method isChecksumAddress
	 * @param {String} $address the given HEX adress
	 * @return {Boolean}
	*/
	function _isChecksumAddress($address)
	{
	    // Check each case
	    $address = str_replace('0x','',$address);
	    $addressHash = @hash('sha3',strtolower($address));
	    $addressArray = str_split($address);
	    $addressHashArray = str_split($addressHash);

	    if(!empty($addressHashArray))
	    {
		    for($i = 0; $i < 40; $i++ )
		    {
		        // the nth letter should be uppercase if the nth digit of casemap is 1
		        if ((intval($addressHashArray[$i], 16) > 7 && 
		        	 strtoupper($addressArray[$i]) !== $addressArray[$i]) || 
		        	(intval($addressHashArray[$i], 16) <= 7 && 
		        	strtolower($addressArray[$i]) !== $addressArray[$i]))
		        {
		            return false;
		        }
		    }
		}
	    return true;
	}



	if(!function_exists('getCountryList'))
	{
	 	function getCountryList()
		{
			$CI =& get_instance();

			$CI->db->order_by('name', 'asc');
			$data = $CI->db->get('countries');
			return $data->result();		
		}

	}

	if(!function_exists('getUserImage'))
	{
	 	function getUserImage()
		{
			$CI =& get_instance();

			$CI->db->where(array('id'=>$CI->session->userdata('user_id')));
			$data = $CI->db->get('users');
			$result = $data->row();
			
			return $result->profile_image;	
		}

	}	

?>
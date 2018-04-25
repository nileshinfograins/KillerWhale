<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_login extends CI_Model {
    
/* ************* get single   data *************** */	
	function login($table, $where)
	{
		$this->db->where($where);
		$data = $this->db->get($table);
		$get = $data->row();
	   
		$num = $data->num_rows();
		
		if($num){
			return $get;
		}
		else
		{
			return false;
		}
	}  
    
}
?>

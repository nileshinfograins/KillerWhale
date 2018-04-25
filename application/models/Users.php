<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Model {
    
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

/* ************* get all data as where class *************** */	
	function getWhere($table,$where)
	{
		$this->db->where($where);
		$data = $this->db->get($table);
		$get = $data->result();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}

/* ************* add  data *************** */
	function insert_data($table,$data)
	{ 
	
     	$this->db->insert($table,$data);
		$num = $this->db->insert_id();
		
			return $num;
	
	}
	
/* ************* update  data *************** */	
	function update_data($table,$where,$data)
	{
		 $this->db->where($where);
	     $update = $this->db->update($table,$data);
		
			if($update)
			{ 
				return TRUE;
			}
			else
			{ 
				return FALSE;
			}
	}
    
	function getSingle($table,$where)
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
    
	function getAllUsers($start_limit, $end_limit)
	{
		$query = "select * from users where is_delete = '1' order by id desc LIMIT $start_limit, $end_limit";
		$data = $this->db->query($query);
		$get = $data->result();
		if($get)
		{
			return $get;
		}
		else
		{
			return FALSE;
		}
	}	

	function getAllUsersCount()
	{
		$query = "select * from users where is_delete = '1'";
		$data = $this->db->query($query);

		return $data->num_rows();
	}

	function is_active_undeleted($userID)
	{
		$q = $this->db
				  ->where(['is_delete' => 1, 'status' => 1, 'id' => $userID])
				  ->get('users');

		if( $q->num_rows() )
			return TRUE;

		return FALSE;
	}
}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transfer_history extends CI_Model {
    
/* ************* get all data as where class *************** */	
	function getTransferHistoryByUserID($user_id, $start_limit, $end_limit)
	{
		$query = "select * from transfer_history where (from_user = '".$user_id."' or to_user = '".$user_id."') order by id desc LIMIT $start_limit, $end_limit";
		$data = $this->db->query($query);
		$get = $data->result();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}

/* ************* get all data as where class *************** */	
	function getTransferHistoryByUserIDCount($user_id)
	{
		$query = "select * from transfer_history where (from_user = '".$user_id."' or to_user = '".$user_id."') order by id desc";
		$data = $this->db->query($query);

		return $data->num_rows();
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
	

/* ************* get all data as where class *************** */	
	function getAllTransferHistory($contract_address, $start_limit, $end_limit)
	{
		$query = "select * from transfer_history where ((from_user = '0' and to_user != '') or (to_user = '0' and from_user != '')) order by id desc LIMIT $start_limit, $end_limit";
		$data = $this->db->query($query);
		$get = $data->result();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}

/* ************* get all data as where class *************** */	
	function getAllTransferHistoryCount($contract_address)
	{
		$query = "select * from transfer_history where ((from_user = '0' and to_user != '') or (to_user = '0' and from_user != '')) order by id desc";
		$data = $this->db->query($query);

		return $data->num_rows();
	}

/* ************* get all data as where class *************** */	
	function getTransferHistoryByUser($user_id, $start_limit, $end_limit)
	{
		$query = "select * from transfer_history where (from_user = '".$user_id."' or to_user = '".$user_id."') order by id desc LIMIT $start_limit, $end_limit";
		$data = $this->db->query($query);
		$get = $data->result();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}

/* ************* get all data as where class *************** */	
	function getTransferHistoryByUserCount($user_id)
	{
		$query = "select * from transfer_history where (from_user = '".$user_id."' or to_user = '".$user_id."') order by id desc";
		$data = $this->db->query($query);

		return $data->num_rows();
	}
		
}
?>

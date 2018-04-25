<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data_model extends CI_Model {
    
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
	
	
/* ************* update  data All*************** */	
	function update_data_all($table,$data)
	{
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
		
/* ************* get single   data *************** */	
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
	function getwhere($table,$where)
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
	
/* ************* Delete data *************** */	
	function delete($table,$where){
	
	    $this->db->where($where);
		$del = $this->db->delete($table);
		if($del){
			return true;
		}else{
			return false;
		}
	}
	
/* ************* Delete in data *************** */	
	function delete_multipal($table,$where){
	    $this->db->where_in('Lead_id',$where);
		$del = $this->db->delete($table);
		if($del){
			return true;
		}else{
			return false;
		}
	}
	
	
/* ************* Delete data with images in folder *************** */	
	function delete_image($table,$where){
	
	    $this->db->where($where);
        $query = $this->db->get($table);
		foreach($query->result() as $row)
         {
          
  
		if($row->a_photo!='')
		    { 
             unlink("uploads/".$row->a_photo);
			}
             
        }
		
		$this->db->where($where);
		$del = $this->db->delete($table);
		if($del){
			return true;
		}else{
			return false;
		}
	}	
	
/* ************* get all data as where class *************** */     
    function getAll($table, $id) 
    { 
	  
      $this->db->order_by($id,'asc');
        $data = $this->db->get($table); 
        $get = $data->result(); 
        if($get){ 
            return $get; 
        }else{ 
            return FALSE; 
        } 
    }	
    
/* ************* get all data as where class *************** */     
    function getById($table, $where) 
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
    function getAllLimit($table, $id) 
    { 
		
		$this->db->limit(1, 0);
		$this->db->order_by($id,'desc');
		
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
    function getAllById($table, $id, $where, $num, $offset) 
    { 
		
		$this->db->where($where);
        $this->db->order_by($id,'desc');
        $q = $this->db->get($table,$num,$offset); 
     
        $num_rows = $q->num_rows();
	
		if ($num_rows > 0)
        {
            foreach ($q->result() as $rows)
            {
                $data[] = $rows;
            }
            $q->free_result();
		
            return $data; 
			
        } 
		
		else
		{
			return false;
		}
    }
           
    
/* ************* get all data as where class *************** */     
    function getCountById($table, $id, $where) 
    { 
		
	    $this->db->where($where);
	    $this->db->order_by($id,'desc');
        $q = $this->db->get($table); 

        if($q->num_rows() > 0)
		{
		 
			return $q->num_rows();
		
		}
		
		else
		{
		return false;	
		}

    }	        
 		
/* *************  count all data as where class *************** */     
    function getAll_num_rows($table) 
    { 
        $q = $this->db->get($table); 
   
        if($q->num_rows() > 0)
		{
		 
			return $q->num_rows();
		
		}
		
		else
		{
		return false;	
		}
    } 		 
   
/* ************* get all data as where class *************** */     
    function getAll_pagination($table,$id,$num,$offset) 
    { 
	 
        $this->db->order_by($id,'asc');
        $q = $this->db->get($table,$num,$offset); 
     
        $num_rows = $q->num_rows();
	
		if ($num_rows > 0)
        {
            foreach ($q->result() as $rows)
            {
                $data[] = $rows;
            }
            $q->free_result();
		
            return $data; 
			
        } 
		
		else
		{
			return false;
		}
    }

	function Getall_count($table,$id)
	{	
		
		$this->db->order_by($id,'asc');
		$q = $this->db->get($table);

		 $num_rows = $q->num_rows();
		if ($num_rows > 0)
        {
          
            return $num_rows; 
        } 
		else
		{
			return false;
		}
  }
  
	/* ************* truncate data *************** */	
	function truncate($table){
	
	   $del = $this->db->truncate($table);
		if($del){
			return true;
		}else{
			return false;
		}
		
		
	}
	
/* ************* code availiblity *************** */         		
	public function check_code($table, $where)
	{

		$this->db->where($where); 
		$query = $this->db->get($table);			
		return $query->result();
		
		}  	 
		
	public function check_field($table, $where)
	{

		$this->db->where($where); 
		$query = $this->db->get($table);			
		return $query->num_rows();
		
		}  	 		 
      
    
}
?>

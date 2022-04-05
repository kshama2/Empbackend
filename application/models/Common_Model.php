<?php

class Common_Model extends CI_Model{

public function __construct(){

	parent::__construct();
	  
}

 public function insertData($dataArray,$tablename){
  
      $res=$this->db->insert($tablename,$dataArray);
      if($res){
        return 1;
      }else{
        return 0;
      }
    }
      
 public function getrowarray($tablename,$where){
   $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where($where);
    $query=$this->db->get();
     // echo print_r($this->db->last_query());exit;
   return $query->row_array();


  }
 
  
  public function updateData($where,$dataArray,$tablename){
        $this->db->where($where);
		
			
	//echo $this->db->last_query();exit;
		if($this->db->update($tablename,$dataArray)){

			//echo $this->db->last_query();exit;
			return true;
		}

}

public function getdata($tablename,$where){
	
     $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where($where);
    $query=$this->db->get();
       // return print_r($this->db->last_query();
   return $query->result_array();

}




    

}//end of class
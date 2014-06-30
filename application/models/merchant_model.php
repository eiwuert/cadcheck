<?php

class Merchant_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

    function getMerchants() {


        $this->db->select('merchants.*');
        $this->db->from('merchants');
        
        if(!isAdmin()) {
            $this->db->join('groups','groups.id=merchants.groupid','left');
            $this->db->join('usergroups','usergroups.groupid=groups.id');
            $this->db->where('usergroups.userid',$this->session->userdata['userid']);
        }
        $this->db->order_by('merchants.name');

        $result = $this->db->get();

        if ($result->num_rows() >= 1) {
            
            return $result->result_array();

        } else {

            return false;

        }


    }
    
    function get_merchants_group($merchantid) {
        
        $this->db->select('groups.id as groupid');
        $this->db->from('groups');
        $this->db->join('merchants','merchants.groupid = groups.id','LEFT');
        $this->db->where('merchants.id',$merchantid);
        
        $result = $this->db->get();
        
        return $result->row(0)->groupid;
                
              
        
    }
    
    function get_merchant_name($merchantid) {
        
        $this->db->select('name');
        $this->db->from('merchants');
        $this->db->where('id',$merchantid);
        
        
        $result = $this->db->get();
        
        if ($result->num_rows() >= 1) {
            return $result->row(0)->name;
        } else {
            return false;
        }
        
    }
    
    function getMerchantById($id) {


        $query_str = "SELECT * FROM merchants WHERE id=?";

        $result = $this->db->query($query_str,array($id));


        if ($result->num_rows() >= 1) {
            
            return $result->row_array();

        } else {

            return false;

        }
        
    }
    
    function getMerchantReceiverAccounts($id) {
        
        $query_str = "SELECT * FROM merchant_accounts WHERE owner=?";
        
        $result = $this->db->query($query_str,array($id));
        
        if ($result->num_rows() >= 1) {
            
            return $result->result_array();
            
        } else {
            
            return false;
            
        }
        
    } 
	
	/**********************************************/
	function get_groups($id="") {
    
        $this->db->select('id,groupname');  
		
		if($id==""){
			$QRY = $this->db->get('groups');
			$retn['records'] = $QRY->result();
			$retn['record_count'] = $QRY->num_rows();
		}else{
			$retn['records'] = $this->db->get_where('groups',array('id'=>$id))->row_array();
		}
	
		return $retn;
    }
	
	function create_newGroup($insertArr){
	
		$rows = $this->db->get_where('groups',$insertArr)->num_rows(); 
		
		if($rows<=0){ // insert new Group
			$this->db->insert('groups',$insertArr);
			return '202';
		}else{
			return '101';
		}
		
	}
	
	function edit_Group($insertArr,$group_id){
	
		if($group_id!=""){
		
			$this->db->where('id',$group_id);
			$this->db->update('groups',$insertArr);
			return '202';
		}else{
			return '101';
		}
	
	}
	
	function deleteGroup($group_ids_array){
	
		 foreach($group_ids_array as $index => $group_id){
			if (is_numeric($group_id) && $group_id > 1){
			
				$this->db->delete('groups', array('id'=>$group_id));
				 
			}
			
		}
		return true;  
		
	}
	
	
}?>

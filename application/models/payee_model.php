<?php

class Payee_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function add_newPayees($insertArr){
	
		$match = array(
				'name'=>$insertArr['name'],
				'email'=>$insertArr['email']
		
		);
		$rows = $this->db->get_where('payees',$match)->num_rows(); 
		
		if($rows<=0){ // insert new payee
			$this->db->insert('payees',$insertArr);
			return '202';
		}else{
			return '101';
		}
		
	}

	function edit_Payees($insertArr,$payee_id){
	
		if($payee_id!=""){
		
			$this->db->where('id',$payee_id);
			$this->db->update('payees',$insertArr);
			return '202';
		}else{
			return '101';
		}
	
	}
    
    function get_payees($id="") {
    
        $this->db->select('id,name,email,phone,address1,address2,state_name,state_code,post_code');  //trans_note
		
		if($id==""){
			$QRY = $this->db->get('payees');
			$retn['records'] = $QRY->result();
			$retn['record_count'] = $QRY->num_rows();
		}else{
			$retn['records'] = $this->db->get_where('payees',array('id'=>$id))->row_array();
		}
		
		
		
		
		return $retn;
    }

   
    function deletePayees($payee_ids_post_array) {
	
        foreach($payee_ids_post_array as $index => $payee_id){
			if (is_numeric($payee_id) && $payee_id > 1){
			
				$this->db->delete('payees', array('id'=>$payee_id));
				 
			}
			
		}
		return true;  
    }    
         
	function getPayees_dropdown(){
	
		$this->db->select('id,name');
		$records = $this->db->get('payees')->result();
		return $records;
		
	}
	
	
}?>
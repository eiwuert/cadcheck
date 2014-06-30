<?php

class Customer_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}


    
    function check_for_duplicate($name,$postcode) {
        
        $this->db->select('count(id) as count');
        $this->db->from('customer_data');
        $this->db->like('name',$name);
        $this->db->like('postcode',$postcode);
        
        $result = $this->db->get();
        
        
        
        if ($result->row(0)->count >= 1) {
            
            return true;

        } else {

            return false;
        }
        
        
    }

    
    function save_customer_data($vars) {
        
        extract($vars);
        
        $duplicate_data1 = $this->check_for_duplicate($issued_by_name,$issued_by_postcode);
        
        if(!$duplicate_data1) {
            
        
            $data_issuedby = array(
                'name' => $issued_by_name,
                'address1' => $issued_by_address,
                'address2' => $issued_by_address2,
                'postcode' => $issued_by_postcode,
                'phone' => $issued_by_phone,
                'email' => $issued_by_email,
                'user_submitted' => $this->session->userdata['userid'],
                'merchant_submitted' => $this->session->userdata['merchant_id']
            ); 
            
            
            $result = $this->db->insert('customer_data',$data_issuedby);
        
        }
        
        $duplicate_data2 = $this->check_for_duplicate($payee_name,$payee_postcode);
        
        if(!$duplicate_data2) {
        
            $data_payee = array(
                'name' => $payee_name,
                'address1' => $payee_address,
                'address2' => $payee_address2,
                'postcode' => $payee_postcode,
                'phone' => $payee_phone,
                'email' => $payee_email,
                'user_submitted' => $this->session->userdata['userid'],
                'merchant_submitted' => $this->session->userdata['merchant_id']
            ); 
            
            
            $result = $this->db->insert('customer_data',$data_payee);

        }
        
        
        
    }
    

}

?>

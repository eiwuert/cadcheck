<?php

class Batch_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

    function display_results_table() {


        $query_str = "SELECT * FROM cashmerchants WHERE 1";

        $result = $this->db->query($query_str);


        if ($result->num_rows() >= 1) {
            
            return $result->result_array();

        } else {

            return false;

        }


    }
    
    function get_unsubmitted_batches($merchantid=NULL) {
        
        $this->db->select('batch.*, COUNT(transactions.id) as txinbatch, SUM(transactions.check_amount) as batchtotal');
        $this->db->from('batch');
        $this->db->join('transactions','batch.id = transactions.batch','LEFT');
        $this->db->join('batchgroups','batch.id = batchgroups.batchid','LEFT');
        
        $this->db->join('merchants','merchants.id = batchgroups.groupid');
        
        $this->db->where('merchants.id',$merchantid);
        
        if(!issystem() && !isadmin()) {
            
           $this->db->where('batch.userid',$this->session->userdata['userid']);
            
        }
        
        $this->db->group_by('batch.id');
        $this->db->where('batch.status',0);
        
        
        $result = $this->db->get();
        
        
        if ($result->num_rows() >= 1) {
            
            return $result->result_array();
            
        } else {
            
            return false;
            
        }
        
    }
    
    function get_batches() {
        
        $this->db->select('batch.*, COUNT(transactions.id) as transactions, SUM(transactions.check_amount) as amount');
        $this->db->from('batch');
        $this->db->join('transactions','batch.id = transactions.batch','LEFT');
        
        if(!isadmin()) {
            
            $this->db->join('batchgroups','batch.id = batchgroups.batchid','LEFT');
            $this->db->join('usergroups','usergroups.groupid = batchgroups.groupid');
            $this->db->where('usergroups.userid',$this->session->userdata['userid']);
        }
        
        $this->db->group_by('batch.id');
        $this->flexigrid->build_query();
        
        
        $return['records'] = $this->db->get();
        
        
		//Build count query
		$this->db->select('count(batch.id) as record_count');
                $this->db->from('batch');
                
                if(!isadmin()) {

                    $this->db->join('batchgroups','batch.id = batchgroups.batchid','LEFT');
                    $this->db->join('usergroups','usergroups.groupid = batchgroups.groupid');
                    $this->db->where('usergroups.userid',$this->session->userdata['userid']);
                }
                
		$this->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
                        
                
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
        
    }
    
    function submit_batch($batchid) {
        
        $data = array(
           'datesubmitted' => date('Y-m-d H:m:s',time()),
           'status' => '1'
        );
        
        $this->db->where('id',$batchid);
        $this->db->update('batch',$data);
        
        return true;
        
    }
    
    function update_batch_externalref($batchid,$reference) {
        
        $data = array(
            
           'ext_batchid' => $reference
            
        );
        
        $this->db->where('id',$batchid);
        $this->db->update('batch',$data);
        
        return true;
    }
   
    
    function has_permission_toview($batchid) {
        
        
        $this->db->select('batch.id');
        $this->db->from('batch');
        
        if(!isadmin()) {
            
            $this->db->join('batchgroups','batch.id = batchgroups.batchid','LEFT');
            $this->db->join('usergroups','usergroups.groupid = batchgroups.groupid');
            $this->db->where('usergroups.userid',$this->session->userdata['userid']);
            
        } 
        
        $this->db->where('batch.id',$batchid);
        
        $result = $this->db->get();
        
        if ($result->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
        
    }
    
        
    
    function create_batch($merchantid) {
        
        
        // Create new batch
        $data = array(
            'datecreated' => date('Y-m-d H:m:s',time()),
            'status' => '0',
            'userid' => $this->session->userdata['userid']
        );  
        
        $result = $this->db->insert('batch',$data);
        
        $batchid = $this->db->insert_id();
        
        
        // Assign the batch a group owner
        
        $ownerdata = array (
            'groupid' => $this->Merchant_model->get_merchants_group($merchantid),
            'batchid' => $batchid
        );
        
        $this->db->insert('batchgroups',$ownerdata);
        
        // Assign it a title        
        $updatedata = array (
            'title' => 'Batch ID # '.$batchid
        );
        
        $this->db->where('id',$batchid);
        $this->db->update('batch',$updatedata);
        
        
        return $batchid;
        
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
    
    function delete_batch($batchid) {
        
        $this->db->delete('transactions', array('batch'=>$batchid));
        $this->db->delete('batch', array('id'=>$batchid));
        $this->db->delete('batchgroups', array('batchid'=>$batchid));
        
        return true;        
        
    }
    
    function validate_batch($batchdata,$type) {

        //print_array($batchdata);
        switch($type) {
            
            case 1:
                //Validate Check
                $line=1;
                foreach($batchdata as $key => $value) {
                
                    // Validate Transaction Number
                    if(count(split("-",$value['tx_no'])) <> 4) {
                            $errorlog[$line]['tx_no']['valid']='ERR'; 
                            $errorlog[$line]['tx_no']['msg']='TX Number not valid';
                    } else $errorlog[$line]['tx_no']['valid']='OK'; 
                
                    // Validate Amount
                    if(!$this->validate->is_numeric($value['amount'])) {
                            $errorlog[$line]['amount']['valid']='ERR'; 
                            $errorlog[$line]['amount']['msg']='Dollar value incorrect';
                    } else $errorlog[$line]['amount']['valid']='OK'; 
                    
                    
                    // Validate Date
                    if(!$this->validate->is_validdate($value['date'])) {
                            $errorlog[$line]['date']['valid']='ERR'; 
                            $errorlog[$line]['date']['msg']='Incorrect Date';
                    } else $errorlog[$line]['date']['valid']='OK'; 
                    
                    // Validate Bank Name
                    if(!$this->validate->string_validate($value['issued_by_bank'],4)) {
                            $errorlog[$line]['issued_by_bank']['valid']='ERR'; 
                            $errorlog[$line]['issued_by_bank']['msg']='You need to provide a valid Issuing Bank';
                    } else $errorlog[$line]['issued_by_bank']['valid']='OK'; 
                    
                     // Validate Issued By Name
                    if(!$this->validate->string_validate($value['issued_by_name'],4)) {
                            $errorlog[$line]['issued_by_name']['valid']='ERR'; 
                            $errorlog[$line]['issued_by_name']['msg']='You need to provide a valid Issuing Name';
                    } else $errorlog[$line]['issued_by_name']['valid']='OK'; 
                    
                     // Validate Issued By Address
                    if(!$this->validate->string_validate($value['issued_by_address'],4)) {
                            $errorlog[$line]['issued_by_address']['valid']='ERR'; 
                            $errorlog[$line]['issued_by_address']['msg']='You need to provide a valid ssuing Address';
                    } else $errorlog[$line]['issued_by_address']['valid']='OK'; 
                    
                     // Validate Issued By Address2
                    if(!$this->validate->string_validate($value['issued_by_address2'],4)) {
                            $errorlog[$line]['issued_by_address2']['valid']='ERR'; 
                            $errorlog[$line]['issued_by_address2']['msg']='You need to provide a valid Issuing Address 2';
                    } else $errorlog[$line]['issued_by_address2']['valid']='OK'; 
                    
                     // Validate Issued By Postcode/ZIp
                    if(!$this->validate->string_validate($value['issued_by_postcode'],4)) {
                            $errorlog[$line]['issued_by_postcode']['valid']='ERR'; 
                            $errorlog[$line]['issued_by_postcode']['msg']='You need to provide a valid Issuing Postcode/ZIP';
                    } else $errorlog[$line]['issued_by_postcode']['valid']='OK'; 
                    
                     // Validate Issued By State
                    if(!$this->validate->string_validate($value['issued_by_state'],2)) {
                            $errorlog[$line]['issued_by_state']['valid']='ERR'; 
                            $errorlog[$line]['issued_by_state']['msg']='You need to provide a valid Issuing State';
                    } else $errorlog[$line]['issued_by_state']['valid']='OK'; 
                    
                     // Validate Issued By State
                    if(!$this->validate->string_validate($value['issued_by_phone'],8)) {
                            $errorlog[$line]['issued_by_phone']['valid']='ERR'; 
                            $errorlog[$line]['issued_by_phone']['msg']='You need to provide a valid Issuing Phone';
                    } else $errorlog[$line]['issued_by_phone']['valid']='OK';
                    
                     // Validate Issued By State
                    if(!$this->validate->string_validate($value['issued_by_state'],2)) {
                            $errorlog[$line]['issued_by_state']['valid']='ERR'; 
                            $errorlog[$line]['issued_by_state']['msg']='You need to provide a valid Issuing State';
                    } else $errorlog[$line]['issued_by_state']['valid']='OK';
                    
                     // Validate Issued By State
                    if(!$this->validate->string_validate($value['issued_by_phone'],8)) {
                            $errorlog[$line]['issued_by_phone']['valid']='ERR'; 
                            $errorlog[$line]['issued_by_phone']['msg']='You need to provide a valid Issuing Phone';
                    } else $errorlog[$line]['issued_by_phone']['valid']='OK';
                    
                     // Validate Issued By State
                    if(!filter_var($value['issued_by_email'], FILTER_VALIDATE_EMAIL)) {
                            $errorlog[$line]['issued_by_email']['valid']='ERR'; 
                            $errorlog[$line]['issued_by_email']['msg']='You need to provide a valid Issuing Email';
                    } else $errorlog[$line]['issued_by_email']['valid']='OK';
                    
                    
                     // Validate Issued By Name
                    if(!$this->validate->string_validate($value['payee_name'],4)) {
                            $errorlog[$line]['payee_name']['valid']='ERR'; 
                            $errorlog[$line]['payee_name']['msg']='You need to provide a valid Issuing Name';
                    } else $errorlog[$line]['payee_name']['valid']='OK'; 
                    
                     // Validate Issued By Address
                    if(!$this->validate->string_validate($value['payee_address'],4)) {
                            $errorlog[$line]['payee_address']['valid']='ERR'; 
                            $errorlog[$line]['payee_address']['msg']='You need to provide a valid ssuing Address';
                    } else $errorlog[$line]['payee_address']['valid']='OK'; 
                    
                     // Validate Issued By Address2
                    if(!$this->validate->string_validate($value['payee_address2'],4)) {
                            $errorlog[$line]['payee_address2']['valid']='ERR'; 
                            $errorlog[$line]['payee_address2']['msg']='You need to provide a valid Issuing Address 2';
                    } else $errorlog[$line]['payee_address2']['valid']='OK'; 
                    
                     // Validate Issued By Postcode/ZIp
                    if(!$this->validate->string_validate($value['payee_postcode'],4)) {
                            $errorlog[$line]['payee_postcode']['valid']='ERR'; 
                            $errorlog[$line]['payee_postcode']['msg']='You need to provide a valid Issuing Postcode/ZIP';
                    } else $errorlog[$line]['payee_postcode']['valid']='OK'; 
                    
                     // Validate Issued By State
                    if(!$this->validate->string_validate($value['payee_state'],2)) {
                            $errorlog[$line]['payee_state']['valid']='ERR'; 
                            $errorlog[$line]['payee_state']['msg']='You need to provide a valid Issuing State';
                    } else $errorlog[$line]['payee_state']['valid']='OK'; 
                    
                     // Validate Issued By State
                    if(!$this->validate->string_validate($value['payee_phone'],8)) {
                            $errorlog[$line]['payee_phone']['valid']='ERR'; 
                            $errorlog[$line]['payee_phone']['msg']='You need to provide a valid Issuing Phone';
                    } else $errorlog[$line]['payee_phone']['valid']='OK';
                    
                     // Validate Issued By State
                    if(!$this->validate->string_validate($value['payee_state'],2)) {
                            $errorlog[$line]['payee_state']['valid']='ERR'; 
                            $errorlog[$line]['payee_state']['msg']='You need to provide a valid Issuing State';
                    } else $errorlog[$line]['payee_state']['valid']='OK';
                    
                     // Validate Issued By State
                    if(!$this->validate->string_validate($value['payee_phone'],8)) {
                            $errorlog[$line]['payee_phone']['valid']='ERR'; 
                            $errorlog[$line]['payee_phone']['msg']='You need to provide a valid Issuing Phone';
                    } else $errorlog[$line]['payee_phone']['valid']='OK';
                    
                     // Validate Issued By State
                    if(!filter_var($value['payee_email'], FILTER_VALIDATE_EMAIL)) {
                            $errorlog[$line]['payee_email']['valid']='ERR'; 
                            $errorlog[$line]['payee_email']['msg']='You need to provide a valid Issuing Email';
                    } else $errorlog[$line]['payee_email']['valid']='OK';
                    
                     // Validate Issued By State
                    $errorlog[$line]['note']['valid']='OK';
                    
                    
                    $line++;
                }
                
                return $errorlog;
                
                //print_array($errorlog);
                exit;
            
        }

        
    }
}

?>

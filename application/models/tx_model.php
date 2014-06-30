<?php

class TX_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}


    public function get_merchant_totals() {
        
        extract($_GET);


        $this->db->select(' merchantid,
                            sum(case when transactions.status=0 then transactions.check_amount else 0 end) as amount_pending,
                            sum(case when transactions.status=1 then transactions.check_amount else 0 end) as amount_submitted,
                            sum(case when transactions.status=2 then transactions.check_amount else 0 end) as amount_settled,
                            sum(check_amount) as amount_total');
        
        $this->db->from('transactions');
        
        
        if(!isadmin()) {
            
            $this->db->join('batchgroups','transactions.batch = batchgroups.batchid');
            $this->db->where('batchgroups.groupid',$this->session->userdata['group']);
            
        }
        
        if(isset($search)) {
        
            if(isset($merchant) && $merchant!='null') {
                $this->db->where('transactions.merchantid',$merchant);
            }

            if(isset($datefrom)) {
                $from = strtotime($datefrom);
                $this->db->where('datesubmitted >',$from);
            }

            if(isset($dateto)) {
                $to = strtotime($dateto);
                $this->db->where('datesubmitted <',$to);
            }

        }
        $this->db->group_by('transactions.merchantid');
        
        $this->flexigrid->build_query();
        
        
        $return['records'] = $this->db->get();
        
	$return['record_count'] = 1;
        
        return $return;
        
    }
       public function get_unassigned_transactions() {
        
        extract($_GET);
        
        $this->db->select('transactions.id,debitcredit,check_no,check_amount,check_date,issued_by_name,payee_name,batch,merchantid,status');
        $this->db->from('transactions');
                       
        if(!isadmin()) {
            
            $this->db->join('batchgroups','transactions.batch = batchgroups.batchid');
            $this->db->join('usergroups','batchgroups.groupid = usergroups.groupid');
            $this->db->where('usergroups.userid',$this->session->userdata['userid']);
            
        }
        
        if(isset($searchby)) {

            
            $from = strtotime($datefrom);
            $to = strtotime($dateto);
            
            $this->db->where('datesubmitted >',$from);
            $this->db->where('datesubmitted <',$to);
            
            
        }
        
        $this->db->where('batch',null);

        $this->flexigrid->build_query();
        
        $return['records'] = $this->db->get();
        

        
		//Build count query
		$this->db->select('count(transactions.id) as record_count');
                $this->db->from('transactions');

                if(!isadmin()) {

                    $this->db->join('batchgroups','transactions.batch = batchgroups.batchid');
                    $this->db->join('usergroups','batchgroups.groupid = usergroups.groupid');
                    $this->db->where('usergroups.userid',$this->session->userdata['userid']);

                }

                
                if(isset($searchby)) {
            

                    $this->db->where('datesubmitted >',$from);
                    $this->db->where('datesubmitted <',$to);


                }
                
        $this->db->where('batch',null);
                
		$this->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
                        
                
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
        
    } 
    
    public function get_txtypes() {
        
        $this->db->select('transaction_type.*');
        $this->db->from('transaction_type');
        
        $result = $this->db->get();
        
        return $result->result_array();
        
    }
    public function get_transactions() {
        
        extract($_GET);
       
        $this->db->select('transactions.id,debitcredit,check_no,check_amount,check_date,issued_by_name,payee_name,batch,merchantid,status,date(datesubmitted) as datesubmitted');
        $this->db->from('transactions');
                       
        if(!isadmin()) {
            
            $this->db->join('batchgroups','transactions.batch = batchgroups.batchid');
            $this->db->join('usergroups','batchgroups.groupid = usergroups.groupid');
            $this->db->where('usergroups.userid',$this->session->userdata['userid']);
            
        }
		
		if(isset($_GET['status'])){
			$status = $_GET['status'];
			$this->db->where('transactions.status',$status);
		} 
        
		if(isset($searchby)) {

			$from = strtotime($datefrom);
			$to = strtotime($dateto);
			
			$this->db->where('datesubmitted >',$from);
			$this->db->where('datesubmitted <',$to);   
			
		}

		
		$this->flexigrid->build_query();  
        
        $return['records'] =  $this->db->get();
		
			//Build count query
			
			$this->db->select('count(transactions.id) as record_count');
            $this->db->from('transactions');

			if(!isadmin()) {

				$this->db->join('batchgroups','transactions.batch = batchgroups.batchid');
				$this->db->join('usergroups','batchgroups.groupid = usergroups.groupid');
				$this->db->where('usergroups.userid',$this->session->userdata['userid']);

			}
			
			if(isset($_GET['status'])){
				$status = $_GET['status'];
				$this->db->where('transactions.status',$status);
			} 
			
			if(isset($searchby)) {

				$this->db->where('datesubmitted >',$from);
				$this->db->where('datesubmitted <',$to);

			}
			
                
		$this->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
                                  
		//Get Record Count
		$return['record_count'] = $row->record_count;
		

		//Return all
		return $return;
        
    }
    
    function assign_tx($txid,$batchid) {
        
        $data = array(
           'batch' => $batchid,
        );
        
        $this->db->where('id',$txid);
        $this->db->update('transactions',$data);
        
        return true;        
        
    }
    
    function update_tx_status($txid,$status) {
        
        $data = array (
            'status' => $status
        );
        
        $this->db->where('id',$txid);
        $this->db->update('transactions',$data);
        
        return true;
        
    }  
    
    function update_tx_externalref($txid,$reference) {
        
        $data = array (
            'external_batchid' => $reference
        );
        
        $this->db->where('id',$txid);
        $this->db->update('transactions',$data);
        
        return true;
        
    } 
    
    function get_tx_merchant($txid) {
        
        $this->db->select('transactions.merchantid as merchantid');
        $this->db->from('transactions');
        $this->db->where('id',$txid);
        
        $result = $this->db->get();
        
        return $result->row(0)->merchantid;
        
    }
	
    function insert_transaction_frombatch($vars,$batchid,$type) {
        
        extract($vars);
        
        $data = array(
            'type' => $type,
            'check_no' => $tx_no,
            'check_amount' => $amount,
            'check_date' => $date,
            'issued_by_bank' => $issued_by_bank,
            'issued_by_name' => $issued_by_name,
            'issued_by_address' => $issued_by_address,
            'issued_by_address2' => $issued_by_address2,
            'issued_by_postcode' => $issued_by_postcode,
            'issued_by_phone' => $issued_by_phone,
            'issued_by_state' => $issued_by_state,
            'issued_by_email' => $issued_by_email,
            'payee_name' => $payee_name,
            'payee_address' => $payee_address,
            'payee_address2' => $payee_address2,
            'payee_postcode' => $payee_postcode,
            'payee_phone' => $payee_phone,
            'payee_state' => $payee_state,
            'payee_email' => $payee_email,
            'datesubmitted' => date('Y-m-d H:m:s',time()),
            'usersubmitted' => $this->session->userdata['userid'],
            'merchantid' => $this->session->userdata['merchant_id'],
            'batch' => $batchid,
            'note' => $note
        ); 
        
        
        $result = $this->db->insert('transactions',$data);
        
        
        return $this->db->insert_id();
        
        
    }
	
    function insert_transaction($vars,$batchid,$type) {
        
        extract($vars);
        
        $data = array(
            'type' => $type,
            'check_no' => $check_details_no1.'-'.$check_details_no2.'-'.$check_details_no3.'-'.$check_details_no4,
            'check_amount' => $check_details_amount,
            'check_date' => $year.'-'.$month.'-'.$day,
            'issued_by_bank' => $issued_by_bank,
            'issued_by_name' => $issued_by_name,
            'issued_by_address' => $issued_by_address,
            'issued_by_address2' => $issued_by_address2,
            'issued_by_postcode' => $issued_by_postcode,
            'issued_by_phone' => $issued_by_phone,
            'issued_by_state' => $issued_by_state,
            'issued_by_email' => $issued_by_email,
            'payee_name' => $payee_name,
            'payee_address' => $payee_address,
            'payee_address2' => $payee_address2,
            'payee_postcode' => $payee_postcode,
            'payee_phone' => $payee_phone,
            'payee_state' => $payee_state,
            'payee_email' => $payee_email,
            'datesubmitted' => date('Y-m-d H:m:s',time()),
            'usersubmitted' => $this->session->userdata['userid'],
            'merchantid' => $this->session->userdata['merchant_id'],
            'batch' => $batchid,
            'note' => $note
        ); 
        
        
        $result = $this->db->insert('transactions',$data);
        
        
        return $this->db->insert_id();
        
        
    }
      function update_transaction($vars,$txid) {
        
        extract($vars);
        
        $data = array(
            'check_no' => $check_details_no1.'-'.$check_details_no2.'-'.$check_details_no3.'-'.$check_details_no4,
            'check_amount' => $check_details_amount,
            'check_date' => $year.'-'.$month.'-'.$day,
            'issued_by_bank' => $issued_by_bank,
            'issued_by_name' => $issued_by_name,
            'issued_by_address' => $issued_by_address,
            'issued_by_address2' => $issued_by_address2,
            'issued_by_postcode' => $issued_by_postcode,
            'issued_by_phone' => $issued_by_phone,
            'issued_by_state' => $issued_by_state,
            'issued_by_email' => $issued_by_email,
            'payee_name' => $payee_name,
            'payee_address' => $payee_address,
            'payee_address2' => $payee_address2,
            'payee_postcode' => $payee_postcode,
            'payee_phone' => $payee_phone,
            'payee_state' => $payee_state,
            'note' => $note
        ); 
        
        $this->db->where('id',$txid);
        $this->db->update('transactions',$data);
        
        
        
    }
    
    function delete_tx($txid) {
        
        $this->db->delete('transactions', array('id'=>$txid));
        
        return true;        
        
    }    
    
    function get_batchtx($batchid) {

        $this->db->select('id,check_no,debitcredit,check_amount,check_date,issued_by_name,payee_name,batch,merchantid,status');
        $this->db->from('transactions');
        $this->db->where('batch',$batchid);
        $this->flexigrid->build_query();

        $return['records'] = $this->db->get();

                //Build count query
                $this->db->select('count(id) as record_count')->from('transactions');
                $this->flexigrid->build_query(FALSE);
                $record_count = $this->db->get();
                $row = $record_count->row();



                //Get Record Count
                $return['record_count'] = $row->record_count;

                //Return all
                return $return;

    }
    
    function get_transactions_by_batch($batchid) {
        
        
        $this->db->select('transactions.*');
        $this->db->from('transactions');
        $this->db->where('batch',$batchid);

        $records = $this->db->get();
        
        if ($records->num_rows()) {
            
            return $records->result_array();

        } else {

            return false;

        }
        
        
    }
     
    function get_transaction_by_id($txid) {
        
        
        $this->db->select('transactions.*');
        $this->db->from('transactions');
        $this->db->where('id',$txid);
        $this->db->limit('1');

        $records = $this->db->get();
        
        if ($records->num_rows()) {
            
            return $records->result_array();

        } else {

            return false;

        }
        
        
    }
    
    function lookup_search($name,$postcode,$accountnumber) {
        
        $this->db->select('transactions.*');
        $this->db->from('transactions');
        $this->db->like('issued_by_name',$name);
        $this->db->like('issued_by_postcode',$postcode);
        $this->db->like('check_no',$accountnumber);
        
        $result = $this->db->get();
        
        
        if($result->num_rows() > 0) {
            
            return $result->result_array();
            
        } else {
            
            return false;
        }
        
        
        
    }

}

?>

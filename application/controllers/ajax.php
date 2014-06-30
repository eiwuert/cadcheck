<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
    
	function __construct()
	{
		parent::__construct();
		$this->load->library('flexigrid');
		$this->load->library('csvreader');
	}
	
	function index()
	{
		//List of all fields that can be sortable. This is Optional.
		//This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
		$valid_fields = array('id','iso','name','printable_name','iso3','numcode');
		
		$this->flexigrid->validate_post('id','asc',$valid_fields);

		$records = $this->Ajax_model->get_countries();
		
		$this->output->set_header($this->config->item('json_header'));
		
		/*
		 * Json build WITH json_encode. If you do not have this function please read
		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative
		 */
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array($row->id,  
			$row->id,
			$row->iso,
			$row->name,
			'<span style=\'color:#ff4400\'>'.addslashes($row->printable_name).'</span>',
			$row->iso3,
			$row->numcode,
			'<a href=\'#\'><img border=\'0\' src=\''.$this->config->item('base_url').'public/images/close.png\'></a> '
			);
		}
		//Print please
		if (isset($record_items))
                    $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
                else
                    $this->output->set_output('{"page":"1","total":"0","rows":[]}'); 
	}
        
        function batchparser() {
            
            
            /**

                    // return text var_dump for the html request
                    echo "VAR DUMP:<p />";
                    var_dump($_POST);
                        $n = $file['name'];
                        $s = $file['size'];
                        echo $file['tmp_name'];
                        if (!$n) continue;
                        echo "File: $n ($s bytes)";
                    }    */     
     
                    foreach($_FILES as $file) {
                        
                        
                        if($file['type']!='text/csv') {
                            
                            echo "Not a valid filetype. Please upload a CSV.";
                            die();
                        
                        } else { // Validate
                            
                            $data = $this->csvreader->parse_file($file['tmp_name']);
                            $validation = $this->Batch_model->validate_batch($data,$_POST['txtype']); 
                            
                            
                            if($this->validate->in_array_r('ERR',$validation)) {
                                
                                echo $this->validate->construct_validationreport($validation);
                                
                            } else {
                                
                                //Process Batch.
  
                                
                                  /* PROCESS CHECK */

                                // Check Batch handling

                                    // create new batch if selected
                                $batchid = $this->Batch_model->create_batch($this->session->userdata['merchant_id']);

                               


                                   foreach($data as $values) {
                                       
                                    $this->TX_model->insert_transaction_frombatch($values,$batchid,$_POST['txtype']); // Insert trnasaction into existing batch
                                    $this->Customer_model->save_customer_data($values); 
                                    
                                   }
                                
                               echo "<div class='success'>Your batch has been processed. To view the processed transactions for Batch #".$batchid." <a href='/transaction/batch?view=".$batchid."'>Click Here</a></div>";
                              
                            }
                            
                        }
                        
                        
                    }

            
        }
        
        
        function merchant_totals() 
            
	{
		//List of all fields that can be sortable. This is Optional.
		//This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
		$valid_fields = array('merchantid','name','amount_pending','amount_submitted','amount_settled','amount_total');
		
		$this->flexigrid->validate_post('merchantid','asc',$valid_fields);

		$records = $this->TX_model->get_merchant_totals();
		
		$this->output->set_header($this->config->item('json_header'));
		
		/*
		 * Json build WITH json_encode. If you do not have this function please read
		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative
		 */
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array(
                        $row->merchantid,
                        $row->merchantid,
                        $this->Merchant_model->get_merchant_name($row->merchantid),
			$row->amount_pending,
			$row->amount_submitted,
			$row->amount_settled,
			$row->amount_total
			);
		}
                
                
		//Print please
		if (isset($record_items))
                    $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
                else
                    $this->output->set_output('{"page":"1","total":"0","rows":[]}');           
            
        }
        
        function search_names() {
            
            $name = trim($this->input->get('term')); //get term parameter sent via text field. Not sure how secure get() is

            $this->db->select('*'); 
            $this->db->from('customer_data');
            $this->db->like('name', $name);
            $this->db->limit('5');
            $query = $this->db->get();

            if ($query->num_rows() > 0) 
            {
                $data['response'] = 'true'; //If username exists set true
                $data['message'] = array(); 

                foreach ($query->result() as $row)
                {
                    $data['message'][] = array(  
                        'label' => $row->name.' (Postcode: '.$row->postcode.')',
                        'value' => $row->name,
                        'user_id'  => $row->id,
                        'email'  => $row->email,
                        'address1' => $row->address1,
                        'address2' => $row->address2,
                        'postcode' => $row->postcode,
                        'phone' => $row->phone
                    );
                }    
            } 
            else
            {
                $data['response'] = 'false'; //Set false if user not valid
            }

            echo json_encode($data);
            
        }
	
        function transactions($filterBy=false) 
            
	{
		
		//List of all fields that can be sortable. This is Optional.
		//This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
		$valid_fields = array('transactions.id','check_no','check_amount','check_date','issued_by_name','payee_name','status','batch');
		
		$this->flexigrid->validate_post('transactions.id','asc',$valid_fields);

		$records = $this->TX_model->get_transactions($filterBy);
		
		$this->output->set_header($this->config->item('json_header'));
		
		/*
		 * Json build WITH json_encode. If you do not have this function please read
		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative
		 */
		foreach ($records['records']->result() as $row)
		{
                        if($row->status==0) {
                            $linkString = '<a href="/transaction/edit?tx='.$row->id.'">Edit Transaction</a> <a href="/transaction/batch?view='.$row->batch.'">View Batch</a>';
                        } else {
                            $linkString = '<a href="/transaction/batch?view='.$row->batch.'">View Batch</a>';
                        }
                        

                        if(!$row->batch) {
                            
                            $batch = '<span style=\'color:red\'>Unassigned</span>';
                            
                        } else {
                            
                            $batch = $row->batch;
                            
                        }
                        
                        $status=txstatustostring($row->status);
			$record_items[] = array($row->id,
			$row->id,
                        $batch,
                        ucfirst($row->debitcredit),
                        $this->Merchant_model->get_merchant_name($row->merchantid),
			$row->check_no,
			$row->check_amount,
			$row->check_date,
			$row->datesubmitted,
			$row->issued_by_name,
			$row->payee_name,
			'<span style=\'color:'.$status['color'].'\'>'.addslashes($status['name']).'</span>'
			);
		}
                
                
		//Print please
		if (isset($record_items))
                    $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
                else
                    $this->output->set_output('{"page":"1","total":"0","rows":[]}');           
            
        }
	
	
        function transactions_unassigned() 
            
	{
		//List of all fields that can be sortable. This is Optional.
		//This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
		$valid_fields = array('transactions.id','check_no','check_amount','check_date','issued_by_name','payee_name','status','batch');
		
		$this->flexigrid->validate_post('transactions.id','asc',$valid_fields);

		$records = $this->TX_model->get_unassigned_transactions();
		
		$this->output->set_header($this->config->item('json_header'));
		
		/*
		 * Json build WITH json_encode. If you do not have this function please read
		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative
		 */
		foreach ($records['records']->result() as $row)
		{

                        
                        if(!$row->batch) {
                            
                            $batch = '<span style=\'color:red\'>Unassigned</span>';
                            
                        } else {
                            
                            $batch = $row->batch;
                            
                        }
                        
                        $status=txstatustostring($row->status);
			$record_items[] = array($row->id,
			$row->id,
                        $batch,
                        ucfirst($row->debitcredit),
                        $this->Merchant_model->get_merchant_name($row->merchantid),
			$row->check_no,
			$row->check_amount,
			$row->check_date,
			$row->issued_by_name,
			$row->payee_name,
			'<span style=\'color:'.$status['color'].'\'>'.addslashes($status['name']).'</span>'
			);
		}
                
                
		//Print please
		if (isset($record_items))
                    $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
                else
                    $this->output->set_output('{"page":"1","total":"0","rows":[]}');           
            
        }
        
    function batchtx() 
	{
		//List of all fields that can be sortable. This is Optional.
		//This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
		$valid_fields = array('id','check_no','check_amount','check_date','issued_by_name','payee_name','status','batch');
		
		$this->flexigrid->validate_post('id','asc',$valid_fields);

		$records = $this->TX_model->get_batchtx($_GET['batch']);
		
		$this->output->set_header($this->config->item('json_header'));
		
		/*
		 * Json build WITH json_encode. If you do not have this function please read
		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative
		 */
		foreach ($records['records']->result() as $row)
		{     			$status=txstatustostring($row->status);
			$record_items[] = array($row->id,
						$row->id,
                        $row->batch,
                        $this->Merchant_model->get_merchant_name($row->merchantid),
			$row->check_no,
			$row->check_amount,
			$row->check_date,
			$row->issued_by_name,
			$row->payee_name,
			'<span style=\'color:'.$status['color'].'\'>'.addslashes($status['name']).'</span>',
			);
		}
		//Print please
		if (isset($record_items))
                    $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
                else
                    $this->output->set_output('{"page":"1","total":"0","rows":[]}');            
            
        }
        
        function get_applicable_batches() {
            
                $merchantid = $this->TX_model->get_tx_merchant($this->input->post('txid'));
                
                $response = $this->Batch_model->get_unsubmitted_batches($merchantid);
                
                echo json_encode($response);
                
            
        }
	
        
        function batches() {
            
            	/*
		$colModel['id'] = array('ID',15,TRUE,'left',2);
		$colModel['title'] = array('Check No',100,TRUE,'center',0);
		$colModel['datecreated'] = array('Check Amount',100,TRUE,'left',1);
		$colModel['datesubmitted'] = array('Check Date',90,TRUE,'left',0);
		$colModel['transactions'] = array('Payee Name',130, TRUE, 'left',1);
		$colModel['amount'] = array('Status',60, FALSE, 'center',0);
		$colModel['status'] = array('Issued By',130, TRUE,'left',1);
		*/
            	
            
		//List of all fields that can be sortable. This is Optional.
		//This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
		$valid_fields = array('id','title','datecreated','datesubmited','transactions','amount','status');
		
		$this->flexigrid->validate_post('id','asc',$valid_fields);

		$records = $this->Batch_model->get_batches();
		
		$this->output->set_header($this->config->item('json_header'));
		
		/*
		 * Json build WITH json_encode. If you do not have this function please read
		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative
		 */
		foreach ($records['records']->result() as $row)
		{
                    
                        $status=batchstatustostring($row->status);
                        
			$record_items[] = array($row->id,
                        '<input type="checkbox" class="rowselect" id="select_'.$row->id.'" onclick="select_row('.$row->id.');" >',
			$row->id,
			$row->title,
			$row->datecreated,
			$row->datesubmitted,
			$row->transactions,
			$row->amount,
			'<span style=\'color:'.$status['color'].'\'>'.addslashes($status['name']).'</span>',
			);
		}
		//Print please
		if (isset($record_items))
                    $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
                else
                    $this->output->set_output('{"page":"1","total":"0","rows":[]}'); 
        }
        
        function get_user_reports() {
            
               
            	/*
		$colModel['id'] = array('ID',15,TRUE,'left',2);
		$colModel['title'] = array('Check No',100,TRUE,'center',0);
		$colModel['datecreated'] = array('Check Amount',100,TRUE,'left',1);
		$colModel['datesubmitted'] = array('Check Date',90,TRUE,'left',0);
		$colModel['transactions'] = array('Payee Name',130, TRUE, 'left',1);
		$colModel['amount'] = array('Status',60, FALSE, 'center',0);
		$colModel['status'] = array('Issued By',130, TRUE,'left',1);
		*/
            	
            
		//List of all fields that can be sortable. This is Optional.
		//This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
		$valid_fields = array('id','filename','filetype','location','viewed','datecreated');
		
		$this->flexigrid->validate_post('id','asc',$valid_fields);

		$records = $this->Report_model->get_user_reports();
		
		$this->output->set_header($this->config->item('json_header'));
		
		/*
		 * Json build WITH json_encode. If you do not have this function please read
		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative
		 */
		foreach ($records['records']->result() as $row)
		{
                        if($row->viewed == 0) { $viewed = '<span style="color:red;">New</span>'; } else { $viewed = 'Downloaded'; }
                        
			$record_items[] = array($row->id,
			$row->id,
			$row->filename,
			$row->filetype,
			$row->location,
			$viewed,
			$row->datecreated
			);
                        
                        ///
		}
		//Print please
		if (isset($record_items))
                    $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
                else
                    $this->output->set_output('{"page":"1","total":"0","rows":[]}');          
            
        }
        
        function get_users() {
            
               
            	/*
		$colModel['id'] = array('ID',15,TRUE,'left',2);
		$colModel['title'] = array('Check No',100,TRUE,'center',0);
		$colModel['datecreated'] = array('Check Amount',100,TRUE,'left',1);
		$colModel['datesubmitted'] = array('Check Date',90,TRUE,'left',0);
		$colModel['transactions'] = array('Payee Name',130, TRUE, 'left',1);
		$colModel['amount'] = array('Status',60, FALSE, 'center',0);
		$colModel['status'] = array('Issued By',130, TRUE,'left',1);
		*/
            	
            
		//List of all fields that can be sortable. This is Optional.
		//This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
		$valid_fields = array('id','username','firstname','lastname','email','lastlogin','ip','role');
		
		$this->flexigrid->validate_post('id','asc',$valid_fields);

		$records = $this->User_model->get_users();
	
		
		$this->output->set_header($this->config->item('json_header'));
		
		/*
		 * Json build WITH json_encode. If you do not have this function please read
		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative
		 */
		foreach ($records['records']->result() as $row)
		{
                        $role = get_role_title($row->role);
                        
			$record_items[] = array($row->id,
			$row->id,
			$row->firstname.' '.$row->lastname,
			$row->username,
			$row->email,
			$role,
			$row->lastlogin,
			$row->loginip
			);
		}
	
		
		//Print please
		if (isset($record_items))
                    $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
                else
                    $this->output->set_output('{"page":"1","total":"0","rows":[]}');          
            
        }
        
	
        
	//Delete Batch & All Transactions
	function delete_batch()
	{
                
                $batch_ids_post_array = split(",",$this->input->post('items'));
		
		foreach($batch_ids_post_array as $index => $batch_id)
			if (is_numeric($batch_id) && $batch_id > 1)
				$this->Batch_model->delete_batch($batch_id);
						
			
		//$error = "Selected batches (id's: ".$this->input->post('items').") submitted with success";

		$this->output->set_header($this->config->item('ajax_header'));
		//$this->output->set_output($error);
	}
        
	//Delete Transaction
	function assign_tx()
	{
                
                $tx_ids_post_array = split(",",$this->input->post('items'));
                $batchid = $this->input->post('batchassign');
                $merchantid = $this->input->post('merchantid');
                
                if($batchid=='newbatch') {
                    
                    //Create new batch for TX Merchant
                    $merchantid=$this->TX_model->get_tx_merchant($tx_id);
                    $newbatchid=$this->Batch_model->create_batch($merchantid);

                    foreach($tx_ids_post_array as $index => $tx_id)
                            if (is_numeric($tx_id) && $tx_id > 1)
                                    $this->TX_model->assign_tx($tx_id,$newbatchid);
                    
                } else {

                    foreach($tx_ids_post_array as $index => $tx_id)
                            if (is_numeric($tx_id) && $tx_id > 1)
                                    $this->TX_model->assign_tx($tx_id,$batchid);
                    
                }
			
		//$error = "Selected batches (id's: ".$this->input->post('items').") submitted with success";

		$this->output->set_header($this->config->item('ajax_header'));
		//$this->output->set_output($error);
	}
        
        
	//Delete Transaction
	function delete_tx()
	{
                
                $tx_ids_post_array = split(",",$this->input->post('items'));
		
		foreach($tx_ids_post_array as $index => $tx_id)
			if (is_numeric($tx_id) && $tx_id >= 1)
				$this->TX_model->delete_tx($tx_id);
						
			
		//$error = "Selected batches (id's: ".$this->input->post('items').") submitted with success";

		$this->output->set_header($this->config->item('ajax_header'));
		//$this->output->set_output($error);
	}
        
        function submit_batch() {
                
                $batch_ids_post_array = split(",",$this->input->post('items'));
		
		foreach($batch_ids_post_array as $index => $batch_id) {
			if (is_numeric($batch_id) && $batch_id > 1) {
						
				$this->Batch_model->submit_batch($batch_id);
                                $this->API_model->send_batch_api_eft($batch_id); // On submit send off batches
                                
                        }
                 
                }
			
		//$error = "Selected batches (id's: ".$this->input->post('items').") submitted with success";

		$this->output->set_header($this->config->item('ajax_header'));
		//$this->output->set_output($error);
        }	


	function createNew_User($user_id=""){
	
		if($this->input->post()){
		
			$user_role = $this->input->post('user_role');
			
			$insertArr = array(			
					'firstname' => $this->input->post('fname'),
					'lastname' => $this->input->post('lname'),
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email')
			);

			if(!($insertArr['firstname']=='' || $insertArr['lastname']=='' || $insertArr['username']=='' || $insertArr['email']=='')){

				if($user_id==""){
					$insertArr['password'] = md5('pass123');
					$response = $this->User_model->create_newUser($insertArr,$user_role);
				}else{
					$response = $this->User_model->edit_user($insertArr,$user_id,$user_role);
				}			
				
				
			}else{
				$response = '000';
			}	
	
			echo $response;

		}
		
	}

		//Delete User
	function delete_user()
	{
        $user_ids_post_array = split(",",$this->input->post('items'));
	
		$this->User_model->delete_user($user_ids_post_array);
	
		$this->output->set_header($this->config->item('ajax_header'));
	
	}


	
		
	function getpayees($id=""){
		
		$this->load->model('payee_model');
		if($id==""){
		
		$valid_fields = array('id','username','firstname','lastname','email','lastlogin','ip','role');			
		$this->flexigrid->validate_post('id','asc',$valid_fields);	
		
		$records = $this->payee_model->get_payees();				
		/* echo '<pre>';			
		print_r($records);	exit;	 */	
		

		$this->output->set_header($this->config->item('json_header')); 		
		
		/*		 * Json build WITH json_encode. If you do not have this function please read		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative		 */	

		if(!empty($records['records'])){	
		
			foreach($records['records'] as $row) {
				$record_items[] = array($row->id, 	
								$row->id, 				
								$row->name,					
								$row->email,					
								$row->phone,					
								$row->address1,					
								$row->address2,					
								$row->state_name,					
								$row->state_code,					
								$row->post_code					
								/* $row->trans_note	 */				
							);				
			}			
		
		}else{				
				$record_items = array();			
			}							
		
		if(isset($record_items)){	
				
				$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));

		}else{
			
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');          			
		}
		
		}else { // get payee by id
					
				$response = array();
					
			$records = $this->payee_model->get_payees($id);
			
			if(!empty($records['records'])){
			
				$response['code'] = '202'; 
				$response['data'] = $records['records']; 	
				
			}else{
				$response['code'] = '101'; 
				$response['message'] = 'No record found !';
				
			}
			
			echo json_encode($response);
		}
	
	}
	
	function addNew_Payee($payee_id=""){
	
		if($this->input->post()){
		
			$insertArr = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'address1' => $this->input->post('address1'),
					'address2' => $this->input->post('address2'),
					'state_name' => $this->input->post('state'),
					'state_code' => $this->input->post('stateAbbr'),
					'post_code' => $this->input->post('post_code')
					/* 'trans_note' => $this->input->post('trans_note') */
			);

		if(!($insertArr['name']=='' || $insertArr['email']=='' || $insertArr['phone']=='' || $insertArr['address1']=='' || $insertArr['state_name']==''|| $insertArr['post_code']=='')){
		
			$this->load->model('payee_model');	
			if($payee_id==""){
				$response = $this->payee_model->add_newPayees($insertArr);
			}else{
				$response = $this->payee_model->edit_Payees($insertArr,$payee_id);
			}			
			
			
		}else{
			$response = '000';
		}	
	
		echo $response;

		}
		
	}
	
	function delete_payee(){
		
		$payee_ids_post_array = split(",",$this->input->post('items'));
		
		$this->load->model('payee_model');
		$this->payee_model->deletePayees($payee_ids_post_array);
	
		$this->output->set_header($this->config->item('ajax_header'));
		
	}
	
	/*		function get_payees()	{		echo 'get_payees';			//$valid_fields = array('id','username','firstname','lastname','email','lastlogin','ip','role');		//$this->flexigrid->validate_post('id','asc',$valid_fields);		//$this->load->model('payee_model');		/* $records = $this->payee_model->get_payees();			print_r($records);				$this->output->set_header($this->config->item('json_header')); 		/*		 * Json build WITH json_encode. If you do not have this function please read		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative		 */		/* 		if(!empty($records['records'])){					foreach($records['records'] as $row) {				$record_items[] = array(								$row->id, 				$row->name,				$row->email,				$row->phone,				$row->address1,				$row->address2,				$row->state_name,				$row->state_code,				$row->post_code				);			}		}else{			$record_items = array();		}					if (isset($record_items)){                    $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));        }else{                    $this->output->set_output('{"page":"1","total":"0","rows":[]}');          		}			} */
     
	 
	/******** ++ Groups  ++**********/

	function getGroups($id=""){
		
		if($id==""){
		
		$valid_fields = array('id','username','firstname','lastname','email','lastlogin','ip','role');			
		$this->flexigrid->validate_post('id','asc',$valid_fields);	
		
		$records = $this->Merchant_model->get_groups();				
			 	

		$this->output->set_header($this->config->item('json_header')); 		
		
		/*		 * Json build WITH json_encode. If you do not have this function please read		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative		 */	

		if(!empty($records['records'])){	
		
			foreach($records['records'] as $row) {
				$record_items[] = array($row->id, 	
								$row->id, 				
								$row->groupname										
							);				
			}			
		
		}else{				
				$record_items = array();			
		}
			 
		if(isset($record_items)){	
				
				$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));

		}else{
			
			$this->output->set_output('{"page":"1","total":"0","rows":[]}');          			
		}
		
		}else { // get Group by id
					
			$response = array();
					
			$records = $this->Merchant_model->get_groups($id);
			
			if(!empty($records['records'])){
			
				$response['code'] = '202'; 
				$response['data'] = $records['records']; 	
				
			}else{
				$response['code'] = '101'; 
				$response['message'] = 'No record found !';
				
			}
			
			echo json_encode($response);
		}
	
	}	
	 
	 function createNew_Group($group_id=""){
	
		if($this->input->post()){
		
			$insertArr = array(
					'groupname' => $this->input->post('gname')
			);

		if(!($insertArr['groupname']=='')){
		
			if($group_id==""){
				$response = $this->Merchant_model->create_newGroup($insertArr);
			}else{
				$response = $this->Merchant_model->edit_Group($insertArr,$group_id);
			}			
			
			
		}else{
			$response = '000';
		}	
	
		echo $response;

		}
		
	}
	 
	function delete_group(){
			
		$group_ids_array = split(",",$this->input->post('items'));
		
		$this->Merchant_model->deleteGroup($group_ids_array);
	
		$this->output->set_header($this->config->item('ajax_header'));
	} 
	 
}
?>
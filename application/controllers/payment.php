<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	function __construct()
	{
		parent::__construct();
                //Check if Authed to view access this controller
                if (!isset($this->session->userdata['logged_in'])) {
                    redirect('auth/login');
                }
	}
        
        function index() {
            
                
                $result_array = $this->Merchant_model->getMerchants();
                
                
                if(count($result_array) > 1) { // if array has multiple merchants ask to select
                    
                    $data['merchants']=$result_array;
                                
                    $this->session->set_userdata(array(
                            'merchant_hasmultiple' => true
                    ));
                
                    $data['page_title']='Home';
                    
                    $data['formpost'] = '/payment/details';
					
					if(isadmin() && CURRENT_THEME!=''){
						
						$header = '_global/'.CURRENT_THEME.'/view_header'; 
						$content = 'payment/'.CURRENT_THEME.'/view_index'; 
			
						$this->load->view($header, $data);
						$this->load->view($content, $data);
                            	
					}else{
					
						$this->load->view('_global/view_header', $data);

						$this->load->view('_global/view_menu', $data);

						$this->load->view('payment/view_menu', $data);

						$this->load->view('payment/view_index', $data);

						$this->load->view('_global/view_footer', $data);
					
						
					}

                    
                    
                } else { // autoselect single merchant and forward to ddetails
                    
                    
                    $this->session->set_userdata(array(
                                                'merchant_id' => $result_array[0]['id'] // set only record
                                                ));
                    redirect('/payment/details');
                    
                }

                    
        }
        
        
        
        function batch() {
            
                
                $result_array = $this->Merchant_model->getMerchants();
                
                
                if(count($result_array) > 1) { // if array has multiple merchants ask to select
                    
                    $data['merchants']=$result_array;
                                
                    $this->session->set_userdata(array(
                            'merchant_hasmultiple' => true
                    ));
                    
                    $data['formpost'] = 'payment/batchupload';
                
                    $data['page_title']='Home';

					
					if(isadmin() && CURRENT_THEME!=''){
						
						$header = '_global/'.CURRENT_THEME.'/view_header'; 
						$content = 'payment/'.CURRENT_THEME.'/view_index'; 
			
						$this->load->view($header, $data);
						$this->load->view($content, $data);
                            	
					}else{
					
						$this->load->view('_global/view_header', $data);

						$this->load->view('_global/view_menu', $data);

						$this->load->view('payment/view_menu', $data);

						$this->load->view('payment/view_index', $data);

						$this->load->view('_global/view_footer', $data);
						
					}
                } else { // autoselect single merchant and forward to ddetails
                    
                    
                    $this->session->set_userdata(array(
                                                'merchant_id' => $result_array[0]['id'] // set only record
                                                ));
                    redirect('/payment/batchupload');
                    
                }

                    
        }
        
        
        
        function batchupload() {
            
                
                $result_array = $this->Merchant_model->getMerchants();
                
				if(!isset($this->session->userdata['merchant_id']) && !isset($_POST['merchant'])) {
							
						redirect('/payment/batch');
							
				}else if(isset($_POST['merchant'])) {
						
						$this->session->set_userdata(array(
										'merchant_id' => $_POST['merchant']
										));
						//redirect('/payment/batchupload');			

				} 
                if(count($result_array) > 1) { // if array has multiple merchants ask to select
                    
                    $data['merchants']=$result_array;
                                
                    $this->session->set_userdata(array(
                            'merchant_hasmultiple' => true
                    ));
                    
                    $data['transaction_type']=$this->TX_model->get_txtypes();
                    
                    $data['processing_merchant']=$this->Merchant_model->getMerchantById($this->session->userdata['merchant_id']); 
                          

                    $data['formpost'] = 'payment/batchupload';
                
                    $data['page_title']='Home';
					
					if(isadmin() && CURRENT_THEME!=''){
						 
						$content = 'payment/'.CURRENT_THEME.'/view_batchupload'; 
		
						$this->load->view($content, $data);
                            	
					}else{

						$this->load->view('_global/view_header', $data);

						$this->load->view('_global/view_menu', $data);

						$this->load->view('payment/view_menu', $data);

						$this->load->view('payment/view_batchupload', $data);

						$this->load->view('_global/view_footer', $data);
					
					}
                    
                } else { // autoselect single merchant and forward to ddetails
                    
                    
                    $this->session->set_userdata(array(
                                                'merchant_id' => $result_array[0]['id'] // set only record
                                                ));
                    
                                        
                    $data['transaction_type']=$this->TX_model->get_txtypes();
                    
                    $data['processing_merchant']=$this->Merchant_model->getMerchantById($this->session->userdata['merchant_id']); 
					
                            
                    $data['formpost'] = 'payment/batchupload';
                
                    $data['page_title']='Home';
					
					if(isadmin() && CURRENT_THEME!=''){
						 
						$content = 'payment/'.CURRENT_THEME.'/view_batchupload'; 
		
						$this->load->view($content, $data);
                            	
					}else{
					
						$this->load->view('_global/view_header', $data);

						$this->load->view('_global/view_menu', $data);

						$this->load->view('payment/view_menu', $data);

						$this->load->view('payment/view_batchupload', $data);

						$this->load->view('_global/view_footer', $data);
					
					}
                    
                }

                    
        }
        
        
        
        function edit() {
                    
             /* LOAD LIBRARIES FOR CONTROLLER */

                    
                    if(isset($_POST['txid'])) {
                    
                        $this->TX_model->update_transaction($_POST,$_POST['txid']);

                        $data['page_title']='Transaction Successfully Edited';

                        $this->load->view('_global/view_header', $data);

                        $this->load->view('_global/view_menu', $data);

                        $this->load->view('payment/view_menu', $data);

                        $this->load->view('payment/view_editsuccess', $data);

                        $this->load->view('_global/view_footer', $data);
                        
                    }
                     else {
            
                    if(isset($_GET['tx'])) {
                        
                        extract($_GET);
                        
                            
                    $tx_details = $this->TX_model->get_transaction_by_id($tx);
                    
                    $check_details=explode('-',$tx_details[0]['check_no']);
                    $date = explode('-',$tx_details[0]['check_date']);
                    
                    $data['tx']=$tx_details[0];
                    
					if(is_array($check_details)){
						$data['tx']['check_details_no1'] = isset($check_details[0])?$check_details[0]:'';
						$data['tx']['check_details_no2']  = isset($check_details[1])?$check_details[1]:'';
						$data['tx']['check_details_no3']  = isset($check_details[2])?$check_details[2]:'';
						$data['tx']['check_details_no4']  = isset($check_details[3])?$check_details[3]:'';
					}
                    
                    $data['tx']['date_year'] = $date[0];
                    $data['tx']['date_month'] = $date[1];
                    $data['tx']['date_day'] = $date[2];
                    
                    $data['page_title']='Edit Transaction';

                    $this->load->view('_global/view_header', $data);

                    $this->load->view('_global/view_menu', $data);

                    $this->load->view('payment/view_menu', $data);

                    $this->load->view('payment/view_edit', $data);

                    $this->load->view('_global/view_footer', $data);

                        
                    } else {
                        
                        exit('Must specify transaction to edit.');
                        
                    }
                     }
                    
        }
        
        function start() {
            
            /* CHECK TO SEE FORM VARIABLE WAS SELECTED AND SEND TO FORM WITHOUT POST */

                            if(isset($_POST['merchant'])) {
                                
                                $this->session->set_userdata(array(
                                                'merchant_id' => $_POST['merchant']
                                                ));
                                redirect('/payment/details');

                            } else {
                                
                                if(!isset($this->session->userdata['merchant_id'])) {
                                    redirect('');
                                }

                            }
                            
                            if(isset($_POST['editpayment'])) {
                                

                                /* PROCESS CHECK */

                                // Check Batch handling
                                if($_POST['batchassignment']=='newbatch') {

                                    // create new batch if selected
                                    $batchid = $this->Batch_model->create_batch($this->session->userdata['merchant_id']);

                                } else if ($_POST['batchassignment']=='unassigned') {

                                    $batchid = null;

                                } else {

                                    //Use batch specified in form
                                    $batchid = $_POST['batchassignment'];

                                }


                                if($this->TX_model->insert_transaction($_POST,$batchid)) { // Insert trnasaction into existing batch


                                   $this->Customer_model->save_customer_data($_POST); 
                                   redirect('payment/complete');

                                } else {

                                   redirect('payment/error');

                                } 



                                }
            
            
        }

	function details()
    {

                if(!isset($_POST['processCheck'])) {
                            

                            /* LOAD LIBRARIES FOR CONTROLLER */

                            $this->load->library('formdate');
                                $formdate = new FormDate();
                                $formdate->setLocale('');
                                $formdate->year['start']=date('Y',time()); // set to current year
                                $formdate->year['end']=date('Y',time()); // limit to current year
                                $formdate->month['values']='numbers';


                            /* PROCESS GLOBAL VARIABLES */
							/* if(isset($this->session->userdata['merchant_id'])){
								$merchant_id = $this->session->userdata['merchant_id'];
							}else{
								$merchant_id ='';
							} */
							
							
							if(isset($_POST['merchant'])) {
                                
								$merchant_id = $_POST['merchant'];
                                $this->session->set_userdata(array(
                                                'merchant_id' => $_POST['merchant']
                                                ));
                          
                            } else{
								$merchant_id ='';
							}
                            $data['processing_merchant']=$this->Merchant_model->getMerchantById($merchant_id); 
                            
							
                            $data['unsubmitted_batches']=$this->Batch_model->get_unsubmitted_batches($merchant_id);
                            
							$this->load->model('payee_model');
							$data['payees']=$this->payee_model->getPayees_dropdown(); 
                           
							
                            $data['formdate']=$formdate;
                            
                            $data['page_title']='Payment Details';

						
                        /* LOAD VIEWS */
						
						if(isadmin() && CURRENT_THEME!=''){
						
							//$header = '_global/'.CURRENT_THEME.'/view_header'; 
							$content = 'payment/'.CURRENT_THEME.'/view_details'; 
							
							//$this->load->view($header, $data);
							$this->load->view($content, $data);
                            	
						}else{
							
							$this->load->view('_global/view_header', $data);

                            $this->load->view('_global/view_menu', $data);
                            
                            
                            $this->load->view('payment/view_menu', $data);


                            $this->load->view('payment/view_details', $data);

                            $this->load->view('_global/view_footer', $data);
						
						}	
                    
					
                } else {
                      
                            
                            /* PROCESS CHECK */
                            
                            // Check Batch handling
                            if($_POST['batchassignment']=='newbatch') {
                                
                                // create new batch if selected
                                $batchid = $this->Batch_model->create_batch($this->session->userdata['merchant_id']);
                                
                            } else if ($_POST['batchassignment']=='unassigned') {
                                
                                $batchid = null;
                                
                            } else {
                                
                                //Use batch specified in form
                                $batchid = $_POST['batchassignment'];
                                
                            }
                               
                            
                            if($this->TX_model->insert_transaction($_POST,$batchid,1)) { // Insert trnasaction into existing batch
                                
                                
                               $this->Customer_model->save_customer_data($_POST); 
                               redirect('payment/complete');
 
                            } else {

                               redirect('payment/error');

                            } 
                                                        
                    
                }
                

	}
          function current() 
	{
		//ver lib
		
		/*
		 * 0 - display name
		 * 1 - width
		 * 2 - sortable
		 * 3 - align
		 * 4 - searchable (2 -> yes and default, 1 -> yes, 0 -> no.)
		 */
		$colModel['id'] = array('ID',15,TRUE,'center',2);
		$colModel['batch'] = array('Batch ID',40, FALSE, 'left',2);
        $colModel['debitcredit'] = array('Type',40,TRUE,'left',0);
        $colModel['name'] = array('Merchant',100,TRUE,'left',0);
		$colModel['check_no'] = array('Check No',100,TRUE,'left',0);
		$colModel['check_amount'] = array('Check Amount',100,TRUE,'left',1);
		$colModel['check_date'] = array('Check Date',90,TRUE,'left',0);
		$colModel['datesubmitted'] = array('Submit Date',90,TRUE,'left',0);
		$colModel['issued_by_name'] = array('Issued By',130, TRUE,'left',1);
		$colModel['payee_name'] = array('Payee Name',130, TRUE, 'left',1);
		$colModel['status'] = array('Status',60, FALSE, 'center',0);
		
		
		/*
		 * Aditional Parameters
		 */
		$gridParams = array(
		'width' => 'auto',
		'height' => 'auto',
		'rp' => 15,
		'rpOptions' => '[10,15,20,25,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} Transactions.',
		'blockOpacity' => 0.5,
		'title' => 'Transactions',
		'showTableToggleBtn' => false
		);
		
		/*
		 * 0 - display name
		 * 1 - bclass
		 * 2 - onpress	
		*/
		$buttons[] = array('Delete Transaction','delete','test');
		$buttons[] = array('separator');
		$buttons[] = array('Edit Transaction','','test');
		$buttons[] = array('separator');
		$buttons[] = array('View Batch','','test');
		
		//Build js
		//View helpers/flexigrid_helper.php for more information about the params on this function
		$grid_js = build_grid_js('flex1',site_url("/ajax/transactions"),$colModel,'id','asc',$gridParams,$buttons);
		
		$data['js_grid'] = $grid_js;
			
            /* LOAD VIEWS */
			
			$data['page_title'] = 'Current Payments';
			
            if(isadmin() && CURRENT_THEME!=''){
						
				$header = '_global/'.CURRENT_THEME.'/view_header'; 
				$content = 'transaction/'.CURRENT_THEME.'/view_list'; 
	
				$this->load->view($header, $data);
				$this->load->view($content, $data);
                            	
			}else{

				$this->load->view('_global/view_header', $data);

				$this->load->view('_global/view_menu', $data);
				
				$this->load->view('payment/view_menu', $data);

				$this->load->view('transaction/view_list',$data);
				
				$this->load->view('_global/view_footer', $data);
			
			}
       
        }      
		
        function complete() {
            
            $data['page_title']='Payment Complete';

            /* LOAD VIEWS */

            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
                            
                            
                            $this->load->view('payment/view_menu', $data);

            $this->load->view('payment/view_complete', $data);

            $this->load->view('_global/view_footer', $data);
            
        }
        
        function error() {
            
            $data['page_title']='Payment Failed';

            /* LOAD VIEWS */

            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
                            
                            
                            $this->load->view('payment/view_menu', $data);

            $this->load->view('payment/view_error', $data);

            $this->load->view('_global/view_footer', $data);
            
        }
        

}
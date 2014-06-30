<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

	function __construct()
	{
		parent::__construct();

                //Check if Authed to view access this controller
                if (!isset($this->session->userdata['logged_in'])) {
                    redirect('auth/login');
                }
	}
        
        function index() 
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
		$colModel['batch'] = array('Batch ID',60, FALSE, 'left',2);
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
                'singleSelect' => true,
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
		$grid_js = build_grid_js('flex1',site_url("/ajax/transactions"),$colModel,'check_date','desc',$gridParams,$buttons);
		
		$data['js_grid'] = $grid_js;
		

            /* LOAD VIEWS */
                
            $data['page_title'] = 'Transactions';

            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
            
            $this->load->view('transaction/view_menu', $data);

            $this->load->view('transaction/view_list',$data);
            
            $this->load->view('_global/view_footer', $data);
       
        }
        
        
        function batch() 
	{
		//ver lib
            
            
                if($_GET['view']) {

                    if($this->Batch_model->has_permission_toview($_GET['view'])) {
                            /*
                             * 0 - display name
                             * 1 - width
                             * 2 - sortable
                             * 3 - align
                             * 4 - searchable (2 -> yes and default, 1 -> yes, 0 -> no.)
                             */
                            $colModel['id'] = array('ID',15,TRUE,'center',2);
                            $colModel['batch'] = array('Batch ID',60, FALSE, 'left',2);
                            $colModel['name'] = array('Merchant',100,TRUE,'left',0);
                            $colModel['check_no'] = array('Check No',100,TRUE,'left',0);
                            $colModel['check_amount'] = array('Check Amount',100,TRUE,'right',1);
                            $colModel['check_date'] = array('Check Date',90,TRUE,'left',0);
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
                            'singleSelect' => true,
                            'title' => 'Transactions',
                            'showTableToggleBtn' => false
                            );

                            /*
                             * 0 - display name
                             * 1 - bclass
                             * 2 - onpress */
                            $buttons[] = array('Delete Transaction','delete','test');
                            $buttons[] = array('separator');
                            $buttons[] = array('Select All','add','test');
                            $buttons[] = array('DeSelect All','delete','test');

                            //Build js
                            //View helpers/flexigrid_helper.php for more information about the params on this function
                            $grid_js = build_grid_js('flex1',site_url("/ajax/batchtx?batch=".$_GET['view']),$colModel,'check_date','desc',$gridParams,null);

                            $data['js_grid'] = $grid_js;


                        /* LOAD VIEWS */

                        $data['page_title'] = 'Transactions';

                        $this->load->view('_global/view_header', $data);

                        $this->load->view('_global/view_menu', $data);
                        
                        $this->load->view('transaction/view_menu', $data);

                        $this->load->view('transaction/view_list',$data);

                        $this->load->view('_global/view_footer', $data);
                    } else {
                        
                        /* LOAD VIEWS */

                        $data['page_title'] = 'Transactions';

                        $this->load->view('_global/view_header', $data);

                        $this->load->view('_global/view_menu', $data);

                        $this->load->view('_global/view_noperm',$data);

                        $this->load->view('_global/view_footer', $data);
                        
                    }
                    
                } else {

                        $data['page_title'] = 'Transactions';

                        $this->load->view('_global/view_header', $data);

                        $this->load->view('_global/view_menu', $data);

                        $this->load->view('_global/view_footer', $data);
                }
       
        }
        
	function unassigned()
        
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
		$colModel['batch'] = array('Batch ID',60, FALSE, 'left',2);
        $colModel['debitcredit'] = array('Type',40,TRUE,'left',0);
        $colModel['name'] = array('Merchant',100,TRUE,'left',0);
		$colModel['check_no'] = array('Check No',100,TRUE,'left',0);
		$colModel['check_amount'] = array('Check Amount',100,TRUE,'left',1);
		$colModel['check_date'] = array('Check Date',90,TRUE,'left',0);
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
                'singleSelect' => true,
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
		$buttons[] = array('Assign Transaction','','test');
		$buttons[] = array('separator');
		
		//Build js
		//View helpers/flexigrid_helper.php for more information about the params on this function
		$grid_js = build_grid_js('flex1',site_url("/ajax/transactions_unassigned"),$colModel,'check_date','desc',$gridParams,$buttons);
		
		$data['js_grid'] = $grid_js;
		

            /* LOAD VIEWS */
                
            $data['unsubmitted_batches']=$this->Batch_model->get_unsubmitted_batches();
            $result_array = $this->Merchant_model->getMerchants();
            $data['merchants']=$result_array;
            
            $data['page_title'] = 'Transactions';

            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
            
            $this->load->view('transaction/view_menu', $data);

            $this->load->view('transaction/view_unassignedlist',$data);
            
            $this->load->view('_global/view_footer', $data);
          

	}

	function details()
        
	{
          

	}

}
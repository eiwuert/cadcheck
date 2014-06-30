<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

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
	/* echo '<pre>';
	print_r($this->session->all_userdata());
	exit; */
	
		$data['page_title']='Home';	
		$data['name'] = $this->session->userdata['name'];
		
		if(!isadmin()){
		 
			$data['data'] = $this->latest_trasactions();
			 
			$this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
			
			$this->load->view('view_index', $data);
           
			$this->load->view('_global/view_footer', $data);
		 
		}else{
			$header = '_global/'.CURRENT_THEME.'/view_header'; 
			$content = 'admin/'.CURRENT_THEME.'/view_index'; 
			
			$this->load->view($header, $data);
			$this->load->view($content, $data);
		
		}
		 
			
				
            

          

	}
	
	function latest_trasactions(){
		
		$string = ''; //?status=2&limit=100
	
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
		$grid_js = build_grid_js('flex1',site_url("/ajax/transactions".$string),$colModel,'check_date','desc',$gridParams,$buttons);
		
		$data['js_grid'] = $grid_js;
		
		return $data;
           // $this->load->view('transaction/view_list',$data);
            
         
	}
	

}
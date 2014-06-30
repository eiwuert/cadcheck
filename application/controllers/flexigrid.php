<?php
class Flexigrid extends CI_Controller {

	function __construct()
	{
		parent::__construct();
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
		$colModel['id'] = array('ID',15,TRUE,'left',2);
		$colModel['check_no'] = array('Check No',100,TRUE,'center',0);
		$colModel['check_amount'] = array('Check Amount',180,TRUE,'left',1);
		$colModel['check_date'] = array('Check Date',120,TRUE,'left',0);
		$colModel['issued_by_name'] = array('Issued By',130, TRUE,'left',1);
		$colModel['payee_name'] = array('Payee Name',130, TRUE, 'right',1);
		$colModel['status'] = array('Status',80, FALSE, 'center',0);
		
		
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
		'title' => sitetitle().' Transactions',
		'showTableToggleBtn' => false
		);
		
		/*
		 * 0 - display name
		 * 1 - bclass
		 * 2 - onpress
		$buttons[] = array('Delete','delete','test');
		$buttons[] = array('separator');
		$buttons[] = array('Select All','add','test');
		$buttons[] = array('DeSelect All','delete','test');
                 * 
                 */
		
		//Build js
		//View helpers/flexigrid_helper.php for more information about the params on this function
		$grid_js = build_grid_js('flex1',site_url("/ajax/transactions"),$colModel,'id','asc',$gridParams,null);
		
		$data['js_grid'] = $grid_js;
		

            /* LOAD VIEWS */
                
            $data['page_title'] = 'Flexigrid';

            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);

            $this->load->view('flexigrid',$data);
            
            $this->load->view('_global/view_footer', $data);
            
	}
	

}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

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
            
            redirect('report/merchant');
            
            
        }
        
        function merchant() 
	{
            
            
                $data['merchants'] = $this->Merchant_model->getMerchants();
		//ver lib
		
		/*
		 * 0 - display name
		 * 1 - width
		 * 2 - sortable
		 * 3 - align
		 * 4 - searchable (2 -> yes and default, 1 -> yes, 0 -> no.)
		 */
		$colModel['merchantid'] = array('ID',15,TRUE,'center',2);
		$colModel['name'] = array('Name',140, FALSE, 'left',2);
                $colModel['amount_pending'] = array('Amount Pending',140,TRUE,'right',0);
                $colModel['amount_submitted'] = array('Amount Submitted',140,TRUE,'right',0);
                $colModel['amount_settled'] = array('Amount Settled',140,TRUE,'right',0);
                $colModel['amount_total'] = array('Amount Total',140,TRUE,'right',0);
		
		
		/*
		 * Aditional Parameters
		 */
		$gridParams = array(
		'width' => 'auto',
		'height' => 'auto',
                'usepager' => false,
		'blockOpacity' => 0.5,
		'title' => 'Merchant Totals',
		'showTableToggleBtn' => false
		);

		//Build js
		//View helpers/flexigrid_helper.php for more information about the params on this function
		$grid_js = build_grid_js('flex1',site_url("/ajax/merchant_totals"),$colModel,'id','asc',$gridParams,null);
		
		$data['js_grid'] = $grid_js;
		

            /* LOAD VIEWS */
                
            $data['page_title'] = 'Merchants';

            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);

            $this->load->view('report/view_menu', $data);

            $this->load->view('report/view_merchanttotals',$data);
            
            $this->load->view('_global/view_footer', $data);
       
        }
        
        function downloads() {	
          
            
                ////ver lib
		
		/*
		 * 0 - display name
		 * 1 - width
		 * 2 - sortable
		 * 3 - align
		 * 4 - searchable (2 -> yes and default, 1 -> yes, 0 -> no.)
		 */
		$colModel['id'] = array('ID',15,TRUE,'center',2);
		$colModel['filename'] = array('File',180, TRUE, 'left',1);
                $colModel['filetype'] = array('File Type',70,TRUE,'left',1);
                $colModel['location'] = array('Location',70,TRUE,'left',1);
                $colModel['viewed'] = array('Status',80,TRUE,'left',1);
		$colModel['datecreated'] = array('Generated',100,TRUE,'left',1);
		
		
		/*
		 * Aditional Parameters
		 */
		$gridParams = array(
		'width' => 'auto',
		'height' => 'auto',
		'rp' => 15,
		'rpOptions' => '[10,15,20,25,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} Downloads.',
		'blockOpacity' => 0.5,
		'title' => 'Report Downloads',
                'singleSelect' => true,
		'showTableToggleBtn' => false
		);
		
		/*
		 * 0 - display name
		 * 1 - bclass
		 * 2 - onpress	
		*/
		$buttons[] = array('Download Report','','test');
		$buttons[] = array('separator');
		
		//Build js
		//View helpers/flexigrid_helper.php for more information about the params on this function
		$grid_js = build_grid_js('flex1',site_url("/ajax/get_user_reports"),$colModel,'datecreated','desc',$gridParams,$buttons);
		
		$data['js_grid'] = $grid_js;
            
            /* LOAD VIEWS */
                
            $data['page_title'] = 'Downloads';

            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);

            $this->load->view('report/view_menu', $data);

            $this->load->view('report/view_index',$data);
            
            $this->load->view('_global/view_footer', $data);
            
        }
        
        function papercheck() {
            
            /* LOAD VIEWS */
                
            $data['page_title'] = 'Paper Check Notice';

            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);

            $this->load->view('report/view_menu', $data);

            $this->load->view('report/view_index',$data);
            
            $this->load->view('_global/view_footer', $data);
            
        }
        

}
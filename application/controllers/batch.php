<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Batch extends CI_Controller {

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
		$colModel['select'] = array('',28,FALSE,'center',0);
		$colModel['id'] = array('Batch ID',40,TRUE,'left',2);
		$colModel['title'] = array('Batch Name',100,TRUE,'left',0);
		$colModel['datecreated'] = array('Date Created',100,TRUE,'left',1);
		$colModel['datesubmitted'] = array('Date Submitted',90,TRUE,'left',0);
		$colModel['transactions'] = array('No. of TX',50, TRUE, 'center',1);
		$colModel['amount'] = array('Batch Total',60, TRUE, 'right',0);
		$colModel['status'] = array('Status',130, TRUE,'left',1);
		
		/*
		 * Aditional Parameters
		 */
		$gridParams = array(
		'width' => 'auto',
		'height' => 'auto',
		'rp' => 15,
		'rpOptions' => '[10,15,20,25,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} Batches.',
		'blockOpacity' => 0.5,
		'title' => 'Batches',
                'singleSelect' => true,
		'showTableToggleBtn' => false,
                    'draggableColumns' => false
		);
		
		/*
		 * 0 - display name
		 * 1 - bclass
		 * 2 - onpress
                 * 
                 */
		$buttons[] = array('Submit Batch','','test');
		$buttons[] = array('separator');
		$buttons[] = array('View Transactions','','test');
		$buttons[] = array('separator');/*
		$buttons[] = array('Add Transaction','','test');
		$buttons[] = array('separator');*/
		$buttons[] = array('Delete Batch','delete','test');
		$buttons[] = array('separator');
                
		//Build js
		//View helpers/flexigrid_helper.php for more information about the params on this function
		$grid_js = build_grid_js('flex1',site_url("/ajax/batches"),$colModel,'datecreated','desc',$gridParams,$buttons);
		
		$data['js_grid'] = $grid_js;
		

            /* LOAD VIEWS */
                
            $data['page_title'] = 'Batches';
			
			if(isadmin() && CURRENT_THEME!=''){
						
					$header = '_global/'.CURRENT_THEME.'/view_header'; 
					$content = 'batch/'.CURRENT_THEME.'/view_list'; 
		
					$this->load->view($header, $data);
					$this->load->view($content, $data);
                            	
			}else{

				$this->load->view('_global/view_header', $data);

				$this->load->view('_global/view_menu', $data);

				$this->load->view('batch/view_list',$data);
				
				$this->load->view('_global/view_footer', $data);
			
			}
       
        }
        
        function submit()
        {
            
            
            /* LOAD VIEWS */
                
            $data['page_title'] = 'Submit Batch';

            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);

            $this->load->view('batch/view_submit',$data);
            
            $this->load->view('_global/view_footer', $data);
            
        }

	function details()
        
	{
          

	}

}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();

                //Check if Authed to view access this controller
                if (!isset($this->session->userdata['logged_in'])) {
                    redirect('auth/login');
                } else if ($this->session->userdata['permission']!='admin') {
                    $this->denied();
                    die();
                }
	}

	function index()
	{
            
            $data['page_title']='Administration Home';

            /* LOAD VIEWS */

            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
            
            $this->load->view('admin/view_menu', $data);

            $this->load->view('admin/view_index', $data);

            $this->load->view('_global/view_footer', $data);
            
	}
        
        function users() {		
          
            
                ////ver lib
		
		/*
		 * 0 - display name
		 * 1 - width
		 * 2 - sortable
		 * 3 - align
		 * 4 - searchable (2 -> yes and default, 1 -> yes, 0 -> no.)
		 */
		$colModel['id'] = array('ID',15,TRUE,'center',2);
		$colModel['name'] = array('Name',140, TRUE, 'left',1);
        $colModel['username'] = array('Username',100,TRUE,'left',1);
        $colModel['email'] = array('Email',180,TRUE,'left',1);
		$colModel['role'] = array('User Role',80,TRUE,'left',1);
		$colModel['last_login'] = array('Last Login',100,TRUE,'left',1);
		$colModel['login_ip'] = array('Last Login IP',100,TRUE,'left',1);
		
		
		/*
		 * Aditional Parameters
		 */
		$gridParams = array(
		'width' => 'auto',
		'height' => 'auto',
		'rp' => 15,
		'rpOptions' => '[10,15,20,25,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} Users.',
		'blockOpacity' => 0.5,
		'title' => 'System Users',
                'singleSelect' => true,
		'showTableToggleBtn' => false
		);
		
		/*
		 * 0 - display name
		 * 1 - bclass
		 * 2 - onpress	
		*/
		$buttons[] = array('Delete User','delete','test');
		$buttons[] = array('separator');
		$buttons[] = array('Edit User','','editUser');  
		$buttons[] = array('separator');
		$buttons[] = array('Create New User','','openCreateUser'); 
		
		//Build js
		//View helpers/flexigrid_helper.php for more information about the params on this function
		$grid_js = build_grid_js('flex1',site_url("/ajax/get_users"),$colModel,'check_date','desc',$gridParams,$buttons);
		
		$data['js_grid'] = $grid_js;
            
            $data['page_title']='System Users';

            /* LOAD VIEWS */
            
            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
            
            $this->load->view('admin/view_menu', $data);

            $this->load->view('admin/view_userlist', $data);

            $this->load->view('_global/view_footer', $data);
            
        }
        
        function user_permissions() {
            
            $data['page_title']='User Permissions';

            /* LOAD VIEWS */
           
            
            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
            
            $this->load->view('admin/view_menu', $data);

            $this->load->view('admin/view_index', $data);

            $this->load->view('_global/view_footer', $data);
            
        }
        
        function groups() {
            
             $data['page_title']='Merchants & Groups';
			
			$colModel['id'] = array('ID',30,TRUE,'center',2);
			$colModel['groupname'] = array('Group Name',200, TRUE, 'left',1);
	 
     
			$gridParams = array(
			'width' => 'auto',
			'height' => 'auto',
			'rp' => 15,
			'rpOptions' => '[10,15,20,25,40]',
			'pagestat' => 'Displaying: {from} to {to} of {total} Groups.',
			'blockOpacity' => 0.5,
			'title' => 'Groups',
					'singleSelect' => true,
			'showTableToggleBtn' => false
			);
		
		
			$buttons[] = array('Delete Group','delete','test');
			$buttons[] = array('separator');
			$buttons[] = array('Edit Group','edit_group','editGroup');
			$buttons[] = array('separator');
			$buttons[] = array('Create New Group','newGroup','openCreateGroup'); 
		
			//Build js
			//View helpers/flexigrid_helper.php for more information about the params on this function
			 $grid_js = build_grid_js('flex1',site_url("/ajax/getGroups"),$colModel,'check_date','desc',$gridParams,$buttons);
			
			$data['js_grid'] = $grid_js; 
			
        
            /* LOAD VIEWS */
               
            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
            
            $this->load->view('admin/view_menu', $data);
			
			//$this->load->view('admin/view_index', $data);
			$this->load->view('admin/view_grouplist', $data);
	
            $this->load->view('_global/view_footer', $data);
			
        }

        
        function fees() {
            
            $data['page_title']='Fees Manager';

            /* LOAD VIEWS */
            
            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
            
            $this->load->view('admin/view_menu', $data);

            $this->load->view('admin/view_index', $data);

            $this->load->view('_global/view_footer', $data);
            
        }
		
		function payees(){
		
		/*
		 * 0 - display name
		 * 1 - width
		 * 2 - sortable
		 * 3 - align
		 * 4 - searchable (2 -> yes and default, 1 -> yes, 0 -> no.)
		 */
		$colModel['id'] = array('ID',15,TRUE,'center',2);
		$colModel['name'] = array('Name',100, TRUE, 'left',1);
		$colModel['email'] = array('Email',140,TRUE,'left',1);
        $colModel['phone'] = array('Phone',70,TRUE,'left',1);
        $colModel['address1'] = array('Address1',160,TRUE,'left',1);
		$colModel['address2'] = array('Address2',160,TRUE,'left',1);
		$colModel['state_name'] = array('State',70,TRUE,'left',1);
		$colModel['state_code'] = array('State Abbreviation',70,TRUE,'left',1);
		$colModel['post_code'] = array('Post Code',50,TRUE,'left',1);
		//$colModel['trans_note'] = array('Transaction Note',120,TRUE,'left',1);
	
		
		$gridParams = array(
		'width' => 'auto',
		'height' => 'auto',
		'rp' => 15,
		'rpOptions' => '[10,15,20,25,40]',
		'pagestat' => 'Displaying: {from} to {to} of {total} Payees.',
		'blockOpacity' => 0.5,
		'title' => 'Payees',
                'singleSelect' => true,
		'showTableToggleBtn' => false
		);
		
		
		$buttons[] = array('Delete Payee','delete','test');
		$buttons[] = array('separator');
		$buttons[] = array('Edit Payee','edit_payee','editPayee');
		$buttons[] = array('separator');
		$buttons[] = array('Create New Payee','newPayee','openAddPayee');
		
		//Build js
		//View helpers/flexigrid_helper.php for more information about the params on this function
		$grid_js = build_grid_js('flex1',site_url("/ajax/getpayees"),$colModel,'check_date','desc',$gridParams,$buttons);
		
		$data['js_grid'] = $grid_js;
            
            $data['page_title']='Payees';

            /* LOAD VIEWS */
            
            $this->load->view('_global/view_header', $data);

            $this->load->view('_global/view_menu', $data);
            
            $this->load->view('admin/view_menu', $data);

            $this->load->view('admin/view_payeelist', $data);

            $this->load->view('_global/view_footer', $data);
			
		}
		
        function denied() 
        {
            
            echo "You are not allowed";
            
        }
		
		
		
		
}

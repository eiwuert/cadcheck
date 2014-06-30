<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->login();
	}

        function login()
        {


            if ($this->session->userdata('logged_in')==TRUE) { 
                
                    redirect('');
                    
            }

            $this->form_validation->set_rules('username','Username','required|trim|max_length[26]|xss_clean');
            $this->form_validation->set_rules('password','Password','required|trim|max_length[26]|xss_clean');

            if ($this->form_validation->run() == FALSE)
            {
                $data['page_title']='Login';
                
                $this->load->view('_global/view_minimal_header', $data);

                $this->load->view('auth/view_login', $data);

                $this->load->view('_global/view_minimal_footer', $data);

            } else 
            {

                // PROCESS LOGIN DETAILS

                extract($_POST);

                $user = $this->Auth_model->check_login($username,$password);
                
                if (!$user)
                {

                    //Login Fail Error

                    $this->session->set_flashdata('login_error', TRUE);

                    redirect('auth/login');
                    
                }
                else
                {

                    //Log them in

                    $this->session->set_userdata(array(
                                    'logged_in' => TRUE,
                                    'username' => $user['username'],
                                    'userid'    => $user['id'],
                                    'name'    => $user['firstname']." ".$user['lastname']
                                    ));
                    
                    // Timestamp login
                    
                    $this->Auth_model->set_timestampip_login($user['id'],$this->input->ip_address());
                    
                    // Assign Permission Role
                    $this->session->set_userdata(array(
                                    'permission' => $this->Auth_model->get_permission($user['id']),
                                    'group' => $this->Auth_model->get_group($user['id'])
                                    ));

                    redirect('');

                }

            }

        }


        function register() {

            echo "Registration Form Here";
            
        }
        
        function logout() {

            $this->session->set_userdata('logged_in', FALSE);
            $this->session->sess_destroy();

            redirect('auth/login');

        }

}

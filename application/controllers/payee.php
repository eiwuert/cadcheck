<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payee extends CI_Controller {

	function __construct()
	{
		parent::__construct();

                //Check if Authed to view access this controller
                if (!isset($this->session->userdata['logged_in'])) {
                    redirect('auth/login');
                } 
	}

	function addnew(){
	
		print_r($this->input->post());
	}
	

	
}?>
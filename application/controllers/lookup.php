<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lookup extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
        
        function index() 
	{
            

            
            /* LOAD VIEWS */
                
            $data['page_title'] = 'Welcome to cdnchqsrv.com';

            $this->load->view('_global/view_lookup_header', $data);

            $this->load->view('lookup/view_index',$data);
            
            $this->load->view('_global/view_lookup_footer', $data);
       
        }
        
        function info() 
	{
            

            
            /* LOAD VIEWS */
                
            $data['page_title'] = 'Electronic Deposit Information';

            $this->load->view('_global/view_lookup_header', $data);

            $this->load->view('lookup/view_info',$data);
            
            $this->load->view('_global/view_lookup_footer', $data);
       
        }
        
        
        
        function search() 
	{
            
            extract($_POST);
            
            if(isset($_POST['search'])) {
                
                $result = $this->TX_model->lookup_search($name,$postcode,$account_number);
                
                if(is_array($result)) {
                    
                    $data['tx'] = $result;
                    
                } else {
                    
                    $data['tx'] = 'false';
                    
                }
                
            }
            
            /* LOAD VIEWS */
                
            $data['page_title'] = 'Transaction Lookup';

            $this->load->view('_global/view_lookup_header', $data);

            $this->load->view('lookup/view_search',$data);
            
            $this->load->view('_global/view_lookup_footer', $data);
       
        }
        
        function enquire() 
	{
            

            if(isset($_POST['txid'])) {
                
                                    
                    $this->email->from($_POST['email'], $_POST['name']);
                    $this->email->to($this->config->item('site_support_email_secondary'));              
                    
                    if($this->config->item('site_support_email_secondary')) {
                        
                        $this->email->cc($this->config->item('site_support_email_secondary'));

                    }

                    $this->email->subject('CDNCHQSRV: Enquiry TXID#'.$_POST['txid']);
                    $this->email->message($_POST['enquiry']);

                    $this->email->send();
                    
                    $data['emailsent']=true;
                    
                
            } else {
                
                                    
                    $this->email->from($_POST['email'], $_POST['name']);
                    $this->email->to($this->config->item('site_support_email_primary'));              
                    
                    if($this->config->item('site_support_email_secondary')) {
                        
                        $this->email->cc($this->config->item('site_support_email_secondary'));

                    }

                    $this->email->subject('CDNCHQSRV: Enquiry');
                    $this->email->message($_POST['enquiry']);

                    $this->email->send();
                    
                    $data['emailsent']=true;
                
                
            }
            
            /* LOAD VIEWS */
                
            $data['page_title'] = 'Transaction Enquiry';

            $this->load->view('_global/view_lookup_header', $data);

            $this->load->view('lookup/view_enquire',$data);
            
            $this->load->view('_global/view_lookup_footer', $data);
       
        }

}
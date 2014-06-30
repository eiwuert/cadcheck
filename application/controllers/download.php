<?php ob_start();  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends CI_Controller {

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
            extract($_GET);
            
            if($this->File_model->has_file_permission($fileid)) {
            
                $file = $this->File_model->get_file_contents($fileid);
			
			//echo $file['data'];  
               
                 force_download($file['name'],$file['data']);
				 ob_end_clean();
                redirect('report');
            } else {
                
                $this->denied();
                die();
                
            }
            
        }
        
        function batchtemplate() 
        {
            extract($_GET);
            
            $file['name']='cheque_batch_template.csv';
            $file['data']='tx_no,amount,date,issued_by_bank,issued_by_name,issued_by_address,issued_by_address2,issued_by_postcode,issued_by_state,issued_by_phone,issued_by_email,payee_name,payee_address,payee_address2,payee_postcode,payee_state,payee_phone,payee_email,note
XXXXXX-XXXXX-XXX-XXXXXX,123.45,YYYY-MM-DD,Generic Bank Pty Ltd,Joe Bloggs,123 Smith Street,Suburb,MGH 432,ON,53252542532,jbloggs@domain.com,Jason Bloggs,987 Anderson Street,Suburb,MGH 553,ON,43534543534534,jason.bloggs@domain2.com,My Note';
             //echo $file['data'];
             ob_clean();
             force_download($file['name'],$file['data']);
            
        }
        
        function test() {
            
            // Assign it a title        
            $updatedata = array (
                'filecontent' => file_get_contents('../testtextfile.rtf')
            );

            $this->db->where('fileid','2');
            $this->db->update('reports_content',$updatedata);

        }
        function denied() 
        {
            
            echo "You are not allowed";
            
        }

}
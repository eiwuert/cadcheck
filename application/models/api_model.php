<?php

class API_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
        



        
        function send_batch_api_eft($batchid) {
            
            /* set login vars */
            $url = $this->config->item('mtm_url');
            $username = $this->config->item('mtm_orgid');
            $password = $this->config->item('mtm_password');
            $txerror = 'Errors
                        -----------------------
                        ';
            
            $tx = $this->TX_model->get_transactions_by_batch($batchid);
            
            foreach ($tx as $transaction) {
                
                $fields = null;
                $bank_details = null;
                $names = null;
                
                
                $bank_details = explode('-',$transaction['check_no']);
                
                
                /* 
                 * 0 - Check Number
                 * 1 - Branch Transit Number
                 * 2 - Financial Institution Number
                 * 3 - Financial Account Number 
                 */
                
                $names = explode(' ',$transaction['issued_by_name']);
                
                if(!isset($names[1])) {
                    
                    $names[1]='N/A';
                    
                }
                
                $fields = array (
                    'method' => 'EFT',
                    'dc' => 'db',
                    'org_id' => $username,
                    'currency' => 'CAD',
                    'password' => $password,
                    'payeerouting' => '0'.$bank_details[2].$bank_details[1], // Requires leading ZERO for EFT
                    'payeeaccount' => $bank_details[3],
                    'industrycode' => '1000',
                    'payeeaccounttype' => 'PC',
                    'payeeamount' => $transaction['check_amount'],
                    'payeeemail' => 'na@na.com',
                    'payeefirstname' => $names[0],
                    'payeelastname' => $names[1],
                    'payeeadd1' => $transaction['issued_by_address'],
                    'payeeadd2' => $transaction['issued_by_address2'],
                    'payeecity' => $transaction['issued_by_address2'],
                    'payeestate' => $transaction['issued_by_state'],
                    'payeephone' => $transaction['issued_by_phone'],
                    'payeecountry' => 'CA',
                    'payeezip' => $transaction['issued_by_postcode'],
                    'payeeref' => $transaction['id'],
                    'payeedescr' => $transaction['note'],
                    'ipaddress' => '127.0.0.1'
                );
                    
                
                $result = $this->curl->simple_post($url,$fields);
                
                $response = json_decode($result);
                
                if($response->status=='OK') {
                    
                    //Update TX's & Batch
                    $this->TX_model->update_tx_status($transaction['id'],1);
                    $this->TX_model->update_tx_externalref($transaction['id'],$response->batchitem_id_api);
                    
                } else {
                    
                    $error=true;
                    
                    $this->TX_model->update_tx_status($transaction['id'],3);
                    
                    $txerror .= 'TXID: '.$transaction['id'].' Failed
                                ';
                    $txerror .= 'Message: '.$response->msg.'
                        
                                ';
                    
                }
                
                
            }
            
                //After processing - email off any errors encountered
                if(isset($error)) {
                    
                    
                    $this->email->from($this->config->item('site_support_email_primary'), $this->config->item('title','site'));
                    $this->email->to($this->config->item('site_support_email_primary'));
                    
                    if($this->config->item('site_support_email_secondary')) {
                        
                        $this->email->cc($this->config->item('site_support_email_secondary'));

                    }
                    
                    $this->email->subject('Failed Batch ID#: '.$batchid);
                    $this->email->message($txerror);

                    $this->email->send();
                    
                }
            
            
        }

}

?>

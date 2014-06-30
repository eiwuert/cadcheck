<?php

class Report_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}


    
    function get_unviewed_downloads() {
        
        $this->db->select('count(id) as unviewed');
        $this->db->from('reports');
        $this->db->where('viewed',0);
        $this->db->where('userid',$this->session->userdata['userid']);
        
        $result = $this->db->get();
        
        return $result->row(0)->unviewed;
        
    }
    
    function get_user_reports() { 
        
        $this->db->select('reports.*');
        $this->db->from('reports');
        $this->db->where('userid',$this->session->userdata['userid']);
        
        $this->flexigrid->build_query();
        
        $return['records'] = $this->db->get();
        

        
		//Build count query
		$this->db->select('count(reports.id) as record_count');
                $this->db->from('reports');
                $this->db->where('userid',$this->session->userdata['userid']);
                
                
		$this->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
                        
                
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
        
    }

}

?>

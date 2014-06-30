<?php

class File_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

    
    function has_file_permission($fileid) {
        
        $this->db->select('reports.*');
        $this->db->from('reports');
        $this->db->where('userid',$this->session->userdata['userid']);
        $this->db->where('id',$fileid);
        
        $result = $this->db->get();
        
        if ($result->num_rows() == 1) {
            
            return true;

        } else {

            return false;

        }

        
        
    }
    
    function get_file_contents($fileid) {
        
  
        
        $this->db->select('reports.filename as filename, reports.filetype as filetype, reports_content.filecontent as filecontent');
        $this->db->from('reports');
        $this->db->join('reports_content','reports_content.fileid = reports.id','LEFT');
        $this->db->where('reports.id',$fileid);
        
        
        $result = $this->db->get();
        
        $file['name']=$result->row(0)->filename.'.'.$result->row(0)->filetype;
        $file['data']=$result->row(0)->filecontent;
        
        // Mark TX as downloaded 
        
        // Assign it a title        
        $updatedata = array (
            'viewed' => 1
        );
        
        $this->db->where('id',$fileid);
        $this->db->update('reports',$updatedata);
        
        return $file;
        

    }
        

}

?>

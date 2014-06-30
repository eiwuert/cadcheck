<?php

class Auth_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

    function check_login($username,$password) {

        $md5_password = md5($password);

        $query_str = "SELECT id,username,firstname,lastname FROM users WHERE username = ? AND password = ?";

        $result = $this->db->query($query_str, array($username,$md5_password));


        if ($result->num_rows() == 1) {
            
            return $result->row_array();

        } else {

            return false;

        }

    }
    
    function set_timestampip_login($userid,$ip) {
        
        // Set timestamp   
        $updatedata = array (
            'lastlogin' => time(),
            'loginip' => $ip
        );
        
        $this->db->where('id',$userid);
        $this->db->update('users',$updatedata);
        
        
        
    }
    
    function get_permission($userid) {
        
        $query_str = "SELECT role FROM user_permissions WHERE userid = ?";
        
        $result = $this->db->query($query_str, array($userid));
        
        if ($result->num_rows() == 1) {
            
            return $result->row(0)->role;
            
        } else {
            
            return false;
            
        }
        
    }
    
    function get_group($userid) {
        
        $this->db->from('groups');
        $this->db->select('groups.id');
        $this->db->join('usergroups','groups.id = usergroups.groupid','LEFT');
        $this->db->where('usergroups.userid',$userid);
        
        $result = $this->db->get();
        
        
        if($result->num_rows() == 1) {
            
            return $result->row(0)->id;
            
            
        } else {
            
            return false;
            
        }
        
    }

}

?>
<?php

class User_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}


    
    function get_users() {
        
  
        
        $this->db->select('users.*, user_permissions.role as role');
        $this->db->from('users');
        $this->db->join('user_permissions','users.id = user_permissions.userid','LEFT');
        
        
        $this->flexigrid->build_query();
        
        $return['records'] = $this->db->get();
        

        
		//Build count query
		$this->db->select('count(users.id) as record_count');
        $this->db->from('users');
                
                
		$this->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
                        
                
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
        
	}
	
	
	function create_newUser($insertArr,$user_role){
	
		$match = array(
				'username'=>$insertArr['username'],
				'email'=>$insertArr['email']
		
		);
		$rows = $this->db->get_where('users',$match)->num_rows(); 
		
		if($rows<=0){ // insert new user
			$this->db->insert('users',$insertArr);
			$userid  = $this->db->insert_id();
			$permissions = array(
								'role'=>$user_role,
								'userid'=>$userid
							);
			$this->db->insert('user_permissions',$permissions);
			
			
			return '202';
		}else{
			return '101';
		}
		
	}

	function edit_user($insertArr,$user_id,$user_role){
	
		if($user_id!=""){
		
			$this->db->where('id',$user_id);
			$this->db->update('users',$insertArr);
			
			$this->db->where('userid',$user_id);
			$this->db->update('user_permissions',array('role'=>$user_role));
			
			
			return '202';
		}else{
			return '101';
		}
	
	}

	
    
    function delete_user($user_ids_post_array) {
      
		foreach($user_ids_post_array as $index => $user_id){
			if (is_numeric($user_id) && $user_id > 1){
			
				$this->db->delete('users', array('id'=>$user_id));
				  
			}
			
		}
       
        return true;        
        
    }    
    

}

?>

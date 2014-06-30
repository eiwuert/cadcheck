
<nav class="sub">
    <ul>

        <li><a href="<?=base_url();?>admin" <?if(menusubsegment()==null) echo 'class="active"'; ?>>Admin Home</a></li>
        
        <li><a href="<?=base_url();?>admin/users" <?if(menusubsegment()=='users') echo 'class="active"'; ?>>Users</a></li>
      
<!--	  
        <li><a href="<?=base_url();?>admin/user_permissions" <?if(menusubsegment()=='user_permissions') echo 'class="active"'; ?>>User Permissions</a></li>
-->
        <li><a href="<?=base_url();?>admin/groups" <?if(menusubsegment()=='groups') echo 'class="active"'; ?>>Groups</a></li>
		
        <li><a href="<?=base_url();?>admin/payees" <?if(menusubsegment()=='payees') echo 'class="active"'; ?>>Manage Payee</a></li>
        
		<li><a href="<?=base_url();?>admin/fees" <?if(menusubsegment()=='fees') echo 'class="active"'; ?>>Fee Manager</a></li>
        
    </ul>

</nav>

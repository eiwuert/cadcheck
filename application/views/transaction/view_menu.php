
<nav class="sub">
    
    <ul>

        <li><a href="<?=base_url();?>transaction" <?if(menusubsegment()==null) echo 'class="active"'; ?>>Transactions</a></li>
        
        <li><a href="<?=base_url();?>transaction/unassigned" <?if(menusubsegment()=='unassigned') echo 'class="active"'; ?>>Unassigned Transactions</a></li>
        
    </ul>

</nav>

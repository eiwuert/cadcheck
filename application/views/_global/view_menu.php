
<nav class="main">
    <ul>

        <li><a href="<?=base_url();?>" <?if(menusegment()==null) echo 'class="active"'; ?>>Home</a></li>

        <li><a href="<?=base_url();?>payment" <?if(menusegment()=='payment') echo 'class="active"'; ?>>Process a Payment</a></li>
		
        <?php if($this->session->userdata('permission') && $this->session->userdata('permission')=='admin'){?>
        <li><a href="<?=base_url();?>batch" <?if(menusegment()=='batch') echo 'class="active"'; ?>>Batches</a></li>
        <?php } ?>
		
        <li><a href="<?=base_url();?>transaction" <?if(menusegment()=='transaction') echo 'class="active"'; ?>>Transactions</a></li>
        
        <?php if($this->session->userdata['permission']=='admin') { ?>
        
        <li><a href="<?=base_url();?>admin" <?if(menusegment()=='admin') echo 'class="active"'; ?>>Administration</a></li>
        
        <? } ?>
        
        <li><a href="<?=base_url();?>report/merchant" <?if(menusegment()=='report') echo 'class="active"'; ?>>Merchant Reports
            <? if (report_downloads() >= 1) echo '<span class="notice">('.report_downloads().')</span>'; ?>
            </a></li>

        <li><a href="<?=base_url();?>auth/logout">Logout</a></li>
        
    </ul>
    
    

</nav>

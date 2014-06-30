
<nav class="sub">
    
    <ul>

        <li><a href="<?=base_url();?>payment" <?if(menusubsegment()!='current' && menusubsegment()!='batchupload' && menusubsegment()!='batch') echo 'class="active"'; ?>>Process an Individual Payment</a></li>
		
        <?php if($this->session->userdata('permission') && $this->session->userdata('permission')=='admin'){?>
        <li><a href="<?=base_url();?>payment/batch" <?if(menusubsegment()=='batch' || menusubsegment()=='batchupload') echo 'class="active"'; ?>>Process a Batch</a></li>
		 <?php } ?>
        
        <li><a href="<?=base_url();?>payment/current" <?if(menusubsegment()=='current') echo 'class="active"'; ?>>View Current Payments</a></li>
        
    </ul>

</nav>

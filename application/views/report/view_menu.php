
<nav class="sub">
    <ul>

        <li><a href="<?=base_url();?>report" <?if(menusubsegment()==null) echo 'class="active"'; ?>>Reports Home</a></li>

        <li><a href="<?=base_url();?>report/merchant" <?if(menusubsegment()=='merchant') echo 'class="active"'; ?>>Merchant Totals</a></li>
        
        <li><a href="<?=base_url();?>report/papercheck" <?if(menusubsegment()=='papercheck') echo 'class="active"'; ?>>Paper Check Notice</a></li>

        <li><a href="<?=base_url();?>report/downloads" <?if(menusubsegment()=='downloads') echo 'class="active"'; ?>>Report Downloads
            <? if (report_downloads() >= 1) echo '<span class="notice">('.report_downloads().' Unviewed)</span>'; ?>
            </a></li>
        
        
    </ul>

</nav>

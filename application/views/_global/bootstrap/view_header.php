<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
        
	<title><?=$page_title;?>  -  <?=sitetitle();?> | <?=sitesubtitle();?></title>
		
	<!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>/theme/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="<?php echo base_url();?>/theme/bootstrap/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>/theme/bootstrap/font-awesome/css/font-awesome.min.css">
	
		 <!-- JavaScript -->
		<script src="<?php echo base_url();?>/theme/bootstrap/js/jquery-1.10.2.js"></script>
		<script src="<?php echo base_url();?>/theme/bootstrap/js/bootstrap.js"></script>

       <script type="text/javascript" src="<?=asset_path()?>scripts/jquery-1.5.1.min.js"></script>
	  
        <script type="text/javascript" src="<?=asset_path()?>scripts/jquery-ui-1.8.14.custom.min.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/jquery.form.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/cufon-yui.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/myriad_400.font.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/cmxforms.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/jquery.validate.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/flexigrid.pack.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/date.js"></script>
        
        <script type="text/javascript">
                Cufon.replace('h1');
                Cufon.replace('h2');
                
                $.ajaxSetup({
                   jsonp: null,
                   jsonpCallback: null
                });
          
        </script>
            
        
</head>
<body>

    <div id="wrapper">
	
		  <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  
		  
		<div id="logo">
		
			<a class="navbar-brand" href="<?php echo base_url();?>">  DEMO Check
				<!-- <img src="<?=theme_path()?>images/logo.png"/> -->
			</a>
              
        </div>
          
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
		  
            <li <?php if(menusegment()==null) echo 'class="active"'; ?>><a href="<?=base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>	

			<li class="dropdown <?if(menusegment()=='payment') echo 'class="active"'; ?>" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tasks"></i> Process a Payment <b class="caret"></b></a>
              <ul class="dropdown-menu">
		   
				<li><a href="<?=base_url();?>payment" <?if(menusubsegment()!='current' && menusubsegment()!='batchupload' && menusubsegment()!='batch') echo 'class="active"'; ?>>Process an Individual Payment</a></li>
				
				<?php if($this->session->userdata('permission') && $this->session->userdata('permission')=='admin'){?>
				<li><a href="<?=base_url();?>payment/batch" <?if(menusubsegment()=='batch' || menusubsegment()=='batchupload') echo 'class="active"'; ?>>Process a Batch</a></li>
				 <?php } ?>
				
				<li><a href="<?=base_url();?>payment/current" <?if(menusubsegment()=='current') echo 'class="active"'; ?>>View Current Payments</a></li>

              </ul>
            </li>
        
			
		<?php if($this->session->userdata('permission') && $this->session->userdata('permission')=='admin'){?>
			
				<li <?if(menusegment()=='batch') echo 'class="active"'; ?>><a href="<?=base_url();?>batch" ><i class="fa fa-desktop"></i> Batches</a></li>
        <?php } ?>
		
		
		<li class="dropdown <?if(menusegment()=='transaction') echo 'class="active"'; ?>" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-table"></i> Transactions <b class="caret"></b></a>
            <ul class="dropdown-menu">
		   
				<li><a href="<?=base_url();?>transaction" <?if(menusubsegment()==null) echo 'class="active"'; ?>>Transactions</a></li>
        
				<li><a href="<?=base_url();?>transaction/unassigned" <?if(menusubsegment()=='unassigned') echo 'class="active"'; ?>>Unassigned Transactions</a></li>
				
            </ul>
			  
		</li>
	        
        <?php if($this->session->userdata['permission']=='admin') { ?>
        
      
		<li class="dropdown <?if(menusegment()=='admin') echo 'class="active"'; ?>" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-edit"></i> Administration <b class="caret"></b></a>
            <ul class="dropdown-menu">
		   
				<li><a href="<?=base_url();?>admin/users" <?if(menusubsegment()=='users') echo 'class="active"'; ?>>Users</a></li>

				<li><a href="<?=base_url();?>admin/groups" <?if(menusubsegment()=='groups') echo 'class="active"'; ?>>Groups</a></li>
		
				<li><a href="<?=base_url();?>admin/payees" <?if(menusubsegment()=='payees') echo 'class="active"'; ?>>Manage Payee</a></li>
        
				<li><a href="<?=base_url();?>admin/fees" <?if(menusubsegment()=='fees') echo 'class="active"'; ?>>Fee Manager</a></li>
				
            </ul>
			  
		</li>
        
        <? } ?>
        
		<li class="dropdown <?if(menusegment()=='report') echo 'class="active"'; ?>" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Merchant Reports 
			<? if (report_downloads() >= 1) echo '<span class="badge">'.report_downloads().'</span>'; ?> <b class="caret"></b></a>
			
            <ul class="dropdown-menu">
		   
			<li><a href="<?=base_url();?>report/merchant" <?if(menusubsegment()=='merchant') echo 'class="active"'; ?>>Merchant Totals</a></li>
        
			<li><a href="<?=base_url();?>report/papercheck" <?if(menusubsegment()=='papercheck') echo 'class="active"'; ?>>Paper Check Notice</a></li>

			<li><a href="<?=base_url();?>report/downloads" <?if(menusubsegment()=='downloads') echo 'class="active"'; ?>>Report Downloads
            <? if (report_downloads() >= 1) echo '<span class="badge">'.report_downloads().' Unviewed</span>'; ?>
            </a></li>
				
            </ul>
			  
		</li>
 
    </ul>

        <ul class="nav navbar-nav navbar-right navbar-user">
         
            <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Merchant Reports <? if (report_downloads() >= 1) echo '<span class="badge">'.report_downloads().'</span>'; ?> <b class="caret"></b></a>
              
			  <ul class="dropdown-menu">  		
			
			<li><a href="<?=base_url();?>report/merchant"> Merchant Totals </a></li>
        
			<li><a href="<?=base_url();?>report/papercheck"> Paper Check Notice </a></li>

			<li><a href="<?=base_url();?>report/downloads"> Report Downloads
            <? if (report_downloads() >= 1) echo '<span class="badge">'.report_downloads().' Unviewed </span>'; ?>
            </a></li>
			 </ul> 
			 
            </li>
			
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$this->session->userdata['name'];?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <!--<li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li> -->
                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                <li class="divider"></li>
                <li><a href="<?=base_url();?>auth/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
			
        </ul>
		  
        </div><!-- /.navbar-collapse -->
      </nav>

	<!-- TOP + Sidebar  -->


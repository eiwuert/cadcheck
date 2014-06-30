<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
        
	<title><?=$page_title;?>  -  <?=sitetitle();?> | <?=sitesubtitle();?></title>

	<link rel="stylesheet" href="<?=theme_path()?>css/screen.css" />

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

<a name="top"></a>
    <div id="body-wrap">
    <header>

            <div id="logo">
                <img src="<?=theme_path()?>images/logo.png"/>
            </div>
        
            <div id="profile">
                 <p><? if (report_downloads() >= 1) echo '<span class="notice"><a href="'.site_url().'report/downloads">You have <strong>'.report_downloads().' Unviewed Reports</strong></a></span>'; ?><br/>You are currently logged in as <strong><?=$this->session->userdata['name'];?></strong>.</p>
            </div>

    </header>
    
    
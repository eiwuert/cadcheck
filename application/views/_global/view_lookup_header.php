<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
        
	<title><?=$page_title;?>  -  <?=sitesubtitle();?></title>

	<link rel="stylesheet" href="<?=theme_path()?>css/screen.css" />

        <script type="text/javascript" src="<?=asset_path()?>scripts/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/jquery-ui-1.8.14.custom.min.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/cufon-yui.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/myriad_400.font.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/cmxforms.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/jquery.validate.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/flexigrid.pack.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/date.js"></script>
        <script type="text/javascript">
                Cufon.replace('h1');
                Cufon.replace('h2');
                Cufon.replace('nav.main a', { hover:true });
                
                
                $.ajaxSetup({
                   jsonp: null,
                   jsonpCallback: null
                });

                
        </script>
            
        
</head>
<body>

<a name="top"></a>
    <div id="body-wrap" class="smallwidth">
    <header>

            <div id="logo">
                <img src="<?=theme_path()?>images/logo.png"/>
            </div>
        
    </header>
    
        <nav class="main">
            <ul>
                
                <li><a href="/">Home</a></li>
                <li><a href="/lookup/info">Electronic Deposit Information</a></li>
                <!--<li><a href="#">About CDNCHQSRV</a></li>
                <li><a href="#">FAQs</a></li>-->
                
            </ul>
        </nav>
<section class="header_body">
<h1><?=$page_title?></h1>
    <ul>

        <li>
<a href="/lookup/search">Transaction Lookup</a>
        </li><li>
<a href="/lookup/enquire">Support</a>
        </li>
    </ul>
</section>
    
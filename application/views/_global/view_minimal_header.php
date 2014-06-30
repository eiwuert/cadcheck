<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
        
	<title><?=$page_title;?>  -  <?=sitetitle();?> | <?=sitesubtitle();?></title>

	<link rel="stylesheet" href="<?=theme_path()?>css/screen.css" />

        <script type="text/javascript" src="<?=asset_path()?>scripts/jquery.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/cufon-yui.js"></script>
        <script type="text/javascript" src="<?=asset_path()?>scripts/myriad_400.font.js"></script>
        <script type="text/javascript">
			Cufon.replace('h1'); // Works without a selector engine
			Cufon.replace('h2'); // Works without a selector engine
			Cufon.replace('h3'); // Works without a selector engine
	</script>
</head>
<body class="minimal">

    <div id="body-wrap">
    <header>

            <div id="logo">
                <img src="<?=theme_path()?>images/logo.png"/>
            </div>

    </header>
    
    
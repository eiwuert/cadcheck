<style type="text/css">
 a.btn
{  background: url("../images/interface/main_nav_bg.png") repeat-x scroll 0 0 #EFEFEF;
    border-bottom: 4px solid #DDDDDD;
    border-left: 1px solid #CCCCCC;
    color: #000000;
    display: block;
    font-size: 1.1em;
    padding: 4px 24px;
    text-decoration: none;
}
.button-payment {
   border-top: 1px solid #96d1f8;
   background: #255783;
   background: -webkit-gradient(linear, left top, left bottom, from(#4d7298), to(#255783));
   background: -webkit-linear-gradient(top, #4d7298, #255783);
   background: -moz-linear-gradient(top, #4d7298, #255783);
   background: -ms-linear-gradient(top, #4d7298, #255783);
   background: -o-linear-gradient(top, #4d7298, #255783);
   padding: 6px 12px;
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border-radius: 5px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 16px;
   font-family: 'Lucida Grande', Helvetica, Arial, Sans-Serif;
   text-decoration: none;
   vertical-align: middle;
   }
.button-payment:hover {
  border-top-color: #194d6f;
  background: #194d6f;
  color: #ffffff !important;
  }
  
 .button-payment:active {
   border-top-color: #04d739;
   background: #04d739;
 }
 .welcome{
	display: inline-block;
	width: 100%;
 }
 .welcome .welmsg{
	float: left;
	clear: both;
	width: 79%;
 }
 .welcome .button-payment{
	float:right;
}
 .navigation{
 width: 99.8%;
border: 1px solid;
padding: 11px 0px;
background: #194c6f;
color: #fff;
font-size: 19px;
 }
 
 #article_main .body{
	padding:0px !important;
 }
 #article_main h1{
	display:none;
 }
 .rt{
	float:right;
 }
 
</style>
<section class="content">
		<div class="navigation">
			<span style="margin-left: 24px;">Welcome to <?=$name;?><?//=$page_title;?></span>
		</div>
<article class="body" id="article_main">


    
          
        <div  <?php if(isadmin()) echo 'class="welcome"';else echo 'class="rt"';?> ><!-- <span class="welmsg">Welcome  <?//=$name;?></span>-->
		<a href="<?=base_url();?>payment" class="button-payment">Click here to process payment </a>
		</div>  
		
		
		<!-- Show Transactions Here-->
		<?php 
			if(!isadmin()){
		
				$this->load->view('transaction/view_list',$data);
			}
		?>
       <!-- Show Transactions -->
	   
	   
	   
        <!---<section id="changelog">
            <ul>
                
                <li>Added Lookup transaction @ <a href="http://www.cdnchqsrv.com/">http://www.cdnchqsrv.com/</a></li>
                
            </ul>
            
        </section>--->
        
    
        
    </section>

</article>
    
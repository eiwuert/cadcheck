
<?php
echo $js_grid;
?>

<h1><?=sitetitle()." Merchant Totals";?></h1>
<article class="body">
 
    
    <section class="content">
    <input id="datefrom" class="date-pick dp-applied" name="date1">
    <input id="dateto" class="date-pick dp-applied" name="date2">
 <?php
                        if(!$merchants) {

                            echo "<p>No Merchants to Display. Please check setup.</p>";

                        } else {


                            echo "<select name='merchant' id='merchant'>";
                            echo "<option value='null'>Search All Merchants</option>";

                                foreach($merchants as $key => $merchant) {

                                    echo "<option value='".$merchant['id']."'>".$merchant['name']."</option>";

                                }
                            echo "</select>";


                        }
                    ?>
    <input type="submit" value="Search" id="search" />
<br/><br/>


<script language="javascript">
    
    $(document).ready(function() {
        
	$('#search').click(function() {
            
            var query = 'search=true';
            
            if($('#datefrom').val()) {
                
                
                query = query + '&datefrom='+$('#datefrom').val();
                
            }
            
            if($('#dateto').val()) {
                
                query = query + '&dateto='+$('#dateto').val();
                
            }
            
            if($('#merchant').val()) {
                
                query = query + '&merchant='+$('#merchant').val();
                
            }
           
            var searchquery = encodeURI(query);
            
            
            $("#flex1").flexOptions({ url: '<?php echo site_url()?>ajax/merchant_totals?' + searchquery }).flexReload();
            
        });
        
    });
    
    
    

	$(function() {
		$( "#datefrom" ).datepicker();
	});
	$(function() {
		$( "#dateto" ).datepicker();
	});
</script>
    
    


<table id="flex1" style="display:none"></table>
        
    </section>

</article>
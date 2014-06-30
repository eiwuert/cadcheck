
<?php
if(isset($js_grid))
	echo $js_grid;
?>


<script type="text/javascript">

function test(com,grid)
{

        if (com=='Download Report')
        {
           if($('.trSelected',grid).length>0){
               
                         var rowValues = $('.trSelected>td',grid);
                         
                         rowValues.each(function(i,val) {
                             
                             
                             var cellvalue = $(this).text();
                             
                             
                             if(cellvalue == 'New') {
                                    
                                   $(this).html('<div style="text-align: left; width: 80px;">Downloaded</div>');
                                 
                             }
                             
                         });
                            var items = $('.trSelected',grid);
		            var item ='';
		        	for(i=0;i<items.length;i++){
						item+= items[i].id.substr(3);
                                                
                            document.location.href='<?php echo site_url();?>download?fileid='+item;
					}
                         
                         
			} else {
				return false;
			} 
        }     
} 
</script>  

<h1><?=$page_title?></h1>
<article class="body">


    <section class="content">
        <table id="flex1" style="display:none"></table>

            </section>

 </article>
    </section>

</article>

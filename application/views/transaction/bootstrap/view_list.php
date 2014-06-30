<style>
.date-pick{
	width:30%;
	float:left;
	margin-left:10px;
}
#search{
	margin-left:10px;
	background:#CCCCCC;
}
#search :hover{
	background:#FFFFFF;
} 
 
</style>

<?php
echo $js_grid;
?>

<div id="page-wrapper">

    <div class="row">
		
	<div class="col-lg-12">	

	<h1><?=sitetitle()." Transactions";?></h1>

	<div class="col-lg-6">
    
		<div class="form-group">
		
			<input id="datefrom" class="date-pick dp-applied form-control" name="date1" />
			<input id="dateto" class="date-pick dp-applied form-control" name="date2" />

			<input type="submit" value="Search" id="search" class="btn btn-default" />

		</div>
		
	</div>

	<div class="table-responsive" >
	
    <table id="flex1" style="display:none"></table>

    </div>  

	</div> 
	</div><!-- /.row -->
</div>	<!-- /#wrapper -->	
	
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
            
            
            $("#flex1").flexOptions({ url: '<?php echo site_url()?>ajax/transactions?' + searchquery }).flexReload();
            
        });
        
    });
    
    
    

	$(function() {
		$( "#datefrom" ).datepicker();
	});
	$(function() {
		$( "#dateto" ).datepicker();
	});
        
        
</script>
    
<script type="text/javascript">

function test(com,grid)
{
   
        if (com=='Delete Transaction')
        {
           if($('.trSelected',grid).length>0){
               
                         var rowValues = $('.trSelected>td',grid);
                         var rowProcess = false;
                         
                         rowValues.each(function(i,val) {
                             
                             
                             var cellvalue = $(this).text();
                             
                             
                             if(cellvalue == 'Pending') {
                                    
                                    rowProcess=true;
                                 
                             }
                             
                         });
                         
                             if(rowProcess) {
                                 
                                 
                                $(function() {
                                        // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
                                        $( "#dialog:ui-dialog" ).dialog( "destroy" );

                                        $( "#dialog-confirm" ).dialog({
                                                resizable: false,
                                                height:140,
                                                modal: true,
                                                buttons: {
                                                        "Delete Transaction": function() {
                                                            
                                                                var items = $('.trSelected',grid);
                                                                var itemlist ='';
																var itemLen = items.length;
																for(i=0;i<itemLen;i++){
																	itemlist+= items[i].id.substr(3);
																	if(i<itemLen-1)
																		itemlist+= ",";
																}
                                                                    
																$.ajax({
																   type: "POST",
																   url: "<?=site_url("/ajax/delete_tx");?>",
																   data: "items="+itemlist,
																   success: function(data){
																		$('#flex1').flexReload();
																   }
																});
                                                            
                                                                $( this ).dialog( "close" );
                                                        },
                                                        Cancel: function() {
                                                                $( this ).dialog( "close" );
                                                        }
                                                }
                                        });
                                });
                                 

                                } else {
                                        $(function() {
                                
                                             var $dialog = $('<div></div>')
                                                .html('You can only delete pending transactions.')
                                                .dialog({

                                                    autoOpen:false,
                                                    title:'Cannot Delete Transaction',
                                                    height:120,
                                                    modal:true,
                                                        buttons: {
                                                                "Ok": function() {
                                                                        $( this ).dialog( "close" );
                                                                }
                                                        }

                                                });

                                                $dialog.dialog('open');

                                        });
                                        return false;
                                }  
                                
                                     
			} else {
				return false;
			} 
        }     
        
        
    if (com=='Edit Transaction')
    {
           if($('.trSelected',grid).length==1){
           
                    var rowValues = $('.trSelected>td',grid);
                         var rowProcess = false;
                         
                         rowValues.each(function(i,val) {
                             
                             
                             var cellvalue = $(this).text();
                             
                             
                             if(cellvalue == 'Pending') {
                                    
                                    rowProcess=true;
                                 
                             }
                             
                         });
                         
                             if(rowProcess) {


                            var id = $('.trSelected').attr('id').substr(3);
                                document.location.href='<?php echo site_url();?>payment/edit?tx='+id;

                            } else {
                                
                                 $(function() {
                                
                                     var $dialog = $('<div></div>')
                                        .html('You can only edit Pending Transactions')
                                        .dialog({
                                            
                                            autoOpen:false,
                                            title:'Unable to Edit',
                                            height:120,
                                            modal:true,
                                                buttons: {
                                                        "Ok": function() {
                                                                $( this ).dialog( "close" );
                                                        }
                                                }
                                            
                                        });
                                        
                                        $dialog.dialog('open');
                                        
                                });
				return false;
                                
                            }
                        }
                        
                        else {
                                $(function() {
                                
                                     var $dialog = $('<div></div>')
                                        .html('You must select a transaction to edit')
                                        .dialog({
                                            
                                            autoOpen:false,
                                            title:'Select a Batch',
                                            height:120,
                                            modal:true,
                                                buttons: {
                                                        "Ok": function() {
                                                                $( this ).dialog( "close" );
                                                        }
                                                }
                                            
                                        });
                                        
                                        $dialog.dialog('open');
                                        
                                });
				return false;
			} 
        }      
} 
</script>


<!-- dialogs -->

<div id="dialog-confirm"  style="display:none;" title="Delete Transaction??">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This transaction will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
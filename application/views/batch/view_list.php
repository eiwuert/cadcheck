
<?php
echo $js_grid;
?>

<h1><?=sitetitle()." Batches";?></h1>
<article class="body">
    
    
    <section class="content">
        
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<script type="text/javascript">

function select_row(id) {
    
    $('#row'.id).addClass('trSelected');
    
}

function test(com,grid)
{
    if (com=='Select All')
    {
		$('.bDiv tbody tr',grid).addClass('trSelected');
    }
    
    if (com=='DeSelect All')
    {
		$('.bDiv tbody tr',grid).removeClass('trSelected');
    }
    
    if (com=='Submit Batch')
        {

            
             if($('.trSelected',grid).length>0) {
                           
                         
                         var rowValues = $('.trSelected>td',grid);
                         var rowProcess = false;
                         
                         rowValues.each(function(i,val) {
                             
                             
                             var cellvalue = $(this).text();
                             
                             
                             if(cellvalue == 'Not submitted') {
                                    
                                    rowProcess=true;
                                 
                             }
                             
                         });
                         
                         if(rowProcess) {
                         
                           
                            $(function() {
                                        // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
                                        $( "#dialog:ui-dialog" ).dialog( "destroy" );

                                        $( "#dialog-submitconfirm" ).dialog({
                                                resizable: false,
                                                height:160,
                                                modal: true,
                                                buttons: {
                                                        "Submit Batch": function() {
                                                   
                                                    var items = $('.trSelected',grid);
                                                    var itemlist ='';
                                                    for(i=0;i<items.length;i++){
                                                                    itemlist+= items[i].id.substr(3)+",";
                                                            }
                                                            $.ajax({
                                                               type: "POST",
                                                               url: "<?=site_url("/ajax/submit_batch");?>",
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
                                        .html('This batch has already been submitted.')
                                        .dialog({
                                            
                                            autoOpen:false,
                                            title:'Already Submitted',
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
    
    if (com=='Delete Batch')
        {
           if($('.trSelected',grid).length>0){
           
                         var rowValues = $('.trSelected>td',grid);
                         var rowProcess = false;
                         
                         rowValues.each(function(i,val) {
                             
                             
                             var cellvalue = $(this).text();
                             
                             
                             if(cellvalue == 'Not submitted') {
                                    
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
                                                        "Delete Batch": function() {
                                                            
                                                            var items = $('.trSelected',grid);
                                                            var itemlist ='';
                                                                for(i=0;i<items.length;i++){
                                                                                itemlist+= items[i].id.substr(3)+",";
                                                                        }
                                                                        $.ajax({
                                                                           type: "POST",
                                                                           url: "<?=site_url("/ajax/delete_batch");?>",
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
                                        .html('Only submitted batches can be deleted.')
                                        .dialog({
                                            
                                            autoOpen:false,
                                            title:'Cannot Delete',
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
    
    if (com=='View Transactions')
        {
           if($('.trSelected',grid).length==1){
           
                            var id = $('.trSelected').attr('id').substr(3);
                            document.location.href='<?php echo site_url()?>transaction/batch?view='+id;
                            
			} 
                        
            else if ($('.trSelected',grid).length>1) {
                                $(function() {
                                
                                     var $dialog = $('<div></div>')
                                        .html('You can only view transactions of one batch.')
                                        .dialog({
                                            
                                            autoOpen:false,
                                            title:'Cannot view Transactions',
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
				return false;
                        }
                        
                        else {
                                $(function() {
                                
                                     var $dialog = $('<div></div>')
                                        .html('You must select a batch to view its transactions')
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

<table id="flex1" style="display:none"></table>
        
    </section>

</article>


<!-- dialogs -->

<div id="dialog"></div>
<div id="dialog-confirm"  style="display:none;" title="Delete Batch?">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This Batch and all Transactions will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>

<!-- dialogs -->

<div id="dialog-submitconfirm"  style="display:none;" title="Submit Batch?">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Once you submit a batch it cannot be altered. Are you sure?</p>
</div>
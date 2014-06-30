
	<div class="col-lg-12">	
	
        <div class="col-lg-6">
           
			 <form id="uploadForm" class="upload" enctype="multipart/form-data" method="POST" action="<?php echo site_url()?>ajax/batchparser">
            
             
			  <div class="form-group">
			  
                 <label>  Type: </label> 
                <select id="txtype" multiple="multiple"  name="txtype"  class="form-control" >
                    <option value="null" selected>Please Select</option>
                    
                    <? foreach($transaction_type as $type) {
                        
                        echo "<option value='".$type['typeid']."'>".$type['typename']."</option>";
                        
                    } ?>
                </select>
				
              </div>
			  
			  <div class="form-group">
				
				<select id="debitcredit"  multiple="multiple" name="debitcredit"  class="form-control" >
                    
                    <option value="null" selected> --Please Select-- </option>
                    <option value="debit">Debit</option>
                    
                </select>
				
			  </div>
			  
			  <div class="form-group">
			   
				 <span class="a"><a href="#templatedownload" name="templatedonwload" class="templatedownload"></a> </span>
				 
			   </div>
			  
			   <div class="form-group">
			   
				 <label>  File: </label>
				 <input type="file" name="file">
         
			   </div>
			   <br/>
			   <div class="form-group">
			   
				<input type="submit" value="Process Batch" class="btn btn-primary btn-sm">
         
			   </div> 
			   
			   <div class="form-group">
			   
				<input type="hidden" value="100000" name="MAX_FILE_SIZE">
                <input type="hidden" value="html" name="mimetype">
         
			   </div>
	    
            </form>		
            						
		</div>
			         
    </div> 
	
	<script type="text/javascript"> 
        // wait for the DOM to be loaded 
        $(document).ready(function() { 
            
            
            $("#uploadForm").submit(function(){
                
               if($('#debitcredit').val()!='null' && $('#txtype').val()!='null') {
                   
                   return true;
                   
               } else {
                   
                   var $dialog = $('<div></div>')
                                        .html('You must select a Batch Type and whether the batch is a Debit or Credit')
                                        .dialog({
                                            
                                            autoOpen:false,
                                            title:'Error',
                                            height:140,
                                            modal:true,
                                                buttons: {
                                                        "Ok": function() {
                                                                $( this ).dialog( "close" );
                                                        }
                                                }
                                            
                                        });
                                        
                                        $dialog.dialog('open');
                                        return false;
                   
               }
               
               
               
            });
            
            var options = {
                
                target: '/ajax/batchparser',
                beforeSubmit: drawValidate,
                success:    showResponse
                
                
            };

            $('#uploadForm').ajaxForm(options);
            
            $("#txtype").change(function() {   
                
                var str="";
                var txtype_id;
                var txtype_name;
                
                $('#txtype option:selected').each(function(){
                   
                   txtype_id = $(this).val();
                   txtype_name = $(this).text();
                   
                });
                
                if(txtype_id!='null') {

                    $("a.templatedownload").empty();
                    $("a.templatedownload").show();
                    $("a.templatedownload").append('Download '+txtype_name+' Batch Template');
                    $("a.templatedownload").attr('type',txtype_id);
                    
                } else {
                    
                    $("a.templatedownload").empty();
                    $("a.templatedownload").attr('type',null);
                    $("a.templatedownload").hide();
                }
             
            });
            
            $("a.templatedownload").click(function(){
               batchtype = $("a.templatedownload").attr('type');
               document.location.href='/download/batchtemplate?id='+batchtype;
               
            });
            
            
           
            

        }); 
            
            
        
        function throwMsg(msg) {
                
                        var $dialog = $('<div></div>')
                                        .html(msg)
                                        .dialog({
                                            
                                            autoOpen:false,
                                            title:'Error',
                                            height:120,
                                            modal:true,
                                                buttons: {
                                                        "Ok": function() {
                                                                $( this ).dialog( "close" );
                                                        }
                                                }
                                            
                                        });
                                        
                                        $dialog.dialog('open');
                
        }
        
        function drawValidate(a,f,o) {
            
                o.dataType = 'html';
                $('#uploadOutput').show();
                $('#uploadOutput').html('<img src="<?=theme_path()?>images/flexigrid/load.gif"/> Validating Batch File...');
            
        }
        
        function showResponse(data) {
            
                                    var $out = $('#uploadOutput');
                                    $out.html('<br/>');
                                    //$out.html('Form success handler received: <strong>' + typeof data + '</strong>');
                                    if (typeof data == 'object' && data.nodeType)
                                        data = elementToString(data.documentElement, true);
                                    else if (typeof data == 'object')
                                        data = objToString(data);
                                    $out.append('<div>'+ data +'</div>');
            
        }
        
    </script> 
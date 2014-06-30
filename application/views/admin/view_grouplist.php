<?php	echo $js_grid;?>
<h1><?=sitetitle()." Groups";?></h1>
<article class="body">  

<script type="text/javascript">		
var group_id = 0;	

function unloadPopupBox() {	// TO Unload the Popupbox		
	$('#second_layer').fadeOut("slow");		
	$('#popup_box').fadeOut("slow");			
}			

function loadPopupBox() { // To Load the Popupbox		
	$('#second_layer').fadeIn("slow");					
	$('#popup_box').fadeIn("slow");				
}	

function test(com,grid){	    

	if (com=='Select All'){		
		$('.bDiv tbody tr',grid).addClass('trSelected');    
	}        
	if (com=='DeSelect All'){		
		$('.bDiv tbody tr',grid).removeClass('trSelected');    
	}        
	if (com=='Delete Group'){           
		if($('.trSelected',grid).length>0){
			
			if(confirm('WARNING: Deleting a payee will remove them permanently.\r\n\r\nAre you sure you want to continue? This cannot be undone.')){ 		            
			
				var items = $('.trSelected',grid);		            
				var itemlist ='';					
				var itemLen = items.length;		        	
				
				for(i=0;i<itemLen;i++){						
					itemlist+= items[i].id.substr(3);						
					if(i<itemLen-1)						
						itemlist+= ",";					
				}										
				if(itemlist!=''){						
					$.ajax({						   
							type: "POST",						   
							url: "<?=site_url("/ajax/delete_group");?>",						   
							data: "items="+itemlist,						   
							success: function(data){							
								$('#flex1').flexReload();						   
							}						
					});					
				}				
			}                                            
		}          
	}     
}

function openCreateGroup(){	

	$('#popuphead').html('Create New Group');
	$('#btnCreateGroup').html('Create Group');	
	$('#form_newGroup input').val('');	
	loadPopupBox();	
}

function createNewGroup(){	

	var new_group_data = $('#form_newGroup').serialize();	
	var ajaxURL = '';	
	var check = true;	
	
	$('#form_newGroup input').each(function(){
		if($(this).val()==''){
			check = false;
			$(this).css('border','1px solid red');
		}
		
	});
	
	if(group_id==0){
			ajaxURL = "<?=site_url("/ajax/createNew_Group");?>";	
	}else{		
			ajaxURL = "<?=site_url("/ajax/createNew_Group");?>/"+group_id;	
	}		
	
	if(check){		
			$.ajax({				   
				type: "POST",				   
				url: ajaxURL,				   
				data: new_group_data,				   
				success: function(response){					
					if(response=='202'){						
						unloadPopupBox();						
						$('#flex1').flexReload();					
					}else if(response=='101'){						
						alert('Group already exist !');					
					}else if(response=='000'){						
						alert('Please fill all fields !');					
					}										   
				}		
			});	
	}
}

function editGroup(){		

	var ele = $('#flex1 .trSelected');	
	
	if(ele.length>0){		
		var count = 0;		
		
		$(ele).find('td').each(function() { 
		
			var eleDiv =  $(this).children();				
			switch(count){									
				case 0:{ group_id = $(eleDiv).html(); break;}					
				case 1:{ $('#gname').val($(eleDiv).html()); break;}							
			}count++;		
			
		}); 		
		$('#btnCreateGroup').html('Update');		
		$('#popuphead').html('Edit Group');		
		loadPopupBox();		
	}			
} 

</script>
<style>
#popup_box { 
 background: none repeat scroll 0 0 #FFFFFF;
    border-radius: 2px;
    display: none;
    font-size: 13px;
    left: 30%;
    margin: auto;
    padding: 15px;
    position: fixed;
    top: 15%;
    width: 40%;
    z-index: 100;
}
</style>

<table id="flex1" style="display:none"></table>            

</section>	
	
	<div class="second_layer" id="second_layer"></div>							

	<div id="popup_box" class="popup_box">	<!-- OUR PopupBox DIV-->		
		<div id="popuphead" style="text-align:center;font-size:18px;float: left;width:98%;">Create New Group</div> 		
		<a href="javascript:void(0)" onclick="unloadPopupBox();" style="float: left;width: 2%;">X</a> </br></br>
				
			<div style="width:84%;margin: auto;">			
				<form id="form_newGroup" action="" method="post">							
				<div class="inputtext">Group Name :</div>
				<div class="inputinput"><input type="text" id="gname" name="gname" value="" style="width:54%;height:22px;"> </div></br>								
				<div style="text-align:center;">					
					<a href="javascript:void(0)" onclick="createNewGroup();" id="btnCreateGroup" class="button-addpayee">Create Group</a>
				</div>			
				</form>		
			</div>		
	</div>	

</article>
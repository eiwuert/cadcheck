<?php
echo $js_grid;
?>

<h1><?=sitetitle()." Payees";?></h1>
<article class="body">

 
<script type="text/javascript">

$(document).ready(function(){

	$('#email').blur(function(){
		if(!isValidEmail($(this).val())){
			alert('Enter a valid email address');
		}
	}); 
	$("#phone").keydown(function (event) {
		if (event.shiftKey) {
			event.preventDefault();
		}

		if (event.keyCode == 46 || event.keyCode == 8) {
		}
		else {
			if (event.keyCode < 95) {
				if (event.keyCode < 48 || event.keyCode > 57) {
					event.preventDefault();
				}
			}
			else {
				if (event.keyCode < 96 || event.keyCode > 105) {
					event.preventDefault();
				}
			}
		}
	});
	
	/* $('.numeric').numeric({ decimal: false,negative: false }, function() { 
					showAlert('Please enter only positive integers')?>'); 
					this.value = ""; 
					this.focus(); 
	}); */
	
});

var payee_id = 0;
	
	function isValidEmail(email) {
	
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	
	}

	function unloadPopupBox() {	// TO Unload the Popupbox
		$('#second_layer').fadeOut("slow");
		$('#popup_box').fadeOut("slow");
		
	}	
	
	function loadPopupBox() { // To Load the Popupbox
		$('#second_layer').fadeIn("slow");			
		$('#popup_box').fadeIn("slow");			
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
        if (com=='Delete Payee')
        {
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
						   url: "<?=site_url("/ajax/delete_payee");?>",
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

function openAddPayee(){
	$('#btnAddPayee').html('Add Payee');
	$('#form_newPayee input').val('');
	loadPopupBox();	
}

function createNewPayee(){
	var new_payee_data = $('#form_newPayee').serialize();
	var ajaxURL = '';
	var check = true;
	
	$('#form_newPayee input').each(function(){
		if($(this).val()==''){
			check = false;
			$(this).css('border','1px solid red');
		}
		
	});
	
	
	if(payee_id==0){
		ajaxURL = "<?=site_url("/ajax/addNew_Payee");?>";
	}else{
		ajaxURL = "<?=site_url("/ajax/addNew_Payee");?>/"+payee_id;
	}
	
	if(check){
		$.ajax({
				   type: "POST",
				   url: ajaxURL,
				   data: new_payee_data,
				   success: function(response){
					if(response=='202'){
						unloadPopupBox();
						$('#flex1').flexReload();
					}else if(response=='101'){
						alert('Payee already exist !');
					}else if(response=='000'){
						alert('Please fill all fields !');
					}
						
				   }
		});
	}
}

function editPayee(com,grid){
	
	var ele = $('#flex1 .trSelected');
	
	if(ele.length>0){
		var count = 0;
		$(ele).find('td').each(function() { 
			
				var eleDiv =  $(this).children();
				switch(count){
				
					case 1:{ $('#name').val($(eleDiv).html()); break;}
					case 2: { $('#email').val($(eleDiv).html()); break;}
					case 3: {$('#phone').val($(eleDiv).html()); break;}
					case 4: {$('#address1').val($(eleDiv).html()); break;}
					case 5: {$('#address2').val($(eleDiv).html()); break;}
					case 6: {$('#state').val($(eleDiv).html()); break;}
					case 7: {$('#stateAbbr').val($(eleDiv).html()); break;}
					case 8: {$('#post_code').val($(eleDiv).html()); break;}
					case 9: {$('#trans_note').val($(eleDiv).html()); break;}
					default :{ payee_id = $(eleDiv).html(); }	
					
				}count++;
				
			
		}); 
		$('#btnAddPayee').html('Update');
		loadPopupBox();	
	}
		
	
}
 
</script>

<table id="flex1" style="display:none"></table>
        
    </section>
	
<div class="second_layer" id="second_layer">

</div>
						
	<div id="popup_box" class="popup_box">	<!-- OUR PopupBox DIV-->
		<div style="text-align:center;font-size:18px;float: left;width:98%;">Add New Payee</div> 
		<a href="javascript:void(0)" onclick="unloadPopupBox();" style="float: left;
width: 2%;">X</a> </br></br>
		
		<div style="width: 81%;margin-left: 188px;">
			<form id="form_newPayee" action="<?php echo site_url();?>/payee/addnew" method="post">
			
				<div class="inputtext">Name  :</div><div class="inputinput"><input type="text" id="name" name="name" value="" style="width: 37%;"> </div></br>
				<div class="inputtext">Email : </div><div class="inputinput"><input type="text" id="email" name="email" value=""style="width: 37%;"></div></br>
				<div class="inputtext">Phone : </div><div class="inputinput"><input type="tel" id="phone" name="phone" value=""style="width: 37%;"></div></br>
				<div class="inputtext">Adress1:</div><div class="inputinput"><input type="text" id="address1" name="address1" value=""style="width: 37%;"></div></br>
				<div class="inputtext">Adress2:</div><div class="inputinput"><input type="text" id="address2" name="address2" value=""style="width: 37%;"></div></br>
				<div class="inputtext">State :</div><div class="inputinput"><input type="text" id="state" name="state" value=""style="width: 37%;"></div></br>
				<div class="inputtext">State Abbreviation :</div><div class="inputinput"><input type="text" id="stateAbbr" name="stateAbbr" value="" style="width: 37%;"></div></br>
				<div class="inputtext">Postal Code :</div><div class="inputinput"><input type="number" id="post_code" name="post_code" value="" style="width: 37%;"></div></br>
				
				<div style="text-align:center;width:50%;">
					<a href="javascript:void(0)" onclick="createNewPayee();" id="btnAddPayee" class="button-addpayee">Add Payee</a>
				</div>
			</form>
		</div>
	</div>
</article>
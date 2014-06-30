
<?php
echo $js_grid;
?>

<h1><?=sitetitle()." Users";?></h1>
<article class="body">
<!--
<link href="<?php echo base_url();?>assets/bootstrap.min.css" />

<script src="<?php echo base_url();?>assets/scripts/validate.js"></script>
<script src="<?php echo base_url();?>assets/scripts/bootstrap.min.js" > </script>
-->
    
    
<script type="text/javascript">

$(document).ready(function(){
	$('#email').blur(function(){
		if(!isValidEmail($(this).val())){
			alert('Enter a valid email address');
		}
	}); 
	$('#email').change(function(){
		if(!isValidEmail($(this).val())){
			//alert('Enter a valid email address');
		}
	}); 
	
});
		/* $("#form_newUser").validate({
		
			rules:{
					fname:{required:true},
					lname:{required:true},
					username:{required:true,minlength:8},
					
					email:{required:true,email:true}
			},
			messages:{
				fname:{
						required:"Username must filled",
						minlength:"Username must be of 5 characters"
				},
				lname:{
					required:"Password must filled",
					minlength:"Password must be minimum 8 characters"
				},
				
				email:{
						required:"Enter your email address",
						email:"Enter a valid email address LIKE:- amanjaiswal453@gmail.com"
				},
				
				    
			},
			
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass)
		{
		$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass)
		{
		$(element).parents('.control-group').removeClass('error');
		$(element).parents('.control-group').addClass('success');
		}
	
		});
		 */
var user_id = 0;

function unloadPopupBox() {	// TO Unload the Popupbox
	$('#second_layer').fadeOut("slow");
	$('#popup_box').fadeOut("slow");
	
}	

function loadPopupBox() { // To Load the Popupbox
	$('#second_layer').fadeIn("slow");			
	$('#popup_box').fadeIn("slow");			
}
	
function openCreateUser(){
	$('#btnCreateUser').html('Create User');
	$('#form_newUser input').val('');
	$('#headline').html('Create New User');
	$('#user_role option:selected').removeAttr('selected');
	  
	loadPopupBox();	
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
        if (com=='Delete User')
        {
           if($('.trSelected',grid).length>0){
               

               
			if(confirm('WARNING: Deleting a user will remove them permanently.\r\n\r\nAre you sure you want to continue? This cannot be undone.')){
			
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
					   url: "<?=site_url("/ajax/delete_user");?>",
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

function editUser(){


var ele = $('#flex1 .trSelected');
	
	if(ele.length>0){
		var count = 0;
		$(ele).find('td').each(function() { 
			
				var eleDiv =  $(this).children();
				switch(count){
					
					case 0:{ user_id = $(eleDiv).html(); break;}
					case 1:{
							var fullname = $(eleDiv).html();
							var splited = fullname.split(' ');
							$('#fname').val(splited[0]); 
							$('#lname').val(splited[1]); 
							break;
							
					}
					case 2: { $('#username').val($(eleDiv).html()); break;}
					case 3: {$('#email').val($(eleDiv).html()); break;}
					case 4: {
						var role = $(eleDiv).html();
						var opt = $('#user_role option:contains("'+role+'")');
						$(opt).attr('selected', 'selected'); 
						break;
					}
					
					default :{ }	
					
				}count++;
				
			
		}); 
		
		$('#btnCreateUser').html('Update');
		$('#headline').html('Update User');
		loadPopupBox();	
	}

	

}

function createUser(){

	var new_user_data = $('#form_newUser').serialize();
	var ajaxURL = '';
	var check = true;
	$('#form_newUser input').each(function(){
		if($(this).val()==''){
			check = false;
			$(this).css('border','1px solid red');
		}
		
	});
	
	if(user_id==0){
		ajaxURL = "<?=site_url("/ajax/createNew_User");?>";
	}else{
		ajaxURL = "<?=site_url("/ajax/createNew_User");?>/"+user_id;
	}
	
	if(check){
		$.ajax({
				   type: "POST",
				   url: ajaxURL,
				   data: new_user_data,
				   success: function(response){
				   
						if(response=='202'){
							unloadPopupBox();
							$('#flex1').flexReload();
						}else if(response=='101'){
							alert('User already exist !');
						}else if(response=='000'){
							alert('Please fill all fields !');
						}
						
					}
		});
	}

}

 function isValidEmail(email) {
	
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);

  }
</script>

<table id="flex1" style="display:none"></table>
        
    </section>
	
	
	<div class="second_layer" id="second_layer">

	</div>
						
	<div id="popup_box" class="popup_box">	<!-- OUR PopupBox DIV-->
		<div id="headline" style="text-align:center;font-size:18px;float: left;width:98%;">Create New User</div> 
		<a href="javascript:void(0)" onclick="unloadPopupBox();" style="float: left;
width: 2%;">X</a> </br></br>
		
		<div style="width: 81%;margin-left: 188px;">
			<form id="form_newUser" action="" method="post">
			
				<div class="inputtext">First Name :</div><div class="inputinput"><input type="text" id="fname" name="fname" value="" style="width: 37%;"> </div><br/>
				<div class="inputtext">Last Name : </div><div class="inputinput"><input type="text" id="lname" name="lname" value=""style="width: 37%;"></div><br/>
				<div class="inputtext">Username : </div><div class="inputinput"><input type="text" id="username" name="username" value=""style="width: 37%;"></div><br/>
				<div class="inputtext">Email :</div><div class="inputinput"><input type="email" id="email" name="email" value=""style="width: 37%;"></div><br/>
				<div class="inputtext">User Role :</div><div class="inputinput">
					<select id="user_role" name="user_role" value="" style="width: 37%;"> 
						<option value="user">User</option>
						<option value="system">System Manager</option>
						<option value="admin">Super Admin</option>	
					</select>
				</div><br/>
		
				<div style="text-align:center;width:50%;">
					<a href="javascript:void(0)" onclick="createUser();" id="btnCreateUser" class="button-addpayee">Create User</a>
				</div>
				
			</form>
			
		</div>
	</div>
	
	
</article>
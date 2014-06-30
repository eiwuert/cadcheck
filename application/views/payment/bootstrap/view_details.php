<style>
.alert-info{
	padding:7px 15px;
}
</style>

<div class="col-lg-12">	

	<?=form_open(base_url() . 'payment/details',array('id'=>'processform','role'=>'form'))?>

	<?=form_hidden('processCheck','true');?>
	<?

	if(validation_errors()) {

		echo '<div class="validation_error">';
		echo validation_errors();
		echo '</div>';
		
	} ?>

  <div class="col-lg-12">	 
  <div class="alert alert-info alert-dismissable"> Batch  </div>
	</div>	
  
	<div class="col-lg-12">	
	<div class="col-lg-6">
        
		<div class="form-group">		
			<label>Group in Batch for <?=$processing_merchant['name'];?></label>
           
			<select name="batchassignment" class="form-control">
				<option value="newbatch">Assign Transaction to New Batch</option>
				<option value="unassigned">Do not assign Transaction to a batch</option>
				<?php if($unsubmitted_batches) {  
				
					foreach($unsubmitted_batches as $value) {

							echo "<option value='".$value['id']."'>".$value['title']." (".$value['txinbatch']." Transaction/s";
							if ($value['batchtotal']) {
								echo " | ".$value['batchtotal'].")";
							} else  {
								echo ")";
							}

							echo "</option>";

					} 
				} ?>
            </select>
		</div>
    </div>
	</div>
	       

	<div class="col-lg-12">	
	<div class="alert alert-info alert-dismissable"> Check &amp; Payment Details  </div>
	
	<div class="col-lg-6">
                
        <img src="<?=theme_path()?>images/interface/cheque_sample.png" /> 
             
		<div class="form-group">
		
			<label>Check Details <span class="note">(reference above)</span></label>
			<div style="width:100%;height:40px;">
				<?=form_input(array('id'=>'check_details_no1','name'=>'check_details_no1','class'=>'required digits form-control','maxlength'=>'10','style'=>'width:22%;float:left;'))?> &nbsp;&nbsp; <?=form_input(array('id'=>'check_details_no2','name'=>'check_details_no2','class'=>'required digits form-control','maxlength'=>'5','style'=>'width
				:18%;float:left;'))?> <?=form_input(array('id'=>'check_details_no3','name'=>'check_details_no3','class'=>'required digits form-control','maxlength'=>'3','style'=>'width:15%;float:left;'))?> 
				&nbsp;&nbsp; <?=form_input(array('id'=>'check_details_no4','name'=>'check_details_no4','class'=>'required digits form-control','maxlength'=>'15','style'=>'width:22%;float:left;'))?>
			</div>
			
		</div>
          
    </div>            
	
	<div class="col-lg-6">
	
		<div class="form-group">
               <label>Check Amount <span class="note">(eg 400.34)</span></label><?=form_input(array('id'=>'check_details_amount','name'=>'check_details_amount','class'=>'required form-control'))?>
        </div>
		
		<div class="form-group">
			<div class="fwrap single"><label>Check Date</label><?=$formdate->selectDay()?> <?=$formdate->selectMonth()?> <?=$formdate->selectYear()?></div>
			   
		</div>

        <div class="form-group">
               <label>Check Issuing Bank</label><?=form_input(array('id'=>'issued_by_bank','name'=>'issued_by_bank','class'=>'required form-control'))?>
        </div>
        
	
	</div>
	  
    </div>
       

	<div class="col-lg-12">
	<div class="alert alert-info alert-dismissable"> Check Issued By </div> 
	
	<div class="col-lg-6">
	
		<div class="form-group">
			<label>Name of Individual or Company</label><?=form_input(array('id'=>'issued_by_name','name'=>'issued_by_name','class'=>'required form-control'))?>
		</div>
		
		<div class="form-group">
			<label>Address</label><?=form_input(array('id'=>'issued_by_address','name'=>'issued_by_address','class'=>'required form-control'))?>
		</div>
		
		<div class="form-group">
			<label>Address (line 2)</label><?=form_input(array('id'=>'issued_by_address2','name'=>'issued_by_address2','class'=>'form-control'))?>
		</div>
			
    </div>   
	
	<div class="col-lg-6">
	
		<div class="form-group">
			<label>Post Code</label><?=form_input(array('id'=>'issued_by_postcode','name'=>'issued_by_postcode','class'=>'required form-control'))?>
			<label>Phone Number</label><?=form_input(array('id'=>'issued_by_phone','name'=>'issued_by_phone','class'=>'required form-control'))?>
		</div>
		<div class="form-group">
			<label>State Abbreviation (Ie. "ON")</label><?=form_input(array('id'=>'issued_by_state','maxlength'=>'5','size'=>'5','name'=>'issued_by_state','class'=>'required form-control'))?>
		</div>
		
		<div class="form-group">
			<label>Email <span class="note">(optional)</span></label><?=form_input(array('id'=>'issued_by_email','name'=>'issued_by_email','class'=>'form-control'))?>
		</div>
         
    </div>        

	</div>

	<div class="col-lg-12">
	<div class="alert alert-info alert-dismissable"> Payee Details </div>       

	<div class="col-lg-12 form-group">
    <div class="col-lg-6">			
	
		<select class="form-control"  name="payee_slct" id="payee_slct" >
			<option value=""> --Select Payee-- </option>
				<?php if(!empty($payees)) {
						
						foreach($payees as $payee){
							echo '<option value="'.$payee->id.'">'.$payee->name.'</option>';
						}
	
				}?>
		</select>
				
	</div>
	
	<div class="col-lg-6">		
		
		<!-- <a href="javascript:void(0)" class="button-addpayee" id="newPayee">Add New Payee</a> -->
		<button class="btn btn-primary btn-sm" type="button" id="newPayee">Add New Payee</button>
	</div>
	
	</div>
	
	<div class="col-lg-12">
	<div class="col-lg-6">	

            <div class="form-group">
                <label>Name</label><?=form_input(array('id'=>'payee_name','name'=>'payee_name','class'=>'required form-control'))?>
            </div>
            
            <div class="form-group">
                <label>Address</label><?=form_input(array('id'=>'payee_address','name'=>'payee_address','class'=>'required form-control'))?>
            </div>
            
            <div class="form-group">
                <label>Address (line 2)</label><?=form_input(array('id'=>'payee_address2','name'=>'payee_address2','class'=>'form-control'))?>
            </div>
      
	</div>
	<div class="col-lg-6">	
	
            <div class="form-group">
                <label>Post Code</label><?=form_input(array('id'=>'payee_postcode','name'=>'payee_postcode','class'=>'required form-control'))?>
               <label>Phone Number</label><?=form_input(array('id'=>'payee_phone','name'=>'payee_phone','class'=>'required form-control'))?>
            </div>
            
            <div class="form-group">
                <label>State Abbreviation (Ie. "ON")</label><?=form_input(array('id'=>'payee_state','maxlength'=>'5','size'=>'5','name'=>'payee_state','class'=>'required form-control'))?>
            </div>
            
            <div class="form-group">
                <label>Email (optional)</label><?=form_input(array('id'=>'payee_email','name'=>'payee_email','class'=>'form-control'))?>
            </div>
         
    </div>
	</div>
	
		
	</div>	
    
	<div class="col-lg-12">  
	<div class="alert alert-info alert-dismissable"> Notes </div>       
  
	<div class="col-lg-6">
	
		<div class="form-group">
			<label>Transaction Note <span class="note">(Max 255 chars)</span></label><?=form_textarea(array('id'=>'note','name'=>'note','maxlength'=>'255'))?>
		</div>
	
		<div class="fbtnrow">
			<?=form_submit(array('name'=>'submit','onclick'=>'$(document).scrollTop(0);','class'=>'btn btn-primary btn-sm'),'Process Payment')?>
		</div>

	</div>
	</div>	
	
            <?=form_close()?>
				
	<!-- <div id="popup_box" class="popup_box">	<!-- OUR PopupBox DIV--
		<div style="text-align:center;font-size:18px;width: 98%;float: left;">Add New payee</div> <a href="javascript:void(0)" onclick="unloadPopupBox();">X</a> </br> </br>
		
		<div style="width: 81%;margin-left: 188px;">
			<form id="form_newPayee" action="<?php echo site_url();?>/payee/addnew" method="post">
			
				<div class="inputtext">Name  :</div><div class="inputinput"><input type="text" name="name" value="" style="width: 37%;"> </div></br>
				<div class="inputtext">Email : </div><div class="inputinput"><input type="text" name="email" value=""style="width: 37%;"></div></br>
				<div class="inputtext">Phone : </div><div class="inputinput"><input type="tel" name="phone" value=""style="width: 37%;"></div></br>
				<div class="inputtext">Adress1:</div><div class="inputinput"><input type="text" name="address1" value=""style="width: 37%;"></div></br>
				<div class="inputtext">Adress2:</div><div class="inputinput"><input type="text" name="address2" value=""style="width: 37%;"></div></br>
				<div class="inputtext">State :</div><div class="inputinput"><input type="text" name="state" value=""style="width: 37%;"></div></br>
				<div class="inputtext">State Abbreviation :</div><div class="inputinput"><input type="text" name="stateAbbr" value="" style="width: 37%;"></div></br>
				<div class="inputtext">Postal Code :</div><div class="inputinput"><input type="number" name="post_code" value="" style="width: 37%;"></div></br>				
				<div style="text-align:center;width:50%;">
					<a href="javascript:void(0)" onclick="createNewPayee();" class="button-addpayee" >Add payee</a>
				</div>
			</form>
		</div>
	</div>  -->

</div>

<script language="javascript">
    
    $(document).ready(function() {
        
	$("#processform").validate();
        
        

        $(function() {                     
            $( "#issued_by_name" ).autocomplete({ //the recipient text field with id #name
                source: function( request, response ) {
                    $.ajax({
                        url: "/ajax/search_names",
                        dataType: "json",
                        data: request,
                        success: function(data){
                            if(data.response == 'true') {
                               response(data.message);
                            }
                        }
                    });
                },
                minLength: 1,
                select: function( event, ui ) {
                    //Do something extra on select... Perhaps add user id to hidden input  
                    $('#issued_by_address').val(ui.item.address1);
                    $('#issued_by_address2').val(ui.item.address2);
                    $('#issued_by_postcode').val(ui.item.postcode);
                    $('#issued_by_phone').val(ui.item.phone);
                    $('#issued_by_email').val(ui.item.email);
                    
                },

            });
        });  
        
        $(function() {                     
            $( "#payee_name" ).autocomplete({ //the recipient text field with id #name
                source: function( request, response ) {
                    $.ajax({
                        url: "/ajax/search_names",
                        dataType: "json",
                        data: request,
                        success: function(data){
                            if(data.response == 'true') {
                               response(data.message);
                            }
                        }
                    });
                },
                minLength: 1,
                select: function( event, ui ) {
                    //Do something extra on select... Perhaps add user id to hidden input
                    $('#payee_address').val(ui.item.address1);
                    $('#payee_address2').val(ui.item.address2);
                    $('#payee_postcode').val(ui.item.postcode);
                    $('#payee_phone').val(ui.item.phone);
                    $('#payee_email').val(ui.item.email);
                    
                },

            });
        });  

		
		$('#payee_slct').change(function(){
			var payee_id = $(this).val();
			
			if(payee_id!=''){
				$.ajax({
							url: "<?php echo site_url()?>/ajax/getpayees/"+payee_id,
							dataType: "json",
							success: function(response){
								if(response.code == '202') {
								
								 var record = response.data;
								 $('#payee_name').val(record.name);
								 
								 $('#payee_address').val(record.address1);
								 
								 $('#payee_address2').val(record.address2);
								 
								 $('#payee_postcode').val(record.post_code);
								 
								 $('#payee_phone').val(record.phone);
								 
								 $('#payee_state').val(record.state_name);
								 
								 $('#payee_email').val(record.email);
								 
								 //$('#note').text(record.trans_note);
								 
								 
								}else{
									alert('No record found !');
								}
							}
				});
			}else{
				$('ul input').val('');
			}
			
		});
		
		$('#newPayee').click(function(){
			loadPopupBox();
		});
        
    });
	
	function unloadPopupBox() {	// TO Unload the Popupbox
		$('#second_layer').fadeOut("slow");
		$('#popup_box').fadeOut("slow");
		
	}	
	
	function loadPopupBox() { // To Load the Popupbox
		$('#second_layer').fadeIn("slow");			
		$('#popup_box').fadeIn("slow");			
	}
	
	function createNewPayee(){
		var new_payee_data = $('#form_newPayee').serialize();
	
		$.ajax({
				   type: "POST",
				   url: "<?=site_url("/ajax/addNew_Payee");?>",
				   data: new_payee_data,
				   success: function(response){
					if(response=='202'){
						//$('#flex1').flexReload();
					}else if(response=='101'){
						alert('Payee already exist !');
					}else if(response=='000'){
						alert('Please fill all fields !');
					}
						
				   }
		});
	
	}
	
</script>
<div id="page-wrapper">

        <div class="row">
		
		<div class="col-lg-12">	
          <div class="col-lg-6">
           
		    <h1> Create a Payment <small> </small></h1>
			
			<div class="form-group">
					
            <?php
                
				if(!$merchants) {

                            echo '<label for="Select"> No Merchants to Display. Please check setup. </label>';

				} else {
						
					echo '<label for="Select"> Please select the Cash Merchant you would like to pay. </label>';
				
					echo form_open(base_url() . $formpost ,array('id'=>'cashmerchant','method'=>'post'));
					
			?>		
					  <select class="form-control"  name='merchant' id='merchantselect'>
						<option>-- Please Select --</option>
							<?php 
							
								foreach($merchants as $key => $merchant) {

                                    echo "<option value='".$merchant['id']."'>".$merchant['name']."</option>";

                                }
							?>
					  </select>
					      
          <?php } 
				
				echo  form_close();            
			?>
            
			</div>
			         
          </div>  </div>
		  
        </div><!-- /.row -->
		
			<div id="detail_section" class="row">   </div>
			
    </div><!-- /#page-wrapper -->

      

    </div><!-- /#wrapper -->	

  </body>
</html>

    <script>

        $('select#merchantselect').change(function() {
		
           var form_action = '<?php echo base_url().$formpost; ?>';
		   var formdata = $('form#cashmerchant').serialize();
		   
		   $.ajax({
			
				url:form_action,
				type:'post',
				data:formdata,
				success:function(response){
				
					$('#detail_section').html(response);
				}
		   
		   
		   });
           //$('form#cashmerchant').submit();
           
        });
    
    </script>
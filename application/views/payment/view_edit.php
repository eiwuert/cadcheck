
        
            <?=form_open(base_url() . 'payment/edit',array('id'=>'processform'))?>

            <?=form_hidden('editpayment','true');?>
            <?=form_hidden('txid',$tx['id']);?>
            <?

            if(validation_errors()) {

                echo '<div class="validation_error">';
                echo validation_errors();
                echo '</div>';
                
            } ?>



<h1><?=$page_title;?></h1>
<article class="body">
    
 
    
    <section class="content">
        
    
        
<h1>Check &amp; Payment Details</h1>
        
        <ul class="form_2column">
            
            <li>
                
            <img src="<?=theme_path()?>images/interface/cheque_sample.png"/>
            
            <div class="frow wide">
                <div class="fwrap single"><label>Check Details <span class="note">(reference above)</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=form_input(array('id'=>'check_details_no1','name'=>'check_details_no1','class'=>'required','maxlength'=>'10','size'=>'10','value'=>$tx['check_details_no1']))?>-&nbsp;<?=form_input(array('id'=>'check_details_no2','name'=>'check_details_no2','class'=>'required','maxlength'=>'5','size'=>'5','value'=>$tx['check_details_no2']))?><?=form_input(array('id'=>'check_details_no3','name'=>'check_details_no3','class'=>'required','maxlength'=>'3','size'=>'3','value'=>$tx['check_details_no3']))?> 
                            &nbsp;-&nbsp;&nbsp;<?=form_input(array('id'=>'check_details_no4','name'=>'check_details_no4','class'=>'required','maxlength'=>'15','size'=>'15','value'=>$tx['check_details_no4']))?>
                </div>
            </div>
                
                
            </li>
            <li>
                
            
            <div class="frow">
                <div class="fwrap"><label>Check Amount <span class="note">(eg 400.34)</span></label><?=form_input(array('id'=>'check_details_amount','name'=>'check_details_amount','class'=>'required','value'=>$tx['check_amount']))?></div>
            </div>
            <div class="frow">
                <div class="fwrap single"><label>Check Date</label>
                    
                    <select name="day">
                        
                        <?php
                        
                            $i = 1;
                            while($i<=31) {
                                
                                if ($i<10) $i = '0'.$i;
                                
                                if ($i==$tx['date_day']) $selected = 'selected="true"';
                                
                                echo '<option value='.$i.' '.$selected.'>'.$i.'</option>';
                                
                                $selected = null;
                                
                                $i++;
                                
                            }
                        
                        ?>
                        
                    </select>
                    
                    <select name="month">
                        
                        <?php
                        
                            $i = 1;
                            while($i<=12) {
                                
                                if ($i<10) $i = '0'.$i;
                                
                                if ($i==$tx['date_month']) $selected = 'selected="true"';
                                
                                echo '<option value='.$i.' '.$selected.'>'.$i.'</option>';
                                
                                $selected = null;
                                
                                $i++;
                                
                            }
                        
                        ?>
                        
                    </select>
                    
                    <select name="year">
                        
                        <?php
                        
                            $i = date('Y',time());
                                
                                
                                echo '<option value='.$i.'>'.$i.'</option>';
         
                        
                        ?>
                        
                    </select>
                    
                </div>
                 
                
            </div>

            <div class="frow wide">
                <div class="fwrap"><label>Check Issuing Bank</label><?=form_input(array('id'=>'issued_by_bank','name'=>'issued_by_bank','class'=>'required','value'=>$tx['issued_by_bank']))?></div>
            </div>
            </li>
            
        </ul>
    

<h1>Check Issued By</h1>

        
        
    <ul class="form_2column">

        <li>


            <div class="frow wide">
                <div class="fwrap"><label>Name of Individual or Company</label><?=form_input(array('id'=>'issued_by_name','name'=>'issued_by_name','class'=>'required','value'=>$tx['issued_by_name']))?></div>
            </div>
            
            <div class="frow wide">
                <div class="fwrap"><label>Address</label><?=form_input(array('id'=>'issued_by_address','name'=>'issued_by_address','class'=>'required','value'=>$tx['issued_by_address']))?></div>
            </div>
            
            <div class="frow wide">
                <div class="fwrap"><label>Address (line 2)</label><?=form_input(array('id'=>'issued_by_address2','name'=>'issued_by_address2','value'=>$tx['issued_by_address2']))?></div>
            </div>
        </li>
        <li>
            <div class="frow">
                <div class="fwrap"><label>Post Code</label><?=form_input(array('id'=>'issued_by_postcode','name'=>'issued_by_postcode','class'=>'required','value'=>$tx['issued_by_postcode']))?></div>
                <div class="fwrap"><label>Phone Number</label><?=form_input(array('id'=>'issued_by_phone','name'=>'issued_by_phone','class'=>'required','value'=>$tx['issued_by_phone']))?></div>
            </div>
            <div class="frow">
                <div class="fwrap"><label>State Abbreviation (Ie. "ON")</label><?=form_input(array('id'=>'issued_by_state','maxlength'=>'5','size'=>'5','name'=>'issued_by_state','class'=>'required','value'=>$tx['issued_by_state']))?></div>
            </div>
            <div class="frow wide">
                <div class="fwrap"><label>Email <span class="note">(optional)</span></label><?=form_input(array('id'=>'issued_by_email','name'=>'issued_by_email','value'=>$tx['issued_by_email']))?></div>
            </div>
         
            

        </li>
        
    </ul>


<h1>Payee Details</h1>

        
    <ul class="form_2column">

        <li>


            <div class="frow wide">
                <div class="fwrap"><label>Name</label><?=form_input(array('id'=>'payee_name','name'=>'payee_name','class'=>'required','value'=>$tx['payee_name']))?></div>
            </div>
            
            <div class="frow wide">
                <div class="fwrap"><label>Address</label><?=form_input(array('id'=>'payee_address','name'=>'payee_address','class'=>'required','value'=>$tx['payee_address']))?></div>
            </div>
            
            <div class="frow wide">
                <div class="fwrap"><label>Address (line 2)</label><?=form_input(array('id'=>'payee_address2','name'=>'payee_address2','value'=>$tx['payee_address2']))?></div>
            </div>
        </li>
        <li>
            <div class="frow">
                <div class="fwrap"><label>Post Code</label><?=form_input(array('id'=>'payee_postcode','name'=>'payee_postcode','class'=>'required','value'=>$tx['payee_postcode']))?></div>
                <div class="fwrap"><label>Phone Number</label><?=form_input(array('id'=>'payee_phone','name'=>'payee_phone','class'=>'required','value'=>$tx['payee_phone']))?></div>
            </div>
            
            <div class="frow">
                <div class="fwrap"><label>State Abbreviation (Ie. "ON")</label><?=form_input(array('id'=>'payee_state','maxlength'=>'5','size'=>'5','name'=>'payee_state','class'=>'required','value'=>$tx['payee_state']))?></div>
            </div>
            <div class="frow wide">
                <div class="fwrap"><label>Email (optional)</label><?=form_input(array('id'=>'payee_email','name'=>'payee_email','value'=>$tx['payee_email']))?></div>
            </div>
         
            

        </li>
    </ul>

<h1>Notes</h1>

        
    <ul class="form_2column">

        <li>

            
            <div class="frow wide">
                <div class="fwrap"><label>Transaction Note <span class="note">(Max 255 chars)</span></label><?=form_textarea(array('id'=>'note','name'=>'note','maxlength'=>'255','value'=>$tx['note']))?></div>
            </div>
        </li>
    </ul>
            <div class="fbtnrow">
                <?=form_submit(array('name'=>'submit','onclick'=>'$(document).scrollTop(0);'),'Edit Payment')?>
            </div>

            <?=form_close()?>
    </section>

</article>
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

        
    });

</script>
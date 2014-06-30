

<article class="body">


    <section class="content">

        
        
        
      <?=form_open(base_url().'lookup/search',array('id'=>'searchform'))?>
        <input type="hidden" name="search" value="1"/>

    <?php
    
    if(isset($tx)) {
        
        if(is_array($tx)) {
            
            echo "<table class='lookup_table'>";
            
            echo "<tr><th>Payment Details</th><th>Check Details</th></tr>";
            
            foreach($tx as $tx_details) {
                
                $check = explode('-',$tx_details['check_no']);
                
                echo "<tr>
                        <td width='50%'>
                        
                            Check made payable to: ".$tx_details['payee_name']."<br/>
                            At the Address of:<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$tx_details['payee_address']."<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$tx_details['payee_address2']."<br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$tx_details['payee_postcode']."<br/>
                        
                        </td>
                        <td>
                      
                            Check Issued By: ".$tx_details['issued_by_name']."<br/>
                            Check No.: ".$check[0]."<br/>
                            Check Amount: $".$tx_details['check_amount']."<br/>
                            Presented for Electronic Processing: ".$tx_details['check_date']."<br/>
                            <a href='/lookup/enquire?id=".$tx_details['id']."'>Enquire about this Transaction</a>
                          
                        </td>
                      </tr>";
                
            }
            
            echo "</table>";
            
        } else {
            
            echo "<div class='validation_error' style='border:1px solid red; background-color:#f3e9e9; text-align:center; margin-bottom:24px; padding:12px; font-size:12px; '>No transactions found.<br/>Please check your details and try again.
                        <br/><br/>If you are unable to locate your transaction please <a href='/lookup/enquire'>Contact Support</a></div>";
            
        }
    }
    
    ?>


    <h1>Lookup Search</h1>

    <p style="padding:6px 12px 12px 12px;">Please use the form below to search for your transaction. Please use your Name, Postcode/ZIP and Account Number of the statement that the transaction appeared on.<br/><br/>
                                           All fields are required.</p>
        
    <ul class="form_1column">

        <li>

            <div class="frow">
                <div class="fwrap"><label>Name</label><?=form_input(array('id'=>'name','name'=>'name','class'=>'required','minlength'=>'6','value'=>$_POST['name']))?></div>
                <div class="fwrap"><label>Postcode/ZIP</label><?=form_input(array('id'=>'postcode','name'=>'postcode','class'=>'required','minlength'=>'4','value'=>$_POST['postcode']))?></div>
            </div>

            <div class="frow wide">
                <div class="fwrap"><label>Account Number</label><?=form_input(array('id'=>'account_number','name'=>'account_number','minlength'=>'5','class'=>'required','value'=>$_POST['account_number']))?></div>
            </div>

        </li>
    </ul>

            <div class="fbtnrow">
                <?=form_submit(array('name'=>'submit','onclick'=>'$(document).scrollTop(0);'),'Lookup Transaction')?>
            </div>

            <?=form_close()?>


    </section>
        


</article>
    
<script language="javascript">
    
    $(document).ready(function() {
        
	$("#searchform").validate();
        
    });

</script>
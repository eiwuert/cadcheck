

<article class="body">


    <section class="content">

        
      <? if(isset($emailsent)) { ?>
          
          <h1>Enquiry successfully sent.</h1>
          <div style="font-size:12px; padding:12px;">
          <p>You have successfully submitted an enquiry regarding your transaction.</p>
          
          <p>Please allow for 24-48 hours for a CDNCHQSRV Representative to contact you in regards to your enquiry.</p>
          <p>Thank you,</p>
          </div>
       <? } else { ?>
        
        
      <?=form_open(base_url().'lookup/enquire',array('id'=>'enquireform'))?>
          
         <?php if(isset($_GET['id'])) { ?>
        <input type="hidden" name="txid" value="<?=$_GET['id'];?>"/>
        <? } ?>


    <h1>Transaction Enquiry Form</h1>

        
    <ul class="form_1column">

        <li>

            <div class="frow">
                <div class="fwrap"><label>Name</label><?=form_input(array('id'=>'name','name'=>'name','class'=>'required','value'=>$_POST['name']))?></div>
                <div class="fwrap"><label>Email</label><?=form_input(array('id'=>'phone','name'=>'phone','class'=>'required','value'=>$_POST['phone']))?></div>

            </div>

            <div class="frow wide">
                <div class="fwrap"><label>Email</label><?=form_input(array('id'=>'email','name'=>'email','class'=>'required email','value'=>$_POST['email']))?></div>
            </div>
            <div class="frow wide">
                <div class="fwrap"><label>Account Number</label><?=form_textarea(array('id'=>'enquiry','name'=>'enquiry','class'=>'required','value'=>$_POST['enquiry']))?></div>
            </div>

        </li>
    </ul>

            <div class="fbtnrow">
                <?=form_submit(array('name'=>'submit','onclick'=>'$(document).scrollTop(0);'),'Enquire about Transaction')?>
            </div>

            <?=form_close()?>

 <? } ?>
    
    </section>
        


</article>
    
<script language="javascript">
    
    $(document).ready(function() {
        
	$("#enquireform").validate();
        
    });

</script>
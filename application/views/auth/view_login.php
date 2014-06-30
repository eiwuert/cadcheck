
<h1><?=$page_title;?> to <?=sitetitle();?></h1>
<article class="body login">

    
    <ul class="form_1column">

        <li>
            <p>Use the form below to login to <?=sitetitle();?>.</p>
            <?=form_open(base_url() . 'auth/login')?>

            <?
            if($this->session->flashdata('login_error')==TRUE)
            {

               echo '<div class="validation_error">';
               echo "You have entered an incorrect username or password.";
               echo '</div>';

            }
            if(validation_errors()) {

                echo '<div class="validation_error">';
                echo validation_errors();
                echo '</div>';
                
            } ?>
            
            <div class="frow wide">

                <div class="fwrap"><label>Username</label><?=form_input(array('id'=>'username','name'=>'username'))?></div>

            </div>

            <div class="frow wide">

                <div class="fwrap"><label>Password</label><?=form_password(array('id'=>'password','name'=>'password'))?></div>

            </div>
            <div class="fbtnrow">
                <?=form_submit(array('name'=>'submit'),'Proceed with Login')?>
            </div>

            <?=form_close()?>

        </li>

    </ul>

</article>
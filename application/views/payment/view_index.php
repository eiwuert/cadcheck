

<h1>Create a Payment</h1>
<article class="body">


    <section class="content">
        
        
        <ul class="form_2column">
            
            <?=form_open(base_url() . $formpost ,array('id'=>'cashmerchant','method'=>'post'))?>
            <li>

                
                <div class="frow wide">
                    <div class="fwrap">
                    
                <?php
                        if(!$merchants) {

                            echo "<p>No Merchants to Display. Please check setup.</p>";

                        } else {

                            echo "<label>Please select the Cash Merchant you would like to pay.</label>";

                            echo "<select name='merchant' id='merchantselect'>";
                            echo "<option>---- Please Select ----</option>";

                                foreach($merchants as $key => $merchant) {

                                    echo "<option value='".$merchant['id']."'>".$merchant['name']."</option>";

                                }
                            echo "</select>";


                        }
                    ?>
                        
                    </div>
                </div>
            </li>
            
            <li>
                
                
            </li>
            <?=form_close()?>
        </ul>
                



    </section>

</article>
    
    <script>

        $('select#merchantselect').change(function() {
           
           $('form#cashmerchant').submit();
           
        });
    
    </script>
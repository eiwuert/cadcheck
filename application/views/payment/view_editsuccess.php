

<h1><?=$page_title;?></h1>
<article class="body">


    <section class="content">
            <p>Transaction was successfully edited</p>
            <p><a href="<?php echo site_url();?>/transaction">Return to Transactions</a></p>
    </section>

</article>
    
    <script>

        $('select#merchantselect').change(function() {
           
           $('form#cashmerchant').submit();
           
        });
    
    </script>
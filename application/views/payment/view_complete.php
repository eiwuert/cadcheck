

<h1><?=$page_title;?></h1>
<article class="body">


    <section class="content">
            <p>Payment Successful</p>
            <p><a href="<?php echo site_url();?>/payment">Create a new Payment</a></p>
            <p><a href="/">Return Home</a></p>
    </section>

</article>
    
    <script>

        $('select#merchantselect').change(function() {
           
           $('form#cashmerchant').submit();
           
        });
    
    </script>
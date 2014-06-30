

<h1><?=$page_title;?></h1>
<article class="body">


    <section class="content">
            <p>Payment Failed</p>
            <p><a href="/payment">Create a new Payment</a></p>
            <p><a href="/">Return Home</a></p>
    </section>

</article>
    
    <script>

        $('select#merchantselect').change(function() {
           
           $('form#cashmerchant').submit();
           
        });
    
    </script>
flexifix = function(){
        $('#row1 div').each(function(i,item){
                if($(item).width() < 30){
                        $(item).width(30);
                        largura = 30;
                }else {
                        largura = $(item).width();
                }

            $($('.hDiv th div')[i]).width(largura);
        })
        pos = 0;
        $('.cDrag div').each(function(i,item){
        pos = pos + parseInt($($('.bDiv table tr td')[i]).css('width')) + i;
        $(item).css('left',pos);
        });

} 
window.onload=function(){
    var i = 1;
    $('.product-items.deposits div.product-item').each(function(){
        if (i > 4) {
            $(this).hide();
        } else {
            i++;
        }
    });
    $('.show-all').click(function(){
        if( $(this).hasClass('hide') ){
            var step = 0;
            $('.product-items.deposits div.product-item').each(function(){
                step++;
                if (step > 4){
                    $(this).hide();
                    $('.show-all').removeClass('hide');
                    $('.show-all').text('Показать еще');
                }
            })
        } else {
            $('.product-items.deposits div.product-item').each(function(){
                $(this).show();
                $('.show-all').text('Скрыть');
                $('.show-all').addClass('hide');
            });
        }
    });
}  
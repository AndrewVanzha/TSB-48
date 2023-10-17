window.onload=function(){
    $('.card-type input').change(function(){

        var arrLimit = [];
        var arrType = [];
        var arrPay = [];

        $('label.limit').each(function(){
            if($(this).find('input').is(':checked')){
                arrLimit.push($(this).find('input').data('value'));
            }
        });
        $('label.type').each(function(){
            if($(this).find('input').is(':checked')){
                arrType.push($(this).find('input').data('value'));
            }
        });
        $('label.pay').each(function(){
            if($(this).find('input').is(':checked')){
                arrPay.push($(this).find('input').data('value'));
            }
        });

        $('.product-item.hidden').removeClass('hidden');
        $('.load-more').hide();
        $('.product-items div.product-item').show();
        $('.product-items div.product-item').addClass('margin');

        $('.product-items div.product-item').each(function(){
            if( (arrLimit.length != 0) && (arrLimit.indexOf($(this).data('limit')) == -1) ){
                $(this).hide();
            }
        });
        $('.product-items div.product-item').each(function(){
            if( (arrType.length != 0) && (arrType.indexOf($(this).data('type')) == -1) ){
                $(this).hide();
            }
        });
        $('.product-items div.product-item').each(function(){
            if( (arrPay.length != 0) && (arrPay.indexOf($(this).data('pay')) == -1) ){
                $(this).hide();
            }
        });

        var i = 0;
        $('.product-items div.product-item').each(function(){
            $(this).removeClass('no-margin');
            if($(this).is(":visible")) i++;
            if( (i % 4) == 0 ) $(this).addClass('no-margin');
        });

        // var limit = arrLimit.join('+');
        // var type  = arrType.join('+');
        // var pay   = arrPay.join('+');
        //
        // $('form.page-section input#limit').val(limit);
        // $('form.page-section input#type').val(type);
        // $('form.page-section input#pay').val(pay);
        //
        // $('form.page-section').submit();
    });
}

window.onload=function(){

    $('.aligner.clearfix .input-field').change(function(){
        $('.currency.clearfix input').val($(this).val());
    })
    $('.aligner.clearfix .input-field').keyup(function(){
        $('.currency.clearfix input').val($(this).val());
    })
    $('.check-box.type input').click(function(){
        $('label.type').each(function(){
            if($(this).find('input').is(':checked')){
                $(this).click();
            }
        });
    });
    $('.card-type input').change(function(){
        result();
    });
    result();
    function result(){
        var arrView = [];
        var arrType = [];
        var arrPay = [];
        var hideArrView = [];
        var hideArrType = [];
        var hideArrPay = [];


        $('label.view').each(function(){
            if($(this).find('input').is(':checked')){
                arrView.push($(this).find('input').data('value'));
            }
        });
        $('label.type').each(function(){
            if($(this).find('input').is(':checked')){
                arrType.push(JSON.parse($(this).find('input').data('value')));
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
        $('.product-items div.product-item').removeClass('filtered');

        $('.product-items div.product-item').addClass('margin');

        $('.product-items div.product-item').each(function(){
            if( (arrView.length != 0) && (arrView.indexOf($(this).data('view')) == -1) ){
                $(this).hide();
                $(this).addClass('filtered');
            }
            console.log(JSON.parse(JSON.stringify('[' + '"\u0414\u0435\u0431\u0435\u0442\u043e\u0432\u0430\u044f \u043a\u0430\u0440\u0442\u0430","\u0417\u0430\u0440\u043f\u043b\u0430\u0442\u043d\u0430\u044f \u043a\u0430\u0440\u0442\u0430"'+ ']')));
            if( (arrType.length != 0) && (arrType.indexOf(JSON.parse($(this).data('type'))) == -1) ){
                $(this).hide();
//console.log(arrType.indexOf($(this).data('type')));

                $(this).addClass('filtered');
            }
            if( (arrPay.length != 0) && (arrPay.indexOf($(this).data('pay')) == -1) ){
                $(this).hide();
                $(this).addClass('filtered');
            }


        });
        $('.product-items div.product-item').each(function(){
            if($(this).is(':visible')){
                hideArrView.push($(this).data('view'));
                hideArrType.push($(this).data('type'));
                hideArrPay.push($(this).data('pay'));
            }
            //console.log($(this).find(".test").data('type'));
            //console.log(hideArrType);
        });
        hideArrView = jQuery.unique( hideArrView );
        hideArrType = jQuery.unique( hideArrType );
        hideArrPay = jQuery.unique( hideArrPay );
        //console.log(hideArrType);
        /*$('label.view').each(function(){
            if(hideArrView.indexOf($(this).data('value')) == -1){
                $(this).hide();
            } else {
                $(this).show();
            }
        });
        $('label.pay').each(function(){
            if(hideArrPay.indexOf($(this).data('value')) == -1){
                $(this).hide();
            } else {
                $(this).show();
            }
        });*/
        // $('label.type').each(function(){
        //     if(hideArrType.indexOf($(this).data('value')) == -1){
        //         $(this).hide();
        //     } else {
        //         $(this).show();
        //     }
        // });


        var i = 0;
        /*$('.product-items div.product-item').each(function(){
            $(this).removeClass('no-margin');
            if($(this).is(":visible")) i++;
            if( (i % 4) == 0 ) $(this).addClass('no-margin');
        });*/
        var n = 0;
        $('.product-items .product-item').each(function(){
            if ($(this).css('display') !== 'none') {
                n++;
                if (n > 4) {
                    $(this).hide();
                }
            }
        });
        if (n <= 4) {
            $('.show-all').hide();
        } else {
            $('.show-all').show();

        }
        $('.show-all').removeClass('hide');
        $('.show-all').text('Показать еще');

    }

    $('.show-all').click(function(){
        if( $(this).hasClass('hide') ){
            var step = 0;
            $('.product-items div.product-item').each(function(){
                if (!$(this).hasClass('filtered')){
                    step++;
                    if (step > 4){
                        $(this).hide();
                        $('.show-all').removeClass('hide');
                        $('.show-all').text('Показать еще');
                    }
                }
            })
        } else {
            $('.product-items div.product-item').each(function(){
                if( (!$(this).hasClass('filtered')) && ($(this).css('display') == 'none') ){
                    $(this).show();
                    $('.show-all').text('Скрыть');
                    $('.show-all').addClass('hide');
                }
            })
        }
    })



    /*-----------------------------------------------------*/
    /* SHOW ALL */
    /*-----------------------------------------------------*/
    //
    // i = 0;
    //
    // $('.show-all').hide();
    //
    // $('.show-all').siblings('.product-items').find('.product-item').each(function() {
    //     if ($(this).css('display') !== 'none') {
    //         i++;
    //         console.log("Количество видимых блоков: " + i);
    //     }
    //     if (i >= 4) {
    //         $(this).css('height', '0');
    //     }
    // });
    // if (i >= 4) {
    //     $('.show-all').show();
    // }
    //
    // $('.show-all').click(function(event) {
    //     event.preventDefault();
    //     $('.product-item').css('height', '408px');
    //     $(this).hide();
    // });
}

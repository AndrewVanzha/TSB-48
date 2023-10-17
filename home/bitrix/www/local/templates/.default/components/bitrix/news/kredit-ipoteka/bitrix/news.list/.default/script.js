window.onload=function(){
    var sectionOne = "#section-394";
    var sectionTwo = "#section-393";
    
    if($(sectionOne).length > 0){
        sectionId = sectionOne;
        var i = 0;
        $(sectionId+' .product-items div.product-item').each(function(){
            $(this).removeClass('no-margin');
            if($(this).is(":visible")) i++;
            if( (i % 4) == 0 ) $(this).addClass('no-margin');
        });
        var n = 0;
        $(sectionId+' .product-items .product-item').each(function(){
            if ($(this).css('display') !== 'none') {
                n++;
                if (n > 4) {
                    $(this).hide();
                }
            }
        });
        if (n <= 4) {
            $(sectionId+' .show-all').hide();
        } else {
            $(sectionId+' .show-all').show();

        }
        $(sectionId+' .show-all').removeClass('hide');
        $(sectionId+' .show-all').text('Показать еще');
        
        $(sectionId+' .show-all').click(function(){
            if( $(this).hasClass('hide') ){
                var step = 0;
                $(sectionId+' .product-items div.product-item').each(function(){
                    if (!$(this).hasClass('filtered')){
                        step++;
                        console.log(step);
                        if (step > 4){
                            console.log(step);
                            $(this).hide();
                            $(sectionId+' .show-all').removeClass('hide');
                            $(sectionId+' .show-all').text('Показать еще');
                        }
                    }
                })
            } else {
                $(sectionId+' .product-items div.product-item').each(function(){
                    if( (!$(this).hasClass('filtered')) && ($(this).css('display') == 'none') ){
                        $(this).show();
                        $(sectionId+' .show-all').text('Скрыть');
                        $(sectionId+' .show-all').addClass('hide');
                    }
                })
            }
        })
    }

    if($(sectionTwo).length > 0){
        sectionId = sectionTwo;
        var i = 0;
        $(sectionId+' .product-items div.product-item').each(function(){
            $(this).removeClass('no-margin');
            if($(this).is(":visible")) i++;
            if( (i % 4) == 0 ) $(this).addClass('no-margin');
        });
        var n = 0;
        $(sectionId+' .product-items .product-item').each(function(){
            if ($(this).css('display') !== 'none') {
                n++;
                if (n > 4) {
                    $(this).hide();
                }
            }
        });
        if (n <= 4) {
            $(sectionId+' .show-all').hide();
        } else {
            $(sectionId+' .show-all').show();

        }
        $(sectionId+' .show-all').removeClass('hide');
        $(sectionId+' .show-all').text('Показать еще');
        
        $(sectionId+' .show-all').click(function(){
            if( $(this).hasClass('hide') ){
                var step = 0;
                $(sectionId+' .product-items div.product-item').each(function(){
                    if (!$(this).hasClass('filtered')){
                        step++;
                        console.log(step);
                        if (step > 4){
                            console.log(step);
                            $(this).hide();
                            $(sectionId+' .show-all').removeClass('hide');
                            $(sectionId+' .show-all').text('Показать еще');
                        }
                    }
                })
            } else {
                $(sectionId+' .product-items div.product-item').each(function(){
                    if( (!$(this).hasClass('filtered')) && ($(this).css('display') == 'none') ){
                        $(this).show();
                        $(sectionId+' .show-all').text('Скрыть');
                        $(sectionId+' .show-all').addClass('hide');
                    }
                })
            }
        })
    }
}
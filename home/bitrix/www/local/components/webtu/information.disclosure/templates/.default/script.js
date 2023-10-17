window.onload=function(){
    $('.cs-box_list li').click(function(){
        var category;
        var categoryList;
        var year;
        var yearList;


        categoryList = $('div.type.select-box ul.cs-box_list li');
        category = $('div.type.select-box ul.cs-box_list li.is-active');
        if($(categoryList).index(category) > 0){
            category = $(category).text();
            category = $.trim(category);
        } else {
            category = false;
        }

        yearList = $('div.date.select-box ul.cs-box_list li');
        year = $('div.date.select-box ul.cs-box_list li.is-active');
        if($(yearList).index(year) > 0){
            year = $(year).text();
            year = $.trim(year);
        } else {
            year = false;
        }

        $('.download-element').show();
        $('.download-element').addClass('show');
        $('.info-accordion li').show();

        if(category){
            $('.download-element').each(function(){
                if ($(this).data('category') != category){
                    $(this).removeClass('show');
                    $(this).hide();
                }
            });
        }
        if(year){
            $('.download-element').each(function(){
                if ($(this).data('year') != year){
                    $(this).removeClass('show');
                    $(this).hide();
                }
            });
        }

        $('.info-accordion_content').each(function(){
            if( !($(this).find('.show').length > 0) ) $(this).parent().hide();
        })

    })
}

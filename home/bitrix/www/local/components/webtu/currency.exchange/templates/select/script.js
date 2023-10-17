window.onload=function(){
    $('.exchange-converter_location .cs-box_list').click(function(){
        $('.exchange-converter').submit();
    });
    $('.input-field').change(function(){
        var type = $(this).attr('data-type');
        sum(type);
    });
    $('.input-field').keyup(function(){
        var type = $(this).attr('data-type');
        sum(type);
    });
    $('.cs-box_list li').click(function(){
        sum();
    });

    $('#flip').click(function(){
        $('#exchangeConverterFlipSides .switch-box').click();
    });
    $('#exchangeConverterFlipSides .switch-box').click(function(){
        flip();
    });
    sum('cur');
    $('#exchange-date').text($('#note-date').text());
}

function flip(){
    if ($('.switch-box_lever.exchange').hasClass('is-active-left')){
        $('.switch-box_lever.exchange').removeClass('is-active-left');
        $('.switch-box_lever.exchange').addClass('is-active-right');
        $('.switch-left span').css({'color': 'rgba(81, 81, 81, 0.5)'});
        $('.switch-right span').css({'color': '#515151'});
    } else {
        $('.switch-box_lever.exchange').removeClass('is-active-right');
        $('.switch-box_lever.exchange').addClass('is-active-left');
        $('.switch-right span').css({'color': 'rgba(81, 81, 81, 0.5)'});
        $('.switch-left span').css({'color': '#515151'});
    }
    sum('cur');
}

function sum(type){

    var curSelectName, curBuy, curSell, curVal, rubVal, result;


    curSelectName = $('#currency .cs-box_selected').text().trim();
    $('#currency .select-box select option').each(function(){
        if($(this).text().trim() == curSelectName){
            curBuy = $(this).data('buy');
            curSell = $(this).data('sell');
            curVal = $('#currency .input-field').val();
            rubVal = $('#rub .input-field').val();
        }
    });

    var count = 1;

	if (curSelectName === 'JPY') {//Если японская иена
		count = 100;//Устанавливаем количество по курсу
	}
		if (curSelectName === 'CNY') {//Если китайский юань
		count = 1.0;//Устанавливаем количество по курсу (уже учтено в форме!)
	}
    if ( $('.switch-box_lever.exchange').hasClass('is-active-left') ) {
        $('#val-cur').text(curBuy);
        if (type == 'rub') {
            result = rubVal / curBuy * count;
            $('#currency .input-field').val(result.toFixed(2));
        } else {
            result = curVal * curBuy / count;
            $('#rub .input-field').val(result.toFixed(2));
        }
    } else {
        $('#val-cur').text(curSell);
        if (type == 'cur') {
            result = curVal * curSell / count;
            $('#rub .input-field').val(result.toFixed(2));
        } else {
            result = rubVal / curSell * count;
            $('#currency .input-field').val(result.toFixed(2));
        }
    }

}
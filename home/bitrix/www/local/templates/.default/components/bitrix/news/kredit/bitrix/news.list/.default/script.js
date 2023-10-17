window.onload=function(){
    $('.content a').click(function(){
        $('#CREDIT_NAME').val($.trim($('.CREDIT_NAME').html()));
        $('#CREDIT_PERCENT').val($.trim($('.credit_percent').html()));
    })
}

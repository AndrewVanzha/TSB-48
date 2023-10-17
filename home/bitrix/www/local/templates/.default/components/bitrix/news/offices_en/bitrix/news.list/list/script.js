window.onload=function(){
    var i=0;
    $('div.cs-box').each(function(){
        i++;
        if (i > 1){
            $(this).remove();
        }
    });
}

function maps(){
    $('.switch-box input').val('yes');
    $('#send').click();
}

function list(){
    $('.switch-box input').val('no');
    $('#send').click();
}

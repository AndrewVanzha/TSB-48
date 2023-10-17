$(window).on('load', function () {

    function changeCur () {
        var cur = $('.cs-box_selected').text().trim();

        $('#CREDIT_CURRENCY').val('Руб.');
        $('#CREDIT_PERCENT').val( $('.currency input[data-currency="Руб."]').data('percent') );

        if (cur == 'Евро') {
            $('#CREDIT_CURRENCY').val('€');
            $('#CREDIT_PERCENT').val( $('.currency input[data-currency="€"]').data('percent') );
        }
        if (cur == 'Доллар США') {
            $('#CREDIT_CURRENCY').val('$');
            $('#CREDIT_PERCENT').val( $('.currency input[data-currency="$"]').data('percent') );
        }
    }

    $('.cs-box_list').on('click', function () {

        setTimeout(changeCur, 1000);

    });

});
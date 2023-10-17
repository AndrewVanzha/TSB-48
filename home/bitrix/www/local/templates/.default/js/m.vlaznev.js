$(window).on('load', function() {
    $('select[name="year-filter"]').next().find('li').click(function () {
        setTimeout(function () {
            window.location = '?year=' + $('select[name="year-filter"]').val();
        }, 500);
    });
    
    $('.cs-box li').click(function() {
        $(this).parent().parent().prev().trigger('change');
    });
    
    $('#searchSort').change(function() {
        window.location = $(this).val();
    });
});
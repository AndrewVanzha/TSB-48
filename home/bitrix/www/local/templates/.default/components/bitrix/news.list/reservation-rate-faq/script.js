(function ($) {
    $(document).ready(function () {
        $('.rr-faq__question').click(function () {
            let parentItem = $(this).parent('.rr-faq__item');
            $('.rr-faq__item_active').removeClass('rr-faq__item_active')
            parentItem.addClass('rr-faq__item_active')
        });
    })
})(jQuery)
<section class="v21-section v21-sbp-topblock">
    <div class="v21-sbp-topblock__block">
        <h1 class="v21-h1-new v21-sbp-topblock__header">Приём платежей по QR-коду</h1>

        <h3 class="v21-h3-new v21-sbp-topblock__content">Зарабатывайте больше благодаря низкой комиссии за платежи через СБП</h3>
        <a href="#fSBPForm" class="v21-button-2022 v21-sbp-topblock__button js-sbp__button">
            <span>Подключить</span>
        </a>
    </div>
    <div class="v21-sbp-topblock__image v21-sbp-topblock__image--dt">
        <img src="/images//credits_business.png" alt="картинка"/>
    </div>
    <div class="v21-sbp-topblock__image v21-sbp-topblock__image--mobile">
        <img src="" alt="картинка">
    </div>
</section>

<script>
    $(document).ready(function () {
        $('.js-sbp__button').on('click', function() {
            let href = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(href).offset().top - 120
            }, {
                duration: 800,   // по умолчанию «400»
                easing: "linear" // по умолчанию «swing»
            });
            return false;
        });
    });
</script>

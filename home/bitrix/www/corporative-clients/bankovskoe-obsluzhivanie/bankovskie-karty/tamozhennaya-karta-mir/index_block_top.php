<section class="corporative-card">
    <h1 class="corporative-card__header">Таможенная карта «МИР»</h1>

    <h3 class="corporative-card__content">Виртуальная карта с моментальной оплатой всех таможенных платежей 24/7</h3>
    <div class="corporative-card__buttons">
        <a href="#fCustomsCardForm" class="v21-button-2022 v21-corpcard-topblock__button js-customscard__button">
            <span>Подключить</span>
        </a>
        <a href="//customs.cpretail.ru/login" class="v21-button-2022 v21-corpcard-topblock__button">
            <span>Личный кабинет</span>
        </a>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('.js-customscard__button').on('click', function() {
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

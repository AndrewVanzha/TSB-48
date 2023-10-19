<div class="v21-section v21-customscard-block1">
    <div class="v21-customscard-block1__left">
        <div class="v21-customscard-block1__left--box">
            <div class="v21-customscard-block1__horline v21-horline-2"></div>
            <h5 class="v21-customscard-block1__left--title">Доступно</h5>
            <p class="v21-customscard-block1__left--text">Перечисления идут сразу на ЕЛС в таможенных органах</p>
        </div>
        <div class="v21-customscard-block1__left--box">
            <div class="v21-customscard-block1__horline v21-horline-1"></div>
            <h5 class="v21-customscard-block1__left--title">Удобно</h5>
            <p class="v21-customscard-block1__left--text">Платёжный сервис <a href="https://cpretail.ru">КП Ритейл</a> с личным кабинетом 24/7</p>
        </div>
        <div class="v21-customscard-block1__left--box">
            <div class="v21-customscard-block1__horline v21-horline-1"></div>
            <div class="v21-customscard-block1__horline v21-horline-3"></div>
            <h5 class="v21-customscard-block1__left--title">Быстро</h5>
            <p class="v21-customscard-block1__left--text">Оплата нескольких видов таможенных платежей одним чеком</p>
        </div>
    </div>

    <div class="v21-customscard-block1__right">
        <div class="v21-customscard-block1__right--img">
            <img src="/images/customs_card_image_plus_620.png" alt="картинка" class="v21-customscard-block1__right--bkgdimg">
            <?/*?><img src="/images/customs_card_image_plus_small.png" alt="картинка" class="v21-customscard-block1__right--bkgdimg-small"><?*/?>
            <img src="/images/customs_card_image_plus.png" alt="картинка" class="v21-customscard-block1__right--bkgdimg-small">
        </div>
        <div class="v21-customscard-block1__right--link">
            <a href="#fBusinessCardTariffs" class="v21-customscard-block1__right--link-button js-v21-customscard-block1__right--link">
                <span>Тарифы</span>
            </a>
            <a href="#fBusinessCardTariffs" target="_blank" class="v21-customscard-block1__right--link-details js-v21-customscard-block1__right--link">
                <!--span>Подробнее </span-->
                <svg class="v21-customscard-block1__right--link-arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                    <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                </svg>
            </a>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.js-v21-customscard-block1__right--link').on('click', function() {
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

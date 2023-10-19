<section class="v21-block-top">
    <div class="v21-section v21-section--xs">
        <div class="v21-grid">
            <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                <div class="v21-grid__item--box">
                    <div class="v21-grid__item--img">
                        <img src="/images/iphone.png" alt="иконка документов">
                    </div>
                    <div class="v21-grid__item--text">Бесконтактная оплата картой или смартфоном</div>
                </div>
            </div><!-- /.v21-grid__item -->

            <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                <div class="v21-grid__item--box">
                    <div class="v21-grid__item--img">
                        <img src="/images/paper.png" alt="изображение">
                    </div>
                    <div class="v21-grid__item--text">Контроль расхода через СМС и выписку по счету</div>
                </div>
            </div><!-- /.v21-grid__item -->

            <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg v21-grid__item--link">
                <div class="v21-grid__item--box">
                    <a class="v21-grid__item--href js-card-section__button--body" href="#fBusinessCardTariffs">
                        <span>Подробности в тарифе</span>
                        <svg class="v21-grid__item--href__arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                            <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                        </svg>
                        <?/*?>
                        <div class="card-section__button">
                            <a href="#fBusinessCardForm" class="v21-button-2022 card-section__button--body js-card-section__button--body">
                                <span>Оставить заявку</span>
                            </a>
                        </div>
                        <?*/?>
                    </a>
                </div>
            </div><!-- /.v21-grid__item -->
        </div>
    </div>

    <div class="v21-block-top--mirpay">
        <img src="/images/MIR_Pay_logo.svg" alt="MIR Pay">
    </div>
</section>

</div><!-- !!! -->

<script>
    $(document).ready(function () {
        $('.js-fBusinessCardTariffs').on('click', function() {
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

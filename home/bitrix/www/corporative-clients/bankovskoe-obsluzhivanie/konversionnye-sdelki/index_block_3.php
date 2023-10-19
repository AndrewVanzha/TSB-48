<?php $img_link = '/corporative-clients/bankovskoe-obsluzhivanie/scheta-dlya-biznesa'; ?>

<div class="v21-block3">
    <section class="v21-block3__left">
        <div class="v21-block3__left--images">
            <div class="v21-block3__left--blur"></div>
            <div class="v21-block3__left--shield"></div>
            <div class="v21-block3__left--frgd">
                <img class="v21-block3__left--frgdimg" src="<?=$img_link?>/images/schet_pnone.png" alt="картинка мобильного телефона">
                <img class="v21-block3__left--frgdimg_768" src="<?=$img_link?>/images/schet_pnone_768.png" alt="картинка мобильного телефона">
            </div>
            <div class="v21-block3__left--bkgd v21-block3__left--bkgd-iimage">
                <??>
                <img class="v21-block3__left--bkgdimg" src="<?=$img_link?>/images/watercolor_texture_bkgd.png" alt="фоновая картинка">
                <img class="v21-block3__left--bkgdimg_768" src="<?=$img_link?>/images/watercolor_texture_bkgd_768.png" alt="фоновая картинка">
                <??>
            </div>
        </div>
    </section>

    <section class="v21-block3__right">
        <div class="v21-block3__right--wrap">
            <h5 class="v21-block3__right--title">Подключайте Онлайн-банк и управляйте финансами в приложении ТСБ-бизнес</h5>
            <p class="v21-block3__right--text">Получайте отчеты и выписки, обменивайтесь документами и информацией с банком без посещения офиса Подключение бесплатное</p>
        </div>
        <div class="v21-block3__left--link">
            <noindex>
                <ul class="v21-footer__socials v21-socials">
                    <li class="v21-socials__item v21-socials__item--app">
                        <a target="_blank" href="https://apps.apple.com/ru/app/тсб-бизнес-онлайн/id1539911932" rel="nofollow" class="v21-socials__link">
                            <svg width="36" height="31" class="v21-socials__icon">
                                <use xlink:href="/local/templates/v21_template_home/img/v21_icons.svg#appStore"></use>
                            </svg>
                            <span>App Store</span>
                        </a>
                    </li>

                    <li class="v21-socials__item v21-socials__item--app">
                        <!--a target="_blank" href="https://play.google.com/store/apps/details?id=com.bssys.mbcphone.tsb" rel="nofollow" class="v21-socials__link"-->
                        <a target="_blank" href="https://play.google.com/store/apps/details?id=com.bssys.mbcphone.tsbank" rel="nofollow" class="v21-socials__link">
                            <svg width="32" height="36" class="v21-socials__icon">
                                <use xlink:href="/local/templates/v21_template_home/img/v21_icons.svg#googlePlay"></use>
                            </svg>
                            <span>Google Play</span>
                        </a>
                    </li>
                </ul><!-- /.v21-footer__socials -->
            </noindex>

        </div>
    </section>
</div>


<script>
    $(document).ready(function () {
        $('.js-ved-contracts__button').on('click', function() {
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
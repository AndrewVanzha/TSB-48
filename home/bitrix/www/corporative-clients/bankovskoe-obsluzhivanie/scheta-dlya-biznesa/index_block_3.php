<?php $img_link = '/corporative-clients/bankovskoe-obsluzhivanie/scheta-dlya-biznesa'; ?>

<div class="v21-scheta-block3">
    <section class="v21-scheta-block3__left">
        <div class="v21-scheta-block3__left--images">
            <div class="v21-scheta-block3__left--blur"></div>
            <div class="v21-scheta-block3__left--shield"></div>
            <div class="v21-scheta-block3__left--frgd">
                <img class="v21-scheta-block3__left--frgdimg" src="<?=$img_link?>/images/schet_pnone.png" alt="картинка мобильного телефона">
                <img class="v21-scheta-block3__left--frgdimg_768" src="<?=$img_link?>/images/schet_pnone_768.png" alt="картинка мобильного телефона">
            </div>
            <div class="v21-scheta-block3__left--bkgd v21-scheta-block3__left--bkgd-iimage">
                <??>
                <img class="v21-scheta-block3__left--bkgdimg" src="<?=$img_link?>/images/watercolor_texture_bkgd.png" alt="фоновая картинка">
                <img class="v21-scheta-block3__left--bkgdimg_768" src="<?=$img_link?>/images/watercolor_texture_bkgd_768.png" alt="фоновая картинка">
                <??>
            </div>
        </div>
        <div class="v21-scheta-block3__left--wrap">
            <h5 class="v21-scheta-block3__left--title">Подключите Онлайн-банк и управляйте финансами в приложении ТСБ-Бизнес</h5>
            <p class="v21-scheta-block3__left--text">Получайте отчёты и выписки, обменивайтесь документами и информацией с банком без посещения офиса. Подключение бесплатное.</p>
            <div class="v21-scheta-block3__left--link">
                <noindex>
                    <ul class="v21-footer__socials v21-socials">
                        <li class="v21-socials__item v21-socials__item--app">
                            <?/*?><a target="_blank" href="https://itunes.apple.com/ru/app/id723491575" rel="nofollow" class="v21-socials__link"><?*/?>
                            <?/*?><a href="https://apps.apple.com/ru/app/%D1%82%D1%80%D0%B0%D0%BD%D1%81%D1%81%D1%82%D1%80%D0%BE%D0%B9%D0%B1%D0%B0%D0%BD%D0%BA-%D0%BC%D0%B1%D0%BA/id1334142386" target="_blank"><?*/?>
                            <a href="https://apps.apple.com/ru/app/тсб-бизнес-онлайн/id1539911932" target="_blank">
                                <svg width="36" height="31" class="v21-socials__icon">
                                    <use xlink:href="/local/templates/v21_template_home/img/v21_icons.svg#appStore"></use>
                                </svg>
                                <span>App Store</span>
                            </a>
                        </li>

                        <li class="v21-socials__item v21-socials__item--app">
                            <?/*?><a target="_blank" href="https://play.google.com/store/apps/details?id=com.isimplelab.ibank.tsbank" rel="nofollow" class="v21-socials__link"><?*/?>
                            <?/*?><a href="https://play.google.com/store/apps/details?id=com.bssys.mbcphone.tsb" target="_blank"><?*/?>
                            <a href="https://play.google.com/store/apps/details?id=com.bssys.mbcphone.tsbank" target="_blank">
                                <svg width="32" height="36" class="v21-socials__icon">
                                    <use xlink:href="/local/templates/v21_template_home/img/v21_icons.svg#googlePlay"></use>
                                </svg>
                                <span>Google Play</span>
                            </a>
                        </li>
                    </ul><!-- /.v21-footer__socials -->
                </noindex>

            </div>
        </div>
    </section>

    <section class="v21-scheta-block3__right">
        <div class="v21-scheta-block3__right--images">
            <img class="v21-scheta-block3__right--frgdimg" src="<?=$img_link?>/images/tv_ball.png" alt="картинка на телевизоре">
            <img class="v21-scheta-block3__right--frgdimg_768" src="<?=$img_link?>/images/tv_ball_768.png" alt="картинка на телевизоре">
        </div>
        <div class="v21-scheta-block3__right--wrap">
            <h5 class="v21-scheta-block3__right--title">Проверяйте бизнес-партнёров</h5>
            <p class="v21-scheta-block3__right--text">В режиме онлайн можно увидеть информацию обо всех партнерах ещё до совершения сделок. Сервис «Светофор» предупреждает о стоп-факторах, имеющихся у контрагента, и присваивает один из цветов светофора.<br>
                <br>«Светофор» предоставляется абсолютно бесплатно и доступен в интернет-банке.</p>
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
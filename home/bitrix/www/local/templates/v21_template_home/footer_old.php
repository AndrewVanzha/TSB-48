<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use Bitrix\Main\Page\Asset; ?>
<? if (!CSite::InDir('/index.php') && !CSite::InDir('/en/index.php') && !CSite::InDir('/chastnym-klientam/index.php') && !CSite::InDir('/en/chastnym-klientam/index.php')) : ?>
  </div><!-- /.v21-container -->
  </div><!-- /.v21-section -->
<? endif ?>

<footer class="v21-footer">
  <? $APPLICATION->IncludeComponent(
    "webtu:feedback",
    ".default",
    array(
      "AJAX_MODE" => "Y",
      "COMPONENT_TEMPLATE" => ".default",
      "IBLOCK_ID" => "5",
      "PROPERTIES" => array(
        0 => "PHONE",
        1 => "EMAIL",
        2 => "FOLDER",
      ),
      "ADMIN_EVENT" => "WEBTU_FEEDBACK_QUESTION",
      "USER_EVENT" => "NONE",
      "SITES" => array(
        0 => "s1",
      ),
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "AJAX_OPTION_HISTORY" => "N",
      "AJAX_OPTION_ADDITIONAL" => "",
      "FOLDER" => $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]
    ),
    false,
    array(
      "ACTIVE_COMPONENT" => "N"
    )
  ); ?>

  <div class="v21-container">
    <div class="v21-footer__main">
      <div class="v21-grid">
        <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
          <ul class="v21-footer__nav">

            <?
            $prefix = '';
            if (CSite::InDir('/en/')) {
              $prefix = '/en';
            }
            ?>

            <li class="v21-footer__nav-item">
              <a href="<?= $prefix ?>/o-banke/" class="v21-footer__nav-link"><?= GetMessage("ABOUT_BANK") ?></a>
            </li>

            <li class="v21-footer__nav-item">
              <a href="<?= $prefix ?>/" class="v21-footer__nav-link"><?= GetMessage("CORPOPATIVE_CLIENTS") ?></a>
            </li>

            <li class="v21-footer__nav-item">
              <a href="<?= $prefix ?>/chastnym-klientam/" class="v21-footer__nav-link"><?= GetMessage("PRIVATE_CUSTOMERS") ?></a>
            </li>

            <li class="v21-footer__nav-item">
              <a href="<?= $prefix ?>/finansovym-organizatsiyam/" class="v21-footer__nav-link"><?= GetMessage("FINANCIAL_CLIENTS") ?></a>
            </li>

            <? if (!$prefix) { ?>
              <li class="v21-footer__nav-item">
                <a href="/chastnym-klientam/finansovaya-gramotnost/" class="v21-footer__nav-link">Финансовая грамотность</a>
              </li>
            <? } ?>

            <li class="v21-footer__nav-item">
              <a href="/arbitrazhnym-upravlyayushchim/" class="v21-footer__nav-link"><?= GetMessage("ARBITRATION_MANAGER") ?></a>
            </li>

            <li class="v21-footer__nav-item">
              <a href="/obratnaya-svyaz/" class="v21-footer__nav-link"><?= GetMessage("FEEDBACK") ?></a>
            </li>

            <li class="v21-footer__nav-item">
              <a href="/o-banke/blog/" class="v21-footer__nav-link"><?= GetMessage("BLOG") ?></a>
            </li>

          </ul><!-- /.v21-footer__nav -->
        </div><!-- /.v21-grid__item -->

        <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
          <div class="v21-footer__entry">
            <h6 class="v21-footer__title"><?= GetMessage("ADRESS") ?></h6>
            <p class="v21-p">
              <?
              if (CSite::InDir('/en/')) {
                echo \GarbageStorage::get('english_address');
              } else {
                echo \GarbageStorage::get('address');
              }
              ?>
            </p>
          </div>

          <div class="v21-footer__entry">
            <a href="tel:<?= \GarbageStorage::get('phone_2') ?>" class="v21-footer__phone"><?= \GarbageStorage::get('phone_2') ?></a>
            <p class="v21-p"><?= GetMessage("CALL_RUS") ?></p>
          </div>

          <div class="v21-footer__entry">
            <a href="tel:<?= \GarbageStorage::get('phone_1') ?>" class="v21-footer__phone"><?= \GarbageStorage::get('phone_1') ?></a>
            <p class="v21-p"><?= GetMessage("CALL_MOSCOW") ?></p>
          </div>

          <?/* 
          <div class="v21-footer__entry">
            <a href="mailto:tsbank@transstroybank.ru" class="v21-footer__phone">tsbank@transstroybank.ru</a>
            <p class="v21-p"></p>
          </div>
          <div class="v21-footer__entry">
            <a href="mailto:client@transstroybank.ru" class="v21-footer__phone">client@transstroybank.ru</a>
            <p class="v21-p"><?= GetMessage("ISSUES") ?></p>
          </div>
          <div class="v21-footer__entry">
            <a href="mailto:notarius@transstroybank.ru" class="v21-footer__phone">notarius@transstroybank.ru</a>
            <p class="v21-p"><?= GetMessage("NOTARIES") ?></p>
          </div>
          */?>

          
        </div><!-- /.v21-grid__item -->

        <div class="v21-grid__item v21-grid__item--1x3@lg">
          <div class="v21-grid">
            <noindex>
              <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x1@lg">
                <div class="v21-footer__entry">
                  <h6 class="v21-footer__title"><?= GetMessage("MOBILE_APPLICATION") ?></h6>
                  <ul class="v21-footer__socials v21-socials">
                    <li class="v21-socials__item v21-socials__item--app">
                      <a target="_blank" href="https://itunes.apple.com/ru/app/id723491575" rel="nofollow" class="v21-socials__link">
                        <svg width="36" height="31" class="v21-socials__icon">
                          <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_icons.svg#appStore"></use>
                        </svg>
                        <span>App Store</span>
                      </a>
                    </li>

                    <li class="v21-socials__item v21-socials__item--app">
                      <a target="_blank" href="https://play.google.com/store/apps/details?id=com.isimplelab.ibank.tsbank" rel="nofollow" class="v21-socials__link">
                        <svg width="32" height="36" class="v21-socials__icon">
                          <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_icons.svg#googlePlay"></use>
                        </svg>
                        <span>Google Play</span>
                      </a>
                    </li>
                  </ul><!-- /.v21-footer__socials -->
                </div><!-- /.v21-footer__entry -->
              </div><!-- /.v21-grid__item -->
            </noindex>

            <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x1@lg">
              <div class="v21-footer__entry">
                <h6 class="v21-footer__title"><?= GetMessage("SOCIAL_NETWORKS") ?></h6>
                <noindex>
                  <ul class="v21-footer__socials v21-socials">

					  <?/*?>
                    <li class="v21-socials__item">
                      <a href="https://vk.com/coins.tsbnk" target="_blank" rel="nofollow" class="v21-socials__link">
                        <svg width="37" height="36" class="v21-socials__icon">
                          <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_icons.svg#vk"></use>
                        </svg>
                      </a>
                    </li>
					  <?*/?>

                      <li class="v21-socials__item">
                          <a href="https://vk.com/tsbnk" target="_blank" rel="nofollow" class="v21-socials__link">
                              <svg width="37" height="36" class="v21-socials__icon">
                                  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_icons.svg#vk"></use>
                              </svg>
                          </a>
                      </li>

					<?/*?>
                    <li class="v21-socials__item">
                      <a href="https://www.facebook.com/tsbnk.ru" target="_blank" rel="nofollow" class="v21-socials__link">
                      <a href="https://www.facebook.com/coins.tsbnk/" target="_blank" rel="nofollow" class="v21-socials__link">
                        <svg width="37" height="36" class="v21-socials__icon">
                          <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_icons.svg#fb"></use>
                        </svg>
                      </a>
                    </li> 
					<?*/?>

					  <?/*?> <li class="v21-socials__item">
                      <a href="https://www.instagram.com/tsbnk.ru/" target="_blank" rel="nofollow" class="v21-socials__link">
                        <svg width="37" height="36" class="v21-socials__icon">
                          <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#ig"></use>
                        </svg>
                      </a>
					  </li> <?*/?>

                      <li class="v21-socials__item">
                          <a href="https://t.me/tsbnk_ru" target="_blank" rel="nofollow" class="v21-socials__link">
                              <svg width="37" height="36" class="v21-socials__icon">
                                  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#tg"></use>
                              </svg>
                          </a>
                      </li>

                  </ul><!-- /.v21-footer__socials -->
                </noindex>
              </div><!-- /.v21-footer__entry -->
            </div><!-- /.v21-grid__item -->
          </div><!-- /.v21-grid -->
        </div><!-- /.v21-grid__item -->
      </div><!-- /.v21-grid -->

      <div class="v21-grid">
        <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
          <ul class="v21-footer__nav">
            <li class="v21-footer__nav-item">
              <p class="v21-p"><a style="font-size:16px;" href="mailto:tsbank@transstroybank.ru" class="v21-footer__phone">tsbank@transstroybank.ru</a></p>
            </li>
          </ul><!-- /.v21-footer__nav -->
        </div><!-- /.v21-grid__item -->
        <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
          <div class="v21-footer__entry">
            <a style="font-size:16px;" href="mailto:client@transstroybank.ru" class="v21-footer__phone">client@transstroybank.ru</a>
            <p class="v21-p">(вопросы и предложения)</p>
          </div>
        </div><!-- /.v21-grid__item -->
        <div class="v21-grid__item v21-grid__item--1x3@lg">
          <div class="v21-grid">
              <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x1@lg">
                <div class="v21-footer__entry">
            <a style="font-size:16px;" href="mailto:notarius@transstroybank.ru" class="v21-footer__phone">notarius@transstroybank.ru</a>
            <p class="v21-p">(для обращений нотариусов)</p>
          </div>
              </div><!-- /.v21-grid__item -->
        </div>
        <!-- /.v21-grid -->
        </div><!-- /.v21-grid__item -->

          <? $rsList = CIBlockElement::GetList(
              Array("SORT"=>"ASC"),
              Array("IBLOCK_ID"=>210),
              false,
              false,
              Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_ATT_DATE", "PROPERTY_ATT_SHOW_DATE")
          );
          while($arList = $rsList->Fetch()) {
              $valid_date = $arList['PROPERTY_ATT_DATE_VALUE'];
              $show_date = $arList['PROPERTY_ATT_SHOW_DATE_VALUE'];
          } ?>
          <div class="tariff-note" <?= (strtotime($show_date) > time())? 'style="display: none"' : ''; ?>>
              <div class="tariff-note-button js-tariff-note-button--click"><!-- кнопка по тарифам -->
                  <div class="tariff-note-button--pulse"></div>
                  <div class="tariff-note-button--pulse"></div>
                  <div class="tariff-note-button--box js-tariff-note-button--hover">
                      <div class="tariff-note-button--icon">
                          <svg class="tariff-note-button--icon__svg" xmlns="http://www.w3.org/2000/svg" width="24" height="30" viewBox="0 0 24 30" fill="none">
                              <path class="tariff-note-button--icon__svg_path" d="M12 29.0156C13.5813 29.0156 14.875 27.7219 14.875 26.1406H9.125C9.125 27.7219 10.4044 29.0156 12 29.0156ZM20.625 20.3906V13.2031C20.625 8.79 18.2675 5.09562 14.1562 4.11812V3.14062C14.1562 1.9475 13.1931 0.984375 12 0.984375C10.8069 0.984375 9.84375 1.9475 9.84375 3.14062V4.11812C5.71813 5.09562 3.375 8.77563 3.375 13.2031V20.3906L0.5 23.2656V24.7031H23.5V23.2656L20.625 20.3906Z" fill="white"/>
                          </svg>
                      </div>
                  </div>
              </div>
              <div class="tariff-note--block"><!-- объявление по тарифам -->
                  <div class="tariff-note--block__band">
                      <div class="tariff-note--block__img">
                          <img src="/images/paper.png" alt="иконка документов">
                      </div>
                      <div class="tariff-note--block__close js-tariff-note--block__close">
                          <svg width="14" height="14">
                              <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
                          </svg>
                      </div>
                  </div>
                  <div class="tariff-note--block__wrap">
                      <h4 class="tariff-note--block__subheader">Новые тарифы на обслуживание счетов</h4>
                      <p class="tariff-note--block__text">Для продолжения банковского обслуживания на новых условиях просим дать нам ваше согласие.</p>
                      <a class="tariff-note--block__button" href="/chastnym-klientam/bank-service-tariffs/">Дать согласие</a>
                  </div>
              </div>
          </div>
          <script>
              $(document).ready(function() {
                  $('.js-tariff-note-button--click').on('click',
                      function (event) {
                          event.stopPropagation();
                          $('.tariff-note').addClass('tariff-note--win');
                          $('.tariff-note').addClass('js-hover');
                      }
                  );
                  $('.js-tariff-note--block__close').on('click', function () {
                      $('.tariff-note').removeClass('js-hover');
                      $('.tariff-note').removeClass('tariff-note--win');
                  });
                  $('body').on('click', function (event) {
                      if(event.target.classList[0] != 'tariff-note--block__button') {
                          $('.tariff-note').removeClass('js-hover');
                          $('.tariff-note').removeClass('tariff-note--win');
                      }
                  });

                  if(localStorage.getItem('tariff_note_key') !== 'done') {
                      setTimeout(() => {
                          $('.tariff-note').addClass('tariff-note--win');
                          $('.tariff-note').addClass('js-hover');
                      }, 2000);
                      localStorage.setItem('tariff_note_key', 'done');
                  }
              });
          </script>
      </div>

    </div><!-- /.v21-footer__main -->

    <div class="v21-footer__bar">
      <a href="/o-banke/raskrytie-informatsii/">Раскрытие информации АКБ "Трансстройбанк" (АО) как профессионального участника рынка ценных бумаг</a>
      <p>
        <a href="/o-banke/raskrytie-informatsii/#rates-info">Информация о процентных ставках по договорам банковского вклада с физическими лицами</a>
        <br>
        <?/*?><a href="/o-banke/raskrytie-informatsii/?it-security=true">Информационная безопасность</a><?*/?>
        <a href="/o-banke/raskrytie-informatsii/">Информационная безопасность</a>
        <br>
        <a href="/o-banke/litsa-kontroliruyushchie-bank/">Лица, контролирующие Банк</a>
        <br>
        <a href="o-banke/finansovaya-otchetnost/">Финансовая отчетность</a>
        <br>
        <a href="https://fincult.info/">Информация о процедуре внесудебного банкротства</a>
        <br>
      </p>
      <?= GetMessage("C") ?> <?= GetMessage("OGRN") ?><br>
      <?= GetMessage("LICENSE") ?> <?= GetMessage("DATE") ?><br>
    </div><!-- /.v21-footer__bar -->
  </div><!-- /.v21-container -->
</footer><!-- /.v21-footer -->

<div class="popup-form popup-city-form" id="citySelector">
    <? if(CSite::InDir('/chastnym-klientam/obmen-valyut/index.php')) {
        $APPLICATION->IncludeComponent(
            "webtu:city.select.form",
            "city_choice",
            array(
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "IBLOCK_ID" => "114",
                "OFFICE_IBLOCK_ID" => "115"
            )
        );
    } else {
        $APPLICATION->IncludeComponent(
            "webtu:city.select.form",
            "common_city_choice",
            array(
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "IBLOCK_ID" => "114",
                "OFFICE_IBLOCK_ID" => "115"
            )
        );
    }
    ?>
</div>

<div class="popup-form" id="callbackForm">
  <? $APPLICATION->IncludeComponent(
    "webtu:feedback",
    "callback",
    array(
      "AJAX_MODE" => "Y",
      "COMPONENT_TEMPLATE" => "callback",
      "IBLOCK_ID" => "6",
      "PROPERTIES" => array(
        0 => "PHONE",
        1 => "TIME",
        2 => "FOLDER"
      ),
      "ADMIN_EVENT" => "WEBTU_FEEDBACK_CALLBACK",
      "USER_EVENT"  => "NONE",
      "SITES" => array(
        0 => "s1",
      ),
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "AJAX_OPTION_HISTORY" => "N",
      "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
  ); ?>
</div>

<div id="v21_overlay" class="v21-overlay v21-fade js-v21-overlay"></div>
</div>

<? if (!isset($_COOKIE['allowCookie']) || $_COOKIE['allowCookie'] != 'Y') : ?>
  <div class="cookie-policy-container" id="component-cookie-policy" data-days="60">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="cookie-policy">
            <div class="cookie-policy-message">
              <div class="cookie-policy-message-heading">Наш сайт использует cookies</div>
              <p>Этот сайт использует файлы cookie для аналитики, персонализации и рекламы. Продолжая просматривать его, вы соглашаетесь на использование нами файлов cookie.</p>
            </div>
            <button id="js-allow-cookies" data-lang="ru-RU" class="cookie-policy-cta">Ok</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<? endif; ?>

<script type="text/javascript">
  $(document).ready(function() {
    function readCookie(name) {
      var name_cook = name + "=";
      var spl = document.cookie.split(";");
      for (var i = 0; i < spl.length; i++) {
        var c = spl[i];
        while (c.charAt(0) == " ") {
          c = c.substring(1, c.length);
        }
        if (c.indexOf(name_cook) == 0) {
          return c.substring(name_cook.length, c.length);
        }
      }
      return null;
    }

    var url = document.location.pathname + document.location.hash;

    if ((url == "/" || url == "" || url == "/en/") && (readCookie('typeSubMenu') == "corporative_menu" || readCookie('typeSubMenu') == null)) {
      $('a[data-type="corporative_menu"]').addClass('is-active');
      $('ul.private_menu').css('display', 'none');
      $('ul.corporative_menu').css('display', 'flex');
    } else if ((url == "/chastnym-klientam/" || url == "/en/chastnym-klientam/" || (url.indexOf('/chastnym-klientam/') == 0)) && (readCookie('typeSubMenu') == "private_menu" || readCookie('typeSubMenu') == null)) {
      $('a[data-type="private_menu"]').addClass('is-active');
      $('ul.private_menu').css('display', 'flex');
      $('ul.corporative_menu').css('display', 'none');
    } else if (readCookie('typeSubMenu') == "corporative_menu" || readCookie('typeSubMenu') == null) {
      $('ul.private_menu').css('display', 'none');
      $('ul.corporative_menu').css('display', 'flex');
    } else {
      $('ul.private_menu').css('display', 'flex');
      $('ul.corporative_menu').css('display', 'none');
    }

    $("a.v21-header__top-nav-link").each(function() {
      var thisURL = $(this).attr('href');
      if (thisURL == url) $(this).addClass('is-active');
    });

    $("a.v21-header__top-nav-link, a.v21-header__logo").click(function(e) {
      url = $(this).attr('href');
      var typeMenu = $(this).data('type');

      if (typeMenu == "private_menu") {
        $('ul.private_menu').css('display', 'flex');
        $('ul.corporative_menu').css('display', 'none');
      } else if (typeMenu == "corporative_menu") {
        $('ul.private_menu').css('display', 'none');
        $('ul.corporative_menu').css('display', 'flex');
      }

      let dateCookie = new Date(Date.now() + 86400e3);
      dateCookie = dateCookie.toUTCString();
      if (typeMenu == 'corporative_menu' || typeMenu == 'private_menu') document.cookie = "typeSubMenu=" + typeMenu + ";path=/;expires=" + dateCookie;
    });

  });
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
  (function(d, w, c) {
    (w[c] = w[c] || []).push(function() {
      try {
        w.yaCounter49389685 = new Ya.Metrika2({
          id: 49389685,
          clickmap: true,
          trackLinks: true,
          accurateTrackBounce: true,
          webvisor: true
        });
      } catch (e) {}
    });

    var n = d.getElementsByTagName("script")[0],
      s = d.createElement("script"),
      f = function() {
        n.parentNode.insertBefore(s, n);
      };
    s.type = "text/javascript";
    s.async = true;
    s.src = "https://mc.yandex.ru/metrika/tag.js";

    if (w.opera == "[object Opera]") {
      d.addEventListener("DOMContentLoaded", f, false);
    } else {
      f();
    }
  })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript>
  <div><img src="https://mc.yandex.ru/watch/49389685" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-949V3XK6TT"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-949V3XK6TT');
</script>
</body>

</html>
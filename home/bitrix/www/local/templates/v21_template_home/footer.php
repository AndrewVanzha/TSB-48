<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use Bitrix\Main\Page\Asset; ?>
<?// if (!CSite::InDir('/index.php') && !CSite::InDir('/en/index.php') && !CSite::InDir('/chastnym-klientam/index.php') && !CSite::InDir('/en/chastnym-klientam/index.php')) : ?>
<? if (!CSite::InDir('/en/index.php') && !CSite::InDir('/chastnym-klientam/index.php') && !CSite::InDir('/en/chastnym-klientam/index.php')) : ?>
  </div><!-- /.v21-container -->
  </div><!-- /.v21-section -->
<? endif ?>
<? global $USER;
if ($USER->IsAuthorized()) {
    $rsUser = CUser::GetByID($USER->GetID());
    $arUser = $rsUser->Fetch(); // $arUser['ID'] = 107, 111, 249 Волкова
    //echo "<pre>"; print_r($arUser); echo "</pre>";
} ?>

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

                  <div class="v21-footer__entry">
                      <a href="tel:<?= str_replace(' ', '', \GarbageStorage::get('phone_2')); ?>" class="v21-footer__phone"><?= \GarbageStorage::get('phone_2') ?></a>
                      <p class="v21-p"><?= GetMessage("CALL_RUS") ?></p>
                  </div>

                  <div class="v21-footer__entry">
                      <a href="tel:<?= str_replace(' ', '', \GarbageStorage::get('phone_1')); ?>" class="v21-footer__phone"><?= \GarbageStorage::get('phone_1') ?></a>
                      <p class="v21-p"><?= GetMessage("CALL_MOSCOW") ?></p>
                  </div>

                  <div class="v21-footer__entry">
                      <?/*?><h6 class="v21-footer__title"><?= GetMessage("ADRESS") ?></h6><?*/?>
                      <?/*?><p class="v21-p"><?*/?>
                      <h6 class="v21-footer__title">
                          <?
                          if (CSite::InDir('/en/')) {
                              echo \GarbageStorage::get('english_address');
                          } else {
                              echo \GarbageStorage::get('address');
                          }
                          ?>
                      </h6>
                  </div>

                  <?/*?>
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
                    <?*/?>

              </div><!-- /.v21-grid__item -->

              <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">

                  <ul class="v21-footer__nav">

                      <?
                      $prefix = '';
                      if (CSite::InDir('/en/')) {
                          $prefix = '/en';
                      }
                      ?>

                      <?/*?><li class="v21-footer__nav-item">
                        <a href="<?= $prefix ?>/o-banke/" class="v21-footer__nav-link"><?= GetMessage("ABOUT_BANK") ?></a>
                      </li><?*/?>

                      <li class="v21-footer__nav-item">
                          <?/*?><a href="<?= $prefix ?>/" class="v21-footer__nav-link"><?= GetMessage("CORPOPATIVE_CLIENTS") ?></a><?*/?>
                          <a href="<?= $prefix ?>/" class="v21-footer__nav-link">Бизнесу</a>
                      </li>

                      <li class="v21-footer__nav-item">
                          <a href="<?= $prefix ?>/chastnym-klientam/" class="v21-footer__nav-link"><?= GetMessage("PRIVATE_CUSTOMERS") ?></a>
                      </li>

                      <?/* if (!$prefix) { ?>
                    <li class="v21-footer__nav-item">
                        <a href="/chastnym-klientam/finansovaya-gramotnost/" class="v21-footer__nav-link">Финансовая грамотность</a>
                    </li>
                <? }*/ ?>

                      <li class="v21-footer__nav-item">
                          <a href="/arbitrazhnym-upravlyayushchim/" class="v21-footer__nav-link"><?= GetMessage("ARBITRATION_MANAGER") ?></a>
                      </li>

                      <li class="v21-footer__nav-item">
                          <a href="<?= $prefix ?>/finansovym-organizatsiyam/" class="v21-footer__nav-link"><?= GetMessage("FINANCIAL_CLIENTS") ?></a>
                      </li>

                      <??><li class="v21-footer__nav-item">
                          <a href="/obratnaya-svyaz/" class="v21-footer__nav-link"><?= GetMessage("FEEDBACK") ?></a>
                      </li><??>

                      <?/*?><li class="v21-footer__nav-item">
                            <a href="/o-banke/blog/" class="v21-footer__nav-link"><?= GetMessage("BLOG") ?></a>
                        </li><?*/?>

                  </ul><!-- /.v21-footer__nav -->

              </div><!-- /.v21-grid__item -->

              <div class="v21-grid__item v21-grid__item--1x3@lg">
                  <p class="v21-footer__info">
                      <a href="/o-banke/raskrytie-informatsii/">Раскрытие информации АКБ "Трансстройбанк" (АО) как профессионального участника рынка ценных бумаг</a>
                  </p>
                  <p class="v21-footer__info">
                      <a href="/o-banke/raskrytie-informatsii/?it-security=true">Информационная безопасность</a>
                  </p>
                  <p class="v21-footer__info">
                      <a href="/o-banke/litsa-kontroliruyushchie-bank/">Лица, контролирующие Банк</a>
                  </p>
                  <p class="v21-footer__info">
                      <a href="/o-banke/raskrytie-informatsii/#rates-info">Информация о процентных ставках по договорам банковского вклада с физическими лицами</a>
                  </p>
                  <p class="v21-footer__info">
                      <a href="/o-banke/finansovaya-otchetnost/">Финансовая отчетность</a>
                  </p>
                  <p class="v21-footer__info">
                      <a href="https://fincult.info/">Информация о процедуре внесудебного банкротства</a>
                  </p>
                  <p class="v21-footer__info">
                      <a href="/2023/1/booklet_SVO.pdf">Информация о кредитных каникулах для участников СВО</a>
                  </p>

              </div><!-- /.v21-grid__item -->
          </div><!-- /.v21-grid -->

          <div class="v21-grid">
              <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                  <div class="v21-footer__entry">
                      <a href="mailto:tsbank@transstroybank.ru" class="v21-footer__tsbank">tsbank@transstroybank.ru</a>
                      <p class="v21-p">Общая почта</p>
                  </div>
                  <div class="v21-footer__entry">
                      <a href="mailto:client@transstroybank.ru" class="v21-footer__tsbank">client@transstroybank.ru</a>
                      <p class="v21-p">Вопросы и предложения</p>
                  </div>
                  <div class="v21-footer__entry">
                      <a href="mailto:notarius@transstroybank.ru" class="v21-footer__tsbank">notarius@transstroybank.ru</a>
                      <p class="v21-p">Для обращений нотариусов</p>
                  </div>
              </div><!-- /.v21-grid__item -->

              <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg">
                  <div class="v21-grid">
                      <noindex>
                          <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x1@lg">
                              <div class="v21-footer__entry" style="margin-bottom: 22px;">
                                  <h6 class="v21-footer__socials--title"><?= GetMessage("UR_APPLICATION") ?></h6>
                                  <ul class="v21-footer__socials v21-socials">
                                      <li class="v21-socials__item v21-socials__item--app">
                                          <?/*?><a target="_blank" href="https://apps.apple.com/ru/app/%D1%82%D1%80%D0%B0%D0%BD%D1%81%D1%81%D1%82%D1%80%D0%BE%D0%B9%D0%B1%D0%B0%D0%BD%D0%BA-%D0%BC%D0%B1%D0%BA/id1334142386" rel="nofollow" class="v21-socials__link"><?*/?>
                                          <a target="_blank" href="https://apps.apple.com/ru/app/тсб-бизнес-онлайн/id1539911932" rel="nofollow" class="v21-socials__link">
                                              <svg width="36" height="31" class="v21-socials__icon">
                                                  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_icons.svg#appStore"></use>
                                              </svg>
                                              <span>App Store</span>
                                          </a>
                                      </li>

                                      <li class="v21-socials__item v21-socials__item--app">
                                          <?/*?><a target="_blank" href="https://play.google.com/store/apps/details?id=com.bssys.mbcphone.tsb" rel="nofollow" class="v21-socials__link"><?*/?>
                                          <a target="_blank" href="https://play.google.com/store/apps/details?id=com.bssys.mbcphone.tsbank" rel="nofollow" class="v21-socials__link">
                                              <svg width="32" height="36" class="v21-socials__icon">
                                                  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_icons.svg#googlePlay"></use>
                                              </svg>
                                              <span>Google Play</span>
                                          </a>
                                      </li>
                                  </ul><!-- /.v21-footer__socials -->
                              </div><!-- /.v21-footer__entry -->

                              <div class="v21-footer__entry">
                                  <h6 class="v21-footer__socials--title"><?= GetMessage("FIZ_APPLICATION") ?></h6>
                                  <ul class="v21-footer__socials v21-socials">
                                      <li class="v21-socials__item v21-socials__item--app">
                                          <a target="_blank" href="https://play.google.com/store/apps/details?id=com.isimplelab.ibank.tsbank" rel="nofollow" class="v21-socials__link">
                                              <svg width="32" height="36" class="v21-socials__icon">
                                                  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_icons.svg#googlePlay"></use>
                                              </svg>
                                              <span>Google Play</span>
                                          </a>
                                      </li>

                                      <li class="v21-socials__item v21-socials__item--app">
                                          <a target="_blank" href="https://itunes.apple.com/ru/app/id723491575" rel="nofollow" class="v21-socials__link">
                                              <svg width="36" height="31" class="v21-socials__icon">
                                                  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_icons.svg#appStore"></use>
                                              </svg>
                                              <span>App Store</span>
                                          </a>
                                      </li>
                                  </ul><!-- /.v21-footer__socials -->
                              </div><!-- /.v21-footer__entry -->
                          </div><!-- /.v21-grid__item -->
                      </noindex>
                  </div><!-- /.v21-grid -->
              </div><!-- /.v21-grid__item -->

              <div class="v21-grid__item v21-grid__item--1x2@sm v21-grid__item--1x3@lg" style="align-self: flex-end;">
                  <? if($arUser['ID'] == 107 || $arUser['ID'] == 111 || $arUser['ID'] == 249) : // 107, 111, 249 Волкова ?>
                      <div class="v21-footer__entry">
                          <a href="/reports/forms-report/" class="v21-button v21-button--link">Отчет по формам</a>
                      </div>
                  <? endif; ?>
                  <div class="v21-footer__entry" style="margin-bottom: 3px;">
                      <?/*?><p class="v21-p"><?= GetMessage("C") ?> <?= GetMessage("OGRN") ?></p><?*/?>
                      <p class="v21-p" style="color: #202020;"><?= GetMessage("OGRN") ?></p>
                  </div>
                  <div class="v21-footer__entry">
                      <p class="v21-p" style="color: #202020;"><?= GetMessage("LICENSE") ?> <?= GetMessage("DATE") ?></p>
                  </div>
              </div><!-- /.v21-grid__item -->
          </div><!-- /.v21-grid -->


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

          <? if (!CSite::InDir('/inkass.service/') && !CSite::InDir('/verification.service/')) : ?>
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
                              <img src="/images/paper.png" width="57" height="56" alt="иконка документов">
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
          <? endif; ?>

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
      </div><!-- /.v21-footer__main -->
  </div><!-- /.v21-container -->

    <div class="v21-footer__bar">
        <div class="v21-container">
            <div class="v21-grid">
                <div class="v21-grid__item v21-grid__item--1x3@sm v21-grid__item--1x3@lg v21-footer__item">
                    <p class="v21-footer__bar-p">© АКБ «Трансстройбанк» (АО), 2023</p>
                </div>
                <div class="v21-grid__item v21-grid__item--1x3@sm v21-grid__item--1x3@lg v21-footer__item">
                    <div class="v21-footer__bar-grid">
                        <noindex>
                            <ul class="v21-socials">
                                <li class="v21-socials__item">
                                    <a href="https://t.me/tsbnk_ru" target="_blank" rel="nofollow" class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="v21-socials__icon" width="19" height="16" viewBox="0 0 19 16" fill="none">
                                            <path d="M18.4813 1.7663L16.3923 14.3997C16.3555 14.6212 16.2636 14.83 16.1253 15.0069C15.9869 15.1838 15.8063 15.3232 15.6001 15.4122C15.394 15.5013 15.1687 15.5372 14.9451 15.5168C14.7214 15.4963 14.5065 15.42 14.3199 15.295L8.53374 11.3988C8.41571 11.3194 8.31715 11.2142 8.24542 11.0914C8.17369 10.9685 8.13064 10.8309 8.11948 10.6891C8.10832 10.5472 8.12935 10.4047 8.18098 10.2721C8.23262 10.1395 8.31353 10.0202 8.41768 9.92329L13.8888 4.75057C13.9407 4.68858 13.9694 4.61047 13.97 4.52964C13.9706 4.44881 13.943 4.3703 13.8921 4.30757C13.8411 4.24483 13.7699 4.20179 13.6906 4.18582C13.6114 4.16984 13.5291 4.18194 13.4578 4.22003L6.17949 9.09433C5.82878 9.32516 5.43093 9.47473 5.01501 9.5321C4.59908 9.58947 4.1756 9.55319 3.7755 9.42591L0.675177 8.51405C0.564914 8.46672 0.470954 8.38809 0.404928 8.2879C0.338902 8.18771 0.303711 8.07035 0.303711 7.95036C0.303711 7.83037 0.338902 7.71301 0.404928 7.61282C0.470954 7.51262 0.564914 7.434 0.675177 7.38667L10.2414 3.20869L16.1934 0.771546L16.9726 0.473119C17.1621 0.415285 17.3632 0.40624 17.5572 0.44682C17.7511 0.487401 17.9317 0.576295 18.0822 0.705261C18.2326 0.834227 18.3481 0.999091 18.4179 1.18457C18.4876 1.37005 18.5095 1.57014 18.4813 1.7663Z" fill="white"/>
                                        </svg>
                                        <?/*?>
                                      <svg width="37" height="36" class="v21-socials__icon">
                                          <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#tg"></use>
                                      </svg>
                                      <?*/?>
                                    </a>
                                </li>
                                <li class="v21-socials__item">
                                    <a href="https://vk.com/tsbnk" target="_blank" rel="nofollow" class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="v21-socials__icon" width="22" height="14" viewBox="0 0 22 14" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M21.4137 1.2918C21.5625 0.790344 21.4137 0.421875 20.7053 0.421875H18.3628C17.7672 0.421875 17.4926 0.740178 17.3437 1.09117C17.3437 1.09117 16.1525 4.02463 14.4649 5.9301C13.919 6.48167 13.6708 6.65717 13.373 6.65717C13.2241 6.65717 13.0086 6.48167 13.0086 5.98026V1.2918C13.0086 0.690055 12.8357 0.421875 12.3393 0.421875H8.65832C8.28612 0.421875 8.06227 0.701158 8.06227 0.965843C8.06227 1.53628 8.90599 1.66783 8.99296 3.27247V6.7575C8.99296 7.52158 8.85638 7.66011 8.55857 7.66011C7.76446 7.66011 5.8328 4.71355 4.68714 1.34192C4.46262 0.686593 4.23743 0.421875 3.63876 0.421875H1.2963C0.627026 0.421875 0.493164 0.740178 0.493164 1.09117C0.493164 1.718 1.28731 4.82695 4.19084 8.93876C6.12651 11.7468 8.85375 13.269 11.3354 13.269C12.8244 13.269 13.0086 12.9309 13.0086 12.3485V10.2262C13.0086 9.55007 13.1497 9.41513 13.6212 9.41513C13.9686 9.41513 14.5642 9.59063 15.954 10.9445C17.5422 12.5491 17.8041 13.269 18.6974 13.269H21.0399C21.7092 13.269 22.0438 12.9309 21.8508 12.2637C21.6395 11.5987 20.8812 10.634 19.875 9.49033C19.329 8.83847 18.5101 8.13648 18.2619 7.7854C17.9145 7.33416 18.0137 7.13354 18.2619 6.73242C18.2619 6.73242 21.1158 2.67073 21.4137 1.2918Z" fill="white"/>
                                        </svg>
                                        <?/*?>
                                      <svg width="37" height="36" class="v21-socials__icon">
                                          <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_icons.svg#vk"></use>
                                      </svg>
                                      <?*/?>
                                    </a>
                                </li>
                            </ul>
                        </noindex>
                    </div><!-- /.v21-grid -->
                </div>
                <div class="v21-grid__item v21-grid__item--1x3@sm v21-grid__item--1x3@lg v21-footer__item">
                    <a href="/2023/3/confid_policy_2023.docx" class="v21-footer__bar-p" style="display: block;">Политика конфиденциальности</a>
                </div>
            </div>
        </div>
    </div>
</footer><!-- /.v21-footer -->

<div class="popup-form popup-city-form" id="citySelector">
    <? if(CSite::InDir('/chastnym-klientam/obmen-valyut/index.php')) { // код не задействуется
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
        2 => "FOLDER",
        3 => "FROM_WHERE",
        4 => "REQ_URI",
        5 => "UTM_SOURCE",
        6 => "UTM_MEDIUM",
        7 => "UTM_CAMPAIGN",
        8 => "UTM_TERM",
        9 => "UTM_CONTENT"
      ),
      "ADMIN_EVENT" => "WEBTU_FEEDBACK_CALLBACK",
      "USER_EVENT"  => "NONE",
      "SITES" => array(
        0 => "s1",
      ),
      "AJAX_OPTION_JUMP" => "N",
      "AJAX_OPTION_STYLE" => "Y",
      "AJAX_OPTION_HISTORY" => "N",
      "AJAX_OPTION_ADDITIONAL" => "",
      "UTM" => "83",
    ),
    false
  ); ?>
</div>

<div id="v21_overlay" class="v21-overlay v21-fade js-v21-overlay"></div>
</div>

<? if (!isset($_COOKIE['allowCookie']) || $_COOKIE['allowCookie'] != 'Y') : ?>
  <div class="cookie-policy-container" id="component-cookie-policy" data-days="60">
    <div class="container">
      <?/*?><div class="row">
        <div class="col"><?*/?>
          <div class="cookie-policy">
            <div class="cookie-policy-message">
              <?/*?><div class="cookie-policy-message-heading">Наш сайт использует cookies</div><?*/?>
                <div class="cookie-policy-message-heading">COOKIE-файлы</div>
              <?/*?><p>Этот сайт использует файлы cookie для аналитики, персонализации и рекламы. Продолжая просматривать его, вы соглашаетесь на использование нами файлов cookie.</p><?*/?>
              <p>Для повышения удобства сайта мы используем файлы cookies. Оставаясь на сайте, Вы соглашаетесь с политикой их применения.</p>
              <button id="js-allow-cookies" data-lang="ru-RU" class="cookie-policy-cta">Ok</button>
            </div>
          </div>
        <?/*?></div>
      </div><?*/?>
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

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-949V3XK6TT"></script>
<script>
    $(window).on('load', function () {
        setTimeout(function () {
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-949V3XK6TT');
        }, 1500);
    });
    /*
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-949V3XK6TT');
    */
  /*
  // PerformanceObserver который прослушивает неожиданные записи смещений макета layout-shift,
  // группирует их в сеансы и регистрирует максимальное значение сеанса при каждом его изменении
  let clsValue = 0;
  let clsEntries = [];

  let sessionValue = 0;
  let sessionEntries = [];
  new PerformanceObserver((entryList) => {
      for (const entry of entryList.getEntries()) {
          // Only count layout shifts without recent user input.
          if (!entry.hadRecentInput) {
              const firstSessionEntry = sessionEntries[0];
              const lastSessionEntry = sessionEntries[sessionEntries.length - 1];

              // If the entry occurred less than 1 second after the previous entry and
              // less than 5 seconds after the first entry in the session, include the
              // entry in the current session. Otherwise, start a new session.
              if (sessionValue &&
                  entry.startTime - lastSessionEntry.startTime < 1000 &&
                  entry.startTime - firstSessionEntry.startTime < 5000) {
                  sessionValue += entry.value;
                  sessionEntries.push(entry);
              } else {
                  sessionValue = entry.value;
                  sessionEntries = [entry];
              }

              // If the current session value is larger than the current CLS value,
              // update CLS and the entries contributing to it.
              if (sessionValue > clsValue) {
                  clsValue = sessionValue;
                  clsEntries = sessionEntries;

                  // Log the updated value (and its entries) to the console.
                  console.log('CLS:', clsValue, clsEntries)
              }
          }
      }
  }).observe({type: 'layout-shift', buffered: true});
  */
</script>
</body>

</html>
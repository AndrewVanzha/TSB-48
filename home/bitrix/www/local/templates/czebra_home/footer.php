<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?use Bitrix\Main\Page\Asset;?>
</div>
</main>
<footer class="footer">
<div class="page-bottom" style="background-image: url(/local/templates/.default/img/page-bottom.jpg);">
    <?$APPLICATION->IncludeComponent("webtu:feedback", ".default", array(
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
    		"FOLDER" => $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]
    	),
    	false,
    	array(
    	   "ACTIVE_COMPONENT" => "N"
    	)
    );?>
    <?if (!CSite::InDir('/index.php')):?>
    <div class="footer-top">
        <div class="page-container clearfix">
            <div class="footer-top_logo">
                <?
                if(CSite::InDir('/en/')){
                    $footerLink = "/en/";
                    $footerLogo = "/local/templates/.default/img/english-logo.svg";
                } else {
                    $footerLink = "/";
                    $footerLogo = "/local/templates/czebra_home/img/logo.svg";
                }
                ?>
                <a href="<?=$footerLink?>" class="aligner">
                    <img src="<?=$footerLogo?>" alt="АКБ «Трансстройбанк»" />
                </a>
            </div>

            <div class="footer-top_phone">
                <div class="aligner">
                    <a href="tel:<?=\GarbageStorage::get('phone_2')?>" class="number mi--phone-3 mi">
                        <?=\GarbageStorage::get('phone_2')?>
                    </a>
                    <span class="note"><?=GetMessage("FREE_CALL")?></span>
                </div>
            </div>
        </div>
    </div>
    <?endif;?>
    

    <div class="footer-middle">
        <div class="page-container">
            <div class="clearfix">
                <div class="footer-middle_column">
                    <h6 class="page-title--5 page-title">
                        <a href="<?if(CSite::InDir('/en/'))echo '/en'?>/o-banke/"><?=GetMessage("ABOUT_BANK")?></a>
                    </h6>

                    <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", array(
                        "ROOT_MENU_TYPE" => "bottom-1",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "bottom-1",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "Y",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    ));?>
                </div>

                <div class="footer-middle_column">
                    <h6 class="page-title--5 page-title">
                        <a href="<?if(CSite::InDir('/en/'))echo '/en'?>/chastnym-klientam/"><?=GetMessage("PRIVATE_CUSTOMERS")?></a>
                    </h6>

                    <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", array(
                        "ROOT_MENU_TYPE" => "bottom-2",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "bottom-2",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "Y",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    ));?>
                </div>

                <div class="footer-middle_column">
                    <h6 class="page-title--5 page-title">
                        <a href="<?if(CSite::InDir('/en/'))echo '/en'?>/corporative-clients/"><?=GetMessage("CORPOPATIVE_CLIENTS")?></a>
                    </h6>

                    <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", array(
                        "ROOT_MENU_TYPE" => "bottom-3",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "bottom-3",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "Y",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    ));?>

                    <h6 class="page-title--5 page-title">
                        <a href="<?if(CSite::InDir('/en/'))echo '/en'?>/finansovym-organizatsiyam/"><?=GetMessage("FINANCIAL_CLIENTS")?></a>
                    </h6>

                    <?$APPLICATION->IncludeComponent("bitrix:menu", "footer", array(
                        "ROOT_MENU_TYPE" => "bottom-4",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "bottom-4",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "Y",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    ));?>
                </div>

                <div class="footer-middle_column">
                    <h6 class="page-title--5 page-title"><?=GetMessage("LOCATION")?></h6>

                    <p class="address">
                        <?
                        if(CSite::InDir('/en/')){
                            echo \GarbageStorage::get('english_address');
                        } else {
                            echo \GarbageStorage::get('address');
                        }
                        ?>
                    </p>

                    <p class="work-time">
                        <?
                        if(CSite::InDir('/en/')){
                            echo \GarbageStorage::get('english_time');
                        } else {
                            echo \GarbageStorage::get('time');
                        }
                        ?>
                    </p>

                    <p class="phone">
                        <a href="tel:<?=\GarbageStorage::get('phone_1')?>" class="callback-toggle"><?=\GarbageStorage::get('phone_1')?></a>
                    </p>

                    <p class="phone">
                        <a href="tel:<?=\GarbageStorage::get('phone_2')?>"><?=\GarbageStorage::get('phone_2')?></a>
                    </p>

                    <p class="email">
                        <a href="mailto:<?=\GarbageStorage::get('email_1')?>"><?=\GarbageStorage::get('email_1')?></a>
                    </p>

                    <p class="email">
                        <a href="mailto:<?=\GarbageStorage::get('email_2')?>"><?=\GarbageStorage::get('email_2')?></a>
                        <span><?=GetMessage("ISSUES")?></span>
                    </p>

					<p class="email">
                        <a href="mailto:notarius@transstroybank.ru">notarius@transstroybank.ru</a>
                        <span>(для обращений нотариусов)</span>
                    </p>


					
					<p>
						<a href="/obratnaya-svyaz/" style="color:#fff;">Обратная связь</a>
					</p>

                    <ul class="sns clearfix">
                        <?/*<li><a href="#" class="si--ok si"></a></li>*/?>
                        <li><noindex><a href="https://www.facebook.com/tsbnk.ru" class="si--fb si" target="_blank" rel="nofollow"></a></noindex></li>
                        <li><noindex><a href="https://vk.com/coins.tsbnk" class="si--vk si" target="_blank" rel="nofollow"></a></noindex></li>
                        <?/*<li><noindex><a href="https://www.instagram.com/tsbnk.ru/" class="si--yt si" target="_blank" rel="nofollow"></a></li>*/?>
                    </ul>
                </div>
            </div>

            <a href="/o-banke/raskrytie-informatsii" style="position:relative;top:-10px;color:#fff;">Раскрытие информации АКБ "Трансстройбанк" (АО) как профессионального участника рынка ценных бумаг</a>
            <p>
              <a href="/o-banke/raskrytie-informatsii/#rates-info" style="position:relative;top:-10px;color:#fff;">Информация о процентных ставках по договорам банковского вклада с физическими лицами</a>
			  <br>
              <a href="/o-banke/raskrytie-informatsii/?it-security=true" style="position:relative;top:-10px;color:#fff;">Информационная безопасность</a>
			  <br>
              <a href="/o-banke/litsa-kontroliruyushchie-bank/" style="position:relative;top:-10px;color:#fff;">Лица, контролирующие Банк</a>
			  <br>
              <a href="/finansovaya-gramotnost/Finliteracy.php" style="position:relative;top:-10px;color:#fff;">Финансовая грамотность</a>
                          <br>
               <a href="https://fincult.info/" style="position:relative;top:-10px;color:#fff;">Информация о процедуре внесудебного банкротства</a>
                          <br>
			</p>

            <div class="footer-middle_bottom clearfix">

                <div class="note">
                    <?=GetMessage("LICENSE")?>
                    <br />
                    <?=GetMessage("DATE")?>
                </div>

                <noindex><div class="store-links">
                    <a target="_blank" href="https://play.google.com/store/apps/details?id=com.isimplelab.ibank.tsbank" rel="nofollow">
                        <img src="/local/templates/.default/img/google-store.png" alt="Google Play">
                    </a>
                    <a target="_blank" href="https://itunes.apple.com/ru/app/id723491575" rel="nofollow">
                        <img src="/local/templates/.default/img/app-store.png" alt="Apple Store">
                    </a>
                </div></noindex>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="page-container clearfix">
            <div class="copyright">
                <div class="aligner">
                    <?=GetMessage("C")?>
                    <br />
                    <?=GetMessage("OGRN")?>
                </div>
            </div>

            <div class="site-map-link">
                <a href="/karta-sayta/" class="aligner">
                    <?=GetMessage("MAP_SITE")?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="popup-form" id="citySelector">
    <?$APPLICATION->IncludeComponent(
        "webtu:city.select.form",
        "",
        Array(
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
    );?>
</div>

<div class="popup-form" id="callbackForm">
    <?$APPLICATION->IncludeComponent(
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
    );?>
</div>

<!-- Scripts -->
<? Asset::getInstance()->addJs("/local/templates/.default/js/vendor/jquery.min.js"); ?>
<? Asset::getInstance()->addJs("/local/templates/.default/fancybox/jquery.fancybox.min.js"); ?>
<? Asset::getInstance()->addJs("/local/templates/.default/jqueryui/jquery-ui.min.js"); ?>
<? Asset::getInstance()->addJs("/local/templates/.default/owlcarousel/owl.carousel.min.js"); ?>
<? Asset::getInstance()->addJs("/local/templates/.default/js/vendor/jquery.customSelect.min.js"); ?>
<? Asset::getInstance()->addJs("/local/templates/.default/js/vendor/jquery.maskedinput.min.js"); ?>
<? Asset::getInstance()->addJs("/local/templates/.default/js/vendor/wow.min.js"); ?>
<? Asset::getInstance()->addJs("/local/templates/.default/js/vendor/packery.pkgd.min.js"); ?>
<? Asset::getInstance()->addJs("/local/templates/.default/js/plugins.js"); ?>
<? Asset::getInstance()->addJs("/local/templates/.default/js/main.js"); ?>
<? Asset::getInstance()->addJs("/local/templates/.default/js/m.vlaznev.js"); ?>

<? Asset::getInstance()->addJs("/local/templates/czebra_home/js/init.js"); ?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter49389685 = new Ya.Metrika2({
                    id:49389685,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/49389685" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</footer>
</div>

<?if (!isset($_COOKIE['allowCookie']) || $_COOKIE['allowCookie'] != 'Y'):?>
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
<?endif;?>

</body>
</html>
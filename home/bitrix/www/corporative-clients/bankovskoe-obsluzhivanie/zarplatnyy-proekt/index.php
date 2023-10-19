<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "«Зарплатный проект», предлагаемой АКБ «Трансстройбанк» (АО), станет для Вас одним из наиболее конструктивных шагов по развитию Вашего бизнеса. Обусловлено это сразу несколькими причинами, т.к. данная услуга избавит Вас от рисков, сопряженных с денежно-наличными расчетами при выплате ежемесячной заработной платы и/или иных социальных выплат");
$APPLICATION->SetPageProperty("keywords", "Зарплатный проект АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("title", "Зарплатный проект | АКБ «ТрансСтройБанк»");
$APPLICATION->SetTitle("Зарплатный проект");
Asset::getInstance()->addCss("/assets/css/style-broker-deposit.css?v=1.0.6");
Asset::getInstance()->addCss("/corporative-clients/bankovskoe-obsluzhivanie/zarplatnyy-proekt/style.css");
Asset::getInstance()->addJs("/corporative-clients/bankovskoe-obsluzhivanie/zarplatnyy-proekt/script.js");
?><div class="page-lf">
	<div class="container">
 <section class="zp-main">
		<div class="zp-main__header">
            <h1 class="v21-h1-new zp-main__title">Зарплатный проект</h1>
            <?/*?><h2 class="zp-main__title page-title">Зарплатный проект</h2><?*/?>
			<div class="zp-main__description offset-md-3 col-md-6">
				 Бесплатное подключение и выпуск зарплатных карт
			</div>
		</div>
		<div class="row">
			<div class="zp-main__image col-md-8">
 <img alt="Инвестиции в драгоценные металлы" src="image/main.png">
			</div>
			<div class="zp-main__info col-md-4 col-lg-3">
				<div class="zp-main__row">
					<div class="zp-main__label">
						 Быстро
					</div>
					 Начисление заработной платы сотрудникам «день в день»
				</div>
				<div class="zp-main__row">
					<div class="zp-main__label">
						 Всё онлайн
					</div>
					 Меньше документов, кассовых операций и нагрузки на бухгалтера
				</div>
				<div class="zp-main__row">
					<div class="zp-main__label">
						 С доставкой
					</div>
					 По вашему желанию доставим карты в офис
				</div>
			</div>
		</div>
    </section>
    <section class="zp-advantages">
		<div class="row">
			<div class="zp-advantages__info">
				<div class="zp-advantages__header">
					<h2 class="zp-advantages__title">Преимущества проекта</h2>
				</div>
			</div>
			<div class="zp-advantages__list">
				<div class="row">
					<div class="zp-advantages__item col-sm-6 col-md-4">
						<div class="zp-advantages__icon">
                            <img src="image/ad_1.svg">
						</div>
						<div class="zp-advantages__name">0 ₽ за карты</div>
						<div class="zp-advantages__desc">
							 Сотрудники бесплатно могут оформить до 2-х дополнительных карт
						</div>
					</div>
					<div class="zp-advantages__item col-sm-6 col-md-4">
						<div class="zp-advantages__icon">
                            <img src="image/ad_2.svg">
						</div>
						<div class="zp-advantages__name">Проценты на остаток</div>
                        <span class="zp-advantages__name--index js--zp-advantages__name--index" data-item="1">
                            <svg width="18" height="18" class="v21-safe-info__icon">
                                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#info"></use>
                            </svg>
                        </span>
						<div class="zp-advantages__desc">
							 Начисляем до 6% на остаток по карточному счету
						</div>
					</div>
					<div class="zp-advantages__item col-sm-6 col-md-4">
						<div class="zp-advantages__icon">
                            <img src="image/ad_3.svg">
						</div>
						<div class="zp-advantages__name">Кэшбэк</div>
                        <div class="zp-advantages__desc"> <a href="#zp-advantages__name--tariffs" class="js-zp-cards__text">Вернём</a> до 1,5% деньгами, а не баллами</div>
					</div>
					<div class="zp-advantages__item col-sm-6 col-md-4">
						<div class="zp-advantages__icon">
                            <img src="image/ad_4.svg">
						</div>
						<div class="zp-advantages__name">Наличные без комиссии</div>
						<div class="zp-advantages__desc">
							 Бесплатное снятие наличных в сети банка и банков-партнеров (более 3 000 устройств по России), а также в банкоматах сторонних банков до 3-х операций в месяц
						</div>
					</div>
					<div class="zp-advantages__item col-sm-6 col-md-4">
						<div class="zp-advantages__icon">
                            <img src="image/ad_5.svg">
						</div>
						<div class="zp-advantages__name">Пополнение на сайте</div>
						 <?/*?><div class="zp-advantages__desc">Пополнение с карт других банков на <a href="https://card2card.intervale.ru/transstroybank/" target="_blank">сайте</a> без комиссии</div><?*/?>
						<div class="zp-advantages__desc">
							 Пополнение с карт других банков на <a href="/chastnym-klientam/platezhi-i-perevody" target="_blank">сайте</a>
						</div>
					</div>
					<div class="zp-advantages__item col-sm-6 col-md-4">
						<div class="zp-advantages__icon">
                            <img src="image/ad_6.svg">
						</div>
						<div class="zp-advantages__name">Переводы по номеру телефона</div>
						<div class="zp-advantages__desc">
							 Мгновенные межбанковские переводы по номеру телефона через Систему быстрых платежей – до 100 000 ₽ бесплатно
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>

        <section class="zp-advantages__item--popup" data-item="1">
            <div class="zp-advantages__item--popup-detail">
                6 % на остаток по картсчету, но не более 3000 руб., если ежедневный остаток на картсчете и сумма всех покупок по банковским картам, выпущенным к картсчету, за календарный месяц равны или превышают 10 000 руб. Подробности <a href="#zp-advantages__name--tariffs" class="js--zp-advantages__name--tariffs">в Тарифах</a>
            </div>
            <div class="zp-advantages__item--popup-close js-zp-advantages__item--popup-close">
                <svg width="20" height="20">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-icons.svg#close"></use>
                </svg>
            </div>
        </section>

        <script>
            $(document).ready(function () {
                const specialFadeIn = (el, timeout, display) => {
                    el.style.opacity = 0;
                    el.style.transition = `opacity ${timeout}ms`;
                    setTimeout(() => {
                        el.style.opacity = 1;
                    }, 10);
                };

                const specialFadeOut = (el, timeout) => {
                    el.style.opacity = 1;
                    el.style.transition = `opacity ${timeout}ms`;
                    el.style.opacity = 0;
                };

                let toggleFlag = [];
                let indexArr = document.querySelectorAll('.js--zp-advantages__name--index');
                indexArr.forEach((item, index) => {
                    item.style.setProperty('left', $(item.previousElementSibling).text().length * 12.5 + 'px');
                    toggleFlag.push(true);
                });

                const delayShow = 1000;
                let popupsArr = document.querySelectorAll('.zp-advantages__item--popup');
                $('.js--zp-advantages__name--index').on('click', function () {  // отработка i
                        let $this = $(this);
                        let coord = $this.offset();
                        let window_width = $(window).width();
                        let popup_infobox_width = $(popupsArr[0]).width();
                        let data_item = $this.data('item');

                        popupsArr.forEach((item, index) => {
                            $(item).removeClass('zp-advantages__item--popup__show');
                            if($(item).data('item') == data_item) {
                                item.style.top = (coord.top + 50) + 'px';
                                if(popup_infobox_width < (window_width - coord.left)) { // вывожу справа от
                                    item.style.left = (coord.left + 5) + 'px';
                                }
                                else {
                                    if(popup_infobox_width < (coord.left)) { // вывожу слева от
                                        item.style.left = (coord.left - popup_infobox_width - 5) + 'px';
                                    }
                                    else {  // вывожу посередине экрана
                                        item.style.left = (window_width - popup_infobox_width) / 2 + 'px';
                                    }
                                }
                                $(item).addClass('zp-advantages__item--popup__show');
                                specialFadeIn(item, delayShow);
                            }
                        });

                    }
                );

                $('.zp-advantages__item--popup-close').click((el) => {
                    specialFadeOut(el.currentTarget.parentElement, delayShow);
                    setTimeout(() => {
                        el.currentTarget.parentElement.classList.remove('zp-advantages__item--popup__show') ;
                        popupsArr.forEach((item, index) => {
                            $(item).removeClass('zp-advantages__item--popup__show');
                        });
                    }, delayShow);
                });

                $('.js--zp-advantages__name--tariffs').on('click', function() {
                    let href = $(this).attr('href');
                    $('html, body').animate({
                        scrollTop: $(href).offset().top - 220
                    }, {
                        duration: 800,   // по умолчанию «400»
                        easing: "linear" // по умолчанию «swing»
                    });
                    return false;
                });
            });
        </script>

        <section class="zp-cards">
		<div class="row">
			<div class="zp-cards__header col-md-6 offset-md-3">
                <img src="image/hr.svg" alt="">
				<h2 class="zp-cards__title">Сотрудникам организаций предоставляются банковские карты платежных систем Visa или Мир</h2>
			</div>
		</div>
		<div class="row">
			<div class="zp-cards__image col-md-5">
                <img src="image/background-card.png" class="zp-cards__background"> <img alt="Мир Классическая" src="image/card-mir.png" id="zp-mir-image" data-zp-card-active="true"> <img alt="Visa Gold" src="image/card-visa-gold.png" id="zp-gold-image" data-zp-card-active="false"> <img alt="Visa Platinum" src="image/card-visa-platinum.png" id="zp-platinum-image" data-zp-card-active="false">
			</div>
			<div class="zp-cards__info col-md-7">
				<div class="zp-cards__tabs">
					<div class="zp-cards__tab zp-cards__tab--active" data-zp-card="zp-mir">
						 Мир Классическая
					</div>
					<div class="zp-cards__tab" data-zp-card="zp-gold">
						 Visa Gold
					</div>
					<div class="zp-cards__tab" data-zp-card="zp-platinum">
						 Visa Platinum
					</div>
				</div>
				<div class="zp-cards__table" id="zp-mir" data-zp-card-active="true">
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 1. Цена
						</div>
						<div class="zp-cards__text">
							 Бесплатное годовое обслуживание и выпуск карты
						</div>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 2. Оповещения
						</div>
						<div class="zp-cards__text">
							 СМС-информирование - 59 руб. в месяц
						</div>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 3. Специальные предложения
						</div>
						<div class="zp-cards__text">
							 Кэшбэк до 20 % за покупки у партнеров
						</div>
                         <a href="https://privetmir.ru" target="_blank" class="zp-cards__link"> <img src="image/info.svg" alt=""> </a>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 4. Зачисления
						</div>
						<div class="zp-cards__text">
							 Банковская карта для социальных и пенсионных выплат
						</div>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 5. Платежи
						</div>
						<div class="zp-cards__text">
							 Оплата покупок по бесконтактной технологии
						</div>
					</div>
				</div>
				<div class="zp-cards__table" id="zp-gold" data-zp-card-active="false">
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 1. Цена
						</div>
						<div class="zp-cards__text">
							 Бесплатный выпуск, обслуживание - 800 руб в год
						</div>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 2. Оповещения
						</div>
						<div class="zp-cards__text">
							 СМС-информирование - 59 ₽ в месяц
						</div>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 3. Поддержка
						</div>
						<div class="zp-cards__text">
							 Круглосуточная служба клиентской поддержки по телефону на обороте карты
						</div>
                        <a href="https://www.transstroybank.ru/zagruzka/%D0%B2%D0%BA%D0%BB%D0%B0%D0%B4%D1%8B/ISOS.pdf" target="_blank" class="zp-cards__link"> <img src="image/info.svg" alt=""> </a>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 4. Специальные предложения
						</div>
                        <?/*?><div class="zp-cards__text">Кэшбэк деньгами, а не баллами <a href="https://www.transstroybank.ru/chastnym-klientam/cashback/">(программа лояльности банка)</a></div><?*/?>
                        <div class="zp-cards__text">Кэшбэк деньгами, а не баллами <a href="#zp-advantages__name--tariffs" class="js-zp-cards__text">(программа лояльности банка)</a></div>
                        <a href="https://www.visa.com.ru/pay-with-visa/visa-offers-and-perks.html" target="_blank" class="zp-cards__link"> <img src="image/info.svg" alt=""> </a>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 5. Платежи
						</div>
						<div class="zp-cards__text">
							 Возможность оплаты покупок в одно касание картой с помощью бесконтактной технологии
						</div>
					</div>
				</div>
				<div class="zp-cards__table" id="zp-platinum" data-zp-card-active="false">
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 1. Цена
						</div>
						<div class="zp-cards__text">
							 Бесплатный выпуск, обслуживание - 1 300 ₽ в год
						</div>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 2. Оповещения
						</div>
						<div class="zp-cards__text">
							 Бесплатное СМС-информирование
						</div>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 3. Поддержка
						</div>
						<div class="zp-cards__text">
							 Круглосуточная служба клиентской поддержки по телефону на обороте карты
						</div>
 <a href="https://www.transstroybank.ru/zagruzka/%D0%B2%D0%BA%D0%BB%D0%B0%D0%B4%D1%8B/ISOS.pdf" target="_blank" class="zp-cards__link"> <img src="image/info.svg" alt=""> </a>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 4. Страхование
						</div>
						<div class="zp-cards__text">
							 Страхование владельца карты в путешествиях (покрытие до € 30 000), Защита покупок и Расширенная гарантия
						</div>
                        <a href="https://www.transstroybank.ru/zagruzka/%D0%97%D0%B0%D1%89%D0%B8%D1%82%D0%B0%20%D0%BF%D0%BE%D0%BA%D1%83%D0%BF%D0%BE%D0%BA%20%D0%B8%20%D0%A0%D0%B0%D1%81%D1%88%D0%B8%D1%80%D0%B5%D0%BD%D0%BD%D0%B0%D1%8F%20%D0%B3%D0%B0%D1%80%D0%B0%D0%BD%D1%82%D0%B8%D1%8F.pdf" target="_blank" class="zp-cards__link"> <img src="image/info.svg" alt=""> </a>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 5. Специальные предложения
						</div>
                        <?/*?><div class="zp-cards__text">Кэшбэк деньгами, а не баллами <a href="https://www.transstroybank.ru/chastnym-klientam/cashback/">(программа лояльности банка)</a></div><?*/?>
                        <div class="zp-cards__text">Кэшбэк деньгами, а не баллами <a href="#zp-advantages__name--tariffs" class="js-zp-cards__text">(программа лояльности банка)</a></div>
                        <a href="https://www.visa.com.ru/pay-with-visa/visa-offers-and-perks.html" target="_blank" class="zp-cards__link"> <img src="image/info.svg" alt=""> </a>
					</div>
					<div class="zp-cards__row">
						<div class="zp-cards__label">
							 6. Платежи
						</div>
						<div class="zp-cards__text">
							 Возможность оплаты покупок в одно касание картой с помощью бесконтактной технологии
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>

    <script>
        $(document).ready(function () {
            $('.js-zp-cards__text').on('click', function() {
                let href = $(this).attr('href');
                //let type = $(this).data('item');
                $('html, body').animate({
                    scrollTop: $(href).offset().top - 220
                }, {
                    duration: 800,   // по умолчанию «400»
                    easing: "linear" // по умолчанию «swing»
                });
                return false;
            });
        });
    </script>

    <section class="zp-online">
		<div class="row">
			<div class="zp-online__info col-10 col-md-5 offset-1">
				<div class="zp-online__header">
					<h2 class="zp-online__title">Бесплатное подключение интернет-банка ТСБ-Онлайн</h2>
				</div>
				<div class="zp-online__description">
					 Пользуйтесь всеми сервисами банка на сайте или в мобильном приложении
				</div>
				<div class="zp-online__buttons">
 <a class="zp-online__button" href="https://itunes.apple.com/ru/app/id723491575" target="_blank"> <img alt="iOS" src="image/ios.svg">
					App Store </a> <a class="zp-online__button" href="https://play.google.com/store/apps/details?id=com.isimplelab.ibank.tsbank" target="_blank"> <img alt="Google Play" src="image/ga.svg">
					Google Play </a>
				</div>
			</div>
			<div class="zp-online__image col-md-5 d-none d-md-block">
 <img src="image/zp-online.png" alt="">
			</div>
		</div>
 </section> <section class="zp-form">
		<div class="zp-form__header">
			<h2 class="zp-form__title page-title">Простое оформление</h2>
		</div>
		<div class="row">
			<div class="zp-form__steps offset-md-1 col-md-10">
				<div class="row">
					<div class="zp-form__step col-sm-4">
						<div class="zp-form__step-icon">
 <img src="image/step-icon.svg" alt="">
							1
						</div>
						<div class="zp-form__step-desc">
							 Предоставляете пакет учредительных документов (если нет расчётного счёта в банке)
						</div>
					</div>
					<div class="zp-form__step col-sm-4">
						<div class="zp-form__step-icon">
 <img src="image/step-icon.svg" alt="">
							2
						</div>
						<div class="zp-form__step-desc">
							 Указываете размер фонда оплаты труда и количество сотрудников
						</div>
					</div>
					<div class="zp-form__step col-sm-4">
						<div class="zp-form__step-icon">
 <img src="image/step-icon.svg" alt="">
							3
						</div>
						<div class="zp-form__step-desc">
							 Заключаем договор и выпускаем карты
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="zp-form__subtitle">
			 Заявка на зарплатный проект
		</div>
		<div class="row">
			<div class="zp-form__wrapper offset-md-3 col-md-6">
				 <?$APPLICATION->IncludeComponent(
	"webtu:feedback",
	"salary_project-new",
	Array(
		"ADMIN_EVENT" => "WEBTU_FEEDBACK_SALARY_PROJECT_ADMIN",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
		"IBLOCK_ID" => "34",
		"POST_CALLBACK" => function($post){return$post;},
        //"PROPERTIES" => array("PHONE","EMAIL","NAME"),
        "PROPERTIES" => array("PHONE","COMPANY_NAME","COMPANY_INN","NAME","EMAIL","CITY","FOLDER","REQ_URI","FROM_WHERE","UTM_SOURCE","UTM_MEDIUM","UTM_CAMPAIGN","UTM_TERM","UTM_CONTENT"),
        "SITES" => array("s1"),
        "USER_EVENT" => "WEBTU_FEEDBACK_SALARY_PROJECT_USER",
        "UTM" => "111",
	)
);?>
			</div>
		</div>
    </section>
    <section class="zp-delivery">
            <div class="zp-delivery__header">
                <h2 class="zp-delivery__title page-title">Доставим карты в ваш офис</h2>
            </div>
            <div class="zp-delivery__images">
                <img src="image/delivery.png" alt="">
            </div>
    </section>
    <section class="zp-docs">
            <div class="zp-docs__header">
                <h2 class="zp-docs__title page-title">Документы</h2>
            </div>
		<div class="zp-docs__list" id="zp-advantages__name--tariffs">
			<div class="row">
				 <?$APPLICATION->IncludeComponent(
                     "bitrix:news.detail",
                     "documents-type-1",
                     Array(
                         "ACTIVE_DATE_FORMAT" => "d.m.Y",
                         "ADD_ELEMENT_CHAIN" => "N",
                         "ADD_SECTIONS_CHAIN" => "N",
                         "AJAX_MODE" => "N",
                         "AJAX_OPTION_ADDITIONAL" => "",
                         "AJAX_OPTION_HISTORY" => "N",
                         "AJAX_OPTION_JUMP" => "N",
                         "AJAX_OPTION_STYLE" => "Y",
                         "BROWSER_TITLE" => "-",
                         "CACHE_GROUPS" => "Y",
                         "CACHE_TIME" => "36000000",
                         "CACHE_TYPE" => "A",
                         "CHECK_DATES" => "Y",
                         "DETAIL_URL" => "",
                         "DISPLAY_BOTTOM_PAGER" => "N",
                         "DISPLAY_DATE" => "Y",
                         "DISPLAY_NAME" => "Y",
                         "DISPLAY_PICTURE" => "Y",
                         "DISPLAY_PREVIEW_TEXT" => "Y",
                         "DISPLAY_TOP_PAGER" => "N",
                         "ELEMENT_CODE" => "",
                         "ELEMENT_ID" => "9090",
                         "FIELD_CODE" => array("",""),
                         "IBLOCK_ID" => "189",
                         "IBLOCK_TYPE" => "ls_documents",
                         "IBLOCK_URL" => "",
                         "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                         "MESSAGE_404" => "",
                         "META_DESCRIPTION" => "-",
                         "META_KEYWORDS" => "-",
                         "PAGER_BASE_LINK_ENABLE" => "N",
                         "PAGER_SHOW_ALL" => "N",
                         "PAGER_TEMPLATE" => ".default",
                         "PAGER_TITLE" => "Страница",
                         "PROPERTY_CODE" => array("","DOCUMENTS","CLASSES"),
                         "SET_BROWSER_TITLE" => "N",
                         "SET_CANONICAL_URL" => "N",
                         "SET_LAST_MODIFIED" => "N",
                         "SET_META_DESCRIPTION" => "N",
                         "SET_META_KEYWORDS" => "N",
                         "SET_STATUS_404" => "N",
                         "SET_TITLE" => "N",
                         "SHOW_404" => "N",
                         "STRICT_SECTION_CHECK" => "N",
                         "USE_PERMISSIONS" => "N",
                         "USE_SHARE" => "N"
                     )
                 );?>
			</div>
		</div>
		<div class="zp-docs__all">
 <a href="/arkhiv-tarifov-i-dokumentov/zarplatnyy-proekt/">Архив тарифов и документов</a>
		</div>
 </section>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
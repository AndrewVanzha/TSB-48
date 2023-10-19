<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Расчетно-кассовое обслуживание АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("description", "Открытие банковского счета в АКБ «ТрансСтройБанк» – гарантия надежности и оперативности совершения операций. Услуги по расчетно-кассовому обслуживанию на выгодных условиях.");
$APPLICATION->SetTitle("Расчетно-кассовое обслуживание");
Asset::getInstance()->addCss("/assets/css/style-broker-deposit.css?v=1.0.6");
Asset::getInstance()->addCss("/corporative-clients/bankovskoe-obsluzhivanie/raschetno-kassovoe-obsluzhivanie/style.css");
Asset::getInstance()->addJs("/corporative-clients/bankovskoe-obsluzhivanie/raschetno-kassovoe-obsluzhivanie/script.js");
?>
<div class="page-lf">
    <div class="container">
        <section class="rko-banner row">
            <div class="rko-banner__info col-md-6">
                <header class="rko-banner__header">
                    <h2 class="rko-banner__title page-title">Откройте счёт без посещения банка</h2>
                </header>
                <div class="rko-banner__steps">
                    <div class="rko-banner__step">Подайте онлайн-заявку</div>
                    <div class="rko-banner__step">Получите документы курьером</div>
                    <div class="rko-banner__step">Принимайте платежи</div>
                </div>
                <h3 class="v21-h3 rko-banner__anno">* Воспользоваться сервисом дистанционного открытия счета возможно только в браузере Yandex</h3>
                <a href="https://rezervscheta.transstroybank.ru/sa/reg" class="rko-banner__button" target="_blank">Открыть счёт</a>

<?
//debugg($arResult["ITEMS"]);
global $USER;
if($USER->GetID() == 107) :
//if(true) :
?>
<!--a href="https://193.42.145.78:48521/sa/reg" class="rko-banner__button" target="_blank">Открыть счёт в тестовом режиме</a-->
<a href="https://193.42.145.78/sa/reg" class="rko-banner__button" target="_blank">Открыть счёт в тестовом режиме</a>
<a href="https://193.42.145.78/login" class="rko-banner__button" target="_blank">Войти в лк в тестовом режиме</a>
<? endif;?>

            </div>
            <div class="rko-banner__image col-md-6">
				<a href="https://rezervscheta.transstroybank.ru/login" class="rko-banner__auth" target="_blank">Войти в личный кабинет</a>
                <img src="images/rko-banner.png" alt="Откройте счёт без посещения банка">
            </div>
        </section>
        <section class="rko-free-services">
            <header class="rko-free-services__header">
                <h3 class="rko-free-services__title page-title">Бесплатно для любых тарифов</h3>
            </header>
            <div class="rko-free-services__items row">
                <div class="rko-free-services__item col-sm-6 col-md-4 row">
                    <div class="rko-free-services__image col-sm-5">
                        <img src="images/open_bill.svg" alt="Открытие счёта">
                    </div>
                    <div class="rko-free-services__name col-sm-7">Открытие счёта</div>
                </div>
                <div class="rko-free-services__item col-sm-6 col-md-4 row">
                    <div class="rko-free-services__image col-sm-5">
                        <img src="images/add_online_bank.svg" alt="Подключение онлайн-банка">
                    </div>
                    <div class="rko-free-services__name col-sm-7">Подключение онлайн-банка</div>
                </div>
                <div class="rko-free-services__item col-sm-6 col-md-4 row">
                    <div class="rko-free-services__image col-sm-5">
                        <img src="images/inside_payments.svg" alt="Внутрибанковские платежи">
                    </div>
                    <div class="rko-free-services__name col-sm-7">Внутрибанковские платежи</div>
                </div>
            </div>
        </section>
        <section class="rko-rate row">
            <header class="rko-rate__header col-md-3">
                <h3 class="rko-rate__title page-title">Подключите выгодный пакет услуг</h3>
            </header>
            <div class="rko-rate__wrapper offset-md-1 col-md-8">
                <div class="rko-rate__items">
                    <div class="rko-rate__item">
                        <header class="rko-rate__item-header row">
                            <div class="col-md-3 col-sm-4">
                                <h4 class="rko-rate__item-title">Старт</h4>
                            </div>
                            <div class="rko-rate__item-desc offset-md-1 col-sm-8">подходит новичкам, чей оборот не более
                                500 000 ₽ в месяц
                            </div>
                        </header>
                        <div class="rko-rate__price">
                            <div class="rko-rate__price-general">990 ₽ в месяц</div>
                            <div class="rko-rate__price-discount">Для новых клиентов первые 6 месяцев обслуживания бесплатно и корпоративная карта в подарок
                            </div>
                        </div>
                        <div class="rko-rate__terms">
                            <div class="row">
                                <div class="rko-rate__terms-col col-md-6">
                                    <div class="rko-rate__terms-cell">Внесение наличных</div>
                                    <div class="rko-rate__terms-cell">0,1% (мин. 50 ₽)</div>
                                    <div class="rko-rate__terms-cell">Выдача наличных</div>
                                    <div class="rko-rate__terms-cell">от 0,75%</div>
                                </div>
                                <div class="rko-rate__terms-col col-md-6">
                                    <div class="rko-rate__terms-cell">5 платежей в месяц - бесплатно</div>
                                    <div class="rko-rate__terms-cell">30 ₽ за платёж начиная с 6-го</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rko-rate__item">
                        <header class="rko-rate__item-header row">
                            <div class="col-md-3 col-sm-4">
                                <h4 class="rko-rate__item-title">Оптима</h4>
                            </div>
                            <div class="rko-rate__item-desc offset-md-1 col-sm-8">подходит при обороте более 500 000 ₽ в
                                месяц
                            </div>
                        </header>
                        <div class="rko-rate__price">
                            <div class="rko-rate__price-general">1 190 ₽ в месяц</div>
                            <div class="rko-rate__price-discount">При предоплате за 3 месяца - 3 400 ₽ / 6 месяцев - 6
                                450 ₽ / 12 месяцев - 12 100 ₽
                            </div>
                        </div>
                        <div class="rko-rate__terms">
                            <div class="row">
                                <div class="rko-rate__terms-col col-md-6">
                                    <div class="rko-rate__terms-cell">Внесение наличных</div>
                                    <div class="rko-rate__terms-cell">0,08% (мин. 100 ₽)</div>
                                    <div class="rko-rate__terms-cell">Выдача наличных</div>
                                    <div class="rko-rate__terms-cell">от 1%</div>
                                </div>
                                <div class="rko-rate__terms-col col-md-6">
                                    <div class="rko-rate__terms-cell">10 платежей в месяц - бесплатно</div>
                                    <div class="rko-rate__terms-cell">25 ₽ за платёж начиная с 11-го</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rko-rate__item">
                        <header class="rko-rate__item-header row">
                            <div class="col-md-3 col-sm-4">
                                <h4 class="rko-rate__item-title">Премиум</h4>
                            </div>
                            <div class="rko-rate__item-desc offset-md-1 col-sm-8">подходит при обороте более 5 000 000 ₽
                                в месяц
                            </div>
                        </header>
                        <div class="rko-rate__price">
                            <div class="rko-rate__price-general">2 990 ₽ в месяц</div>
                            <div class="rko-rate__price-discount">При предоплате за 3 месяца - 8 500 ₽ / 6 месяцев - 16
                                150 ₽ / 12 месяцев - 30 500 ₽
                            </div>
                        </div>
                        <div class="rko-rate__terms">
                            <div class="row">
                                <div class="rko-rate__terms-col col-md-6">
                                    <div class="rko-rate__terms-cell">Внесение наличных</div>
                                    <div class="rko-rate__terms-cell">0,08% (мин. 100 ₽)</div>
                                    <div class="rko-rate__terms-cell">Выдача наличных</div>
                                    <div class="rko-rate__terms-cell">от 1%</div>
                                </div>
                                <div class="rko-rate__terms-col col-md-6">
                                    <div class="rko-rate__terms-cell">20 платежей в месяц - бесплатно</div>
                                    <div class="rko-rate__terms-cell">19 ₽ за платёж начиная с 21-го</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="rko-base-value">
            <div class="rko-base-value__wrapper row">
                <div class="rko-base-value__title col-md-5">Стоимость базового обслуживания</div>
                <div class="rko-base-value__price col-md-7">
                    <p>ведение счёта</p>
                    <span>от 1 100 ₽ в месяц</span>
                </div>
                <div class="rko-base-value__condition col-md-5">Внесение наличных 0,1% (мин. 50 ₽)</div>
                <div class="rko-base-value__condition col-md-4">Выдача наличных от 1%</div>
                <div class="rko-base-value__condition col-md-3">35 ₽ за платёж</div>
            </div>
        </section>
        <section class="rko-mobile row">
            <div class="rko-mobile__info col-md-5">
                <header class="rko-mobile__header">
                    <h3 class="rko-mobile__title page-title">Эффективно управляйте средствами организации в
                        интернет-банке и мобильном приложении</h3>
                </header>
                <p>Совершайте операции, получайте отчёты и выписки, обменивайтесь документами и информацией с банком без
                    посещения офиса</p>
                <div class="rko-mobile__apps row">
                    <a href="https://itunes.apple.com/ru/app/id723491575"
                       target="_blank" class="rko-mobile__app col-sm-4">
                        <img src="images/app_store.svg" alt="App Store">
                        <span>App Store</span>
                    </a>
                    <a href="https://play.google.com/store/apps/details?id=com.isimplelab.ibank.tsbank"
                       target="_blank" class="rko-mobile__app col-sm-5">
                        <img src="images/google_play.svg" alt="Google Play">
                        <span>Google Play</span>
                    </a>
                </div>
                <footer class="rko-mobile__footer">
                    <p>Оцените возможности мобильного приложения с помощью демо-версии (логин: clientdemo, пароль:
                        democlient)</p>
                    <div class="rko-mobile__footer-info">
                        <img src="images/info.svg" alt="Информация">
                        Приложение совместимо с ОС не ниже iOS 9 и Android 4
                    </div>
                </footer>
            </div>
            <div class="rko-mobile__image col-md-7">
                <img src="images/rko-mobile.png" alt="Эффективно управляйте в мобильном приложении">
            </div>
        </section>
        <section class="rko-lights">
            <div class="row">
                <div class="rko-lights__images col-md-7">
                    <img src="images/rko-lights.png" alt="Светофор">
                </div>
                <div class="rko-lights__info col-md-4">
                    <header class="rko-lights__header">
                        <h3 class="rko-lights__title page-title">Проверяйте партнёров по бизнесу</h3>
                    </header>
                    <p>Встроенный в интернет-банк сервис «Светофор» соберёт данные о компании и определит уровень
                        надежности
                        контрагента</p>
                    <a class="rko-lights__link" href="javascript:">
                        <img src="images/info.svg" alt="Подробнее">
                        <span>Узнать больше</span>
                    </a>
                </div>
            </div>
            <div class="popup-rko-lights">
                <div class="popup-rko-lights__wrapper">
                    <header class="popup-rko-lights__header">
                        <p class="popup-rko-lights__title">О сервисе «Светофор»</p>
                        <span class="popup-rko-lights__exit">
                            <svg width="26" height="27" viewBox="0 0 26 27" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M0.0201816 24.5994L23.9494 0.599365L25.3657 2.01149L1.43648 26.0115L0.0201816 24.5994Z"
                                      fill="#C4C4C4"/>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M25.365 24.5994L1.43583 0.599365L0.0195312 2.01149L23.9487 26.0115L25.365 24.5994Z"
                                      fill="#C4C4C4"/>
                            </svg>
                        </span>
                    </header>
                    <div class="swiper-container popup-rko-lights__slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="popup-rko-lights__image">
                                    <img src="images/lights_1.png">
                                </div>
                                <div class="popup-rko-lights__desc">Популярный сервис проверки контрагентов «Светофор» позволяет в наглядной форме через систему интернет-банка показать информацию о контрагенте в режиме онлайн.</div>
                            </div>
                            <div class="swiper-slide">
                                <div class="popup-rko-lights__image">
                                    <img src="images/lights_2.png">
                                </div>
                                <div class="popup-rko-lights__desc">Еще до отправки платежного поручения сервис предупредит о стоп-факторах, имеющихся у контрагента, информация в системе обрабатывается из открытых официальных источников, сортируется, благодаря специальным алгоритмам, на важные и неважные.</div>
                            </div>
                            <div class="swiper-slide">
                                <div class="popup-rko-lights__image">
                                    <img src="images/lights_3.png">
                                </div>
                                <div class="popup-rko-lights__desc">Важной информацией считается та, которая может повлиять на финансово-хозяйственные отношения с контрагентом. В зависимости от уровня риска и значимости сервис присваивает контрагенту один из цветов светофора.</div>
                            </div>
                            <div class="swiper-slide">
                                <div class="popup-rko-lights__image">
                                    <img src="images/lights_4.png">
                                </div>
                                <div class="popup-rko-lights__desc">Также с использованием сервиса «Светофор» можно получать подробный отчет с показателями, которые стали причиной появления того или иного сигнала. Сервис «Светофор» доступен всем клиентам, пользующимся инетрнет-банком и предоставляется бесплатно.</div>
                            </div>
                            <div class="swiper-slide">
                                <div class="popup-rko-lights__image">
                                    <img src="images/lights_5.png">
                                </div>
                                <div class="popup-rko-lights__desc">Обращаем внимание, что информация о результате проверки является рекомендательной. Сервис «Светофор» не оценивает компании и не присваивает рейтинг, его задача – дать оценку фактам о компании по двум параметрам: достаточность информации о компании в открытых источниках и существенность фактов, способных влиять на отношения с контрагентом (например, наличие информации о банкротств).</div>
                            </div>
                        </div>
                        <div class="popup-rko-lights__scroll">
                            <div class="popup-rko-lights__prev popup-rko-lights__arrows">
                                <svg width="27" height="14" viewBox="0 0 27 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.36523 12.5161L13.3015 1.48389L25.3652 12.5161" stroke="#C4C4C4" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="swiper-pagination popup-rko-lights__pagination"></div>
                            <div class="popup-rko-lights__next popup-rko-lights__arrows">
                                <svg width="27" height="14" viewBox="0 0 27 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.36523 12.5161L13.3015 1.48389L25.3652 12.5161" stroke="#C4C4C4" stroke-width="2"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="rko-products">
            <header class="rko-products__header row">
                <h3 class="rko-products__title page-title col-12 offset-md-2 col-md-8">Сопутствующие продукты для комфортного
                    управления
                    бизнесом</h3>
            </header>
            <div class="rko-products__items row">
                <div class="rko-products__item col-md-4">
                    <h3 class="rko-products__item-title">Выпуск корпоративных карт</h3>
                    <div class="rko-products__item-desc">
                        <p>Отсутствие комиссии при безналичном расчёте</p>
                        <p>Инкассация выручки в удобном месте и в удобное время</p>
                        <p>Неограниченный выпуск карт для сотрудников</p>
                        <p>Индивидуальные лимиты</p>
                    </div>
                    <a class="rko-products__item-link" href="/corporative-clients/bankovskoe-obsluzhivanie/bankovskie-karty/karty-dlya-biznesa/">
                        <span>Подробнее</span>
                        <img src="images/arrow_link.svg" alt="Подробнее">
                    </a>
                </div>
                <div class="rko-products__item col-md-4">
                    <h3 class="rko-products__item-title">Зарплатный проект</h3>
                    <div class="rko-products__item-desc">
                        <p>Бесплатный выпуск и обслуживание карт сотрудников</p>
                        <p>Начисляем кэшбэк и до 4,5% на остаток</p>
                        <p>Бесплатное снятие наличных в банкоматах банка и банков-партёров</p>
                    </div>
                    <a class="rko-products__item-link" href="/corporative-clients/bankovskoe-obsluzhivanie/zarplatnyy-proekt/">
                        <span>Подробнее</span>
                        <img src="images/arrow_link.svg" alt="Подробнее">
                    </a>
                </div>
                <div class="rko-products__item col-md-4">
                    <h3 class="rko-products__item-title">Торговый эквайринг от 1,2%</h3>
                    <div class="rko-products__item-desc">
                        <p>Бесплатный терминал</p>
                        <p>Подключение 0 ₽</p>
                        <p>Гибкая тарифная политика</p>
                        <p>Бесплатное техническое обслуживание</p>
                    </div>
                    <a class="rko-products__item-link" href="/corporative-clients/bankovskoe-obsluzhivanie/ekvayring/">
                        <span>Подробнее</span>
                        <img src="images/arrow_link.svg" alt="Подробнее">
                    </a>
                </div>
            </div>
        </section>
        <section class="rko-online">
            <div class="row">
                <div class="rko-online__images col-md-5 col-lg-6">
                    <img src="images/rko-online.png" alt="Окажем помощь в переводе вашего бизнеса в онлайн">
                </div>
                <div class="col-md-7 col-lg-6">
                    <div class="rko-online__info">
                        <header class="rko-online__header">
                            <h3 class="rko-online__title">Окажем помощь в переводе вашего бизнеса в онлайн</h3>
                        </header>
                        <div class="rko-online__list">
                            <div class="rko-online__item">
                                Разработка корпоративного сайта, продающего лендинг или интернет-магазин на популярных
                                CMS
                            </div>
                            <div class="rko-online__item">Подключение интернет-эквайринга с комиссией от 1,5%</div>
                            <div class="rko-online__item">Интеграция с CRM сервисами и системами управления торговлей
                            </div>
                        </div>
                        <a href="/corporative-clients/razrabotka-sajtov/" class="rko-online__link">
                            <span>Подробнее</span>
                            <img src="images/arrow_link.svg" alt="Подробнее">
                        </a>
                        <footer class="rko-online__footer">
                            Услуга предоставляется компаниями-партнёрами АКБ «Трасстройбанк» (АО)
                        </footer>
                    </div>
                </div>
            </div>
        </section>
        <section class="rko-doc">
            <div class="row">
                <div class="rko-doc__block rko-doc__rate col-md-4">
                    <header class="rko-doc__header">
                        <div class="rko-doc__title">Тарифы</div>
                    </header>
                    <div class="rko-doc__items">
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
		"ELEMENT_ID" => "8887",
		"FIELD_CODE" => array("", ""),
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
		"PROPERTY_CODE" => array("", "DOCUMENTS", "CLASSES"),
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
                <div class="rko-doc__block rko-doc__contract offset-md-1 col-md-4">
                    <header class="rko-doc__header">
                        <div class="rko-doc__title">Договоры</div>
                    </header>
                    <div class="rko-doc__items">
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
		"ELEMENT_ID" => "8888",
		"FIELD_CODE" => array("", ""),
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
		"PROPERTY_CODE" => array("", "DOCUMENTS", "CLASSES"),
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
                <div class="rko-doc__block rko-doc__push-bank col-12">
                    <header class="rko-doc__header">
                        <div class="rko-doc__title">Документы для предоставления в Банк</div>
                    </header>
                    <div class="rko-doc__items row">
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
		"ELEMENT_ID" => "8889",
		"FIELD_CODE" => array("", ""),
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
		"PROPERTY_CODE" => array("", "DOCUMENTS", "CLASSES"),
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
                <div class="rko-doc__block rko-doc__client-bank col-12">
                    <header class="rko-doc__header">
                        <div class="rko-doc__title">Сертификаты и руководства пользователя системы Клиент-Банк</div>
                    </header>
                    <div class="rko-doc__items row">
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
		"ELEMENT_ID" => "8890",
		"FIELD_CODE" => array("", ""),
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
		"PROPERTY_CODE" => array("", "DOCUMENTS", "CLASSES"),
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
            </div>
            <div class="rko-doc__all">
                <a href="/arkhiv-tarifov-i-dokumentov/" class="rko-dock__link">Архив тарифов и документов</a>
            </div>
        </section>
    </div>
</div>


<div class="popup-form" id="cashServiceRequest">
	<?$APPLICATION->IncludeComponent(
		"webtu:feedback",
		"booking",
		Array(
			"ADMIN_EVENT" => "WEBTU_FEEDBACK_BOOKING_ADMINISTRATOR",
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "N",
			"EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
			"IBLOCK_ID" => "28",
			"POST_CALLBACK" => function($post){$post['TYPE']=implode(',', $post['TYPE']);$post['CURRENCY']=implode(',', $post['CURRENCY']);if(!empty($post['FIRST_NAME'])){$post['NAME']=$post['FIRST_NAME'];}return$post;},
			"PROPERTIES" => array("SEX","PHONE","EMAIL","CITY","NAME_COMPANY","INN","LEGAL_FORM","ONLINE_BANK","CURRENCY","TYPE","ADDRESS"),
			"SITES" => array("s1"),
			"USER_EVENT" => "WEBTU_FEEDBACK_BOOKING_USER"
		)
	);?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
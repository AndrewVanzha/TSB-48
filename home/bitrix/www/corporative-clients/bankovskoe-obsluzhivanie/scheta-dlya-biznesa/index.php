<?
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "АКБ «Трансстройбанк» (АО), в соответствии с требованиями законодательства РФ, осуществляет банковскую деятельность. В Банке работают опытные, квалифицированные специалисты, которые помогут быстро решить все проблемы, связанные с проведением платежей.");
$APPLICATION->SetPageProperty("keywords", "Счёт для бизнеса в АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("title", "Счёт для бизнеса | АКБ «ТрансСтройБанк»");
$APPLICATION->SetTitle("Счёт для бизнеса");
Asset::getInstance()->addCss("/assets/css/style-broker-deposit.css?v=1.0.6");
Asset::getInstance()->addCss("/corporative-clients/bankovskoe-obsluzhivanie/scheta-dlya-biznesa/style.css");
?>
<??>
    <style>
        .v21 {
            overflow: hidden;
        }
        .v21 .v21-container.v21-container--header {
            position: relative;
            z-index: 0;
        }
        .v21 .v21-wide-container {
            overflow: visible;
        }
        .v21 .js-color-switch .v21-block-interests--left,
        .v21 .js-color-switch .v21-block-interests--right {
            background-color: transparent;
            box-shadow: none;
        }
        .v21 .js-color-switch .v21-block-interests--right::before,
        .v21 .js-color-switch .v21-block-interests--left::before {
            content: none;
        }
    </style>
<??>
    <div class="scheta-page__background-blue scheta-page__background-time"></div>

<?$APPLICATION->IncludeComponent(
    "bitrix:news",
    "business-account",
    Array(
        "ADD_ELEMENT_CHAIN" => "N",	// Включать название элемента в цепочку навигации
        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
        "AJAX_MODE" => "N",	// Включить режим AJAX
        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
        "BROWSER_TITLE" => "-",	// Установить заголовок окна браузера из свойства
        "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
        "DETAIL_DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
        "DETAIL_FIELD_CODE" => array(	// Поля
            0 => "",
            1 => "",
        ),
        "DETAIL_PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
        "DETAIL_PAGER_TEMPLATE" => "",	// Название шаблона
        "DETAIL_PAGER_TITLE" => "Страница",	// Название категорий
        "DETAIL_PROPERTY_CODE" => array(	// Свойства
            0 => "",
            1 => "",
        ),
        "DETAIL_SET_CANONICAL_URL" => "N",	// Устанавливать канонический URL
        "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
        "DISPLAY_DATE" => "Y",	// Выводить дату элемента
        "DISPLAY_NAME" => "Y",	// Выводить название элемента
        "DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
        "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
        "IBLOCK_ID" => "212",	// Инфоблок
        "IBLOCK_TYPE" => "corporative-clients",	// Тип инфоблока
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
        "LIST_FIELD_CODE" => array(	// Поля
            0 => "",
            1 => "",
        ),
        "LIST_PROPERTY_CODE" => array(	// Свойства
            0 => "ATT_BA_VOLUME",
            1 => "ATT_BA_PAYMENTS",
            2 => "ATT_BA_CASH_IN",
            3 => "ATT_BA_CASH_OUT",
            4 => "ATT_BA_COMISSION",
            5 => "",
        ),
        "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
        "META_DESCRIPTION" => "-",	// Установить описание страницы из свойства
        "META_KEYWORDS" => "-",	// Установить ключевые слова страницы из свойства
        "NEWS_COUNT" => "20",	// Количество новостей на странице
        "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
        "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
        "PAGER_TITLE" => "Новости",	// Название категорий
        "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
        "SEF_MODE" => "N",	// Включить поддержку ЧПУ
        "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
        "SET_STATUS_404" => "N",	// Устанавливать статус 404
        "SET_TITLE" => "Y",	// Устанавливать заголовок страницы
        "SHOW_404" => "N",	// Показ специальной страницы
        "SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
        "SORT_BY2" => "ACTIVE_FROM",	// Поле для второй сортировки новостей
        "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
        "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
        "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела
        "USE_CATEGORIES" => "N",	// Выводить материалы по теме
        "USE_FILTER" => "N",	// Показывать фильтр
        "USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
        "USE_RATING" => "N",	// Разрешить голосование
        "USE_REVIEW" => "N",	// Разрешить отзывы
        "USE_RSS" => "N",	// Разрешить RSS
        "USE_SEARCH" => "N",	// Разрешить поиск
        "USE_SHARE" => "N",	// Отображать панель соц. закладок
        "COMPONENT_TEMPLATE" => "business-account",
        //"COMPONENT_TEMPLATE" => ".default",
        "VARIABLE_ALIASES" => array(
            "SECTION_ID" => "SECTION_ID",
            "ELEMENT_ID" => "ELEMENT_ID",
        )
    ),
    false
);?>
        </div><!-- v21-container -->
    </div><!-- v21-section -->

    <div class="v21-wide-container v21-scheta-wide-container">
        <div class="v21-card-application" id="fBusinessAccountForm">
            <div class="v21-container">
                <?$APPLICATION->IncludeComponent(
                    "webtu:feedback",
                    //"qr_podkluch",
                    "account_application",
                    Array(
                        "ADMIN_EVENT" => "WEBTU_FEEDBACK_ACCOUNTS_ADMIN",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "COMPONENT_TEMPLATE" => "account_application",
                        "EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
                        "IBLOCK_ID" => "213",  // Заявка на открытие счета
                        "PROPERTIES" => array("PHONE","COMPANY_NAME","ORGANIZATION","FIO","COMPANY_INN","NAME","EMAIL","CITY","FOLDER","REQ_URI","FROM_WHERE","UTM_SOURCE","UTM_MEDIUM","UTM_CAMPAIGN","UTM_TERM","UTM_CONTENT"),
                        //"PROPERTIES" => array("PHONE","CREDIT_SUMM","CREDIT_CURRENCY","FIO","EMAIL","ORGANIZATION","CREDIT_NAME"),
                        "SITES" => array(0=>"s1",),
                        "USER_EVENT" => "WEBTU_FEEDBACK_ACCOUNTS_USER",
                        "UTM" => "152",
                    )
                );?>
            </div>
        </div>
    </div>

    <div class="v21-scheta-popproducts--top">
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "block_bottom",
        "EDIT_TEMPLATE" => ""
    )
);?>
    </div>
	<div id="scheta-section-documents"></div>
    <div class="v21-section v21-scheta-section-documents">
    <div class="v21-container">

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
                            "IBLOCK_ID" => "189",     //  (464)
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
            <a href="/arkhiv-tarifov-i-dokumentov/" class="rko-doc__all--link-button">
                <span>Архив тарифов и документов</span>
            </a>
            <a href="/arkhiv-tarifov-i-dokumentov/" target="_blank" class="rko-doc__all--link-details">
                <!--span>Подробнее </span-->
                <svg class="rko-doc__all--link-arrow" xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                    <path d="M13.2371 0.989515C13.2371 0.492459 12.8342 0.0895151 12.3371 0.0895145L4.23715 0.0895146C3.74009 0.0895146 3.33714 0.492459 3.33714 0.989515C3.33714 1.48657 3.74009 1.88952 4.23714 1.88951L11.4371 1.88951L11.4371 9.08952C11.4371 9.58657 11.8401 9.98952 12.3371 9.98952C12.8342 9.98952 13.2371 9.58657 13.2371 9.08951L13.2371 0.989515ZM1.65983 12.9396L12.9735 1.62591L11.7007 0.353119L0.387041 11.6668L1.65983 12.9396Z" fill="#00345E"/>
                </svg>
            </a>
        </div>
    </section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "АКБ «Трансстройбанк» (АО), в соответствии с требованиями валютного законодательства РФ, осуществляет функции агента валютного контроля при осуществлении клиентами Банка валютных операций. В Банке работают опытные, квалифицированные специалисты в области валютного контроля, которые помогут быстро решить все проблемы, связанные с проведением валютных операций.");
$APPLICATION->SetPageProperty("keywords", "Внешнеэкономическая деятельность АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("title", "Внешнеэкономическая деятельность | Банковское обслуживание | КОРПОРАТИВНЫМ КЛИЕНТАМ | АКБ «ТрансСтройБанк»");
$APPLICATION->SetTitle("Внешнеэкономическая деятельность");
Asset::getInstance()->addCss("/assets/css/style-broker-deposit.css?v=1.0.6");
Asset::getInstance()->addCss("/corporative-clients/bankovskoe-obsluzhivanie/vneshneekonomicheskaya-deyatelnost/style.css");
?>
<??>
    <style>
        .v21 {
            overflow: hidden;
        }
        /*.v21 .v21-container.v21-container--header {
            position: relative;
            z-index: 0;
        }*/
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
<div class="ved-page__background-blue ved-page__background-time"></div>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "top",
        "EDIT_TEMPLATE" => ""
    )
);?>
<?/*$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "china",
        "EDIT_TEMPLATE" => ""
    )
);*/?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "VED_complex_solutions",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
            "AJAX_MODE" => "N",	// Включить режим AJAX
            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
            "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
            "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
            "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
            "CACHE_GROUPS" => "Y",	// Учитывать права доступа
            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
            "CACHE_TYPE" => "A",	// Тип кеширования
            "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
            "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
            "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
            "DISPLAY_DATE" => "Y",	// Выводить дату элемента
            "DISPLAY_NAME" => "Y",	// Выводить название элемента
            "DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
            "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
            "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
            "FIELD_CODE" => array(	// Поля
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "",	// Фильтр
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
            "IBLOCK_ID" => "84",	// Код информационного блока
            "IBLOCK_TYPE" => "corporative_clients",	// Тип информационного блока (используется только для проверки)
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
            "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
            "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
            "NEWS_COUNT" => "20",	// Количество новостей на странице
            "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
            "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
            "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
            "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
            "PAGER_TEMPLATE" => "modern",	// Шаблон постраничной навигации
            "PAGER_TITLE" => "Новости",	// Название категорий
            "PARENT_SECTION" => "562",	// ID раздела
            "PARENT_SECTION_CODE" => "",	// Код раздела
            "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
            "PROPERTY_CODE" => array(	// Свойства
                0 => "",
                1 => "",
            ),
            "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
            "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
            "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
            "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
            "SET_STATUS_404" => "Y",	// Устанавливать статус 404
            "SET_TITLE" => "N",	// Устанавливать заголовок страницы
            "SHOW_404" => "N",	// Показ специальной страницы
            "SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
            "SORT_BY2" => "ID",	// Поле для второй сортировки новостей
            "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
            "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
            "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
        ),
        false
    );?>
<div class="v21-section-ved-consult">
    <? $APPLICATION->IncludeComponent(
        "webtu:feedback",
        "VED_consult_new",
        array(
            "AJAX_MODE" => "Y",
            "COMPONENT_TEMPLATE" => "VED_consult",
            "IBLOCK_ID" => "202", // Заявка на консультации в области ВЭД
            "PROPERTIES" => array(
                0 => "NAME",
                1 => "PHONE",
                2 => "FOLDER",
                3 => "REQ_URI",
                4 => "UTM_SOURCE",
                5 => "UTM_MEDIUM",
                6 => "UTM_CAMPAIGN",
                7 => "UTM_TERM",
                8 => "UTM_CONTENT"
            ),
            "ADMIN_EVENT" => "WEBTU_FEEDBACK_CALLBACK", //
            "USER_EVENT" => "NONE", //
            "SITES" => array(
                0 => "s1",
            ),
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "UTM" => "83",
            //"EVENT_CALLBACK" => 'Уважаемый(ая)',
        ),
        false
    ); ?>
</div>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "VED_control_tariffs",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
            "AJAX_MODE" => "N",	// Включить режим AJAX
            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
            "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
            "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
            "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
            "CACHE_GROUPS" => "Y",	// Учитывать права доступа
            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
            "CACHE_TYPE" => "A",	// Тип кеширования
            "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
            "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
            "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
            "DISPLAY_DATE" => "Y",	// Выводить дату элемента
            "DISPLAY_NAME" => "Y",	// Выводить название элемента
            "DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
            "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
            "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
            "FIELD_CODE" => array(	// Поля
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "",	// Фильтр
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
            "IBLOCK_ID" => "84",	// Код информационного блока
            "IBLOCK_TYPE" => "corporative_clients",	// Тип информационного блока (используется только для проверки)
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
            "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
            "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
            "NEWS_COUNT" => "20",	// Количество новостей на странице
            "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
            "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
            "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
            "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
            "PAGER_TEMPLATE" => "modern",	// Шаблон постраничной навигации
            "PAGER_TITLE" => "Новости",	// Название категорий
            "PARENT_SECTION" => "563",	// ID раздела
            "PARENT_SECTION_CODE" => "",	// Код раздела
            "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
            "PROPERTY_CODE" => array(	// Свойства
                0 => "ADD_PROP_1",
                1 => "ADD_PROP_2",
            ),
            "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
            "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
            "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
            "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
            "SET_STATUS_404" => "Y",	// Устанавливать статус 404
            "SET_TITLE" => "N",	// Устанавливать заголовок страницы
            "SHOW_404" => "N",	// Показ специальной страницы
            "SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
            "SORT_BY2" => "ID",	// Поле для второй сортировки новостей
            "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
            "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
            "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
        ),
        false
    );?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "hedge",
        "EDIT_TEMPLATE" => ""
    )
);?>
        <!--/div--><!-- v21-container -->
    <!--/div--><!-- v21-section -->

    <div class="v21-ved-wide-container">
        <div class="v21-card-application" id="fCurrencyForm">
            <!--div class="v21-container"-->
                <? $APPLICATION->IncludeComponent(
                    "webtu:feedback",
                    "VED_foreign_currency_account_new",
                    array(
                        "ADMIN_EVENT" => "WEBTU_FEEDBACK_CURRACCOUNT_ADMINISTRATOR",
                        "USER_EVENT" => "WEBTU_FEEDBACK_CURRACCOUNT_USER",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "COMPONENT_TEMPLATE" => "VED_foreign_currency_account_new",
                        "EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
                        "IBLOCK_ID" => "203",  // Заявка на валютный счёт
                        "PROPERTIES" => array("PHONE","COMPANY","ORGANIZATION","COMPANY_INN","FIO","NAME","EMAIL","CITY","FOLDER","REQ_URI","FROM_WHERE","UTM_SOURCE","UTM_MEDIUM","UTM_CAMPAIGN","UTM_TERM","UTM_CONTENT"),
                        "SITES" => array(0=>"s1",),
                        "UTM" => "133",
                    )
                ); ?>
            <!--/div-->
        </div>
    </div>

    <div class="v21-ved-popproducts--top">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "page",
                "AREA_FILE_SUFFIX" => "bottom",
                "EDIT_TEMPLATE" => ""
            )
        );?>
    </div>

    <!--div class="v21-section v21-ved-section-documents">
        <div class="v21-container"-->

        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "v21_safes_docs",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "CACHE_FILTER" => "N",
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
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                //"IBLOCK_ID" => "207", - и-блок не нужен
                "IBLOCK_ID" => "83",
                "IBLOCK_TYPE" => "-",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "INCLUDE_SUBSECTIONS" => "N",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Документы",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "FILE",
                    1 => "",
                ),
                "SET_BROWSER_TITLE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => ".default",
                "UTM_SOURCE" => "no_data",
                "UTM_MEDIUM" => "no_data",
                "UTM_CAMPAIGN" => "no_data",
                "UTM_TERM" => "no_data",
                "UTM_CONTENT" => "no_data",
                //"DOC_OUTPUT_LINK_HTML" => "Y", // выбираю только документ с наличием "22.04.2022" в названии
                //"DOC_OUTPUT_LINK_HTML_PATTERN" => "22.04.2022",
            ),
            false
        ); ?>
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

<?/*?>
<div class="v21-section">
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
</div>
<?*/?>
<?/*?>
<div class="v21-section">
    <?$APPLICATION->IncludeComponent(
        "webtu:faq.form",
        "",
        Array(
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "FORMAT_DATE" => "d.m.Y",
            "IBLOCK_ID" => "20",
            "IBLOCK_TYPE" => "feedback_form",
            "ID" => $arResult['ID']
        )
    );?>
</div>
<?*/?>

<?/*?>
<h2>Было (webtu:spoiler)</h2>
<?$APPLICATION->IncludeComponent( // faq.form
    "bitrix:news.detail",
    "inkassatsiya",
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
        "COMPONENT_TEMPLATE" => "inkassatsiya",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_CODE" => "",
        "IBLOCK_ID" => "84",
        "ELEMENT_ID" => "499",
        "FIELD_CODE" => array(0=>"",1=>"",),
        "IBLOCK_TYPE" => "corporative_clients",
        "IBLOCK_URL" => "",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "MESSAGE_404" => "",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Страница",
        "PROPERTY_CODE" => array(0=>"",1=>"ATT_URL",2=>"ADD_INFO_BANK",3=>"ADD_INFO_SELF",4=>"",),
        "SET_BROWSER_TITLE" => "Y",
        "SET_CANONICAL_URL" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "STRICT_SECTION_CHECK" => "N",
        "USE_PERMISSIONS" => "N",
        "USE_SHARE" => "N"
    )
);?>
<?*/?>
<?
//Отображаем форму в футере
\GarbageStorage::set('feedback', true);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
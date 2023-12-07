<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рассылка");
?><?$APPLICATION->IncludeComponent("bitrix:subscribe.edit", ".default", Array(
		"SHOW_HIDDEN" => "N",	// Показать скрытые рубрики подписки
		"ALLOW_ANONYMOUS" => "Y",	// Разрешить анонимную подписку
		"SHOW_AUTH_LINKS" => "Y",	// Показывать ссылки на авторизацию при анонимной подписке
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"COMPONENT_TEMPLATE" => ".default",
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"CACHE_TYPE" => "A",	// Тип кеширования
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
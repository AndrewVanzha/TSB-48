<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Изменения профиля");

global $USER;
if (!$USER->IsAuthorized()) {
    LocalRedirect('/login/');
}

?>

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.profile.detail",
	"",
	Array(
		"COMPATIBLE_LOCATION_MODE" => "N",
		"ID" => $ID,
		"PATH_TO_DETAIL" => "/personal/profile/izmeneniya-profilya/",
		"PATH_TO_LIST" => "/personal/profile/",
		"SET_TITLE" => "Y",
		"USE_AJAX_LOCATIONS" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
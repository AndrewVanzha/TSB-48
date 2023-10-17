<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница успешного окончания");
global $USER;
if ($_GET['check_id']) {
    unset($_SESSION['INKASS'][$USER->GetID()]);
    LocalRedirect("/inkass/?logout=yes&check_id=" . $_GET['check_id']);
}
?> finish <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
use Bitrix\Main\Page\Asset;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вход в чек-лист инкассатора");
global $USER;
Asset::getInstance()->addCss("/inkass/style.css");
?>
<?php
if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($_REQUEST["backurl"]);
}

if ($_GET['check_id']) : ?>
    <div class="v21-section">
        <div class="v21-container">
            <div class="verification">
                <h1 class="verification-header">Информация успешно отправлена</h1>
                <div class="form-group" style="text-align: center;">
                    <noindex>
                        <div class="aligner" style="margin-top: 64px;">
                            <a href="/inkass/" rel="nofollow" class="button-1 vs-form__button" style="color: #ffffff;">На главную</a>
                        </div>
                    </noindex>
                </div>
            </div>
        </div>
    </div>

<? else: ?>
    <div class="v21-section">
        <div class="v21-container">
            <div class="verification">
                <h1 class="verification-header">Вход в систему</h1>
                <p class="verification-subheader">Введите логин и пароль</p>
                <div class="verification-wrap">
                    <? $app = $APPLICATION->IncludeComponent(
                        "bitrix:system.auth.form",
                        "",
                        Array(
                            "REGISTER_URL" => "",
                            //"REGISTER_URL" => "/auth/registration.php", /auth/?forgot_password=yes
                            "FORGOT_PASSWORD_URL" => "/auth/?forgot_password=yes",
                            "PROFILE_URL" => "/personal/",
                            "SHOW_ERRORS" => "Y"
                        )
                    );
                    ?>
                </div>
            </div>

        </div>
    </div>
    <?php if($USER->IsAuthorized()) {
        //unset($_SESSION['INKASS'][$USER->GetID()]);
        LocalRedirect('/inkass.service/');
    } ?>
<? endif; ?>
<?/*$APPLICATION->IncludeComponent("bitrix:system.auth.confirmation","",Array(
        "USER_ID" => "confirm_user_id",
        "CONFIRM_CODE" => "confirm_code",
        "LOGIN" => "login"
    )
);*/?>
<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/*
// LocalRedirect('/verification.service/');

$APPLICATION->SetTitle("Авторизация");

?>
<p>Вы зарегистрированы и успешно авторизовались.</p>

<p>Используйте административную панель в верхней части экрана для быстрого доступа к функциям управления структурой и информационным наполнением сайта. Набор кнопок верхней панели отличается для различных разделов сайта. Так отдельные наборы действий предусмотрены для управления статическим содержимым страниц, динамическими публикациями (новостями, каталогом, фотогалереей) и т.п.</p>

<p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>

<?*/?>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

<?
//define("NEED_AUTH", true);
//require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $APPLICATION;
global $USER;
?>
<style>
    .v21 .verification-header {
        text-align: center;
    }
    .v21 .verification-wrap {
        display: flex;
        justify-content: center;
    }
    .v21 .form-contacts .title {
        display: none;
    }
    .v21 .form-contacts .form-group {
        width: 300px;
        margin-bottom: 15px;
    }
    .v21 .form-contacts .form-group .has-input.input-2 {
        display: flex;
        align-items: center;
    }
    .v21 .form-contacts .form-group input[type="checkbox"] {
        margin-right: 10px;
    }
    .v21 .form-contacts .form-group .has-input.input-2 .aligner {
        vertical-align: unset;
    }
</style>
<div class="v21-section">
    <div class="v21-container">
        <h1 class="verification-header">ВЕРИФИКАЦИЯ</h1>
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
            //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/currency/a_post.json', json_encode($_POST));
            ?>
        </div>


    </div>
</div>
<?/*$APPLICATION->IncludeComponent("bitrix:system.auth.confirmation","",Array(
        "USER_ID" => "confirm_user_id",
        "CONFIRM_CODE" => "confirm_code",
        "LOGIN" => "login"
    )
);*/?>
<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) {
    LocalRedirect($_REQUEST["backurl"]);
}
if($USER->IsAuthorized()) {
    LocalRedirect('/verification.service/');
}

/*
// LocalRedirect('/verification.service/');

$APPLICATION->SetTitle("Авторизация");

?>
<p>Вы зарегистрированы и успешно авторизовались.</p>

<p>Используйте административную панель в верхней части экрана для быстрого доступа к функциям управления структурой и информационным наполнением сайта. Набор кнопок верхней панели отличается для различных разделов сайта. Так отдельные наборы действий предусмотрены для управления статическим содержимым страниц, динамическими публикациями (новостями, каталогом, фотогалереей) и т.п.</p>

<p><a href="<?=SITE_DIR?>">Вернуться на главную страницу</a></p>

<?*/?>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
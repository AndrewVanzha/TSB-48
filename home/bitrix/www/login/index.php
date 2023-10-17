<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Войти или зарегистрироваться через одну из социальных сетей");
?>

<?/*--- Авторизация через соц сети (uLogin) ---*/?>
<?$APPLICATION->IncludeComponent(
    "ulogin:auth",
    "",
    Array(
        "GROUP_ID" => array("2", "3", "4", "6"),
        "LOGIN_AS_EMAIL" => "Y",
        "SEND_EMAIL" => "Y",
        "SOCIAL_LINK" => "N",
        "ULOGINID1" => "2aad5593",
        "ULOGINID2" => ""
    )
);?>

<div class="row">
    <?/*--- Авторизация ---*/?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:system.auth.form",
        "",
        Array(
            "FORGOT_PASSWORD_URL" => "/auth/?forgot_password=yes",
            "PROFILE_URL" => "/personal/",
            "REGISTER_URL" => "/login/",
            "SHOW_ERRORS" => "Y"
        )
    );?>

    <?/*--- Регистрация ---*/?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.register",
        "",
        Array(
            "AUTH" => "Y",
            "REQUIRED_FIELDS" => array("EMAIL"),
            "SET_TITLE" => "N",
            "SHOW_FIELDS" => array("EMAIL"),
            "SUCCESS_PAGE" => "/",
            "USER_PROPERTY" => array(),
            "USER_PROPERTY_NAME" => "",
            "USE_BACKURL" => "Y"
        )
    );?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
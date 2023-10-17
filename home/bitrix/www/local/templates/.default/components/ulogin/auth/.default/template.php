<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!$USER->IsAuthorized()): ?>

    <div class="social-login">
        <? echo $arResult['ULOGIN_CODE']; ?>
    </div>
    
<?endif; ?>
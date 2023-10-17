<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Банковские карты");
?>
    <section class="v21-bank-cards--top">
        <div class="v21-bank-cards--top_left">
            <h1>Банковские карты</h1>
            <p>Карты для жизни и бизнеса с популярными и выгодными опциями.</p>
        </div>
    </section>
    <section class="v21-section v21-section-bank-cards">
        <div class="v21-section-bank-cards--item v21-section-bank-cards--debit">
            <div class="v21-section-bank-cards--img">
                <img src="/images/debit-card-pair.png" alt="дебитовая карта">
            </div>
            <div class="v21-section-bank-cards--box">
                <h3 class="v21-section-bank-cards--subheader">Дебетовые карты</h3>
                <p class="v21-section-bank-cards--text">Дебетовые карты Мир и Visa с кэшбэком, доставкой, пополнением без комиссии и другими услугами.</p>
                <a class="v21-button-2022 v21-section-bank-cards--button" href="/chastnym-klientam/debit-cards/">Выбрать карту</a>
            </div>
        </div>
        <div class="v21-section-bank-cards--item v21-section-bank-cards--credit">
            <?/*?>
            <div class="v21-section-bank-cards--img">
                <img src="/images/credit-card-pair.png" alt="кредитная карта">
            </div>
            <div class="v21-section-bank-cards--box">
                <h3 class="v21-section-bank-cards--subheader">Кредитная карта</h3>
                <p class="v21-section-bank-cards--text">Бесплатная кредитная карта Мир от Трансстройбанка.</p>
                <a class="v21-button-2022 v21-section-bank-cards--button" href="/chastnym-klientam/kreditnaya-karta-mir/">Подробнее о карте</a>
            </div>
            <?*/?>
            <div class="v21-section-bank-cards--img">
                <img src="/images/corp-card-pair.png" alt="корпоративная карта">
            </div>
            <div class="v21-section-bank-cards--box">
                <h3 class="v21-section-bank-cards--subheader">Корпоративные карты</h3>
                <p class="v21-section-bank-cards--text">Карты для бизнеса с индивидуальными лимитами, инкассацией, для таможенных пошлин.</p>
                <a class="v21-button-2022 v21-section-bank-cards--button" href="/corporative-clients/bankovskoe-obsluzhivanie/bankovskie-karty/karty-dlya-biznesa/">Выбрать карту</a>
            </div>
        </div>
        <??>
        <div class="v21-section-bank-cards--item v21-section-bank-cards--corporate">
            <div class="v21-section-bank-cards--img">
                <img src="/images/customs-card-pair.png" alt="Таможенная карта">
            </div>
            <div class="v21-section-bank-cards--box">
                <h3 class="v21-section-bank-cards--subheader">Таможенная карта</h3>
                <p class="v21-section-bank-cards--text">Карты для таможенных пошлин.</p>
                <a class="v21-button-2022 v21-section-bank-cards--button" href="/corporative-clients/bankovskoe-obsluzhivanie/bankovskie-karty/tamozhennaya-karta-mir/">Подробнее о карте</a>
            </div>
        </div>
        <??>
    </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
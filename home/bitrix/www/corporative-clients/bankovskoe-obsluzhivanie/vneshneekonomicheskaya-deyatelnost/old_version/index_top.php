<h1 class="v21-h1">Обслуживание ВЭД</h1>


<div class="v21-section v21-section--border v21-ved-contracts__border" style="border-bottom: 1px solid #e4e5e5;">
    <div class="v21-ved-contracts__box">
        <div class="v21-ved-contracts__content">
            <div class="v21-ved-contracts__wrap">
                <h3 class="v21-ved-contracts__header">Бесплатное открытие счета в популярных валютах, рассчитывайтесь без двойной конвертации</h3>
                <p class="v21-ved-contracts__text">Евро, китайские юани, армянские драмы, казахстанские тенге, турецкие лиры</p>
            </div>
			<?/*?><h3 class="v21-h3 rko-banner__anno" style="color:#a58a57;font-size:16px;">* Воспользоваться сервисом дистанционного открытия счета возможно только в браузере Yandex</h3><?*/?>
            <a href="#fCurrencyForm" class="v21-ved-contracts__button v21-button js-ved-contracts__button">
                <span>Открыть счёт для ВЭД</span>
            </a>
        </div>
        <div class="v21-ved-contracts__image v21-ved-contracts__image--dt">
            <?/*?><img src="/images/VED_Contracts.png" alt="Валютные контракты"><?*/?>
            <img src="/images/sphere_coins.png" alt="Валютные контракты">
        </div>
		<?/*?>
        <div class="v21-ved-contracts__image v21-ved-contracts__image--mobile">
            <img src="/images/VED_Contracts_mobile.png" alt="Валютные контракты">
        </div>
		<?*/?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.js-ved-contracts__button').on('click', function() {
            let href = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(href).offset().top - 120
            }, {
                duration: 800,   // по умолчанию «400»
                easing: "linear" // по умолчанию «swing»
            });
            return false;
        });
    });
</script>

<?/*?>
<div class="v21-section v21-section--border v21-ved-contracts__border">
    <div class="v21-ved-contracts__box">
        <div class="v21-ved-contracts__content">
            <div class="v21-ved-contracts__wrap">
                <h3 class="v21-ved-contracts__header">3 месяца бесплатного обслуживания внешнеэкономических контрактов</h3>
                <p class="v21-ved-contracts__text">Откройте счёт в иностранной валюте до 31 мая и получите 3 месяца бесплатного обслуживания экспортно-импортных контрактов.</p>
            </div>
                <h3 class="v21-h3 rko-banner__anno" style="color:#a58a57;font-size:16px;">* Воспользоваться сервисом дистанционного открытия счета возможно только в браузере Yandex</h3>
            <a href="https://www.transstroybank.ru/corporative-clients/bankovskoe-obsluzhivanie/raschetno-kassovoe-obsluzhivanie/" class="v21-ved-contracts__button v21-button">
                <span>Открыть счёт для ВЭД</span>
            </a>
        </div>
        <div class="v21-ved-contracts__image v21-ved-contracts__image--dt">
			<img src="/images/VED_Contracts_main.png" alt="Валютные контракты">
        </div>
        <div class="v21-ved-contracts__image v21-ved-contracts__image--mobile">
            <img src="/images/VED_Contracts_mobile.png" alt="Валютные контракты">
        </div>
    </div>
</div>
<?*/?>
<?

use Bitrix\Main\Application;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Резервирование курсов валют");
$request = Application::getInstance()->getContext()->getRequest();
?>
    <style>
        .rr-result {
            max-width: 50%;
            padding: 24px;
            background: #F1F8FC;
            border-radius: 14px;
            margin: 24px 0;
        }

        .rr-result__tr {
            display: grid;
            grid-template-columns: 1fr 1fr;
            padding: 5px 0;
        }

        .rr-result__td:first-child {
            font-weight: bold;
        }

        @media all and (max-width: 629px) {
            .rr-result {
                max-width: 100%;
                padding: 12px 18px;
                font-size: 14px;
            }
        }
    </style>

    <p>Данные по вашему заказу:</p>
    <div class="rr-result">
        <?php if (!empty($request->get('order_id'))): ?>
            <div class="rr-result__tr">
                <div class="rr-result__td">Номер заказа:</div>
                <div class="rr-result__td"><?= $request->get('order_id') ?></div>
            </div>
        <?php endif; ?>
        <?php if (!empty($request->get('type'))): ?>
            <div class="rr-result__tr">
                <div class="rr-result__td">Тип операции:</div>
                <div class="rr-result__td"><?= $request->get('type') ?></div>
            </div>
        <?php endif; ?>
        <?php if (!empty($request->get('rate'))): ?>
            <div class="rr-result__tr">
                <div class="rr-result__td">Курс валюты:</div>
                <div class="rr-result__td">1 <?= $request->get('currency') ?> = <?= number_format($request->get('rate'),
                        2, '.', ' ') ?> ₽
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($request->get('amount'))): ?>
            <div class="rr-result__tr">
                <div class="rr-result__td">Сумма сделки:</div>
                <div class="rr-result__td"><?= number_format($request->get('amount'), 2, '.',
                        ' ') ?> <?= $request->get('currency') ?></div>
            </div>
        <?php endif; ?>
        <?php if (!empty($request->get('amount-rub'))): ?>
            <div class="rr-result__tr">
                <div class="rr-result__td">К оплате:</div>
                <div class="rr-result__td"><?= number_format($request->get('amount-rub'), 2, '.', ' ') ?> ₽</div>
            </div>
        <?php endif; ?>
        <?php if (!empty($request->get('amount-security'))): ?>
            <div class="rr-result__tr">
                <div class="rr-result__td">Обеспечительный платеж:</div>
                <div class="rr-result__td"><?= number_format($request->get('amount-security'), 2, '.', ' ') ?> ₽</div>
            </div>
        <?php endif; ?>
    </div>
    <p>Ваш резерв действителен до <?= $request->get('expired') ?>.</p>
    <p>Вам необходимо до назначенного времени обратиться в кассу Банка по адресу: ул. Дубининская 94, Москва.</p>
    <p>Пн-пт 10:00-18:00 (без перерыва)</p>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
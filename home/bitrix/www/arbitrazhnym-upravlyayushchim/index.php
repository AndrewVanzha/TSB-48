<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Открытие и обслуживание счёта банкрота");
$APPLICATION->SetPageProperty("keywords", "счет, банкрот, АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("title", "Открытие и обслуживание счёта банкрота | АКБ «ТрансСтройБанк»");
$APPLICATION->SetTitle("Открытие и обслуживание счёта банкрота");
Asset::getInstance()->addCss("/assets/css/style-broker-deposit.css?v=1.0.6");
Asset::getInstance()->addCss("/arbitrazhnym-upravlyayushchim/style.css");
Asset::getInstance()->addJs("/arbitrazhnym-upravlyayushchim/script.js");
?><div class="page-lf">
	<div class="container">
 <section class="oosb-main">
		<div class="oosb-main__header col-md-8 offset-md-2">
			<h2 class="oosb-main__title page-title">Открытие и обслуживание счёта банкрота</h2>
		</div>
		<div class="row">
			<div class="oosb-main__image col-md-5 offset-md-1">
                <img alt="Открытие и обслуживание счёта банкрота" src="images/main.png">
			</div>
			<div class="oosb-main__info col-md-5">
				<p>Откроем специальный счёт для организаций и граждан, находящихся в стадии банкротства.</p>
				<div class="oosb-main__list">
                    <div class="oosb-main__row">Антикризисные тарифы</div>
                    <div class="oosb-main__row">Подача документов онлайн</div>
                    <div class="oosb-main__row">Открытие счета сразу при личном присутствии в Банке</div>
                    <div class="oosb-main__row">Юридическая помощь и персональный менеджер</div>
                    <div class="oosb-main__row">Контролируем правильность оформления платежей, уведомляем о наличии решений налоговых органов и судебных приставов</div>
                    <div class="oosb-main__row">Индивидуальный подход к каждому клиенту</div>
				</div>
			</div>
		</div>
 </section>
 <section class="oosb-types">
		<div class="oosb-types__header col-md-8 offset-md-2">
			<h2 class="oosb-types__title">Работаем со следующими спецсчетами при процедурах банкротства</h2>
		</div>
		<div class="oosb-types__wrapper col-md-10 offset-md-1">
			<div class="row">
				<div class="oosb-types__tabs col-md-3">
					<div class="oosb-types__tab oosb-types__tab--active" data-set-type="yur">
						 Юридические лица
					</div>
					<div class="oosb-types__tab" data-set-type="ip">
						 Индивидуальные предприниматели
					</div>
					<div class="oosb-types__tab" data-set-type="fiz">
						 Физические лица
					</div>
				</div>
				<div class="oosb-types__content col-md-8 offset-md-1">
					<div class="oosb-types__content-type" id="type-yur" data-type-active="true">
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для возврата задатков по реализации имущества должника
							</div>
							<div class="oosb-types__spoiler-content">
								 Денежные средства, находящиеся на этом счёте, предназначены для погашения требований о возврате задатков, а также для перечисления суммы задатка на основной счёт должника в случае заключения внесшим его лицом договора купли-продажи имущества должника или наличия иных оснований для оставления задатка за должником.
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для расчётов с кредиторами путём реализации предмета залога
							</div>
							<div class="oosb-types__spoiler-content">
								 Денежные средства с этого счёта могут списываться только для погашения требований кредиторов первой и второй очереди, а также для погашения судебных расходов, расходов по выплате вознаграждения арбитражным управляющим и оплате услуг лиц, привлеченных арбитражным управляющим в целях обеспечения исполнения возложенных на него обязанностей.
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для вознаграждения арбитражного управляющего
							</div>
							<div class="oosb-types__spoiler-content">
								 На этот счёт будет перечислена зарезервированная сумма денег на выплату процентов за работу конкурсного управляющего.
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт застройщика-должника
							</div>
							<div class="oosb-types__spoiler-content">
								 Предназначен для осуществления банкротом застройщиком расчётов, связанных с удовлетворением требований кредиторов по текущим платежам
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для расчётов с кредиторами в ходе конкурсного производства
							</div>
							<div class="oosb-types__spoiler-content">
								 Счёт предназначен для того, чтобы зарезервировать денежные средства для кредитора в случае разногласий между конкурсным управляющим и кредитором, или при заявлении о признании сделки должника недействительной.
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для расчётов с кредиторами при привлечении лица к субсидиарной ответственности
							</div>
							<div class="oosb-types__spoiler-content">
								 Счет предназначен для удовлетворения требований кредиторов, в интересах которых было удовлетворено заявление о привлечении лица к субсидиарной ответственности, в соответствии с очередностью, установленной статьей 134 Закона о банкротстве
							</div>
						</div>
					</div>
					<div class="oosb-types__content-type" id="type-ip" data-type-active="false">
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для процедуры реструктуризации долга
							</div>
							<div class="oosb-types__spoiler-content">
								<p>
									 Гражданин вправе открыть один специальный банковский счёт и распоряжаться деньгами, размещёнными на нём, без согласия финансового управляющего.
								</p>
								<p>
									 Сумма совершённых физлицом операций по счёту не может превышать 50 000 ₽ в месяц.
								</p>
								<p>
									 Должник может увеличить максимальный размер средств на счёте обратившись в арбитражный суд. При положительном решении, необходимо предоставить в банк копию судебного определения.
								</p>
								<p>
									 Если должник расторгает договор специального счёта, то применяются требования и ограничения на расходы по счёту без согласия финансового управляющего в месячном периоде.
								</p>
								<p>
									 В случае прекращения дела о банкротстве, счёт закрывается по письменному заявлению. Остаток денежных средств выдается физическому лицу в кассе Банка или перечисляется на другой счет гражданина.
								</p>
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для расчетов с кредиторами, включенными в реестр требований кредиторов
							</div>
							<div class="oosb-types__spoiler-content">
								 Счёт оформляется по заявлению финансового управляющего. На нём учитываются средства для обеспечения кредиторов, включенных в реестр требований кредиторов
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Залоговый счёт
							</div>
							<div class="oosb-types__spoiler-content">
								 Этот вид счёта открывается финансовым управляющим и предназначен только для погашения требований кредиторов за счёт денежных средств, вырученных от реализации предмета залога. Также средства могут быть направлены для обеспечения судебных расходов, оплаты вознаграждения арбитражным управляющим и услуг привлечённых лиц.
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для учёта задатков
							</div>
							<div class="oosb-types__spoiler-content">
								 Специальный банковский счет должника, предназначенный для зачисления на него сумм задатков, перечисляемых участниками торгов по реализации имущества физлица, и обеспечения исполнения обязанности по возврату задатков. открывается по заявлению финансового управляющего.
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счет для вознаграждения финансового (арбитражного) управляющего
							</div>
							<div class="oosb-types__spoiler-content">
								 На этот счёт будет перечислена зарезервированная сумма денег на выплату процентов за работу финансового (арбитражного) управляющего
							</div>
						</div>
					</div>
					<div class="oosb-types__content-type" id="type-fiz" data-type-active="false">
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для процедуры реструктуризации долга
							</div>
							<div class="oosb-types__spoiler-content">
								<p>
									 Гражданин вправе открыть один специальный банковский счёт и распоряжаться деньгами, размещёнными на нём, без согласия финансового управляющего.
								</p>
								<p>
									 Сумма совершённых физлицом операций по счёту не может превышать 50 000 ₽ в месяц.
								</p>
								<p>
									 Должник может увеличить максимальный размер средств на счёте обратившись в арбитражный суд. При положительном решении, необходимо предоставить в банк копию судебного определения.
								</p>
								<p>
									 Если должник расторгает договор специального счёта, то применяются требования и ограничения на расходы по счёту без согласия финансового управляющего в месячном периоде.
								</p>
								<p>
									 В случае прекращения дела о банкротстве, счёт закрывается по письменному заявлению. Остаток денежных средств выдается физическому лицу в кассе Банка или перечисляется на другой счет гражданина.
								</p>
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для расчетов с кредиторами, включенными в реестр требований кредиторов
							</div>
							<div class="oosb-types__spoiler-content">
								 Счёт оформляется по заявлению финансового управляющего. На нём учитываются средства для обеспечения кредиторов, включенных в реестр требований кредиторов
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Залоговый счёт
							</div>
							<div class="oosb-types__spoiler-content">
								 Этот вид счёта открывается финансовым управляющим и предназначен только для погашения требований кредиторов за счёт денежных средств, вырученных от реализации предмета залога. Также средства могут быть направлены для обеспечения судебных расходов, оплаты вознаграждения арбитражным управляющим и услуг привлечённых лиц.
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счёт для учёта задатков
							</div>
							<div class="oosb-types__spoiler-content">
								 Специальный банковский счет должника, предназначенный для зачисления на него сумм задатков, перечисляемых участниками торгов по реализации имущества физлица, и обеспечения исполнения обязанности по возврату задатков. открывается по заявлению финансового управляющего.
							</div>
						</div>
						<div class="oosb-types__spoiler">
							<div class="oosb-types__spoiler-label">
								 Счет для вознаграждения финансового (арбитражного) управляющего
							</div>
							<div class="oosb-types__spoiler-content">
								 На этот счёт будет перечислена зарезервированная сумма денег на выплату процентов за работу финансового (арбитражного) управляющего
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
 </section> <section class="oosb-tariffs">
		<div class="row">
			<div class="oosb-tariffs__header col-md-10 offset-md-1">
 <img src="images/hr.svg">
				<h2 class="oosb-tariffs__title">Тарифы на открытие и ведение счёта банкрота</h2>
			</div>
			<div class="oosb-tariffs__tabs col-md-10 offset-md-1">
				<div class="oosb-tariffs__tab oosb-tariffs__tab--active" data-set-tariff="org">
					 Организациям и ИП
				</div>
				<div class="oosb-tariffs__tab" data-set-tariff="fiz">
					 Гражданам
				</div>
			</div>
			<div class="oosb-tariffs__content col-md-10 offset-md-1">
				<div class="oosb-tariffs__content-tariff" id="tariff-org" data-tariff-active="true">
					<div class="oosb-tariffs__list">
						<div class="oosb-tariffs__row">
							<div class="oosb-tariffs__label">
								 Комиссия за открытие счёта
							</div>
							<div class="oosb-tariffs__params">
								<div class="oosb-tariffs__param">
									 За первый расчётный счёт –&nbsp; 3 000 ₽
								</div>
								<div class="oosb-tariffs__param">
									 За последующие счета – 500 ₽
								</div>
							</div>
						</div>
						<div class="oosb-tariffs__row">
							<div class="oosb-tariffs__label">
								 Система дистанционного банковского обслуживания
							</div>
							<div class="oosb-tariffs__params">
								<div class="oosb-tariffs__param">
									 Интернет-банк - 600 ₽/мес
								</div>
								<div class="oosb-tariffs__param">
									 Мобильный банк - бесплатно
								</div>
							</div>
						</div>
						<div class="oosb-tariffs__row">
							<div class="oosb-tariffs__label">
								 Обслуживание счёта
							</div>
							<div class="oosb-tariffs__params oosb-tariffs__params--only">
								<div class="oosb-tariffs__param">
									 1 500 ₽.
								</div>
							</div>
						</div>
						<div class="oosb-tariffs__row">
							<div class="oosb-tariffs__label">
								 Платежи в другие кредитные организации
							</div>
							<div class="oosb-tariffs__params oosb-tariffs__params--only">
								<div class="oosb-tariffs__param">
									 250 ₽/платеж
								</div>
							</div>
						</div>
						<div class="oosb-tariffs__row">
							<div class="oosb-tariffs__label">
								 Закрытие счёта
							</div>
							<div class="oosb-tariffs__params oosb-tariffs__params--only">
								<div class="oosb-tariffs__param">
									 По заявлению Клиента – Бесплатно
								</div>
							</div>
						</div>
						<div class="oosb-tariffs__full">
 <a href="docs/Тарифы РКО банкроты 010920211.pdf" download="" target="_blank">Полное описание тарифа</a> <img src="images/arrow.svg">
							<?/*?>
							<div class="oosb-tariffs__label">
								 Полное описание тарифа
							</div>
							<div class="oosb-tariffs__params oosb-tariffs__params--only">
								<div>
 <a href="docs/Тарифы РКО 01.08.2021 Москва для ст-счетов.pdf" download="" target="_blank">Для клиентов в г.Москва, открывших счета до 01.08.2021</a> <img src="images/arrow.svg">
								</div>
								<div>
 <a href="docs/Тарифы РКО с 01.08.2021 Москва.pdf" download="" target="_blank">Для клиентов в г.Москва, открывших счета после 01.08.2021</a> <img src="images/arrow.svg">
								</div>
								<div>
 <a href="docs/Тарифы РКО с 01.08.2021 регионы.pdf" download="" target="_blank">Для клиентов в г.Липецк, Калининград, Казань, Пермь, НижнийНовгород, Туапсе</a> <img src="images/arrow.svg">
								</div>
								<div>
 <a href="docs/Тарифы РКО банкроты 010920211.pdf" download="" target="_blank">Для клиентов, в отношении которых введена любая из процедур, применяемых в деле о банкротстве (вступают в силу с 01.09.2021)</a> <img src="images/arrow.svg">
								</div>
							</div>
							<?*/?>
						</div>
					</div>
				</div>
				<div class="oosb-tariffs__content-tariff" id="tariff-fiz" data-tariff-active="false">
					<div class="oosb-tariffs__list">
						<div class="oosb-tariffs__row">
							<div class="oosb-tariffs__label">
								 Комиссия за открытие счёта
							</div>
							<div class="oosb-tariffs__params">
								<div class="oosb-tariffs__param">
									 За первый текущий счёт 4 000 ₽
								</div>
								<div class="oosb-tariffs__param">
									 За последующие счета – 500 ₽
								</div>
							</div>
						</div>
						<div class="oosb-tariffs__row">
							<div class="oosb-tariffs__label">
								 Обслуживание счёта
							</div>
							<div class="oosb-tariffs__params oosb-tariffs__params--only">
								<div class="oosb-tariffs__param">
									 В пределах остатка, но не более 1000 ₽/мес.
								</div>
							</div>
						</div>
						<div class="oosb-tariffs__row">
							<div class="oosb-tariffs__label">
								 Мобильный банк
							</div>
							<div class="oosb-tariffs__params oosb-tariffs__params--only">
								<div class="oosb-tariffs__param">
									 Бесплатно
								</div>
							</div>
						</div>
						<div class="oosb-tariffs__row">
							<div class="oosb-tariffs__label">
								 Закрытие счёта
							</div>
							<div class="oosb-tariffs__params oosb-tariffs__params--only">
								<div class="oosb-tariffs__param">
									 Бесплатно
								</div>
							</div>
						</div>
						<div class="oosb-tariffs__row">
							<div class="oosb-tariffs__label">
								 Платежи в другие кредитные организации
							</div>
							<div class="oosb-tariffs__params">
								<div class="oosb-tariffs__param">
									 Через отделение – 250 ₽/платеж
								</div>
								<div class="oosb-tariffs__param">
									 Через Онлайн-банк – 100 ₽/платеж
								</div>
							</div>
						</div>
						<div class="oosb-tariffs__full">
 <a href="/arbitrazhnym-upravlyayushchim/docs/Сборник%20тарифов%20%20физ.лиц%20пр%20СФ%20165_%2014042022.docx" download="" target="_blank">Полное описание тарифа</a> <img src="images/arrow.svg">
						</div>
					</div>
				</div>
			</div>
		</div>
 </section> <section class="oosb-form">
		<div class="oosb-form__header">
			<h2 class="oosb-form__title page-title">Оставьте заявку на открытие специального счёта</h2>
		</div>
		<div class="row">
			<div class="oosb-form__steps offset-md-1 col-md-10">
				<div class="row">
					<div class="oosb-form__step col-sm-4">
						<div class="oosb-form__step-icon">
 <img src="images/step-icon.svg" alt="">
							1
						</div>
						<div class="oosb-form__step-desc">
							 Вы подаёте заявку, и мы связываемся с вами
						</div>
					</div>
					<div class="oosb-form__step col-sm-4">
						<div class="oosb-form__step-icon">
 <img src="images/step-icon.svg" alt="">
							2
						</div>
						<div class="oosb-form__step-desc">
							 Заключаем договор на открытие счёта
						</div>
					</div>
					<div class="oosb-form__step col-sm-4">
						<div class="oosb-form__step-icon">
 <img src="images/step-icon.svg" alt="">
							3
						</div>
						<div class="oosb-form__step-desc">
							 Проводите операции в рамках процедур
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="oosb-form__wrapper offset-md-3 col-md-6">
				 <?$APPLICATION->IncludeComponent(
	"webtu:feedback",
	"bankroty",
	Array(
		"ADMIN_EVENT" => "BANKROTY_ADMIN",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
		"IBLOCK_ID" => "34",
		"POST_CALLBACK" => function($post){return$post;},
        //"PROPERTIES" => array("PHONE","EMAIL","NAME"),
        "PROPERTIES" => array("PHONE","COMPANY_NAME","COMPANY_INN","NAME","EMAIL","CITY","FOLDER","REQ_URI","FROM_WHERE","UTM_SOURCE","UTM_MEDIUM","UTM_CAMPAIGN","UTM_TERM","UTM_CONTENT"),
        "SITES" => array("s1"),
        "USER_EVENT" => "BANKROTY_USER",
        "UTM" => "129",
	)
);?>
			</div>
		</div>
 </section> <section class="oosb-docs">
		<div class="oosb-docs__header">
			<h2 class="oosb-docs__title">Документы для</h2>
			<div class="oosb-docs__tabs">
				<div class="oosb-docs__tab oosb-docs__tab--active" data-set-docs="fiz">
					 физических лиц
				</div>
				<div class="oosb-docs__tab" data-set-docs="yur">
					 юридических лиц
				</div>
				<div class="oosb-docs__tab" data-set-docs="ip">
					 ИП
				</div>
			</div>
		</div>
		<div class="oosb-docs__content">
			<div class="oosb-docs__list" id="docs-fiz" data-docs-active="true">
				<div class="row">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"documents-type-1",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => "9110",
		"FIELD_CODE" => array("",""),
		"IBLOCK_ID" => "189",
		"IBLOCK_TYPE" => "ls_documents",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array("","DOCUMENTS","CLASSES"),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N"
	)
);?>
				</div>
			</div>
			<div class="oosb-docs__list" id="docs-yur" data-docs-active="false">
				<div class="row">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"documents-type-1",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => "9111",
		"FIELD_CODE" => array("",""),
		"IBLOCK_ID" => "189",
		"IBLOCK_TYPE" => "ls_documents",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array("","DOCUMENTS","CLASSES"),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N"
	)
);?>
				</div>
			</div>
			<div class="oosb-docs__list" id="docs-ip" data-docs-active="false">
				<div class="row">
					 <?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"documents-type-1",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => "9112",
		"FIELD_CODE" => array("",""),
		"IBLOCK_ID" => "189",
		"IBLOCK_TYPE" => "ls_documents",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array("","DOCUMENTS","CLASSES"),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N"
	)
);?>
				</div>
			</div>
		</div>
 </section>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
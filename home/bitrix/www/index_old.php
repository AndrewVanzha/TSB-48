<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "АКБ «Трансстройбанк» (ЗАО) — это универсальный коммерческий банк, успешно работающий на рынке банковских услуг с апреля 1994 года. За годы своей деятельности Банк зарекомендовал себя как стабильный и надежный партнер, всегда выполняющий свои обязательства, идущий навстречу пожеланиям клиентов и выстраивающий свою клиентскую политику в их интересах.");
$APPLICATION->SetPageProperty("keywords", "АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("title", "Главная страница АКБ «ТрансСтройБанк»");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Главная страница");
?>
<div id="tabs" class="tabs-items" style="margin: 0 0 120px;">
	<div class="tab-item active" id="corporative">
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"main_slider_new",
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "N",
				"CACHE_FILTER" => "N",
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
				"FIELD_CODE" => array("NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PICTURE", ""),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "184",
				"IBLOCK_TYPE" => "slider_main",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "10",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "400",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array("LINK", "NAME_BTN", "NAME_BTN_ENG", "TEXT_SLIDE", "TEXT_SLIDE_ENG"),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "ACTIVE_FROM",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "DESC",
				"STRICT_SECTION_CHECK" => "N"
			)
		); ?>
		<div class="wrapp-banners-corporat">
			<div class="container">
                <?/*?><div class="banners-corporat" style="background: url('../local/templates/czebra_home/img/banner-corp1.png'); background-size: 100% 100%"><?*/?>
                <div class="banners-corporat" style="background: url('../local/templates/czebra_home/img/banner-corp1.webp'); background-size: 100% 100%">
					<?/*div class="bg-corp-banners"></div*/ ?>
					<div class="title-banners">
						Сокращай расходы
					</div>
					<p>
						Торговый эквайринг по минимальной ставке от 1,2%
					</p>
					<div class="link-banners">
						<a href="/corporative-clients/bankovskoe-obsluzhivanie/ekvayring/" class="btn-site1">Подробнее</a>
					</div>
					<?/*img src="<?=SITE_TEMPLATE_PATH?>/img/terminal.png" alt=""*/ ?>
				</div>
                <?/*?><div class="banners-corporat" style="background: url('../local/templates/czebra_home/img/banner-corp2.png'); background-size: 100% 100%"><?*/?>
                <div class="banners-corporat" style="background: url('../local/templates/czebra_home/img/banner-corp2.webp'); background-size: 100% 100%">
					<?/*div class="bg-corp-banners"></div*/ ?>
					<div class="title-banners">
						Инвестируй и зарабатывай с профи
					</div>
					<p>
						Личный биржевой брокер от Трансстройбанка
					</p>
					<div class="link-banners">
						<a href="/chastnym-klientam/vklady-i-investitsii/investitsii/brokerskoe-obsluzhivanie/" class="btn-site1">Подробнее</a>
					</div>
					<?/*img src="<?=SITE_TEMPLATE_PATH?>/img/safe.png" alt=""*/ ?>
				</div>
			</div>
		</div>
		<div class="wrapp-checking-account">
			<div class="bg-checking-account">
			</div>
			<div class="container">
				<div class="title-checking-account">
					Расчетный счет в Трансстройбанке
				</div>
				<div class="service-packages">
					Пакеты банковских услуг:
				</div>
				<div class="wrapp-list-packages">
					<div class="block-services-packages">
						<div class="name-packages">
							Пакет банковских услуг «Старт»
						</div>
						<div class="price-packages">
							990 руб. в месяц
						</div>
						<?/*div class="info-packages">Выдача наличной валюты под 0,5%</div*/ ?>
					</div>
					<div class="block-services-packages">
						<div class="name-packages">
							Пакет банковских услуг «Оптима»
						</div>
						<div class="price-packages">
							1990 руб. в месяц
						</div>
						<?/*div class="info-packages">Выдача наличной валюты под 0,5%</div*/ ?>
					</div>
					<div class="block-services-packages">
						<div class="name-packages">
							Пакет банковских услуг «Премиум»
						</div>
						<div class="price-packages">
							2990 руб. в месяц
						</div>
						<?/*div class="info-packages">Выдача наличной валюты под 0,5%</div*/ ?>
					</div>
				</div>
				<div class="see-all-tarif">
					<a href="/corporative-clients/bankovskoe-obsluzhivanie/raschetno-kassovoe-obsluzhivanie/">Смотреть все тарифы</a>
				</div>
				<div class="open-account-bank">
					<a href="#cashServiceRequest" data-fancybox="">Открыть счет</a>
				</div>
			</div>
		</div>
		<?/*div class="popup-form" id="salaryProjectRequest">
			<?$APPLICATION->IncludeComponent(
				"webtu:feedback",
				"salary_project",
				Array(
					"ADMIN_EVENT" => "WEBTU_FEEDBACK_SALARY_PROJECT_ADMIN",
					"AJAX_MODE" => "Y",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "N",
					"EVENT_CALLBACK" => function($post){$post['RECOURSE']='Уважаемый(ая)';return$post;},
					"IBLOCK_ID" => "38",
					"POST_CALLBACK" => function($post){$post['TYPE']=implode(',', $post['TYPE']);$post['CURRENCY']=implode(',', $post['CURRENCY']);if(!empty($post['FIRST_NAME'])){$post['NAME']=$post['FIRST_NAME'];}return$post;},
					"PROPERTIES" => array("PHONE","EMAIL","CITY","COMPANY_NAME","EMPLOYEES"),
					"SITES" => array("s1"),
					"USER_EVENT" => "WEBTU_FEEDBACK_SALARY_PROJECT_USER"
				)
			);?>
		</div*/ ?>
		<div class="wrapp-mobil-application-business">
			<div class="container">
				<div class="mobil-application-business">
					<div class="title">
						Мобильное приложение для бизнеса
					</div>
					<p>
						Решение «Мобильный Бизнес Клиент» («МБК») предназначено для организации дистанционного обслуживания индивидуальных предпринимателей, предприятий малого и среднего бизнеса, а также крупных корпоративных клиентов. Решение позволяет клиентам банков управлять счетами своих организаций, используя смартфоны .
					</p>
					<div class="link-store">
						<?/*?><a href="https://apps.apple.com/ru/app/%D1%82%D1%80%D0%B0%D0%BD%D1%81%D1%81%D1%82%D1%80%D0%BE%D0%B9%D0%B1%D0%B0%D0%BD%D0%BA-%D0%BC%D0%B1%D0%BA/id1334142386" target="_blank"><?*/?>
						<a href="https://apps.apple.com/ru/app/тсб-бизнес-онлайн/id1539911932" target="_blank">
                            <img src="/local/templates/czebra_home/img/appstore-new.png" alt="">
                        </a>
                        <?/*?><a href="https://play.google.com/store/apps/details?id=com.bssys.mbcphone.tsb" target="_blank"><?*/?>
                        <a href="https://play.google.com/store/apps/details?id=com.bssys.mbcphone.tsbank" target="_blank">
                            <img src="/local/templates/czebra_home/img/google-play-new.png" alt="">
                        </a>
					</div>
					<div class="more-info-link">
						<a href="https://transstroybank.ru/corporative-clients/bankovskoe-obsluzhivanie/raschetno-kassovoe-obsluzhivanie/" class="btn-site1">Подробнее</a>
					</div>
                    <?/*?><img src="/local/templates/czebra_home/img/mobil-application-buizness.png" alt="" class="img-hidden"><?*/?>
                    <img src="/local/templates/czebra_home/img/mobil-application-buizness.webp" alt="мобильный бизнес" class="img-hidden">
				</div>
			</div>
		</div>
		<div class="wrapp-useful-info">
			<div class="container">
				<div class="title-useful-info">
					Полезная информация для предпринимателей
				</div>
				<div class="wrapp-list-info">
					<div class="list-info">
						<ul>
							<li><a href="/corporative-clients/kredity-i-garantii/kredity-dlya-biznesa/#spoiler-237">Общие условия кредитования</a></li>
							<li><a href="/corporative-clients/kredity-i-garantii/kredity-dlya-biznesa/#spoiler-3925">Требования к заемщикам</a></li>
							<li><a href="/corporative-clients/kredity-i-garantii/kredity-dlya-biznesa/#spoiler-3924">Формы кредитования</a></li>
							<li><a href="/corporative-clients/kredity-i-garantii/bankovskie-garantii/#spoiler-4163">Информация о предоставлении банковских гарантий</a></li>
							<li><a href="/corporative-clients/kredity-i-garantii/bankovskie-garantii/#spoiler-4164">Виды и условия предоставления банковских гарантий</a></li>
							<li><a href="/corporative-clients/kredity-i-garantii/bankovskie-garantii/#spoiler-247">Требования к принципалу</a></li>
						</ul>
					</div>
					<div class="list-info">
						<ul>
							<li><a href="/corporative-clients/kredity-i-garantii/bankovskie-garantii/#spoiler-248">Требования к обеспечению</a></li>
							<li><a href="https://coins.tsbnk.ru/">Подарочные монеты</a></li>
							<li><a href="/corporative-clients/bankovskoe-obsluzhivanie/bankovskie-karty/karty-dlya-biznesa/#spoiler-3606">Тарифы по корпоративным картам</a></li>
							<li><a href="/corporative-clients/bankovskoe-obsluzhivanie/inkassatsiya/#spoiler-3594">Преимущества самоинкассации</a></li>
							<li><a href="/corporative-clients/razmeshchenie-sredstv/vekselya/#spoiler-297">Операции с собственными векселями</a></li>
							<li><a href="/corporative-clients/arenda-seyfov/#spoiler-3973">Особенности пользования банковским индивидуальным сейфом</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news-list",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "news-list",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0 => "PREVIEW_PICTURE", 1 => "DETAIL_PICTURE", 2 => "",),
		"FILTER_NAME" => "specialFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "about",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0 => "LINKS", 1 => "",),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
); ?>
<div class="v21-section">
	<div class="v21-container">
		<div class="v21-grid">

			<div class="v21-grid__item v21-grid__item--1x2@sm">
				<a href="/finansovaya-gramotnost/Finliteracy.php" class="v21-help-card">
					<div class="v21-help-card__text">
						<h3 class="v21-help-card__title v21-h3">Финансовая<br> грамотность</h3>
						<p class="v21-help-card__brief v21-p">Трансстройбанк убедительно просит Вас ознакомиться с простыми правилами защиты от мошеннических действий.</p>
						<div class="v21-help-card__button v21-button">Подробнее</div>
					</div>
                    <?/*?><img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-help-1.png" alt="Финансовая грамотность" class="v21-help-card__image"><?*/?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-help-1.webp" alt="Финансовая грамотность" class="v21-help-card__image">
				</a><!-- /.v21-help-card -->
			</div><!-- /.v21-grid__item -->

			<div class="v21-grid__item v21-grid__item--1x2@sm">
				<a href="/ofisy-i-bankomaty/" class="v21-help-card">
					<div class="v21-help-card__text">
						<h3 class="v21-help-card__title v21-h3">Офисы и<br> банкоматы</h3>
						<p class="v21-help-card__brief v21-p">Кроме сети банкоматов Транстройбанка, Вы можете также воспользоваться услугами банкоматов и ПВН наших партнеров.</p>
						<div class="v21-help-card__button v21-button">Подробнее</div>
					</div>
                    <?/*?><img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-help-2.png" alt="Офисы и банкоматы" class="v21-help-card__image"><?*/?>
                    <img src="<?= SITE_TEMPLATE_PATH ?>/img/v21_v21-help-2.webp" alt="Офисы и банкоматы" class="v21-help-card__image">
				</a><!-- /.v21-help-card -->
			</div><!-- /.v21-grid__item -->

		</div><!-- /.v21-grid -->
	</div><!-- /.v21-container -->
</div><!-- ./v21-section -->

<div class="popup-form" id="agentRequest">
	<? $APPLICATION->IncludeComponent(
		"webtu:feedback",
		"agent",
		array(
			"ADMIN_EVENT" => "WEBTU_FEEDBACK_AGENT_ADMIN",
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"COMPONENT_TEMPLATE" => "agent",
			"EVENT_CALLBACK" => function ($post) {
				if ($post['SEX'] == 'Мужской') {
					$post['RECOURSE'] = 'Уважаемый';
				} else {
					$post['RECOURSE'] = 'Уважаемая';
				}
				return $post;
			},
			"IBLOCK_ID" => "17",
			"POST_CALLBACK" => function ($post) {
				if (!isset($post['CITIZENSHIP'])) {
					$post['CITIZENSHIP'] = 'Нет';
				} else {
					$post['CITIZENSHIP'] = 'Да';
				}
				$post['NAME'] = "{$post['FIRST_NAME']} {$post['SECOND_NAME']} {$post['LAST_NAME']}";
				return $post;
			},
			"PROPERTIES" => array("PHONE", "LAST_NAME", "FIRST_NAME", "SECOND_NAME", "SEX", "BIRTHDATE", "EMAIL", "CITIZENSHIP", "CITY",),
			"SITES" => array(0 => "s1",),
			"USER_EVENT" => "WEBTU_FEEDBACK_AGENT_USER"
		)
	); ?>
</div>

<div class="popup-form formCashService" id="cashServiceRequest">
	<? $APPLICATION->IncludeComponent(
		"webtu:feedback",
		"booking",
		array(
			"ADMIN_EVENT" => "WEBTU_FEEDBACK_BOOKING_ADMINISTRATOR",
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "N",
			"EVENT_CALLBACK" => function ($post) {
				$post['RECOURSE'] = 'Уважаемый(ая)';
				return $post;
			},
			"IBLOCK_ID" => "28",
			"POST_CALLBACK" => function ($post) {
				$post['TYPE'] = implode(',', $post['TYPE']);
				$post['CURRENCY'] = implode(',', $post['CURRENCY']);
				if (!empty($post['FIRST_NAME'])) {
					$post['NAME'] = $post['FIRST_NAME'];
				}
				return $post;
			},
			"PROPERTIES" => array("SEX", "PHONE", "EMAIL", "CITY", "NAME_COMPANY", "INN", "LEGAL_FORM", "ONLINE_BANK", "CURRENCY", "TYPE", "ADDRESS"),
			"SITES" => array("s1"),
			"USER_EVENT" => "WEBTU_FEEDBACK_BOOKING_USER"
		)
	); ?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
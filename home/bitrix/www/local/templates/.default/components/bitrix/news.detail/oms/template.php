<?
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Инвестиции в драгоценные металлы | АКБ «ТрансСтройБанк»");
$APPLICATION->SetTitle("Инвестиции в драгоценные металлы");
Asset::getInstance()->addCss("/assets/css/style-broker-deposit.css?v=1.0.6");

$metal_json_path = $_SERVER["DOCUMENT_ROOT"] . '/currency/metal.json';
$metal = json_decode(file_get_contents($metal_json_path), true);
//$dataID = 10900;
$dataID = 10901;
$course = $metal['data'][$dataID]['currency'];
?>

<div class="page-lf">
    <div class="container">
        <section class="oms-main">
            <header class="oms-main__header">
                <?/*?><h2 class="oms-main__title page-title">Инвестиции <br>в драгоценные металлы</h2><?*/?>
                <h1 class="v21-h1-new">Инвестиции <br>в драгоценные металлы</h1>
                <div class="oms-main__description offset-md-3 col-md-6">Храните деньги в универсальной валюте, которая ценится по всему миру</div>
            </header>
            <div class="oms-main__image">
                <img src="/images/oms/apple.png" alt="Инвестиции в драгоценные металлы"/>
            </div>
        </section>
        <section class="oms-how">
            <header class="oms-how__header">
                <div class="oms-how__header-after"></div>
                <h2 class="oms-how__title">Как хранить деньги в металле?</h2>
                <div class="oms-how__header-before"></div>
            </header>
            <div class="oms-how__wrapper">
                <div class="row">
                    <div class="oms-how__left col-md-6">
                        <div class="oms-how__block">
                            <div class="oms-how__icon"><img src="/images/oms/stone_1.svg"></div>
                            <div class="oms-how__info">
                                <div class="oms-how__name">Обезличенный металлический счёт</div>
                                <div class="oms-how__desc">
                                    <p>Самый простой и удобный способ - открыть обезличенный металлический счёт (ОМС). Вы сможете покупать и продавать драгоценные металлы в любой момент, не владея ими физически.</p>
                                    <p>Почему это удобно, расскажем ниже.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="oms-how__right col-md-5">
                        <div class="oms-how__block">
                            <div class="oms-how__icon"><img src="/images/oms/stone_2.svg"></div>
                            <div class="oms-how__info">
                                <div class="oms-how__name">А что будет на счёте?</div>
                                <div class="oms-how__desc">Вы покупаете металл по ценам, установленным в банке. На ваш счет будет зачислен драгоценный металл в граммах, при этом количество металла не ограничивается весовыми стандартами приобретаемого металла (как в случае физической покупки) и зависит только от вашего желания.</div>
                            </div>
                        </div>
                        <div class="oms-how__block">
                            <div class="oms-how__icon"><img src="/images/oms/stone_3.svg"></div>
                            <div class="oms-how__info">
                                <div class="oms-how__name">Что покупать?</div>
                                <div class="oms-how__desc">
                                    <p>Для инвестирования доступны четыре вида металлов: золото, серебро, платина, палладий. По каждому открывается отдельный ОМС.</p>
                                    <p>Счёт бессрочный. Открытие, ведение и закрытие бесплатные.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="oms-advantages">
            <div class="row">
                <div class="oms-advantages__info col-md-4">
                    <header class="oms-advantages__header">
                        <h2 class="oms-advantages__title">Преимущества обезличенного металлического счёта</h2>
                        <div class="oms-advantages__description">
                            <p>Вкладывая средства в драгоценные металлы в большинстве случаев можно получить проценты выше, чем от вложений в ценные бумаги или банковские вклады.</p>
                            <p>Это объясняется прежде всего тем, что запасы ископаемых ограниченные и трудноизвлекаемые.</p>
                        </div>
                    </header>
                </div>
                <div class="oms-advantages__list col-md-7 offset-md-1">
                    <div class="row">
                        <div class="oms-advantages__item col-sm-6">
                            <div class="oms-advantages__icon"><img src="/images/oms/adv_1.svg"></div>
                            <div class="oms-advantages__name">Без издержек</div>
                            <div class="oms-advantages__desc">Стоимость обезличенного драгоценного металла не включает в себя издержки, связанные с изготовлением слитков, их хранением и транспортировкой</div>
                        </div>
                        <div class="oms-advantages__item col-sm-6">
                            <div class="oms-advantages__icon"><img src="/images/oms/adv_2_1.svg"></div>
                            <div class="oms-advantages__name">Легко получить денежные средства</div>
                            <div class="oms-advantages__desc">Получить денежные средства с металлического счета намного проще, чем продать слитки, — нет необходимости проверять подлинность, целостность и массу слитков</div>
                        </div>
                        <div class="oms-advantages__item col-sm-6">
                            <div class="oms-advantages__icon"><img src="/images/oms/adv_3.svg"></div>
                            <div class="oms-advantages__name">Налоговые преимущества</div>
                            <div class="oms-advantages__desc">Если металл находится в собственности Клиента более 3 лет, доход от его продажи не облагается НДФЛ</div>
                        </div>
                        <div class="oms-advantages__item col-sm-6">
                            <div class="oms-advantages__icon"><img src="/images/oms/adv_4.svg"></div>
                            <div class="oms-advantages__name">Без НДС</div>
                            <div class="oms-advantages__desc">При покупке обезличенного металла не взимается НДС</div>
                        </div>
                        <div class="oms-advantages__item col-sm-6">
                            <div class="oms-advantages__icon"><img src="/images/oms/adv_5.svg"></div>
                            <div class="oms-advantages__name">Торговля 24/7</div>
                            <div class="oms-advantages__desc">Возможность торговать онлайн через мобильное приложение и интернет-банк</div>
                        </div>
                        <div class="oms-advantages__item col-sm-6">
                            <div class="oms-advantages__icon"><img src="/images/oms/adv_6.svg"></div>
                            <div class="oms-advantages__name">Надёжность</div>
                            <div class="oms-advantages__desc">Драгметаллы не подвержены инфляции, а их стоимость исторически только растёт</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="oms-price">
            <header class="oms-price__header">
                <h2 class="oms-price__title">Цены на металл за грамм в Москве, ₽  – <?=$metal['data'][$dataID]['date']?></h2>
            </header>
            <div class="oms-price__wrapper">
                <div class="row">
                    <div class="oms-price__item col-sm-6 col-md-4 col-lg-3">
                        <div class="oms-price__image">
                            <img class="oms-price__image-back" src="/images/oms/price_back_1.png">
                            <img class="oms-price__image-stone" src="/images/oms/price_1.png" alt="Au">
                            <span class="oms-price__image-n">Au</span>
                        </div>
                        <div class="oms-price__name">Золото</div>
                        <div class="oms-price__value">
                            <div class="row">
                                <div class="oms-price__buy col-6">
                                    <div class="oms-price__value-title">покупка</div>
                                    <div class="oms-price__value-price"><?=$course['XAU']['buy']?></div>
                                    <div class="oms-price__value-difference">
										<?=$course['XAU']['difference_buy'] > 0 ? '+ ' . $course['XAU']['difference_buy'] : $course['XAU']['difference_buy']?>
									</div>
                                </div>
                                <div class="oms-price__sell col-6">
                                    <div class="oms-price__value-title">продажа</div>
                                    <div class="oms-price__value-price"><?=$course['XAU']['sell']?></div>
                                    <div class="oms-price__value-difference">
										<?=$course['XAU']['difference_sell'] > 0 ? '+ ' . $course['XAU']['difference_sell'] : $course['XAU']['difference_sell']?>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="oms-price__desc">Основное применение в наши дни золото находит в ювелирной промышленности. В мировой экономике этот драгметалл может использоваться в качестве золотого стандарта – гарантированного наполнения национальных валют. Самое большое количество золота в мире добывается в ЮАР.</div>
                    </div>
                    <div class="oms-price__item col-sm-6 col-md-4 col-lg-3">
                        <div class="oms-price__image">
                            <img class="oms-price__image-back" src="/images/oms/price_back_2.png">
                            <img class="oms-price__image-stone" src="/images/oms/price_2.png" alt="Ag">
                            <span class="oms-price__image-n">Ag</span>
                        </div>
                        <div class="oms-price__name">Серебро</div>
                        <div class="oms-price__value">
                            <div class="row">
                                <div class="oms-price__buy col-6">
                                    <div class="oms-price__value-title">покупка</div>
                                    <div class="oms-price__value-price"><?=$course['XAG']['buy']?></div>
                                    <div class="oms-price__value-difference">
										<?=$course['XAG']['difference_buy'] > 0 ? '+ ' . $course['XAG']['difference_buy'] : $course['XAG']['difference_buy']?>
									</div>
                                </div>
                                <div class="oms-price__sell col-6">
                                    <div class="oms-price__value-title">продажа</div>
                                    <div class="oms-price__value-price"><?=$course['XAG']['sell']?></div>
                                    <div class="oms-price__value-difference">
										<?=$course['XAG']['difference_sell'] > 0 ? '+ ' . $course['XAG']['difference_sell'] : $course['XAG']['difference_sell']?>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="oms-price__desc">Росту интереса на серебро помогает его использование в промышленном производстве электроники и солнечных батарей. В добыче лидируют Перу, Мексика, Китай, Чили, Австралия, Польша, США, Канада.</div>
                    </div>
                    <div class="oms-price__item col-sm-6 col-md-4 col-lg-3">
                        <div class="oms-price__image">
                            <img class="oms-price__image-back" src="/images/oms/price_back_3.png">
                            <img class="oms-price__image-stone" src="/images/oms/price_3.png" alt="Pt">
                            <span class="oms-price__image-n">Pt</span>
                        </div>
                        <div class="oms-price__name">Платина</div>
                        <div class="oms-price__value">
                            <div class="row">
                                <div class="oms-price__buy col-6">
                                    <div class="oms-price__value-title">покупка</div>
                                    <div class="oms-price__value-price"><?=$course['XPT']['buy']?></div>
                                    <div class="oms-price__value-difference">
										<?=$course['XPT']['difference_buy'] > 0 ? '+ ' . $course['XPT']['difference_buy'] : $course['XPT']['difference_buy']?>
									</div>
                                </div>
                                <div class="oms-price__sell col-6">
                                    <div class="oms-price__value-title">продажа</div>
                                    <div class="oms-price__value-price"><?=$course['XPT']['sell']?></div>
                                    <div class="oms-price__value-difference">
										<?=$course['XPT']['difference_sell'] > 0 ? '+ ' . $course['XPT']['difference_sell'] : $course['XPT']['difference_sell']?>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="oms-price__desc">Основной потребитель платины - автомобилестроение. Она требуется для очищения выхлопных газов автомобилей с дизелем. Больше всего платины добывается в ЮАР, России, США и Зимбабве.</div>
                    </div>
                    <div class="oms-price__item col-sm-6 col-md-4 col-lg-3">
                        <div class="oms-price__image">
                            <img class="oms-price__image-back" src="/images/oms/price_back_4.png">
                            <img class="oms-price__image-stone" src="/images/oms/price_4.png" alt="Pd">
                            <span class="oms-price__image-n">Pd</span>
                        </div>
                        <div class="oms-price__name">Палладий</div>
                        <div class="oms-price__value">
                            <div class="row">
                                <div class="oms-price__buy col-6">
                                    <div class="oms-price__value-title">покупка</div>
                                    <div class="oms-price__value-price"><?=$course['XPD']['buy']?></div>
                                    <div class="oms-price__value-difference">
										<?=$course['XPD']['difference_buy'] > 0 ? '+ ' . $course['XPD']['difference_buy'] : $course['XPD']['difference_buy']?>
									</div>
                                </div>
                                <div class="oms-price__sell col-6">
                                    <div class="oms-price__value-title">продажа</div>
                                    <div class="oms-price__value-price"><?=$course['XPD']['sell']?></div>
                                    <div class="oms-price__value-difference">
										<?=$course['XPD']['difference_sell'] > 0 ? '+ ' . $course['XPD']['difference_sell'] : $course['XPD']['difference_sell']?>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="oms-price__desc">Как и платину, палладий применяют для очищения выхлопов, но в бензиновых автомобилях. Палладий способен поглотить выхлопы в 900 раз превышающие его собственный вес. На Россию и Южную Африку приходится до 80% запасов в мире.</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="oms-coins">
            <div class="row">
                <div class="oms-coins__image col-md-6 col-lg-5 offset-lg-1">
                    <img src="/images/oms/coins.png" alt="Инвестиционные монеты">
                </div>
                <div class="oms-coins__info col-md-6 col-lg-5">
                    <header class="oms-coins__header">
                        <h2 class="oms-coins__title">Инвестиционные монеты</h2>
                        <div class="oms-coins__description">Помимо стандартных слитков, торгуемых на биржах, в обращении находятся также золотые и серебряные монеты. В нашем магазине вы можете собрать инвестиционный портфель из редких драгоценных монет со всего мира.</div>
                    </header>
                    <a href="https://coins.tsbnk.ru" target="_blank" class="oms-coins__button">В магазин</a>
                </div>
            </div>
        </section>
        <section class="oms-form">
            <header class="oms-form__header">
                <h2 class="oms-form__title page-title">Открыть счёт в драгоценных металлах</h2>
            </header>
            <div class="row">
                <div class="oms-form__steps offset-md-2 col-md-8 offset-lg-3 col-lg-6">
                    <div class="row">
                        <div class="oms-form__step col-sm-4">
                            <div class="oms-form__step-icon">
                                <img src="/images/oms/step-icon.svg" alt="">
                                <span>1</span>
                            </div>
                            <div class="oms-form__step-desc">Вы подаёте заявку, и мы связываемся с вами</div>
                        </div>
                        <div class="oms-form__step col-sm-4">
                            <div class="oms-form__step-icon">
                                <img src="/images/oms/step-icon.svg" alt="">
                                <span>2</span>
                            </div>
                            <div class="oms-form__step-desc">Заключаем договор на открытие ОМС</div>
                        </div>
                        <div class="oms-form__step col-sm-4">
                            <div class="oms-form__step-icon">
                                <img src="/images/oms/step-icon.svg" alt="">
                                <span>3</span>
                            </div>
                            <div class="oms-form__step-desc">Выбираете металл и оформляете покупку</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="oms-form__wrapper offset-md-3 col-md-6">
					<?$APPLICATION->IncludeComponent(
						"webtu:feedback",
						"oms",
						Array(
							"ADMIN_EVENT" => "OMS_OPEN_ADMIN",
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
                            "USER_EVENT" => "OMS_OPEN_USER",
                            "UTM" => "126",
						)
					);?>
                </div>
            </div>
        </section>
        <section class="oms-gk">
            <span class="oms-gk__info"><img src="/images/oms/info.svg" alt=""></span>
            <p>АКБ «Трансстройбанк» (АО), принимая во внимание требования п. 3 ст. 859.1 Гражданского кодекса Российской Федерации, уведомляет о том, что к отношениям по Договору банковского счета в металле физического лица в АКБ «Трасстройбанк» (АО) не применяются положения Федерального закона от 23.12.2003 № 177-ФЗ «О страховании вкладов в банках Российской Федерации».</p>
        </section>
        <section class="oms-docs">
            <header class="oms-docs__header">
                <h2 class="oms-docs__title page-title">Документы</h2>
            </header>
            <div class="oms-docs__list">
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
		"ELEMENT_ID" => "8937",
		"FIELD_CODE" => array("", ""),
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
		"PROPERTY_CODE" => array("", "DOCUMENTS", "CLASSES"),
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
        </section>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
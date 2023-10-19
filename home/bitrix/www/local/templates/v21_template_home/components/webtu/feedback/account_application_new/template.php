<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<? IncludeTemplateLangFile(__FILE__); ?>

<!--div class="v21-container"-->
    <?//debugg($arResult);?>
    <div class="form-block">
        <div class="form-block--left">
            <?/*?>
            <div class="form-block--triags">
                <svg xmlns="http://www.w3.org/2000/svg" width="885" height="841" viewBox="0 0 885 841" fill="none">
                    <path style="mix-blend-mode:color-dodge" d="M528.257 563.993L283.254 358.475C263.038 341.509 268.757 309.019 293.553 299.994L594.033 190.577C618.83 181.552 644.106 202.756 639.526 228.745L584.035 543.681C579.454 569.671 548.459 580.958 528.229 564.006L528.257 563.993Z" stroke="url(#paint0_linear_1656_1064)" stroke-width="4.11447" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.95" d="M523.62 574.608L273.652 364.921C247.992 343.402 255.261 302.162 286.723 290.71L593.306 179.07C624.782 167.605 656.847 194.513 651.046 227.498L594.43 548.824C588.615 581.808 549.281 596.141 523.62 574.608V574.608Z" stroke="url(#paint1_linear_1656_1064)" stroke-width="3.93618" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.9" d="M519 585.237L264.067 371.381C232.962 345.295 241.767 295.318 279.908 281.438L592.58 167.591C630.721 153.698 669.59 186.312 662.554 226.291L604.814 553.995C597.765 593.973 550.092 611.337 519 585.237Z" stroke="url(#paint2_linear_1656_1064)" stroke-width="3.75788" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.86" d="M514.365 595.866L254.453 377.84C217.917 347.188 228.258 288.488 273.078 272.167L591.84 156.098C636.647 139.777 682.317 178.096 674.047 225.056L615.183 559.151C606.913 606.125 550.887 626.519 514.351 595.866H514.365Z" stroke="url(#paint3_linear_1656_1064)" stroke-width="3.57959" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.81" d="M509.742 606.495L244.866 384.3C202.885 349.094 214.776 281.644 266.261 262.896L591.126 144.605C642.612 125.856 695.085 169.868 685.567 223.836L625.578 564.322C616.074 618.276 551.723 641.715 509.742 606.495Z" stroke="url(#paint4_linear_1656_1064)" stroke-width="3.4013" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.76" d="M505.108 617.111L235.267 390.746C187.855 350.973 201.281 274.787 259.433 253.611L590.387 133.098C648.538 111.922 707.814 161.639 697.075 222.588L635.962 569.451C625.223 630.401 552.534 656.87 505.121 617.097L505.108 617.111Z" stroke="url(#paint5_linear_1656_1064)" stroke-width="3.223" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.71" d="M500.487 627.74L225.682 397.206C172.824 352.865 187.787 267.943 252.618 244.339L589.662 121.605C654.478 98.0013 720.557 153.423 708.584 221.367L646.345 574.622C634.372 642.565 553.345 672.066 500.487 627.726V627.74Z" stroke="url(#paint6_linear_1656_1064)" stroke-width="3.03099" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.67" d="M495.849 638.369L216.065 403.679C157.777 354.786 174.276 261.113 245.772 235.082L588.918 110.139C660.414 84.1083 733.282 145.236 720.074 220.16L656.711 579.806C643.504 654.731 554.138 687.276 495.849 638.383V638.369Z" stroke="url(#paint7_linear_1656_1064)" stroke-width="2.8527" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.62" d="M491.213 648.984L206.464 410.125C142.731 356.665 160.78 254.255 238.941 225.797L588.177 98.6323C666.338 70.1739 746.008 136.993 731.566 218.912L667.079 584.949C652.651 666.868 554.946 702.445 491.213 648.984V648.984Z" stroke="url(#paint8_linear_1656_1064)" stroke-width="2.67441" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.57" d="M486.59 659.613L196.877 416.585C127.712 358.557 147.284 247.425 232.124 216.526L587.45 87.1392C672.29 56.2532 758.749 128.778 743.073 217.691L677.461 590.106C661.798 679.02 555.755 717.627 486.59 659.613V659.613Z" stroke="url(#paint9_linear_1656_1064)" stroke-width="2.49611" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.52" d="M481.958 670.242L187.266 423.045C112.657 360.464 133.778 240.582 225.284 207.254L586.713 75.6461C678.218 42.3326 771.48 120.562 754.583 216.457L687.846 595.263C670.949 691.171 556.567 732.81 481.958 670.229V670.242Z" stroke="url(#paint10_linear_1656_1064)" stroke-width="2.31782" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.48" d="M477.334 680.871L177.677 429.505C97.6364 362.356 120.293 233.738 218.465 197.983L585.983 64.1532C684.154 28.3984 784.218 112.334 766.087 215.237L698.226 600.433C680.095 703.323 557.374 748.02 477.334 680.871V680.871Z" stroke="url(#paint11_linear_1656_1064)" stroke-width="2.13953" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.43" d="M472.701 691.487L168.079 435.951C82.5944 364.235 106.801 226.881 211.638 188.712L585.246 52.6738C690.096 14.4915 796.949 104.132 777.584 214.016L708.598 605.59C689.232 715.474 558.186 763.202 472.701 691.487V691.487Z" stroke="url(#paint12_linear_1656_1064)" stroke-width="1.96123" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.38" d="M468.061 702.116L158.475 442.41C67.5448 366.142 93.2877 220.037 204.804 179.441L584.514 41.1806C696.03 0.570804 809.686 95.9168 789.086 212.795L718.975 610.761C698.389 727.639 558.991 778.398 468.061 702.129V702.116Z" stroke="url(#paint13_linear_1656_1064)" stroke-width="1.78294" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.33" d="M463.441 712.745L148.876 448.87C52.5146 368.034 79.7936 213.207 197.975 170.169L583.775 29.6876C701.957 -13.3498 822.415 87.7016 800.594 211.561L729.359 615.918C707.538 739.791 559.802 793.58 463.441 712.745V712.745Z" stroke="url(#paint14_linear_1656_1064)" stroke-width="1.60464" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.29" d="M458.806 723.374L139.276 455.33C37.4707 369.927 66.2994 206.363 191.146 160.898L583.05 18.1946C707.91 -27.2703 835.157 79.4728 812.102 210.34L739.742 621.088C716.688 751.942 560.612 808.777 458.82 723.388L458.806 723.374Z" stroke="url(#paint15_linear_1656_1064)" stroke-width="1.42635" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.24" d="M454.184 733.989L129.676 461.79C22.4387 371.833 52.7898 199.519 184.316 151.627L582.309 6.70153C713.834 -41.1909 847.884 71.2576 823.595 209.106L750.11 626.231C725.821 764.08 561.421 823.945 454.184 733.989V733.989Z" stroke="url(#paint16_linear_1656_1064)" stroke-width="1.23434" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.19" d="M449.55 744.618L120.09 468.249C7.40844 373.726 39.3093 192.675 177.501 142.355L581.583 -4.79185C719.774 -55.1118 860.626 63.0421 835.103 207.885L760.494 631.401C734.97 776.245 562.231 839.141 449.55 744.618V744.618Z" stroke="url(#paint17_linear_1656_1064)" stroke-width="1.05605" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.14" d="M444.925 755.247L110.487 474.695C-7.6392 375.619 25.7978 185.832 170.668 133.084L580.854 -16.2848C725.724 -69.0323 873.365 54.8133 846.621 206.651L770.874 636.558C744.13 788.396 563.038 854.324 444.925 755.247V755.247Z" stroke="url(#paint18_linear_1656_1064)" stroke-width="0.877754" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.1" d="M440.291 765.876L100.888 481.155C-22.6694 377.511 12.3036 178.988 163.84 123.799L580.114 -27.7778C731.65 -82.9529 886.094 46.5981 858.116 205.417L781.243 641.702C753.265 800.52 563.835 869.492 440.291 765.849V765.876Z" stroke="url(#paint19_linear_1656_1064)" stroke-width="0.69946" stroke-miterlimit="10"/>
                    <path style="mix-blend-mode:color-dodge" opacity="0.05" d="M435.656 776.492L91.2881 487.615C-37.7006 379.404 -1.19152 172.144 157.024 114.528L579.388 -39.2573C737.589 -96.8599 898.835 38.3965 869.623 204.21L791.626 646.886C762.413 812.699 564.658 884.716 435.656 776.505V776.492Z" stroke="url(#paint20_linear_1656_1064)" stroke-width="0.521166" stroke-miterlimit="10"/>
                    <defs>
                        <linearGradient id="paint0_linear_1656_1064" x1="658.793" y1="480.696" x2="382.052" y2="203.979" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00246A"/>
                            <stop offset="1" stop-color="#00345E"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear_1656_1064" x1="634.827" y1="539.619" x2="406.621" y2="204.914" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002569"/>
                            <stop offset="1" stop-color="#00335E"/>
                        </linearGradient>
                        <linearGradient id="paint2_linear_1656_1064" x1="591.177" y1="587.729" x2="428.332" y2="214.508" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002669"/>
                            <stop offset="1" stop-color="#00325D"/>
                        </linearGradient>
                        <linearGradient id="paint3_linear_1656_1064" x1="532.771" y1="618.691" x2="434.814" y2="189.582" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002668"/>
                            <stop offset="1" stop-color="#00315D"/>
                        </linearGradient>
                        <linearGradient id="paint4_linear_1656_1064" x1="466.479" y1="628.28" x2="448.366" y2="144.712" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002768"/>
                            <stop offset="1" stop-color="#00305C"/>
                        </linearGradient>
                        <linearGradient id="paint5_linear_1656_1064" x1="400.292" y1="614.988" x2="477.239" y2="104.393" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002867"/>
                            <stop offset="1" stop-color="#002F5C"/>
                        </linearGradient>
                        <linearGradient id="paint6_linear_1656_1064" x1="369.618" y1="589.83" x2="546.79" y2="83.4294" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002967"/>
                            <stop offset="1" stop-color="#002E5B"/>
                        </linearGradient>
                        <linearGradient id="paint7_linear_1656_1064" x1="353.513" y1="559.642" x2="625.393" y2="88.696" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002966"/>
                            <stop offset="1" stop-color="#002D5B"/>
                        </linearGradient>
                        <linearGradient id="paint8_linear_1656_1064" x1="345.435" y1="531.45" x2="699.612" y2="119.876" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002A65"/>
                            <stop offset="1" stop-color="#002C5B"/>
                        </linearGradient>
                        <linearGradient id="paint9_linear_1656_1064" x1="295.077" y1="545.556" x2="760.782" y2="174.142" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002B65"/>
                            <stop offset="1" stop-color="#002B5A"/>
                        </linearGradient>
                        <linearGradient id="paint10_linear_1656_1064" x1="238.803" y1="543.324" x2="801.713" y2="245.806" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002C64"/>
                            <stop offset="1" stop-color="#002A5A"/>
                        </linearGradient>
                        <linearGradient id="paint11_linear_1656_1064" x1="179.578" y1="513.528" x2="814.675" y2="317.598" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002C64"/>
                            <stop offset="1" stop-color="#002959"/>
                        </linearGradient>
                        <linearGradient id="paint12_linear_1656_1064" x1="127.05" y1="437.974" x2="801.411" y2="361.97" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002D63"/>
                            <stop offset="1" stop-color="#002859"/>
                        </linearGradient>
                        <linearGradient id="paint13_linear_1656_1064" x1="100.336" y1="347.396" x2="776.945" y2="398.085" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002E63"/>
                            <stop offset="1" stop-color="#002758"/>
                        </linearGradient>
                        <linearGradient id="paint14_linear_1656_1064" x1="103.317" y1="251.248" x2="780.019" y2="432.536" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002F62"/>
                            <stop offset="1" stop-color="#002658"/>
                        </linearGradient>
                        <linearGradient id="paint15_linear_1656_1064" x1="136.404" y1="159.694" x2="813.178" y2="485.589" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#002F61"/>
                            <stop offset="1" stop-color="#002558"/>
                        </linearGradient>
                        <linearGradient id="paint16_linear_1656_1064" x1="196.517" y1="82.6006" x2="830.697" y2="550.612" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#003061"/>
                            <stop offset="1" stop-color="#002457"/>
                        </linearGradient>
                        <linearGradient id="paint17_linear_1656_1064" x1="257.615" y1="46.4409" x2="808.838" y2="640.486" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#003160"/>
                            <stop offset="1" stop-color="#002357"/>
                        </linearGradient>
                        <linearGradient id="paint18_linear_1656_1064" x1="312.971" y1="37.6516" x2="747.759" y2="729.564" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#003260"/>
                            <stop offset="1" stop-color="#002256"/>
                        </linearGradient>
                        <linearGradient id="paint19_linear_1656_1064" x1="364.996" y1="44.3952" x2="660.496" y2="797.234" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00325F"/>
                            <stop offset="1" stop-color="#002156"/>
                        </linearGradient>
                        <linearGradient id="paint20_linear_1656_1064" x1="395.616" y1="-7.79934" x2="555.273" y2="835.83" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#00335F"/>
                            <stop offset="1" stop-color="#002055"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <?*/?>
            <div class="form-block--image">
                <img src="/corporative-clients/bankovskoe-obsluzhivanie/accounts-in-yuans/images/airplane_250.png" class="form-block--image-768" alt="самолетик">
                <img src="/corporative-clients/bankovskoe-obsluzhivanie/accounts-in-yuans/images/airplane_400.png" class="form-block--image-1024" alt="самолетик">
                <img src="/corporative-clients/bankovskoe-obsluzhivanie/accounts-in-yuans/images/airplane_539.png" class="form-block--image-1366" alt="самолетик">
            </div>
            <!--p class="form-block--thank">Спасибо <i>за&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;обращение</i></p-->
        </div>
        <div class="form-block--right">
            <?/*?><form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="v21-card-application--form" id="fBusinessCreditForm"><?*/?>
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="card-application--form" id="applicationForm">
                <input type="hidden" name="FORM_ID" value="<?=$arResult['FORM_ID']?>">
                <input type="hidden" name="SESSION_ID" value="<?=bitrix_sessid()?>">
                <input type="hidden" name="PARAMS" value='<?= json_encode($arParams) ?>'>
                <input type="hidden" id="PROPERTIES" name="PROPERTIES" value='<?= json_encode($arParams["PROPERTIES"]) ?>'>
                <?
                if (isset($_POST['CREDIT_NAME'])) { $creditName = $_POST['CREDIT_NAME']; } else { $creditName = 'MIR'; }
                ?>
                <?/*?><input type="hidden" name="CARD_NAME" id="credit_name" value="<?=$creditName?>">
                <?/*?><input type="hidden" id="PARAMS" name="PARAMS" value="<?= json_encode($arParams['PROPERTIES']) ?>"><?*/?>
                <input type="hidden" name="REQ_URI" value="<?= $_SERVER['REQUEST_URI'] ?>">
                <input type="hidden" name="FOLDER" value="<?= $APPLICATION->GetTitle() ?>">

                <div class="card-application--content">
                    <?/*?><h2 class="card-application--header"><?= GetMessage("WEBTU_FEEDBACK_3_HEADER") ?></h2><?*/?>
                    <h2 class="card-application--header"><?= $arParams['FORM_HEADER'] ?></h2>

                    <?/* if (!empty($arResult['ERRORS'])) { ?>
                        <? foreach ($arResult['ERRORS'] as $error) { ?>
                            <div class="alert alert-danger"><?=$error?></div>
                        <? } ?>
                    <? } ?>

                    <? if (!empty($arResult['SUCCESS'])) { ?>
                        <? foreach ($arResult['SUCCESS'] as $success) { ?>
                            <div class="alert alert-success"><?=$success?></div>
                        <? } ?>
                    <? } */?>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <input class="input-group__field"
                                        type="text"
                                        name="COMPANY_NAME"
                                        placeholder="Название организации"
                                        <?// value пишу в input[name=NAME]?>
                                        onchange="javascript:document.getElementById('name_'+'<?=$arResult['FORM_ID']?>').value = this.value;"
                                    <? if (isset($arResult['POST']['COMPANY_NAME'])) { ?> value="<?=$arResult['POST']['COMPANY_NAME']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_ORGANIZATION")?></span><?*/?>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="NAME" value="<?=$arResult['POST']['COMPANY_NAME']?>" id="<?= 'name_'.$arResult['FORM_ID']; ?>">

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <input class="input-group__field"
                                        type="text"
                                        name="COMPANY_INN"
                                        placeholder="ИНН компании"
                                    <? if (isset($arResult['POST']['COMPANY_INN'])) { ?> value="<?=$arResult['POST']['COMPANY_INN']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_INN")?></span><?*/?>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                            </label>
                        </div>
                    </div>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_NAME")?></span><?*/?>
                                <input class="input-group__field"
                                        type="text" name="FIO"
                                        placeholder="ФИО"
                                    <? if (isset($arResult['POST']['FIO'])) { ?> value="<?=$arResult['POST']['FIO']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="input-group__label"><?=GetMessage("WEBTU_FEEDBACK_3_NAME")?></span><?*/?>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                            </label>
                        </div>
                    </div>

                    <??>
                    <div class="card-application--form__section">
                        <?// debugg($arResult["CITIES"]); ?>
                        <div class="grid__item-2">
                            <div class="input-group js-change-input-color">
                                <?/*?><span class="input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_CITY") ?></span><?*/?>
                                <?// CModule::IncludeModule('iblock'); ?>
                                <?/*?><? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114)); ?>
                                <select name="CITY" class="input-group__field select_field">
                                    <? while ($city = $cities->Fetch()) : ?>
                                        <option value="<?= $city['NAME'] ?>">
                                            <?= $city['NAME'] ?>
                                        </option>
                                    <? endwhile; ?>
                                </select>
                                <?*/?>
                                <?/*?><span class="input-group__label input-group__label--city"><?= GetMessage("WEBTU_FEEDBACK_3_CITY") ?></span><?*/?>
                                <? $cities = CIblockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => 114)); ?>
                                <select name="CITY" class="v21-input-group__field v21-select js-v21-select city-select">
                                    <? foreach ($arResult['CITIES'] as $city) : ?>
                                        <option value="<?= $city ?>"
                                                <? if ($arResult['POST']['CITY'] == $city) { ?>selected<? } ?>
                                                <?/* if (!isset($arResult['POST']['CITY']) && $city == $arResult['SPECIAL_CITY']) { ?>selected<? } */?>>
                                            <?= $city ?>
                                        </option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <? //debugg($arResult['ACCOUNT_CURRENCY']); ?>
                        <div class="grid__item-2">
                            <div class="input-group js-change-input-color">
                                <?/*?><span class="input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_CITY") ?></span><?*/?>
                                <?/*?><span class="input-group__label input-group__label--city"><?= GetMessage("WEBTU_FEEDBACK_3_CITY") ?></span><?*/?>
                                <select name="CURRENCY" class="v21-input-group__field v21-select js-v21-select city-select">
                                    <? foreach ($arResult['ACCOUNT_CURRENCY'] as $curr) : ?>
                                        <option value="<?= $curr ?>"
                                                <? if ($arResult['POST']['CURRENCY'] == $curr) { ?>selected<? } ?>
                                                <?/* if (!isset($arResult['POST']['CURRENCY']) && $city['CURRENCY'] == $arResult['SPECIAL_CITY']) { ?>selected<? } */?>>
                                            <?= $curr ?>
                                        </option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <??>

                    <div class="card-application--form__section">
                    <div class="grid__item-2">
                            <label class="input-group">
                                <input class="input-group__field"
                                    type="email" name="EMAIL"
                                    placeholder="Электронная почта"
                                    <? if (isset($arResult['POST']['EMAIL'])) { ?> value="<?=$arResult['POST']['EMAIL']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                                <?/*?><span class="input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_EMAIL") ?></span><?*/?>
                                <?/*?><span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_3_EMAIL_LINE") ?></span><?*/?>
                            </label>
                        </div>

                        <div class="grid__item-2">
                            <label class="input-group">
                                <input class="input-group__field" required
                                    type="tel" name="PHONE"
                                    <?/*?>placeholder="+7 ___ ___ __ __"<?*/?>
                                    placeholder="Мобильный телефон"
                                    data-inputmask="'mask': '+7 999 999 99 99'"
                                    <? if (isset($arResult['POST']['PHONE'])) { ?> value="<?=$arResult['POST']['PHONE']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="input-group__label"><?= GetMessage("WEBTU_FEEDBACK_3_PHONE") ?></span><?*/?>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                                <?/*?><span class="v21-input-group__note"><?= GetMessage("WEBTU_FEEDBACK_3_PHONE_LINE") ?></span><?*/?>
                            </label>
                        </div>
                    </div>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <label class="input-group">
                                <input class="input-group__field"
                                        type="text"
                                        name="FROM_WHERE"
                                        placeholder="Откуда Вы узнали о нас"
                                    <? if (isset($arResult['POST']['FROM_WHERE'])) { ?> value="<?=$arResult['POST']['FROM_WHERE']?>" <? } ?>
                                >
                                <div class="input-group--achtung">
                                    <span class="input-group--warn">Обязательное поле к заполнению</span>
                                </div>
                                <?/*?><span class="input-group__label">Откуда Вы узнали о нас</span><?*/?>
                                <?/*?><span class="v21-input-group__warn">Обязательное поле к заполнению</span><?*/?>
                            </label>
                        </div>
                    </div>

                    <div class="card-application--form__section card-application--form__captcha">
                        <?
                        $politics = GetMessage("WEBTU_FEEDBACK_3_POLITICS");
                        $politics_1 = "<a href='/assets/docs/Правила оформления онлайн заявок.pdf' target='_blank' class='v21-link'><span>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_1"). "</span></a>";
                        $politics_2 = "<a href='/assets/docs/Согласие на обработку ПД для сайта.pdf' target='_blank' class='v21-link'><span>" .GetMessage("WEBTU_FEEDBACK_3_POLITICS_2"). "</span></a>";
                        $politics_output = sprintf($politics, $politics_1, $politics_2);
                        ?>

                        <div class="grid__item-1 grid__item-48">
                            <div class="v21-checkbox">
                                <label class="v21-checkbox__content">
                                    <input type="checkbox" checked name="" class="v21-checkbox__input" id="politics2">
                                    <div class="v21-checkbox__text"><?= $politics_output ?></div>
                                </label>
                                <span class="v21-checkbox__warn">Для подачи заявки необходимо подтвердить свое ознакомление и соглашение с правилами</span>
                                <?/*?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                        <path d="M4.35462 8.83905L9.85267 2.93903C9.94763 2.8316 10 2.6933 10 2.55005C10 2.4068 9.94763 2.26846 9.85267 2.16104C9.8081 2.11044 9.75321 2.06988 9.6917 2.04211C9.63019 2.01434 9.56345 2 9.49594 2C9.42842 2 9.36168 2.01434 9.30017 2.04211C9.23866 2.06988 9.18378 2.11044 9.1392 2.16104L4.00291 7.67303L0.861593 4.16403C0.816839 4.11355 0.76184 4.07313 0.700259 4.04544C0.638677 4.01776 0.571911 4.00345 0.50437 4.00345C0.436829 4.00345 0.370062 4.01776 0.308481 4.04544C0.246899 4.07313 0.191901 4.11355 0.147146 4.16403C0.0523127 4.27171 0 4.41017 0 4.55353C0 4.69689 0.0523127 4.83537 0.147146 4.94305L3.64519 8.84305C3.69037 8.89218 3.74535 8.93132 3.80659 8.95798C3.86783 8.98464 3.93395 8.99821 4.00076 8.99783C4.06758 8.99746 4.13358 8.98316 4.19451 8.95581C4.25545 8.92846 4.31001 8.88869 4.35462 8.83905Z" fill="#FFFFFF"/>
                                    </svg>
                                <?*/?>
                            </div>
                        </div>

                        <div class="grid__item-captcha grid__item-48">
                            <div class="grid__item-2">
                                <div class="captcha_image">
                                    <input type="hidden" id="captchaSid" name="CAPTCHA_ID" value="<?= $arResult['CAPTCHA'] ?>" />
                                    <img id="captchaImg" src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['CAPTCHA'] ?>" alt="капча">
                                </div>

                                <a id="reloadCaptcha" title="Обновить капчу"></a>
                            </div>

                            <div class="grid__item-2">
                                <?/*?><div class="captcha_input v21-input-group"><?*/?>
                                <div class="v21-input-group">
                                    <input type="text" name="CAPTCHA_WORD" placeholder="<?= GetMessage('WEBTU_FEEDBACK_CAPTCHA') ?>" class="input-group__field input-captcha" id="CAPTCHA_WORD">
                                    <span class="v21-input-group__warn">Неверно введен код с картинки</span>
                                    <?/* if (in_array("Неверно введен код с картинки", $arResult['ERRORS'])) : ?>
                                        <span class="v21-input-group__warn" style="display: block;">Неверно введен код с картинки</span>
                                    <? endif; */?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-application--form__section">
                        <div class="grid__item-1">
                            <button class="grid__item-button" name="WEBTU_FEEDBACK">
                                <?= GetMessage("WEBTU_FEEDBACK_3_BUTTON") ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                    <path d="M14.7307 1.51639C14.7307 0.964101 14.283 0.516386 13.7307 0.516386L4.73068 0.516387C4.1784 0.516386 3.73068 0.964102 3.73068 1.51639C3.73068 2.06867 4.1784 2.51639 4.73068 2.51639L12.7307 2.51639L12.7307 10.5164C12.7307 11.0687 13.1784 11.5164 13.7307 11.5164C14.283 11.5164 14.7307 11.0687 14.7307 10.5164L14.7307 1.51639ZM1.70711 14.9542L14.4378 2.22349L13.0236 0.80928L0.292893 13.54L1.70711 14.9542Z" fill="white"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <?/* if (!empty($arResult['SUCCESS'])) {
                        LocalRedirect('/thanks/');
                    } */?>

                </div><!-- v21-card-application--form__section -->
            </form>
        </div>
    </div>

<!--/div-->

<script type="text/javascript">
    $(document).ready(function() {
        $('input[name=NAME]').val($('input[name=COMPANY_NAME]').val()); // пишу в input[name=NAME] исходное значение из input[name=COMPANY_NAME]

        $('.js-change-input-color').click(function () {
            console.log('click');
            console.log($(this));
            $(this).addClass('input-black-color');
        });

        function changeColors(scrollTop) {
            let opacityLevel = 1;
            let param1;  // rgba(21,24,45,1);
            let param2;  // rgba(0,52,94,1);
            const inversionOffset = 100; // метка первой смены цвета, привязана к блоку - не нужна
            const opacityOffset = 0; // метка отмены смены цвета, привязана к блоку - не нужна
            const classOffset = 150; // не нужна
            const windowInnerWidth = window.innerWidth;
            let formBlockTop = $('.card-application--form').offset().top;
            let fixLevel1 = formBlockTop - windowInnerWidth * .35; // уровень первого переключения
            let fixLevel2 = formBlockTop + $('.card-application--form').height() * .6 - opacityOffset; // уровень второго переключения
            let fixLevel3 = formBlockTop - inversionOffset + classOffset; // не нужен
            let fixLevel = (fixLevel1 - scrollTop) / opacityOffset; // диапазон смены прозрачности - не нужен
            //console.log('scrollTop=' + scrollTop);
            //console.log('formBlockTop=' + formBlockTop);
            //console.log('fixLevel1=' + fixLevel1);
            //console.log('fixLevel2=' + fixLevel2);
            //console.log('windowInnerWidth=' + windowInnerWidth);

            if(scrollTop > fixLevel2) {
                //console.log('scrollTop=' + scrollTop);
                /*if(fixLevel < 0) {
                    opacityLevel = 1;
                } else if(fixLevel >= 1) {
                    opacityLevel = 0;
                } else {
                    opacityLevel = 1 - fixLevel;
                }*/
                //$('.v21-card-application').css('background', 'linear-gradient(106.11deg, '+param1+' 27.82%, '+param2+' 100%)');
                $('.scheta-page__background-blue').css('opacity', '0');
                $('.v21 .v21-card-application').removeClass('js-color-switch');
                $('.v21 .v21-scheta-block4').removeClass('js-color-switch');
                $('.v21 .v21-block-interests').removeClass('js-color-switch');
            } else if(scrollTop > fixLevel1) {
                $('.scheta-page__background-blue').css('opacity', '1');
                $('.v21 .v21-card-application').addClass('js-color-switch');
                $('.v21 .v21-scheta-block4').addClass('js-color-switch');
                $('.v21 .v21-block-interests').addClass('js-color-switch');
            } else {
                //$('.v21-card-application').css('background', 'linear-gradient(106.11deg, '+param1+' 27.82%, '+param2+' 100%)');
                $('.scheta-page__background-blue').css('opacity', '0');
                $('.v21 .v21-card-application').removeClass('js-color-switch');
                $('.v21 .v21-scheta-block4').removeClass('js-color-switch');
                $('.v21 .v21-block-interests').removeClass('js-color-switch');
            }

            /*if(scrollTop > (fixLevel2+200)) {
                $('.scheta-page__background-blue').css('position', 'unset'); // для нижний блоков отработать стилем z-index
            } else if(scrollTop > (fixLevel1-200)) {
                $('.scheta-page__background-blue').css('position', 'fixed');
            } else {
                $('.scheta-page__background-blue').css('position', 'unset');
            }*/

            /*if(scrollTop > fixLevel3) {
                $('.v21-card-application').addClass('js-color-switch');
            } else {
                $('.v21-card-application').removeClass('js-color-switch');
            }*/
        }
        changeColors($(window).scrollTop());

        $(window).on('scroll',function(){
            let $window = $(window);
            let scrollTop = $window.scrollTop();
            //console.log('scrollTop='+scrollTop);

            changeColors(scrollTop);
        });

        $('#reloadCaptcha').click(function() {
            $.getJSON('/local/components/webtu/feedback/reload_captcha.php', function(data) {
                $('#captchaImg').attr('src','/bitrix/tools/captcha.php?captcha_sid=' + data);
                $('#captchaSid').val(data);
            });
            return false;
        });
    });
</script>

<script>
    /*function requiredContacts () {
        if ($('input[name="EMAIL"]').val() !== '') {
            $('input[name="EMAIL"]').attr('required', true);
            $('input[name="PHONE"]').attr('required', false);
        } else {
            $('input[name="PHONE"]').attr('required', true);
            $('input[name="EMAIL"]').attr('required', false);
        }
    }

    $('input[name="EMAIL"]').on('focusout', function () {
        requiredContacts ();
    });

    $('input[name="PHONE"]').on('focusout', function () {
        requiredContacts ();
    });*/


    function clearFields () {
        $('textarea').val('').css('box-shadow', 'none');
        $('input:not([type="hidden"])').val('').css('box-shadow', 'none');

        $('textarea').focusout(function () {   
            $(this).css('box-shadow', '');
        });
        $('input').focusout(function () {
            $(this).css('box-shadow', '');
        });
    }

    if ($('.alert-success').length > 0) {
        clearFields ();
        //document.location.href = "/thanks/";
    }

    /*$('.feedback_form .button').click(function () {
        $(".alert").remove();
    });*/


    /*$('.agreement input[required]').change(function () {
        if ( $(this).is(':checked') ) {
            $(this).closest('.agreement').css('box-shadow', '');
        } else {
            $(this).closest('.agreement').css('box-shadow', '0 0 2px 1px red');
        }
    });*/

    function requiredFields() {
        let arFields = [
            'input[name="COMPANY_NAME"]',
            'input[name="COMPANY_INN"]',
            'input[name="FIO"]',
            'input[name="CITY"]',
            'input[name="CURRENCY"]',
            //'input[name="PHONE"]',
            'input[name="EMAIL"]',
            'input[name="FROM_WHERE"]',
        ];

        let countErr = 0;

        arFields.forEach(function (value) {
            if ($(value).val() == '' || $(value).val() == ' ') {
                $(value).parent().addClass("is-error");
                countErr += 1;
                console.log('value');
                console.log(value);
                console.log('['+$(value).val()+']');
            } else {
                $(value).parent().removeClass("is-error");
            }
        });
        if($('#politics2').is(':checked')) {
            $('#politics2').parent().parent().removeClass("is-error");
        } else {
            countErr += 1;
            $('#politics2').parent().parent().addClass("is-error");
        }

        return (countErr > 0) ? false : true;
    }

    $('#applicationForm').submit(function (e) {
        e.preventDefault();
        console.log('1');
        if ($("#politics2").prop("checked")) {
            $('#politics2').parent().parent().removeClass("is-error");
            console.log('2');
            if (requiredFields()) {
                console.log('3');
                $.ajax({
                    type: "POST",
                    //url: '/local/templates/v21_template_home/components/webtu/feedback/account_application/ajax.customer.php',
                    url: '/ajax_scripts/ajax.customer.php',
                    data: {
                        'fields': $(this).serialize(),
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log('**');
                        if (data.status) {
                            clearFields ();
                            $('input[name="CAPTCHA_WORD"]').parent().removeClass("is-error");
                            document.location.href = "/thanks/";
                        } else {
                            console.log('not OK');
                            if (!data.captcha){
                                $('input[name="CAPTCHA_WORD"]').parent().addClass("is-error");
                            } else {
                                $('input[name="CAPTCHA_WORD"]').parent().removeClass("is-error");
                            }
                        }
                    }
                });
            }
        } else {
            $('#politics2').parent().parent().addClass("is-error");
        }
    });

</script>

<? if (isset($_REQUEST['AJAX_CALL'])) { ?>
    <script>
        $('input[data-mask="phone"]').mask('+7 999 9999999');

        $('.select-box select').customSelect({
            speed: 360
        });
    </script>
<? } ?>
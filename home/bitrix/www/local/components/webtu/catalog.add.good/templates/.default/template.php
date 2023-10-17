<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

if ($arResult["CAN_ADD"]) { ?>

    <div class="form-sell-wrap">
        <div class="form-sell-wrap">
            <form action="<?=$APPLICATION->GetCurPageParam("", array("MESSAGE_SEND_".$arResult["COMPONENT_ID"], "MESSAGE_ERROR_".$arResult["COMPONENT_ID"]))?>" method="post" enctype="multipart/form-data">
                <div class="form-block">
                    <div class="topic-title">Введите информацию о монете</div>
                    <div class="clearfix">
                        <div class="form-sell-img">
                            <div class="info">
                                Загрузите фотографии (аверс, реверс) <span>(не более 4 шт)</span>
                            </div>
                            <div class="form-file">
                                <? if ( count($arResult["REQUEST"]["PROP"]["MORE_PHOTO"]) > 0 ) { ?>
                                    <div class="info">Будет загружено <?=count($arResult["REQUEST"]["PROP"]["MORE_PHOTO"])?> фото</div>
                                <? } else { ?>
                                    <label class="button">
                                        <input type="file" multiple="" id="photo">
                                        <span>Загрузить</span>
                                    </label>
                                <? } ?>
                            </div>
                            <div class="preview-wrap">
                                <ul id="preview-photo">
                                    <?
                                    foreach ($arResult["REQUEST"]["PROP"]["MORE_PHOTO"] as $value) {
                                        echo '<input type="hidden" name="PROP[MORE_PHOTO][]" value="'.$value.'">';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="form-sell">
                            <?if( count($arResult["MESSAGE_ERROR"]) > 0 ){
                                echo '<div class="message_err">';
                                foreach( $arResult["MESSAGE_ERROR"] as $item ){
                                    echo '<div>'.$item.'</div>';
                                }
                                echo '</div>';
                            }
                            ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="size size-1">
                                        <input type="text" name="PROP[NAME]" placeholder="Введите название монеты*" value="<?=$arResult["REQUEST"]["NAME"]?>">
                                    </div>
                                    <div class="size size-1">
                                        <input type="text" name="PROP[SERIES]" placeholder="Серия (если есть)" value="<?=$arResult["REQUEST"]["PROP"]["SERIES"]?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="size size-1">
                                        <select name="PROP[COUNTRY]">
                                            <option value="">Страна</option>
                                            <? foreach ($arResult["PROPERTY_LIST"]["COUNTRY"] as $key => $value) {
                                                if ($key == $arResult["REQUEST"]["PROP"]["COUNTRY"]) $selected = "selected";
                                                else $selected = "";
                                                echo  '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                                            } ?>
                                            <option value="Иная" <?=("Иная" == $arResult["REQUEST"]["PROP"]["COUNTRY"]) ? "selected": "" ?>>Иная</option>
                                        </select>
                                    </div>
                                    <div class="size size-2">
                                        <select name="PROP[METAL]">
                                            <option value="">Металл</option>
                                            <? foreach ($arResult["PROPERTY_LIST"]["METAL"] as $key => $value) {
                                                if ($key == $arResult["REQUEST"]["PROP"]["METAL"]) $selected = "selected";
                                                else $selected = "";
                                                echo  '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="size size-3">
                                        <select name="PROP[PROBA]">
                                            <option value="">Проба</option>
                                            <? foreach ($arResult["PROPERTY_LIST"]["PROBA"] as $key => $value) {
                                                if ($key == $arResult["REQUEST"]["PROP"]["PROBA"]) $selected = "selected";
                                                else $selected = "";
                                                echo  '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="size size-2">
                                        <input type="text" name="PROP[RELEASE_YEAR]" placeholder="Год*" value="<?=$arResult["REQUEST"]["PROP"]["RELEASE_YEAR"]?>">
                                    </div>
                                    <div class="size size-3">
                                        <input type="text" name="PROP[WEIGHT]" placeholder="Вес*" value="<?=$arResult["REQUEST"]["PROP"]["WEIGHT"]?>">
                                    </div>
                                    <div class="size size-2">
                                        <select name="PROP[QUALITY]">
                                            <option value="">Качество</option>
                                            <option value="АЦ">АЦ</option>
                                            <option value="АЦ">Пруф</option>
                                        </select>

                                    </div>
                                    <div class="size size-3">
                                        <input type="text" name="PROP[NOMINAL]" placeholder="Номинал*" value="<?=$arResult["REQUEST"]["PROP"]["NOMINAL"]?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="size size-1">
                                        <input type="text" name="PROP[PRICE]" placeholder="Моя цена (руб)*" value="<?=$arResult["REQUEST"]["MIN_PRICE"]?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <? if ($arResult["TERMS"]) { ?>
                    <div class="form-block">
                        <div class="topic-title">Условия участия</div>
                        <p><?= Loc::getMessage('CAG_PROP_PRIVACE_POLICE_TEXT')?></p>
                        <div class="has-input input-2">
                            <input type="checkbox" class="input-btn" id="terms" name="PROP[PRIVACE_POLICE]" checked="checked">
                            <label for="terms">Соглашаюсь с условиями</label>
                        </div>
                    </div>
                <? } ?>

                <input class="submit" name="CAG_SUBMIT" type="submit" value="Продать монету">
            </form>
        </div>
    </div>
    <? if( count($arResult["MESSAGE_SEND"]) > 0 ) { ?>
        <div id="popup-add-lot-send" class="popup">
            <div class="title-wrap">
               <?
                echo '<div class="title-form">Успешно</div>';
                echo '</br>';
                foreach( $arResult['MESSAGE_SEND'] as $item ){
                    echo '<div class="message_send">'.$item.'</div>';
                }
                ?>
            </div>
        </div>
        <script>
            $(window).load(function(){
                $.fancybox.open({
                    src  : '#popup-add-lot-send',
                    type : 'inline',
                    opts : {
                        onComplete : function() {

                        }
                    }
                });
            });
        </script>
    <? } ?>
<? } ?>

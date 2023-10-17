<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if ($arParams["ADDITIONAL_IBLOCK_ID"]) {
    $arResult["FREE_TOP_UP"] = "";

    $arSelect = array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_TEXT", "PROPERTY_*");
    $arFilter = array("IBLOCK_ID" => IntVal($arParams["ADDITIONAL_IBLOCK_ID"]), "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(array("SORT" => "ASC", "ID" => "ASC"), $arFilter, false, false, $arSelect);
    if (intval($res->SelectedRowsCount()) > 0) {
        $arResult["FREE_TOP_UP"] .= '
        <div class="v21-section">
            <h2 class="v21-section__title v21-h2">Бесплатное пополнение карты Трансстройбанка</h2>
                <div class="v21-benefits v21-benefits--debit">
                    <div class="v21-benefits__grid v21-grid">
        ';
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
            $target = $arProps["TYPE_LINK"]["VALUE_XML_ID"] === "Y" ? ' target="_blank"' : '';
            $arResult["FREE_TOP_UP"] .= '
            <div class="v21-benefits__grid-item v21-grid__item v21-grid__item--1x2@sm">
                <div class="v21-benefits__item">
                    <img src="' . CFile::GetPath($arProps["ICON"]["VALUE"]) . '" alt="' . $arFields["NAME"] . '" class="v21-benefits__image">
                    <div class="v21-benefits__text">
                        <h3 class="v21-benefits__title v21-h6">' . $arFields["NAME"] . '</h3>
                        <p class="v21-benefits__brief v21-p">' . $arFields["PREVIEW_TEXT"] . '</p>';
            foreach ($arProps["LINK"]["VALUE"] as $key => $titleLink) {
                $arResult["FREE_TOP_UP"] .= '<p><a href="' . $arProps["LINK"]["DESCRIPTION"][$key] . '" class="v21-benefits__button v21-button v21-button--border"' . $target . '>' . $titleLink . '</a></p>';
            }
            $arResult["FREE_TOP_UP"] .= '</div>
                </div>
            </div>
            ';
        }
        $arResult["FREE_TOP_UP"] .= '</div></div></div>';
    }
}

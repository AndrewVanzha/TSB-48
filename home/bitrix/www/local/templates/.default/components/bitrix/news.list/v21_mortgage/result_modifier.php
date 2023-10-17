<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

function isStats(array $data): bool
{
    if (
        $data["INTEREST_RATE"]["VALUE"] ||
        $data["INITIAL_FEE"]["VALUE"] ||
        $data["ATT_MIN"]["VALUE"] ||
        $data["ATT_MAX"]["VALUE"] ||
        $data["ATT_DATE"]["VALUE"]
    ) {
        return true;
    }

    return false;
}

function getStats(array $data): string
{
    $result = '<div class="v21-service-card__item">';
    $result .= '<div class="v21-service-card__stats v21-service-card__stats--mortgage v21-grid">';

    if ($data["INTEREST_RATE"]["VALUE"]) {
        $result .= '<div class="v21-service-card__stats-item--1 v21-service-card__stats-item v21-grid__item v21-grid__item--1x2@xs v21-grid__item--1x3@md">';
        $result .= '<div class="v21-service-card__stats-title">Ставка</div>';
        $result .= getStatsValue($data["INTEREST_RATE"]);
        $result .= '</div><!-- /.v21-service-card__stats-item -->';
    }
    if ($data["INITIAL_FEE"]["VALUE"]) {
        $result .= '<div class="v21-service-card__stats-item--2 v21-service-card__stats-item v21-grid__item v21-grid__item--1x2@xs v21-grid__item--1x3@md">';
        $result .= '<div class="v21-service-card__stats-title">Первоначальный взнос</div>';
        $result .= getStatsValue($data["INITIAL_FEE"]);
        $result .= '</div><!-- /.v21-service-card__stats-item -->';
    }
    if ($data["ATT_MIN"]["VALUE"]) {
        $result .= '<div class="v21-service-card__stats-item--a v21-service-card__stats-item--3 v21-service-card__stats-item v21-grid__item v21-grid__item--1x2@xs v21-grid__item--1x3@md">';
        $result .= '<div class="v21-service-card__stats-title">Минимальная сумма</div>';
        $result .= getStatsValue($data["ATT_MIN"]);
        $result .= '</div><!-- /.v21-service-card__stats-item -->';
    }
    if ($data["ATT_MAX"]["VALUE"]) {
        $result .= '<div class="v21-service-card__stats-item--a v21-service-card__stats-item--4 v21-service-card__stats-item v21-grid__item v21-grid__item--1x2@xs v21-grid__item--1x3@md">';
        $result .= '<div class="v21-service-card__stats-title">Максимальная сумма</div>';
        $result .= getStatsValue($data["ATT_MAX"]);
        $result .= '</div><!-- /.v21-service-card__stats-item -->';
    }
    if ($data["ATT_DATE"]["VALUE"]) {
        $result .= '<div class="v21-service-card__stats-item--5 v21-service-card__stats-item v21-grid__item v21-grid__item--1x2@xs v21-grid__item--1x3@md">';
        $result .= '<div class="v21-service-card__stats-title">Срок ипотеки</div>';
        $result .= getStatsValue($data["ATT_DATE"]);
        $result .= '</div><!-- /.v21-service-card__stats-item -->';
    }

    $result .=    '</div><!-- /.v21-service-card__stats -->';
    $result .=    '</div><!-- /.v21-service-card__item -->';

    return $result;
}

function getStatsValue(array $data): string
{
    $result = "";
    foreach ($data["VALUE"] as $key => $item) {
        $isset = ($item !== "null");
        if ($isset) {
            $result .= '<div class="v21-service-card__stats-value">' . $item . '</div>';
        }
        if ($data["DESCRIPTION"][$key]) {
            $result .= '
			<div class="' . ($isset ? "v21-service-card__stats-note" : "v21-service-card__stats-value v21-service-card__stats-value--sm") . '">
				' . $data["DESCRIPTION"][$key] . '
			</div>
			';
        }
    }

    return $result;
}

function getDocuments($idElements)
{
    if (!$idElements) {
        return null;
    }

    $result = CIBlockElement::GetByID($idElements);
    if ($arResult = $result->GetNextElement()) {
        // $arFields = $arResult->GetFields();
        $arPropeties = $arResult->GetProperties();

        $arFiles = [];
        foreach ($arPropeties["FILE"]["VALUE"] as $key => $idFile) {
            if (!$nameFile = $arPropeties["FILE"]["DESCRIPTION"][$key]) {
                continue;
            }

            $arFiles[] = [
                "NAME" => $nameFile,
                "LINK" => CFile::GetPath($idFile)
            ];
        }
    }

    return count($arFiles) > 0 ? $arFiles : null;
}

$programsType = CIBlockPropertyEnum::GetList(
    [
        "SORT" => "ASC",
        "VALUE" => "ASC"
    ],
    [
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "PROPERTY_CODE" => "PROGRAM_TYPE"
    ]
);

$arResult["PROGRAM_TYPE_HTML"] = [];
$counter = 1;
while ($programType = $programsType->Fetch()) {
    if ($programType["VALUE"] === "Возврат налога") {
        $arResult["PROGRAM_TYPE_HTML"][] = '
        <a href="#" data-tab-id="' . $programType["XML_ID"] . '" data-slide="' . $counter . '" class="v21-tabs-header__item v21-tabs-header__item--emph js-v21-tabs-toggle">
            <span>' . $programType["VALUE"] . '</span>
            <svg width="20" height="20" class="v21-tabs-header__item-icon">
                <use xlink:href="' . SITE_TEMPLATE_PATH . '/img/v21_v21-icons.svg#rubleRound"></use>
            </svg>
        </a>
        ';
    } else {
        $arResult["PROGRAM_TYPE_HTML"][] = '
            <a href="#" data-tab-id="' . $programType["XML_ID"] . '" data-slide="' . $counter . '" class="v21-tabs-header__item js-v21-tabs-header-item js-v21-tabs-toggle">
            ' . $programType["VALUE"] . '
            </a>
        ';
    }
    $counter++;
}

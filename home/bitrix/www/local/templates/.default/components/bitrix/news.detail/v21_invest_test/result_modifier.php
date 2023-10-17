<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

function isStats(array $data): bool
{
    if (
        $data["INTEREST_RATE"]["VALUE"] ||
        $data["DEPOSIT_TERM"]["VALUE"] ||
        $data["MIN_SUMM"]["VALUE"]
    ) {
        return true;
    }

    return false;
}

function getStats(array $data): string
{
    $result = '<div class="v21-service-card__item">';
    $result .= '<div class="v21-service-card__stats v21-service-card__stats--deposit v21-grid">';

    if ($data["INTEREST_RATE"]["VALUE"]) {
        $result .= '<div class="v21-service-card__stats-item--1 v21-service-card__stats-item v21-grid__item v21-grid__item--1x2@xs v21-grid__item--1x3@md">';
        $result .= '<div class="v21-service-card__stats-title">Ставка</div>';
        $result .= '<div class="v21-service-card__stats-value">' . $data["INTEREST_RATE"]["VALUE"] . '</div>';
        $result .= '</div><!-- /.v21-service-card__stats-item -->';
    }
    if ($data["DEPOSIT_TERM"]["VALUE"]) {
        $result .= '<div class="v21-service-card__stats-item--a v21-service-card__stats-item--3 v21-service-card__stats-item v21-grid__item v21-grid__item--1x2@xs v21-grid__item--1x3@md">';
        $result .= '<div class="v21-service-card__stats-title">Минимальная сумма</div>';
        $result .= '<div class="v21-service-card__stats-value">' . $data["DEPOSIT_TERM"]["VALUE"] . '</div>';
        $result .= '</div><!-- /.v21-service-card__stats-item -->';
    }
    if ($data["MIN_SUMM"]["VALUE"]) {
        $result .= '<div class="v21-service-card__stats-item--5 v21-service-card__stats-item v21-grid__item v21-grid__item--1x2@xs v21-grid__item--1x3@md">';
        $result .= '<div class="v21-service-card__stats-title">Срок вклада</div>';
        $result .= '<div class="v21-service-card__stats-value">' . $data["MIN_SUMM"]["VALUE"] . '</div>';
        $result .= '</div><!-- /.v21-service-card__stats-item -->';
    }

    $result .=    '</div><!-- /.v21-service-card__stats -->';
    $result .=    '</div><!-- /.v21-service-card__item -->';

    return $result;
}

function getDocuments($documents)
{
    foreach ($documents["VALUE"] as $key => $document) {
        if (!$nameFile = $documents["DESCRIPTION"][$key]) {
            continue;
        }

        $arFiles[] = [
            "NAME" => $nameFile,
            "LINK" => CFile::GetPath($document)
        ];
    }

    return count($arFiles) > 0 ? $arFiles : null;
}

<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<script>
    var cityNames = [];
    var cityIds = [];
</script>

<div class="popup-form_block">

    <?if (CSite::InDir('/en/')) {
        $db_props = CIBlockElement::GetProperty(114, $_SESSION['city'], array("sort" => "asc"), Array("CODE"=>"ATT_ENGLISH"));
        if($ar_props = $db_props->Fetch()) {
            $selectedCity = $ar_props["VALUE"];
        }
    } else {
        if (CSite::InDir('/chastnym-klientam/obmen-valyut/')) {
            $cityCode = 'moskva';
            if (!empty($_GET['city'])) {
                $cityCode = htmlspecialchars($_GET['city']);
                $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID","CODE"=>$cityCode), false, Array(), Array("ID", "NAME"));
                while ($ob = $res->GetNextElement()) {
                    //debugg($ob);
                    $selectedCity = $ob->GetFields()['~NAME'];
                }
            } else {
                $selectedCity = 'Москва';
            }
        } else {
            $res = CIBlockElement::GetByID($_SESSION['city']);
            if($ar_res = $res->GetNext()) $selectedCity = $ar_res['NAME'];
        }
    }?>
    <?/*?><h4 class="popup-form_title page-title--4 page-title">
        <?=GetMessage("YOUR_CITY")?>
    </h4><?*/?>
    <div class="popup-form_content">
        <?//debugg($selectedCity);?>

        <ul class="city-selector_list clearfix">  

           <?foreach($arResult['CITY'] as $city){?>
               <?//debugg($city);?>

                <?if (CSite::InDir('/en/')) {
                    $cityName = $city['NAME_ENGLISH'];
                } else {
                    $cityName = $city['NAME'];
                }?>
                <script>
                    cityNames.push("<?=$cityName?>");
                    cityIds.push("<?=$city['ID']?>");
                </script>

                <li class="<?= ($selectedCity == $city['NAME'])? 'selected' : ''; ?>">
                    <??><a href="?city=<?=$city['CODE_NAME']?>"><??>
                        <?if (CSite::InDir('/en/')) {
                            echo $city['NAME_ENGLISH'];
                        } else {
                            echo $city['NAME'];
                        }?>
                    </a>
                </li>
            
			<?}?>
        </ul>

    </div>

</div>

<?if($_REQUEST['search']){?>
<script>
    $('.fancybox-close-small').click(function(){
        location.reload();
    })      
</script>
<?}?>


    
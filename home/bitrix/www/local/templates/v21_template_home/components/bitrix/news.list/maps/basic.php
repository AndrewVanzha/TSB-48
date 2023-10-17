<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//print_r($arResult['ITEMS']);
$arCoordinates = array();
$arCityEl = [];
foreach ($arResult['ITEMS'] as $arItem) {
    $arCoordinates[] = $arItem['PROPERTIES']['ATT_COORDINATES']['VALUE'];
}

$arCoordinatesTemp = $arCoordinates;
for ($i = 0; $i < count($arCoordinatesTemp); $i++) {
    $value = $arCoordinatesTemp[$i];
    unset($arCoordinatesTemp[$i]);
    if( in_array($value, $arCoordinatesTemp) ) {
        $x = rand(-3, 3) * 0.000005;
        $y = rand(-3, 3) * 0.000005;
        $coordinate = explode(',', $arResult['ITEMS'][$i]['PROPERTIES']['ATT_COORDINATES']['VALUE']);
        $coordFirst = $coordinate[0] + $x;
        $coordSecond = $coordinate[1] + $y;
        $arResult['ITEMS'][$i]['PROPERTIES']['ATT_COORDINATES']['VALUE'] = $coordFirst.','.$coordSecond;
        //echo $coordFirst.','.$coordSecond.'<br>';
    }
    $arCoordinatesTemp = $arCoordinates;
}
?>

<div class="page-content page-container">
    <div class="offices-filter clearfix">

        <form class="filter" action="<?=$_SERVER['REQUEST_URI']?>" method="post">

            <div class="city select-box">

                <select id="city" data-id="<?=htmlspecialchars($_REQUEST['city'])?>" name="city">
                        <option value='' <?if (empty($_SESSION['offices']['cityFilter'])) :?>selected<?endif?>>Все</option>
                        <?foreach ($arSections as $section) :?>
                        <option  value="<?=$section['ID']?>" <?if (htmlspecialchars($_SESSION['offices']['cityFilter']) == $section['ID']){?>selected<?}?>>
                            <?=$section['NAME']?>
                        </option>
                        <?endforeach?>
                </select>
            </div>

            <div class="type clearfix">

                <label class="check-box">
                    <input type="checkbox" name="type[]" value="office" onchange="$('#send').click();" <?if (in_array('office', $_SESSION['offices']['type'])||(empty($_SESSION['offices']['type']))){?>checked<?}?>>
                    <span class="check-box_caption">
                        <?=GetMessage("OFFICES")?>
                    </span>
                </label>

                <label class="check-box">
                    <input type="checkbox" name="type[]" value="cash" onchange="$('#send').click();" <?if (in_array('cash', $_SESSION['offices']['type'])){?>checked<?}?>>
                    <span class="check-box_caption">
                        <?=GetMessage("ATMS")?>
                    </span>
                </label>
            </div>
            <input hidden id="send" type="submit" name="" value="">
        </form>

    </div>
</div>

<div class="offices-map" id="map"></div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqTI_k2NvGWLhGNk0dT3nTLSgZI1Cgurs&libraries=places&callback=initMap"></script>

<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

<script src="/local/templates/.default/js/vendor/infobox.min.js"></script>



<script>

    var map;
    
    function initMap() {


        function latLng2Point(latLng, map) {

            var topRight = map.getProjection().fromLatLngToPoint( map.getBounds().getNorthEast() );
            var bottomLeft = map.getProjection().fromLatLngToPoint( map.getBounds().getSouthWest() );
            var scale = Math.pow( 2, map.getZoom() );
            var worldPoint = map.getProjection().fromLatLngToPoint(latLng);

            return new google.maps.Point( ( worldPoint.x - bottomLeft.x ) * scale, ( worldPoint.y - topRight.y ) * scale );
        }

        function point2LatLng(point, map) {

            var topRight = map.getProjection().fromLatLngToPoint( map.getBounds().getNorthEast() );
            var bottomLeft = map.getProjection().fromLatLngToPoint( map.getBounds().getSouthWest() );
            var scale = Math.pow( 2, map.getZoom() );
            var worldPoint = new google.maps.Point( point.x / scale + bottomLeft.x, point.y / scale + topRight.y );

            return map.getProjection().fromPointToLatLng(worldPoint);
        }

        var mapOptions = {
            mapTypeControl: false,
            maxZoom:20, 
            gestureHandling: 'cooperative',
            styles: [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#444444"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#c4c4c4"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ]

        };

        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var bounds = new google.maps.LatLngBounds();
        
        var infowindow = new google.maps.InfoWindow({
            boxClass: 'office-popup',
            closeBoxURL: '/local/templates/.default/img/close.png',
        });

        var popup = new InfoBox({
            alignBottom: true,
            boxClass: 'office-popup',
            closeBoxURL: '/local/templates/.default/img/close.png',
            closeBoxMargin: '5px',
            infoBoxClearance: new google.maps.Size(20, 20),
            pixelOffset: new google.maps.Size(-135, -15)
        });

        var markerIconsCount = 4;
        var markerIcons = [], popupContent = [];
        for ( var i = 0; i < markerIconsCount; i++ ) {

            markerIcons[i] = new google.maps.MarkerImage( '/local/templates/czebra_home/components/bitrix/news.list/maps/images/map-marker-' + ( i + 1 ) + '.png',
            //markerIcons[i] = new google.maps.MarkerImage( '/local/templates/czebra_home/components/bitrix/news.list/maps/images/map-marker-1.png',
                new google.maps.Size(38, 54),
                new google.maps.Point(0, 0),
                new google.maps.Point(19, 54)
            );

        }

        var mcOptions = {gridSize: 50, maxZoom: 20, imagePath: '/local/templates/.default/img/m'};
        var markerCluster = new MarkerClusterer(map, [], mcOptions);

        var markers = [

            <?foreach ($arResult['ITEMS'] as $arItem):

                //Изображение
                $img = !empty($arItem['PREVIEW_PICTURE']) ? $arItem['PREVIEW_PICTURE']['SRC'] : $this->GetFolder().'/images/logo.jpg';

                    switch ($arItem['PROPERTIES']['ATT_TYPE']['VALUE']) {
                        case 'Офис':
                            $typeIcon = 0;
                            break;
                        case 'Банкомат':
                            $typeIcon = 2;
                            break;
                        case 'Банкомат партнера':
                            $typeIcon = 3;
                            break;
                    };
                    $res = CIBlockElement::GetByID($arItem['ID']);
                    if($ar_res = $res->GetNext());
                    $res = CIBlockSection::GetByID($ar_res['IBLOCK_SECTION_ID']);
                    if($ar_res = $res->GetNext());
                ?>
                {
                    latLng: [ <?=$arItem['PROPERTIES']['ATT_COORDINATES']['VALUE']?> ],
                    city: "<?=$ar_res['NAME'];?>",
                    title: "<?=$arItem['NAME']?>",
                    address: "<?=$arItem['PROPERTIES']['ATT_ADDRESS']['VALUE']?>",
                    phone: "<?=$arItem['PROPERTIES']['ATT_PHONE']['VALUE']?>",
                    subway: "<?=$arItem['PROPERTIES']['ATT_METRO']['VALUE']?>",
                    services: "<?=$arItem['PROPERTIES']['ATT_SERVICE']['VALUE']?>",
                    hours: "<?=$arItem['PROPERTIES']['ATT_MODE']['VALUE']?>",
                    imgSrc: "<?=$img?>",
                    href: "<?=$arItem['DETAIL_PAGE_URL']?>",
                    markerIconId: <?=$typeIcon?>
                },

            <?endforeach;?>

        ];
        

        



        map.fitBounds(bounds);

        google.maps.event.addListenerOnce( map, 'idle', function() {

            var topRightLatLng = map.getBounds().getNorthEast();
            var topRightPoint = latLng2Point( topRightLatLng, map );

            topRightPoint.x += 24;
            topRightPoint.y += 67;
            topRightLatLng = point2LatLng( topRightPoint, map );

            bounds.extend( topRightLatLng );

            var bottomLeftLatLng = map.getBounds().getSouthWest();
            var bottomLeftPoint = latLng2Point( bottomLeftLatLng, map );

            bottomLeftPoint.x -= 24;
            bottomLeftLatLng = point2LatLng( bottomLeftPoint, map );

            bounds.extend( bottomLeftLatLng );

            map.fitBounds(bounds);

        } );

        google.maps.event.addDomListener( map, 'click', function() { popup.close(); } );
        google.maps.event.addDomListener( window, 'resize', function() {

            var center = map.getCenter();
            google.maps.event.trigger( map, 'resize' );
            map.setCenter( center );

        } );

    }

    google.maps.event.addDomListener( window, 'load', initMap );


</script>




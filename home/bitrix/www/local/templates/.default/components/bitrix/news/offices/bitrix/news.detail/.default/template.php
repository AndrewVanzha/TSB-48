<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
switch ($arResult['PROPERTIES']['ATT_TYPE']['VALUE']) {
	case 'Офис':
		$typeIcon = '/local/templates/.default/img/map-marker-1.png';
		$typePlace = 'Офис';
		break;
	case 'Банкомат':
		$typeIcon = '/local/templates/.default/img/map-marker-3.png';
		$typePlace = 'Банкомат';
		break;
	case 'Банкомат партнера':
		$typeIcon = '/local/templates/.default/img/map-marker-4.png';
		$typePlace = 'Банкомат партнера';
		break;
};
$coordinates = explode(",", $arResult['PROPERTIES']['ATT_COORDINATES']['VALUE']);
//debugg('detail');
//debugg($arResult);
//debugg($coordinates);
?>

<div class="office-map-wrapper">

    <div class="page-container clearfix">

        <div class="office-float office-entry">

            <img src="/img/examples/photo-slide.jpg" alt="" class="image">

            <div class="text">

                <h2 class="page-title--3 page-title">
                    
                        <?=$arResult['NAME']?>
                    
                </h2>

                <p>
					<?=$arResult['PREVIEW_TEXT']?>
                </p>

            </div>

        </div>

    </div>

<?
global $USER;
//if($USER->GetID() == 107) :
if(true) : // включены карты gis
?>

<!--<input id="pac-input" class="controls" type="text" placeholder="Адрес или объект">-->
<div class="office-map" id="map_gis"></div>

<script type="text/javascript">
	var map_gis, ii;
	//var markers_coord = [];

	DG.then(function() {
		map_gis = DG.map('map_gis', {
			//center: [55.714996361286, 37.632732992065],
			center: ["<?=$coordinates[0]?>", "<?=$coordinates[1]?>"],
			zoom: 12
		});
		var markers1 = DG.featureGroup();
		var markers1_icon = DG.icon({
			iconUrl:  '/local/templates/.default/img/map-marker-1.png',
			iconSize: [26, 34]
		});
		var markers2_icon = DG.icon({
			iconUrl:  '/local/templates/.default/img/map-marker-3.png',
			iconSize: [26, 34]
		});

        var comment = "<?=$arResult['~NAME']?>"+ "<br>" + "<?=$arResult['PROPERTIES']['ATT_ADDRESS']['~VALUE']?>" + "<br>" + "<?=$arResult['PROPERTIES']['ATT_PHONE']['VALUE']?>";
        //console.log(comment);
		switch ("<?=$typePlace;?>") {
			case 'Офис':
				DG.marker(["<?=$coordinates[0]?>", "<?=$coordinates[1]?>"], {icon: markers1_icon}).addTo(markers1).bindLabel(comment);
				break;
			case 'Банкомат':
				DG.marker(["<?=$coordinates[0]?>", "<?=$coordinates[1]?>"], {icon: markers2_icon}).addTo(markers1).bindLabel(comment);
				break;
			case 'Банкомат партнера': 
				DG.marker(["<?=$coordinates[0]?>", "<?=$coordinates[1]?>"], {icon: markers2_icon}).addTo(markers1).bindLabel(comment);
				break;
		}

		markers1.addTo(map_gis);
		//map_gis.fitBounds(markers1.getBounds());
	});
</script>

<?else: //google-карты отключены ?>

    <div class="office-map" id="map"></div>

    <script>

        function initMap() {

            var markerIcon = new google.maps.MarkerImage( '<?=$typeIcon?>',
                    new google.maps.Size(48, 67),
                    new google.maps.Point(0, 0),
                    new google.maps.Point(24, 67) );

            var markerPosition = {

                lat: <?=$coordinates['0']?>,
                lng: <?=$coordinates['1']?>

            };

            var mapOptions = {

                disableDoubleClickZoom: true,
                scrollwheel: false,
                mapTypeControl: false,
                center: markerPosition,
                zoom: 14,
                styles: [

                    {
                        featureType: 'landscape.natural',
                        elementType: 'geometry',
                        stylers: [ { color: '#eaeaea' } ]
                    },

                    {
                        featureType: 'all',
                        elementType: 'labels.text.fill',
                        stylers: [ { color: '#1b1b1b' }, { weight: 0.01 } ]
                    },

                    {   featureType: 'road.highway',
                        elementType: 'geometry.fill',
                        stylers: [ { color: '#fff' }, { lightness: 0 } ]
                    },

                    {
                        featureType: 'poi',
                        elementType: 'geometry',
                        stylers: [ { color: '#ded7c6' } ]
                    },

                    {
                        featureType: 'poi',
                        elementType: 'labels.text.fill',
                        stylers: [ { color: '#36322e' } ]
                    },

                    {
                        featureType: 'transit',
                        elementType: 'labels.text.fill',
                        stylers: [ { color: '#2c9ccc' } ]
                    },

                    /*{
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [ { color: '#fff'} ]
                    },*/

                    {
                        featureType: 'water',
                        elementType: 'geometry',
                        stylers: [ { color: '#c3a866' } ]
                    }

                ]

            };

            var map = new google.maps.Map( document.getElementById('map'), mapOptions );

            var marker = new google.maps.Marker( {

                position: markerPosition,
                map: map,
                icon: markerIcon,
                title: 'Центральный офис'

            } );

            google.maps.event.addDomListener( window, 'resize', function() {

                var center = map.getCenter();
                google.maps.event.trigger( map, 'resize' );
                map.setCenter( center );

            } );

        }

    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqTI_k2NvGWLhGNk0dT3nTLSgZI1Cgurs&callback=initMap"></script>

<?endif; // ending Google Map script ?>

</div>

<div class="page-content page-container">

    <article class="content-area">

        <?=$arResult['DETAIL_TEXT']?>

    </article>

    <div class="article-bottom-bar">

        <div class="share">
            <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
            <script src="//yastatic.net/share2/share.js"></script>
            <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus" data-limit="3"></div>
        </div>

    </div>

    <?if(!empty($arResult['PROPERTIES']['ATT_PICTURES']['VALUE'])){?>

        <div class="photo-slider">

            <div class="owl-carousel">

                <?foreach($arResult['PROPERTIES']['ATT_PICTURES']['VALUE'] as $key => $arPicture){?>

                    <a href="<?=CFile::GetPath($arPicture);?>" data-fancybox="gallery" data-caption="Lorem ipsum dolor" class="slide">
                       <img src="<?=CFile::GetPath($arPicture);?>" alt="<?=$arResult['PROPERTIES']['ATT_PICTURES']['DESCRIPTION'][$key]?>">
                       <span>
                           <?=$arResult['PROPERTIES']['ATT_PICTURES']['DESCRIPTION'][$key]?>
                       </span>
                   </a>

                <?}?>

            </div>

            <a href="#" class="slider-control--prev slider-control mi--angle-left mi"></a>
            <a href="#" class="slider-control--next slider-control mi--angle-right mi"></a>

        </div>

    <?}?>

    

</div>

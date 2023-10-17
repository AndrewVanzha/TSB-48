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
		break;
	case 'Банкомат':
		$typeIcon = '/local/templates/.default/img/map-marker-3.png';
		break;
	case 'Банкомат партнера':
		$typeIcon = '/local/templates/.default/img/map-marker-4.png';
		break;
};
$coordinates = explode(",", $arResult['PROPERTIES']['ATT_COORDINATES']['VALUE']);
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

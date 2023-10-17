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
?>
</div></div>
<div class="map-container">
	<div id="map">
	</div>
	<script type="text/javascript">
		var latitude = <?=$arResult['PROPERTIES']['ATT_LATITUDE']['VALUE'];?> ,
		longitude = <?=$arResult['PROPERTIES']['ATT_LONGITUDE']['VALUE'];?> ,
		map_zoom = 13;

		var marker_url = 'images/map.png';

		//Стили для элементов на карте
		var style= [ 
			{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#eaeaea"}]}, {'featureType': 'all', 'elementType': 'labels.text.fill', 'stylers': [{'color': '#1b1b1b'}, {"weight": "0.01"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":"0"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#ded7c6"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#36322e"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#2c9ccc"}]}, {"featureType": 'road', "elementType": 'geometry', "stylers": [{"color": '#ffffff'}]}, {"featureType": 'water', "elementType": 'geometry', "stylers": [{'color': '#c3a866'}]}
		];
			

		//Создание точки на карте
		var map_options = {
	      	center: new google.maps.LatLng(latitude+0.005, longitude),
	      	zoom: map_zoom,
	      	panControl: false,
	      	zoomControl: false,
	      	mapTypeControl: false,
	      	streetViewControl: false,
	      	mapTypeId: google.maps.MapTypeId.ROADMAP,
	      	scrollwheel: false,
	      	styles: style
	    }

 		//Инициализация карты
		var map = new google.maps.Map(document.getElementById('map'), map_options);

		var contentString = '<?=$arResult['PROPERTIES']['ATT_ADDRESS_MAGAZINE']['VALUE'];?><br/><img style="margin-left: 20px; margin-top: 10px;" width="180px" src="<?=$arResult['PREVIEW_PICTURE']['SRC'];?>">';
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude, longitude),
            map: map
        });
        google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});
        
		infowindow.open(map,marker);

		google.maps.event.addDomListener(window, "resize", function() {
			var center = map.getCenter();
			google.maps.event.trigger(map, "resize");
			map.setCenter(center);
		});
	</script>

	
</div>

<div class="container">
	<div class="content-block-2">
		<div class="contacts-wrap clearfix" itemscope itemtype="http://schema.org/Organization">
			<span itemprop="name" style="display: none;">ТрансСтройБанк</span>
			<span itemprop="telephone" style="display: none;">8 800 505 37 73</span>
			<div class="contacts item-1 icon">
				<div class="block">
					<div class="phone"><?=$arResult['PROPERTIES']['ATT_PHONE']['VALUE'];?></div>
					<div class="text-shedule">
						(<?=$arResult['PROPERTIES']['ATT_MODE']['VALUE'];?>)
					</div>
				</div>
			</div>

			<div class="contacts item-2 icon">
				<? if ($arResult['PROPERTIES']['ATT_ADDRESS_MAGAZINE']['VALUE']) {?>
					<div class="block">
						<div class="title">Наш адрес</div>
						<div class="text" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><?=$arResult['PROPERTIES']['ATT_ADDRESS_MAGAZINE']['VALUE'];?></div>
					</div>
				<? } ?>
				<? if ($arResult['PROPERTIES']['ATT_MODE']['VALUE']) {?>
					<div class="block">
						<div class="title">Режим работы</div>
						<div class="text"><?=$arResult['PROPERTIES']['ATT_MODE']['VALUE'];?></div>
					</div>
				<? } ?>
				<? if ($arResult['PROPERTIES']['ATT_HELP']['VALUE']) {?>
					<div class="block">
						<div class="title">Справки и прием заказов по телефону</div>
						<div class="text"><?=$arResult['PROPERTIES']['ATT_HELP']['VALUE'];?></div>
					</div>
				<? } ?>
			</div>

			<div class="contacts item-3 icon">
				<? if ($arResult['PROPERTIES']['ATT_EMAIL']['VALUE']) {?>
					<div class="block">
						<div class="title">Email</div>
						<div class="text" itemprop="email"><?=$arResult['PROPERTIES']['ATT_EMAIL']['VALUE'];?></div>
					</div>
				<? } ?>
				<? if ($arResult['PROPERTIES']['DETAIL_TEXT']['VALUE']) {?>	
					<div class="block">
						<div class="title">Юридический адрес</div>
						<div class="text">
							<?=$arResult["DETAIL_TEXT"]?>
						</div>
					</div>
				<? } ?>	
			</div>
		</div>
	</div><!-- /.content-block-2 -->

</div><!-- /.container -->

window.onload=function(){
    var i=0;
    $('div.cs-box').each(function(){
        i++;
        if (i > 1){
            $(this).remove();
        }
    });

    $('.section-title').parent().removeClass('page-content');

};


function getList(){



    $('.check-box input').each(function () {

        if( ($(this).val() == 'partners') && ($(this).prop('checked'))  ){

            var markerCluster = new MarkerClusterer(map, [],
                {imagePath: '/local/templates/.default/img/m'});
            var markerIcon = new google.maps.MarkerImage( '/local/templates/.default/img/map-marker-3.png',
                new google.maps.Size(48, 67),
                new google.maps.Point(0, 0),
                new google.maps.Point(24, 67)
            );
            var infowindow = new google.maps.InfoWindow({
                boxClass: 'office-popup',
                closeBoxURL: '/local/templates/.default/img/close.png',
            });
            var bounds = new google.maps.LatLngBounds();

            $.ajax({
                type: "POST",
                url: "/local/php_interface/ajax/loadOffices.php",
                data: {
                    CITY: $('#city').data('id'),
                },
                dataType: "json",
                success: function (data) {
                    if(data){

                        console.log(data);
                        data.forEach(function(item, i ,arr) {
                            var latLng = item['COORDINATES'].split(','),
                                name = item['NAME'],
                                city = item['CITY'],
                                href = item['URL'],
                                address = item['ADDRESS'],
                                phone = item['PHONE'],
                                subway = item['SUBWAY'],
                                services = item['SERVICES'],
                                hours = item['MODE'],
                                imgSrc = item['IMG'];


                            var marker = new google.maps.Marker( {

                                position: new google.maps.LatLng( latLng[0], latLng[1]),
                                map: map,
                                icon: markerIcon,
                                title: name,

                            } );
                            markerCluster.addMarker(marker);
                            bounds.extend( marker.getPosition() );
                            var popupContent =
                                '<div class="office-popup">' +
                                '<div class="content ">' +
                                '<h3 class="city page-title--3 page-title">' + city + '</h3>' +
                                '<h4 class="title page-title--4 page-title"><a href="' + href + '">' + name + '</a></h4>';

                            if (address) popupContent = popupContent + '<p class="mi--address-s mi">' + address + '</p>';
                            if (phone) popupContent = popupContent + '<p class="mi--phone-s mi">' + phone + '</p>';
                            if (subway) popupContent = popupContent + '<p class="mi--subway-s mi">' + subway + '</p>';
                            if (services) popupContent = popupContent + '<p class="mi--services-s mi">' + services + '</p>';
                            if (hours) popupContent = popupContent + '<p class="mi--hours-s mi">' + hours + '</p>';
                            popupContent = popupContent + '<a href="' + href + '" class="image" style="background-image: url(' + imgSrc + ');"></a>' +
                                '</a>';

                            google.maps.event.addListener( marker, 'click', ( function( marker, i ) {

                                return function() {

                                    infowindow.setContent( popupContent );
                                    infowindow.open(map, marker);

                                    // popup.setContent( popupContent[i] );
                                    // popup.open(map, marker);

                                    map.setCenter( marker.getPosition() );

                                }

                            } )( marker, i ) );
                            map.setCenter( marker.getPosition() );
                        });



                    }
                }
            });

        }

    });



}



function maps(){
    $('.switch-box input').val('yes');
    $('#send').click();
}

function list(){
    $('.switch-box input').val('no');
    $('#send').click();
}

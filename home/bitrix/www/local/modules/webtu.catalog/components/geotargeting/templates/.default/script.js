$(window).on('load', function() {

    if (!navigator.geolocation) {
        console.log('Геолокация не поддерживается в браузере.');
    }

    if (typeof($.cookie('WEBTU_GEOTARGETING_CITY')) == 'undefined') {

        navigator.geolocation.getCurrentPosition(
            function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var min_distance = 1000;

                $('#webtu-geotargeting option').each(function() {
                    var city_lat = parseFloat($(this).data('lat'));
                    var city_lng = parseFloat($(this).data('lng'));

                    distance = Math.sqrt(Math.pow(lat - city_lat, 2) + Math.pow(lng - city_lng, 2));

                    if (distance < min_distance) {
                        min_distance = distance;
                        $.cookie('WEBTU_GEOTARGETING_CITY', $(this).val(), { expires: 7 });
                    }
                });

                $('#webtu-geotargeting option').removeAttr('selected');
                $('#webtu-geotargeting option[value="' + $.cookie('WEBTU_GEOTARGETING_CITY') + '"]').attr('selected', 'selected');

            },
            function() {
                console.log('Не удалось получить геоданные.');
            }
        );
    }

    $('#webtu-geotargeting').change(function() {
        console.log($(this).val());
        $.cookie('WEBTU_GEOTARGETING_CITY', $(this).val(), { expires: 7 });
        window.location.reload();
    });
});
var page = 0,
    countPage,
    pageSize = 2000,
    res = true,
    arMarker = [];
window.onload=function(){
    var i=0;
    $('div.cs-box').each(function(){
        i++;
        if (i > 1){
            $(this).remove();
        }
    });

    $('.section-title').parent().removeClass('page-content');

    //получить колличество банкоматов партнеров
    $.ajax({
        type: "POST",
        url: "/local/php_interface/ajax/countOffices.php",
        data: {
        },
        dataType: "text",
        success: function (data) {
            if(data){
                countPage = data / pageSize;
                loadList();


            }
        }
    });



};

function loadList(){

    var test = 'test';
    // console.log(markerCluster);
    var timerList = setInterval(function(){timer()}, 2000);



    function timer(){
        $('.check-box input').each(function () {

            var markerCluster = new MarkerClusterer(map, [],
                {imagePath: '/local/templates/.default/img/m'});


            if( ($(this).val() == 'partners') && ($(this).prop('checked')) && (page <= countPage) ){


                console.log('yes');
                $.ajax({
                    type: "POST",
                    url: "/local/php_interface/ajax/loadOffices.php",
                    data: {
                        PAGE: page,
                        SIZE: pageSize,
                    },
                    dataType: "json",
                    success: function (data) {
                        if(data){

                            console.log(data);
                            data.forEach(function(item, i ,arr) {
                                var latLng = item['PROPERTY_ATT_COORDINATES_VALUE'].split(',');
                                var marker = new google.maps.Marker( {

                                    position: new google.maps.LatLng( latLng[0], latLng[1]),
                                    map: map,
                                    title: 'test',

                                } );
                                arMarker.push(marker);
                                markerCluster.addMarker(marker);
                                // markerCluster.redraw();
                            });

                            console.log(page);
                            page++;
                        }
                    }
                });

            }

            if (page > countPage && res){
                // var markerCluster = new MarkerClusterer(map, [],
                //     {imagePath: '/local/templates/.default/img/m'});
                // console.log(arMarker);
                //
                // arMarker.forEach(function(item, i ,arr) {
                //     markerCluster.addMarker(item);
                // });

                res = false;
            }
        });

    }



}




function maps(){
    $('.switch-box input').val('yes');
    $('#send').click();
}

function list(){
    $('.switch-box input').val('no');
    $('#send').click();
}

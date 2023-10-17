// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.

$(window).on( 'load', function() {

    /*-----------------------------------------------------*/
    /* FANCYBOX */
    /*-----------------------------------------------------*/

    $('[data-fancybox]').fancybox( {

        animationDuration: 720,
        buttons : [
            'slideShow',
            'fullScreen',
            'close'
        ],

        onActivate: function() {

            $('html').css('overflow', 'hidden');

        },

        afterClose: function() {

            $('html').css('overflow', 'auto');

        }

    } );

    /*-----------------------------------------------------*/
    /* CUSTOM SELECT */
    /*-----------------------------------------------------*/

    $('.select-box select').customSelect( {

        speed: 360

    } );

    /*-----------------------------------------------------*/
    /* CLIENTS MENU */
    /*-----------------------------------------------------*/

    $('.clients-menu').packery( {

        itemSelector: '.clients-menu_item',
        gutter: 30

    } );

    /*-----------------------------------------------------*/
    /* INPUT MASK */
    /*-----------------------------------------------------*/

    $('input[data-mask="date"]').mask( '99.99.9999', {

        placeholder: 'дд.мм.гггг'

    } );

    $('input[data-mask="phone"]').mask('+7 (999) 999-99-99');

    /*-----------------------------------------------------*/
    /* WOW */
    /*-----------------------------------------------------*/

    new WOW( {

        mobile: false

    } ).init();

    /*-----------------------------------------------------*/
    /* MAIN PAGE SLIDER */
    /*-----------------------------------------------------*/

    $('#mpSlider').owlCarousel( {

        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        autoHeight: true,
        autoplay: true,
        autoplaySpeed: 720,
        autoplayTimeout: 10800,
        dotsContainer: '#mpSliderPager',
        items: 1,
        loop: true,
        mouseDrag: false

    } );

    /*-----------------------------------------------------*/
    /* CALC RANGE SLIDER */
    /*-----------------------------------------------------*/

    function formatCalcRangeNumber( num ) {

        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");

    }

    $('.calc-range-block').each( function() {
        var $value = $(this).find('.value .input-field');
        var incVal = +$value.data('increment');
        var curVal = +$value.val();
        var defVal = curVal;

        var stepsVal = $value.data('steps').split(', ');
        var stepsPos = [];

        var minVal = +stepsVal[0];
        var maxVal = +stepsVal[ stepsVal.length - 1 ];

        var $slider = $(this).find('.calc-range-block_slider');

        $(this).find('.calc-range-block_steps').append('<li class="first"><span>' + formatCalcRangeNumber( minVal ) + '</span></li>');
        $(this).find('.calc-range-block_steps').append('<li class="last"><span>' + formatCalcRangeNumber( maxVal ) + '</span></li>');

        for ( var i = 1; i < stepsVal.length - 1; i++ ) {

            stepsPos[i] = ( ( +stepsVal[i] - minVal ) / ( maxVal - minVal ) * 100 ).toFixed(2);

            $(this).find('.calc-range-block_steps').append('<li class="middle" style="left: ' + stepsPos[i] + '%;"><span>' + formatCalcRangeNumber( stepsVal[i] ) + '</span></li>');

        }

        function setValue(arr, val) {
            for (i=0; i<arr.length; i++) {
                if (arr[i] > val) {
                    if (arr[i] - val < val - arr[i - 1]) {
                        return arr[i];
                    } else {
                        return arr[i - 1];
                    }
                }
            }
        }

        $slider.slider( {

            max: maxVal,
            min: minVal,
            step: incVal,
            value: curVal,
            change: function( event, ui ) {
                $value.val( addSpaces ( ui.value ) );
                change();
            },
            slide: function( event, ui ) {
                if ( stepsVal.indexOf(ui.value.toString()) === -1  && $value.data('set_value') == 'Y' ) {
                    return false;
                } else {
                    $value.val( addSpaces ( ui.value ) );
                }
            }

        } );

        $value.change( function() {

            var valueToNum = parseInt( $(this).val().replace(/\s/g, '') );

            if ($(this).data('set_value') == 'Y') {
                valueToNum = setValue(stepsVal, valueToNum);
            }

            if ( ( valueToNum < minVal ) || ( valueToNum > maxVal ) || ( isNaN( valueToNum ) ) ) {

                $(this).val( defVal );

            } else {

                defVal = +valueToNum;

                $slider.slider( 'value', +valueToNum );

            }

            $(this).val();

        } );

        $value.val( addSpaces ( $value.val() ) );

        function addSpaces ( value ) {

            var _val = value.toString();

            var _valArr = _val.split("", _val.length);
            n = 0;
            var valueString = '';
            for (var i = _valArr.length - 1; i >= 0; i--) {
                n++;
                valueString = _valArr[i] + valueString;
                if ( ( n%3 == 0 ) && ( i != 0 ) ) {
                    valueString = ' ' + valueString;
                }
            }

            return valueString;
        }
    });

    /*-----------------------------------------------------*/
    /* PROMO SLIDER */
    /*-----------------------------------------------------*/

    function promoSlider () {

        $('#promoSlider').owlCarousel( {

           autoHeight: true,
           loop: true,
           responsive: {

               0: {

                   items: 1

               },

               650: {

                   items: 2

               },

               984: {

                   items: 3

               },

               1240: {

                   items: 4

               }

           }

        } );

        $('#promoSliderNext').click( function() {

            $('#promoSlider').trigger( 'next.owl.carousel', [ 720 ] );

            return false;

        } );

        $('#promoSliderPrev').click( function() {

            $('#promoSlider').trigger( 'prev.owl.carousel', [ 720 ] );

            return false;

        } );

    }

    promoSlider ();

    document.onresize = function () {
        promoSlider ();
    };


    /*-----------------------------------------------------*/
    /* PHOTO SLIDER */
    /*-----------------------------------------------------*/

    $('.photo-slider .owl-carousel').owlCarousel( {

        autoHeight: true,
        loop: false,
        margin: 30,
        mouseDrag: false,
        responsive: {

            0: {

                animateIn: 'fadeIn',
                animateOut: 'fadeOut',
                items: 1,
                margin: 0

            },

            631: {

                items: 2

            },

            931: {

                items: 3

            }

        }

    } );

    $('.photo-slider .slider-control--next').click( function() {

        $(this).closest('.photo-slider').find('.owl-carousel').trigger( 'next.owl.carousel', [ 720 ] );

        return false;

    } );

    $('.photo-slider .slider-control--prev').click( function() {

        $(this).closest('.photo-slider').find('.owl-carousel').trigger( 'prev.owl.carousel', [ 720 ] );

        return false;

    } );
} );
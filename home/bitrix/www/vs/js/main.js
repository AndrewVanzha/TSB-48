$(window).on('load', function(){

    /*-----------------------------------------------------*/
    /* PRELOADER */
    /*-----------------------------------------------------*/

    $('#preloader').fadeOut(1800);
    $('html').css('overflow', 'auto');

    /*-----------------------------------------------------*/
    /* NAVIGATION */
    /*-----------------------------------------------------*/

    $('#navToggle').click( function() {

        $('#pageOverlay').addClass('is-visible');
        $('#navigation').addClass('is-visible');
        $('html').css('overflow', 'hidden');

        return false;

    } );

    $('#navClose').click( function() {

        $('#pageOverlay').removeClass('is-visible');
        $('#navigation').removeClass('is-visible');
        $('html').css('overflow', 'auto');

        return false;

    } );

    $('.navigation .has-submenu > a').click( function() {

        if ( $(this).parent().hasClass('is-active') ) {

            $(this).parent().removeClass('is-active').find('.has-submenu').removeClass('is-active').find('ul').finish().slideUp(360);
            $(this).next().finish().slideUp(360);

        } else {

            $(this).closest('ul').find('.has-submenu').removeClass('is-active').find('ul').finish().slideUp(360);
            $(this).parent().addClass('is-active');
            $(this).next('ul').finish().slideDown(360);

        }

        return false;

    } );

    /*-----------------------------------------------------*/
    /* PAGE OVERLAY */
    /*-----------------------------------------------------*/

    $('#pageOverlay').click( function() {

        $(this).removeClass('is-visible');
        $('#navigation').removeClass('is-visible');

        $('.tooltip_text').finish().fadeOut(360);

        $('html').css('overflow', 'auto');

    } );

    /*-----------------------------------------------------*/
    /* TOOLTIP */
    /*-----------------------------------------------------*/

    function changeTooltipTriggerMethod() {

        if ( $(window).width() > 631 ) {

            $('.tooltip_icon').bind( {

                mouseenter: function() {

                    $(this).next().finish().fadeIn(360);

                    if ( ( $(this).next().offset().left + $(this).next().outerWidth() + 30 ) > $(window).width() ) {

                        $(this).next().addClass('left-sided');

                    } else {

                        $(this).next().removeClass('left-sided');

                    }

                },

                mouseleave: function() {

                    $(this).next().finish().fadeOut(360);

                }

            }).bind( {

                click: function() {

                    return false;

                }

            } );

        } else {

            $('.tooltip_text').removeClass('left-sided');

            $('.tooltip_icon').bind( {

                click: function() {

                    $('#pageOverlay').toggleClass('is-visible');
                    $('html').css('overflow', 'hidden');

                    $(this).next('.tooltip_text').finish().fadeToggle(360);

                    return false;

                }

            }).unbind('mouseenter mouseleave');

        }

    }

    changeTooltipTriggerMethod();

    $(window).resize( function() {

        changeTooltipTriggerMethod();

    } );

    $('.tooltip_close').click( function() {

        $('#pageOverlay').click();

        return false;

    } );

    /*-----------------------------------------------------*/
    /* SWITCH BOX */
    /*-----------------------------------------------------*/

    function setSwitchBoxLever(obj) {

        if ( obj.find('input[type="radio"]:checked').parent().next().length ) {

            obj.find('.switch-box_lever').addClass('is-active-left').removeClass('is-active-right');

        } else if ( obj.find('input[type="radio"]:checked').parent().prev().length ) {

            obj.find('.switch-box_lever').addClass('is-active-right').removeClass('is-active-left');

        }

    }

    $('.switch-box').each( function() {

        setSwitchBoxLever( $(this) );

    } );

    $('.switch-box input[type="radio"]').change( function() {

        setSwitchBoxLever( $(this).parents('.switch-box') );

    } );

    $('.switch-box_lever').click( function() {

        if ( $(this).siblings().find('input[type="radio"]').length ) {

            if ( $(this).hasClass('is-active-left') ) {

                $(this).removeClass('is-active-left').addClass('is-active-right');
                $(this).prev().find('input[type="radio"]').prop('checked', false);
                $(this).next().find('input[type="radio"]').prop('checked', true);

            } else {

                $(this).removeClass('is-active-right').addClass('is-active-left');
                $(this).prev().find('input[type="radio"]').prop('checked', true);
                $(this).next().find('input[type="radio"]').prop('checked', false);

            }

            $(this).siblings().find('input[type="radio"]').change();

        }

    } );

    /*-----------------------------------------------------*/
    /* HEADER PHONE */
    /*-----------------------------------------------------*/

    $('.callback-toggle').click( function() {

        if ( $(window).width() > 630 ) {

            $.fancybox.close();
            $.fancybox.open( {

                src: '#callbackForm',
                type: 'inline'

            } );

            return false;

        }

    } );

    /*-----------------------------------------------------*/
    /* FEEDBACK FORM */
    /*-----------------------------------------------------*/

    function toggleFeedbackFormInputType() {

        if ( $('#feedbackFormInputType').find('input[type="radio"]:checked').parent().next().length ) {

            $('#feedbackFormInputPhone').show();
            $('#feedbackFormInputEmail').hide();

        } else {

            $('#feedbackFormInputPhone').hide();
            $('#feedbackFormInputEmail').show();

        }

    }

    toggleFeedbackFormInputType();

    $('.feedback_form .switch-box input[type="radio"]').change( function() {

        toggleFeedbackFormInputType();

    } );

    /*-----------------------------------------------------*/
    /* INFO ACCORDION */
    /*-----------------------------------------------------*/

    $('.info-accordion_heading').click( function() {

        if ( $(this).hasClass('is-active') ) {

            $(this).removeClass('is-active').find('.toggle').html('Развернуть');
            $(this).next().finish().slideUp(360);

        } else {

            $(this).addClass('is-active').find('.toggle').html('Свернуть');
            $(this).next().finish().slideDown(360);

            if ( $(window).width() < 631 ) {

                $('html, body').animate( { scrollTop: $(this).offset().top }, 360 );

            }

        }

        return false;

    } );

    /*-----------------------------------------------------*/
    /* EXCHANGE CONVERTER */
    /*-----------------------------------------------------*/

    $('#exchangeConverterFlipSides').click( function() {

        $(this).after( $('.exchange-converter_value:first') );
        $(this).before( $('.exchange-converter_value:last') );

        return false;

    } );

    /*-----------------------------------------------------*/
    /* CHOOSE ALL */
    /*-----------------------------------------------------*/

    $('.choose-all input[type="checkbox"]').change( function() {

        if ( $(this).prop('checked') ) {

            $(this).parent().siblings('.check-box').children('input[type="checkbox"]').prop('checked', true);

        } else {

            $(this).parent().siblings('.check-box').children('input[type="checkbox"]').prop('checked', false);

        }

    } );

    $('.choose-all').siblings('.check-box').children('input[type="checkbox"]').change( function() {

        if ( !$(this).prop('checked') ) {

            $(this).parent().siblings('.choose-all').children('input[type="checkbox"]').prop('checked', false);

        } else {

            if ( $(this).parents().eq(1).find('.check-box:not(.choose-all) input[type="checkbox"]:checked').length == $(this).parents().eq(1).find('.check-box:not(.choose-all)').length ) {

                $(this).parent().siblings('.choose-all').children('input[type="checkbox"]').prop('checked', true);

            }

        }

    } );

    /*-----------------------------------------------------*/
    /* LOAD MORE */
    /*-----------------------------------------------------*/

    $('.load-more').click( function() {

        $( $(this).attr('href')).slideDown(360);
        $(this).slideUp(360);

        return false;

    } );

    /*-----------------------------------------------------*/
    /* SCROLLER CONTROLS */
    /*-----------------------------------------------------*/

    $('.scroller-controls .right').click( function() {

        var $target = $(this).parent().next('.scroller');
        $target.animate( { scrollLeft: $target.scrollLeft() + 90 }, 90 );

        return false;

    } );

    $('.scroller-controls .left').click( function() {

        var $target = $(this).parent().next('.scroller');
        $target.animate( { scrollLeft: $target.scrollLeft() - 90 }, 90 );

        return false;

    } );

});
$(window).on('load', function () {

    /*-----------------------------------------------------*/
    /* PRELOADER */
    /*-----------------------------------------------------*/

    $('#preloader').fadeOut(1800);
    $('html').css('overflow', 'auto');

    /*-----------------------------------------------------*/
    /* NAVIGATION */
    /*-----------------------------------------------------*/

    $('#navToggle').click(function () {

        $('#pageOverlay').addClass('is-visible');
        $('#navigations').addClass('is-visible');
        $('html').css('overflow', 'hidden');

        return false;

    });

    $('#navClose').click(function () {

        $('#pageOverlay').removeClass('is-visible');
        $('#navigations').removeClass('is-visible');
        $('html').css('overflow', 'auto');

        return false;

    });

    $('.navigation .has-submenu > a').click(function () {

        if ($(this).parent().hasClass('is-active')) {

            $(this).parent().removeClass('is-active').find('.has-submenu').removeClass('is-active').find('ul').finish().slideUp(360);
            $(this).next().finish().slideUp(360);

        } else {

            $(this).closest('ul').find('.has-submenu').removeClass('is-active').find('ul').finish().slideUp(360);
            $(this).parent().addClass('is-active');
            $(this).next('ul').finish().slideDown(360);

        }

        return false;

    });

    /*-----------------------------------------------------*/
    /* PAGE OVERLAY */
    /*-----------------------------------------------------*/

    $('#pageOverlay').click(function () {

        $(this).removeClass('is-visible');
        $('#navigations').removeClass('is-visible');

        $('.tooltip_text').finish().fadeOut(360);

        $('html').css('overflow', 'auto');

    });

    /*-----------------------------------------------------*/
    /* TOOLTIP */
    /*-----------------------------------------------------*/

    function changeTooltipTriggerMethod() {

        if ($(window).width() > 631) {

            $('.tooltip_icon').bind({

                mouseenter: function () {

                    $(this).next().finish().fadeIn();

                    if (($(this).next().offset().left + $(this).next().outerWidth() + 30) > $(window).width()) {

                        $(this).next().addClass('left-sided');

                    } else {

                        $(this).next().removeClass('left-sided');

                    }

                },

                mouseleave: function () {

                    $(this).next().finish().fadeOut();

                }

            }).bind({

                click: function () {

                    return false;

                }

            });

        } else {

            $('.tooltip_text').removeClass('left-sided');

            $('.tooltip_icon').bind({

                click: function () {

                    $('#pageOverlay').addClass('is-visible');
                    //$('html').css('overflow', 'hidden');

                    $(this).next('.tooltip_text').finish().fadeIn();

                    return false;

                }

            }).unbind('mouseenter mouseleave');

        }

    }

    changeTooltipTriggerMethod();

    $(window).resize(function () {

        changeTooltipTriggerMethod();

    });

    $('.tooltip_close').click(function () {

        $('#pageOverlay').click();

        return false;

    });

    /*-----------------------------------------------------*/
    /* HEADER PHONE */
    /*-----------------------------------------------------*/

    $('.callback-toggle').click(function () {

        if ($(window).width() > 630) {

            $.fancybox.close();
            $.fancybox.open({

                src: '#callbackForm',
                type: 'inline'

            });

            return false;

        }

    });

    /*-----------------------------------------------------*/
    /* HEADER SLIDER */
    /*-----------------------------------------------------*/

    function setMainSliderMarginTop() {

        if (document.querySelectorAll('.mp-slider').length > 0) {

            mainSlider = document.querySelector('.mp-slider');

            if (screen.width > 780) {
                mainSliderMarginTop = document.querySelector('.mp-top .header').offsetHeight;
            } else {
                mainSliderMarginTop = 0;
            }

            mainSlider.style.marginTop = mainSliderMarginTop + 'px';
        }

    }

    setMainSliderMarginTop();

    /*-----------------------------------------------------*/
    /* SWITCH BOX */
    /*-----------------------------------------------------*/

    function setSwitchBoxLever(obj) {

        if (obj.find('input[type="radio"]:checked').parent().next().length) {

            obj.find('.switch-box_lever').addClass('is-active-left').removeClass('is-active-right');

        } else if (obj.find('input[type="radio"]:checked').parent().prev().length) {

            obj.find('.switch-box_lever').addClass('is-active-right').removeClass('is-active-left');

        }

    }

    $('.switch-box').each(function () {

        setSwitchBoxLever($(this));

    });

    $('.switch-box input[type="radio"]').change(function () {

        setSwitchBoxLever($(this).parents('.switch-box'));

    });

    $('.switch-box_lever').click(function () {

        if ($(this).siblings().find('input[type="radio"]').length) {

            if ($(this).hasClass('is-active-left')) {

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

    });

    /*-----------------------------------------------------*/
    /* FEEDBACK FORM */
    /*-----------------------------------------------------*/

    function toggleFeedbackFormInputType() {

        if ($('.page-bottom .switch-box_lever').hasClass('is-active-left')) {
            $('#feedbackFormInputPhone').removeClass('hidden');
            $('#feedbackFormInputPhone').prop('required', true);
            $('#feedbackFormInputEmail').addClass('hidden');
            $('#feedbackFormInputEmail').prop('required', false);
        } else {
            $('#feedbackFormInputPhone').addClass('hidden');
            $('#feedbackFormInputPhone').prop('required', false);
            $('#feedbackFormInputEmail').removeClass('hidden');
            $('#feedbackFormInputEmail').prop('required', true);
        }
    }

    toggleFeedbackFormInputType();

    $('.feedback_form .switch-box input[type="radio"]').change(function () {

        toggleFeedbackFormInputType();

    });

    /*-----------------------------------------------------*/
    /* SCROLLER CONTROLS */
    /*-----------------------------------------------------*/

    $('.scroller-controls .right').click(function () {

        var $target = $(this).parent().next('.scroller');
        $target.animate({ scrollLeft: $target.scrollLeft() + 90 }, 90);

        return false;

    });

    $('.scroller-controls .left').click(function () {

        var $target = $(this).parent().next('.scroller');
        $target.animate({ scrollLeft: $target.scrollLeft() - 90 }, 90);

        return false;

    });

    $('.header_search-link.mi--zoom-1.mi').click(function () {
        $('#navToggle').click();
    });

    // $('[href^="#"]').click(function(event){
    //     if ( $(this).attr('href') !== "#" && !$(this).is('[data-fancybox]') ) {
    //         event.preventDefault();
    //         var header = document.querySelector('.header');
    //         var headerStyle = getComputedStyle(header);
    //         var headerHeight;
    //         if (headerStyle.position == "fixed") {
    //             headerHeight = header.offsetHeight;
    //         } else {
    //             headerHeight = 0;
    //         }
    //         var id  = $(this).attr('href'),
    //             top = $(id).offset().top;
    //         $('body,html').animate({scrollTop: top - headerHeight}, 1500);
    //         if (! ($(id).hasClass('is-active')) ) {
    //             $(id).click();
    //         };
    //     }
    // });

    // function onloadScrolling () {
    //     var header = document.querySelector('.header');
    //     var headerStyle = getComputedStyle(header);
    //     var headerHeight;
    //     if (headerStyle.position == "fixed") {
    //         headerHeight = header.offsetHeight;
    //     } else {
    //         headerHeight = 0;
    //     }
    //     var anchorPosition = window.pageYOffset;
    //     var scrollPosition = anchorPosition - headerHeight - 10;
    //     scrollTo (0, scrollPosition);
    //     console.log(anchorPosition);
    //     console.log(scrollPosition);
    // }

    // if (window.location.hash) {
    //     onloadScrolling ();
    // }

    /*-----------------------------------------------------*/
    /* INFO ACCORDION */
    /*-----------------------------------------------------*/

    $('.info-accordion_heading').click(function () {

        if ($(this).hasClass('is-active')) {

            if($(this).attr('data-flag') != 'noword') {
                $(this).removeClass('is-active').find('.toggle').html('Развернуть');
            } else {
                $(this).removeClass('is-active');
            }
            //$(this).removeClass('is-active').find('.toggle').html('Развернуть');
            $(this).next().finish().slideUp(360);

        } else {

            if($(this).attr('data-flag') != 'noword') {
                $(this).addClass('is-active').find('.toggle').html('Свернуть');
            } else {
                $(this).addClass('is-active');
            }
            //$(this).addClass('is-active').find('.toggle').html('Свернуть');
            $(this).next().finish().slideDown(360);

            if ($(window).width() < 631) {

                $('html, body').animate({ scrollTop: $(this).offset().top }, 360);

            }

        }

        return false;

    });

    function openAccordion() {
        var anchorName = window.location.hash;
        $(anchorName).click();
    }

    if (window.location.hash) {
        openAccordion();
    }

    /*-----------------------------------------------------*/
    /* EXCHANGE CONVERTER */
    /*-----------------------------------------------------*/

    $('#exchangeConverterFlipSides .switch-box').click(function () {

        $('.flip-sides.mi--flip.mi').after($('.exchange-converter_value:first'));
        $('.flip-sides.mi--flip.mi').before($('.exchange-converter_value:last'));

        return false;

    });

    /*-----------------------------------------------------*/
    /* CHOOSE ALL */
    /*-----------------------------------------------------*/

    $('.choose-all input[type="checkbox"]').change(function () {

        if ($(this).prop('checked')) {

            $(this).parent().siblings('.check-box').children('input[type="checkbox"]').prop('checked', true);

        } else {

            $(this).parent().siblings('.check-box').children('input[type="checkbox"]').prop('checked', false);

        }

    });

    $('.choose-all').siblings('.check-box').children('input[type="checkbox"]').change(function () {

        if (!$(this).prop('checked')) {

            $(this).parent().siblings('.choose-all').children('input[type="checkbox"]').prop('checked', false);

        } else {

            if ($(this).parents().eq(1).find('.check-box:not(.choose-all) input[type="checkbox"]:checked').length == $(this).parents().eq(1).find('.check-box:not(.choose-all)').length) {

                $(this).parent().siblings('.choose-all').children('input[type="checkbox"]').prop('checked', true);

            }

        }

    });

    /*-----------------------------------------------------*/
    /* LOAD MORE */
    /*-----------------------------------------------------*/

    $('.load-more').click(function () {

        $($(this).attr('href')).slideDown(360);
        $(this).slideUp(360);

        return false;

    });

    /*-----------------------------------------------------*/
    /* FORCE DOWNLOAD */
    /*-----------------------------------------------------*/

    allLinks = document.querySelectorAll('a');

    for (var i = 0; i < allLinks.length; i++) {
        linkHref = allLinks[i].getAttribute('href');
        if (linkHref !== null && linkHref.length > 5) {
            if (linkHref.substr(-4, 4) === ".dot" || linkHref.substr(-4, 4) === ".xml") {
                allLinks[i].setAttribute('download', '');
            }
        }
    }

    /*-----------------------------------------------------*/
    /* TITLE RESIZE */
    /*-----------------------------------------------------*/

    function titleResize() {

        if (document.querySelectorAll('h1.page-title--1').length > 0) {

            var title = document.querySelector('h1.page-title--1');
            var titleText = title.innerText;
            var arTitle = titleText.split(' ');
            if (document.querySelector('.page-content').offsetWidth < 300) {

                for (var i = 0; i < arTitle.length; i++) {
                    if (arTitle[i].length > 14) {
                        title.style.fontSize = "28px";
                    }
                    if (arTitle[i].length > 16) {
                        title.style.fontSize = "26px";
                    }
                    if (arTitle[i].length > 18) {
                        title.style.fontSize = "24px";
                    }
                }

            } else {
                title.style.fontSize = "";
            }
        }

    }

    titleResize();

    /*-----------------------------------------------------*/
    /* PRODUCT ITEMS WIDTH */
    /*-----------------------------------------------------*/

    function productItemsWidth() {

        arContainer = document.querySelectorAll('.product-items');
        if (arContainer.length > 0) {

            for (var i = 0; i < arContainer.length; i++) {
                arItems = arContainer[i].querySelectorAll('.product-item');
                if (arItems.length < 4) {
                    widthItem = arItems[0].offsetWidth;
                    style = arItems[0].currentStyle || window.getComputedStyle(arItems[0]);
                    marginItem = parseInt(style.marginRight);
                    widthContainer = (widthItem + marginItem) * arItems.length;
                    widthSection = arContainer[i].parentElement.offsetWidth;
                    if (widthContainer > widthSection) {
                        widthContainer = widthSection;
                    }
                    arContainer[i].style.position = "relative";
                    if (widthContainer >= 900) {
                        arContainer[i].style.left = marginItem / 2 + "px";
                    } else {
                        arContainer[i].style.left = '0';
                    }
                    arContainer[i].style.marginLeft = "auto";
                    arContainer[i].style.marginRight = "auto";
                    arContainer[i].style.width = widthContainer + "px";
                }
            }

        }

        arServices = document.querySelectorAll('.service-item');
        if (arServices.length > 0) {
            serviceContainer = arServices[0].parentNode;
            if (arServices.length < 4) {
                widthItem = arServices[0].offsetWidth;
                style = arServices[0].currentStyle || window.getComputedStyle(arServices[0]);
                marginItem = parseInt(style.marginRight);
                i = arServices.length - 1;
                arServices[i].style.marginRight = '0';
                widthContainer = ((widthItem + marginItem) * arServices.length) - marginItem;
                widthSection = serviceContainer.parentElement.offsetWidth;
                if (widthContainer > widthSection) {
                    widthContainer = widthSection;
                }
                serviceContainer.style.position = "relative";
                if (widthContainer >= 900) {
                    serviceContainer.style.left = marginItem / 2 + "px";
                } else {
                    serviceContainer.style.left = '0';
                }
                serviceContainer.style.marginLeft = "auto";
                serviceContainer.style.marginRight = "auto";
                serviceContainer.style.width = widthContainer + "px";
            }
        }

    }

    setTimeout(productItemsWidth(), 100);


    window.onresize = function () {
        setMainSliderMarginTop();
        titleResize();
        productItemsWidth();
    };

    /*-----------------------------------------------------*/
    /* HIDE EMPTY IMGS */
    /*-----------------------------------------------------*/

    allImages = document.querySelectorAll('img');

    for (var i = 0; i < allImages.length; i++) {

        objImg = new Image();
        objImg.src = allImages[i].getAttribute('src');
        if (!objImg.complete) {
            allImages[i].style.display = 'none';
        }

    }

    /*-----------------------------------------------------*/
    /* REMOVE ALERT IN FORM */
    /*-----------------------------------------------------*/

    $('[data-fancybox=""], .product-item').on('click', function () {
        $(".alert").remove();
    });

    if ($('#js-allow-cookies').length) {
        document.getElementById('js-allow-cookies').addEventListener('click', event => {
            document.getElementById('component-cookie-policy').hidden = true;
            document.cookie = "allowCookie=Y; path=/; max-age=5184000";
        });
    }
});
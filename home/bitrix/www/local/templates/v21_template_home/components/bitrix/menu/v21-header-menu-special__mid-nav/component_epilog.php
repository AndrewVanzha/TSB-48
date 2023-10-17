<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
foreach ($arResult as $arItem) {
    if ($arItem['IS_PARENT'] && $arItem['DEPTH_LEVEL'] == 1) {
        //$arBuffLinks[] = str_replace('/', '', $arItem['LINK']);
        //$arLinks[] = $arItem['LINK'];

        ob_start();
        if ($arItem['LINK'] == '/' || $arItem['LINK'] == '/corporative-clients/' || $arItem['LINK'] == '/chastnym-klientam/') {
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => $arItem['LINK'] . 'index_menublock.php',
                    "EDIT_TEMPLATE" => ""
                )
            );
        }
        $content = ob_get_clean();
        $APPLICATION->AddViewContent('show_block_' . str_replace('/', '', $arItem['LINK']), $content);
    }
}
?>
<script>
    $(document).ready(function () {
        const detectBrowser = () => {
            let result = 'Other';
            if (navigator.userAgent.indexOf('YaBrowser') !== -1 ) {
                result = 'Yandex Browser';
            } else if (navigator.userAgent.indexOf('Firefox') !== -1 ) {
                result = 'Firefox';
            } else if (navigator.userAgent.indexOf('MSIE') !== -1 ) {
                result = 'Exploder';
            } else if (navigator.userAgent.indexOf('Edge') !== -1 ) {
                result = 'Microsoft Edge';
            } else if (navigator.userAgent.indexOf('Safari') !== -1 ) {
                result = 'Safari';
            } else if (navigator.userAgent.indexOf('Opera') !== -1 ) {
                result = 'Opera';
            } else if (navigator.userAgent.indexOf('Chrome') !== -1 ) {
                result = 'Google Chrome';
            }
            return result;
        }
        console.log(detectBrowser());
        // добавлять к v21-header__bot-nav-wrap фон для FF background-color
        if(detectBrowser() == 'Firefox') {
            $('.v21-newheader__container').addClass('v21-newheader__container--firefox');
        }

        $('.js-v21-header-search-bckgrnd').click(() => {
            $('#v21_headerSearchOverlay').addClass('v21-header__search-overlay--bckgrnd');
        });
        $('.v21-header__search .v21-header__search-close').click(() => {
            $('#v21_headerSearchOverlay').removeClass('v21-header__search-overlay--bckgrnd');
        });
        $('#v21_headerSearchOverlay').click(() => {
            console.log('++');
            $('#v21_headerSearchOverlay').removeClass('v21-header__search-overlay--bckgrnd');
        });

        let originalHeight = $('.v21-menu_special').height(); // h = 56,
        let hoverSpeed = 300;
        if($(window).width() > 767) { // десктопная версия
            $('.js-v21-header__mid-nav-item').hover(
                function() {
                    let hoverHeight = $(this).find('.v21-header__bot-nav-wrap').height(); // разные
                    $('.v21-newheader__container').addClass('v21-header__bot-nav-wrap--shadow');
                    $('.v21-newheader__container').stop().animate({ height: hoverHeight + 56*0 }, hoverSpeed);
                },
                function() {
                    $('.v21-newheader__container').removeClass('v21-header__bot-nav-wrap--shadow');
                    $('.v21-newheader__container').stop().animate({ height: originalHeight }, hoverSpeed);
                },
            );
        }
        else {   /* мобильное меню отключено */
        }

        let $win = $(window);
        let $target = $('.js-v21-header__fixed'); // блок, который нужно фиксировать при прокрутке
        let targetTop = $target.offset().top; // координаты верха нужного блока
        let $anchor = $('.v21-header__anchor');
        let topGap = 20; //  расстояние от верха
        let fixed = false;

        let fixBox = function () {
            let scroll_top = $win.pageYOffset || document.documentElement.scrollTop; // как далеко вниз прокрутил страницу

            if($win.width() > 767) { // десктопная версия
                if(scroll_top > ($anchor.offset().top - topGap)) {
                    if(!fixed) {
                        $anchor.height($target.outerHeight());
                        $target.addClass('v21-header__fixed');
                        fixed = true;
                    }
                    if($win.width() < 1480) {
                        $('.v21-header-2').width($win.width()); // контролирую ширину блока
                        $target.width($win.width() - 30*2); // контролирую ширину блока + paddings
                    }
                } else {
                    if(fixed) {
                        $anchor.height(0);
                        $target.removeClass('v21-header__fixed');
                        fixed = false;
                    }
                }

            }
            else {  /* мобильное меню отключено */
            }

        };
        fixBox();
        $win.on('scroll', function() {
            fixBox();
        });

        if($(window).width() > 767) { // десктопная версия
            $('.js-v21-menu_special--appendix').hover( // показываю доп.меню из-под трех точек
                function() {
                    let $appx = $('.v21-route-appendix__menu');
                    $appx.addClass('v21-route-appendix__menu-show');
                    $appx.css({ left: $(this).offset().left - 35 });
                    $appx.css({ top: $('.js-v21-header__fixed').position().top + $('.js-v21-header__fixed').height() + 4 });
                    $appx.hover(
                        function () {
                            $(this).addClass('v21-route-appendix__menu-show');
                        },
                        function () {
                            $(this).removeClass('v21-route-appendix__menu-show');
                        }
                    );
                },
                function() {
                    $('.v21-route-appendix__menu').removeClass('v21-route-appendix__menu-show');
                }
            );
        }
        else {  /* мобильное меню отключено */
        }

        $('.js-v21-route-choice').hover( // показываю доп.меню из-под Онлайн-банк
            function () {
                let $appx = $('.v21-route-choice__block');
                let $newheader = $('.v21-newheader__container');
                $appx.addClass('v21-route-choice__block--show');
                let x_right = $newheader.offset().left + $newheader.width();
                if($(window).width() > 767) {
                    $appx.css({ left: x_right - $appx.width() - 20*2 }); // paddings
                }
                if($(window).width() > 767) {
                    $appx.css({ top: $('.js-v21-header__fixed').position().top + $('.js-v21-header__fixed').height() + 4 });
                } else {
                    $appx.css({ top: $('.v21-header-1').height() + $('.js-v21-header__fixed').height() + 4 });
                }
                $appx.hover(
                    function () {
                        $(this).addClass('v21-route-choice__block--show');
                    },
                    function () {
                        $(this).removeClass('v21-route-choice__block--show');
                    }
                );
            },
            function () {
                $('.v21-route-choice__block').removeClass('v21-route-choice__block--show');
            }
        );

        $('.js-v21-route-language').hover( // показываю доп.меню из-под RU на широком экране
            function () {
                let $appx = $('.v21-route-choice__language');
                let $newheader = $('.v21-newheader__container');
                $appx.addClass('v21-route-choice__language--show');
                let x_right = $newheader.offset().left + $newheader.width();
                if($(window).width() > 767) {
                    $appx.css({ left: x_right - $appx.width() - 20*2 }); // paddings
                    $appx.css({ top: $('.v21-header-1').height() - 24 });
                } else {
                }
                $appx.hover(
                    function () {
                        $(this).addClass('v21-route-choice__language--show');
                    },
                    function () {
                        $(this).removeClass('v21-route-choice__language--show');
                    }
                );
            },
            function () {
                $('.v21-route-choice__language').removeClass('v21-route-choice__language--show');
            }
        );

        //$('.js-v21-link').hover(  // показываю подменю с городами
        $('.js-v21-link').click(  // показываю подменю с городами
            function () {
                let $appx = $('.v21-route-choice__city');
                let $newheader = $('.v21-newheader__container');
                $appx.addClass('v21-route-choice__city--show');
                let x_right = $newheader.offset().left + $newheader.width();
                if($(window).width() > 767) {
                    $appx.css({ left: x_right - $appx.width() - 20*2 });
                    $appx.css({ top: $('.v21-header-1').height() - 24 });
                    /*$appx.hover(
                        function () {
                            $(this).addClass('v21-route-choice__city--show');
                        },
                        function () {
                            $(this).removeClass('v21-route-choice__city--show');
                        }
                    );*/
                }
            }/*,
            function () {
                $('.v21-route-choice__city').removeClass('v21-route-choice__city--show');
            },*/
        );

        let checkMainMenu = function (node) { // убираю слишком длинные слова под три точки
            let blockWidth = $(node).width();
            if(blockWidth < 1190) {
                $('.v21-menu_special .v21-header__mid-nav-item:nth-of-type(4)').addClass('v21-menu__item--none');
                $('.v21-route-appendix__block-1').removeClass('v21-menu__item--none');
            } else {
                $('.v21-menu_special .v21-header__mid-nav-item:nth-of-type(4)').removeClass('v21-menu__item--none');
                $('.v21-route-appendix__block-1').addClass('v21-menu__item--none');
            }
            if(blockWidth < 980) {
                $('.v21-menu_special .v21-header__mid-nav-item:nth-of-type(3)').addClass('v21-menu__item--none');
                $('.v21-route-appendix__block-2').removeClass('v21-menu__item--none');
            } else {
                $('.v21-menu_special .v21-header__mid-nav-item:nth-of-type(3)').removeClass('v21-menu__item--none');
                $('.v21-route-appendix__block-2').addClass('v21-menu__item--none');
            }
        };
        checkMainMenu('.v21 .v21-newheader__container');

        $(window).resize(function () {
            checkMainMenu('.v21 .v21-newheader__container');
            fixBox();
        });
    });
</script>
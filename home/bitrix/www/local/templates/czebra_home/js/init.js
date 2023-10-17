$(document).ready(function(){

    $('.wrapp-slider .owl-carousel').owlCarousel({
        items: 1,
        dots: true,
        nav: true,
        responsive:{
            0:{
                nav: false
            },
            992:{
                nav: true
            }
        }
    });

    $('.wrapp-dop-menu .icon-dop-menu').click(function(){
        $(this).toggleClass('icon-dop-menu icon-dop-menu-active');
        $('.menu-item').slideToggle();
        return false
    });

    $('.menu-arrow-top').click(function(){
        $(this).siblings('ul').slideToggle();
        $(this).toggleClass('menu-arrow-top menu-arrow-down');
        return false;
    });

    $('.mobil-news-main .owl-carousel').owlCarousel({
        items: 1,
        dots: true,
        margin: 10,
    });

    $('.icon-dop-menu-mobil').click(function(){
        $(this).siblings('.menu-item').slideToggle();
        $('.header').toggleClass('menu-background');
        $(this).toggleClass('icon-dop-menu-mobil-active icon-dop-menu-mobil-close');
        return false
    });

    $(".wrapp-search .btn-search").click(function(){
        $(".input").toggleClass("active").focus;
        $(".input").val("");
    });

    $(".search-mob .btn-search").click(function(){
        $(".input").toggleClass("active").focus;
        $(".input").val("");
    });
  
    // textSlideVertical();

    // $(window).resize(function() {
    //     textSlideVertical();
    // });

    //Клики по вкладкам.
    // var tab = $('.tabs-items > div'); 
    //  tab.hide().filter(':first').show(); 
    // $('.top-menu .tab').click(function(){
    //     tab.hide(); 
    //     tab.filter(this.hash).show(); 
    //     $('.top-menu .tab').removeClass('active');
    //     $(this).addClass('active');
    //     return false;
    // }).filter(':first').click();


    // Вкладки мобильная версия
/*
    var tabs = document.querySelector('#tabs');
    document.querySelector('#select').addEventListener('change', function() {
        tabs.querySelector('.active').classList.remove('active');
        tabs.querySelector(`#${this.value}`).classList.add('active');
    });
*/

    $("#select").change(function(){
        $('#corporative').removeClass('active');
        $('#private').removeClass('active');
        $("#" + $(this).val()).addClass('active');
    });

    if(window.matchMedia('(max-width: 991px)').matches) {
        if($('.header-bottom .menu-mobil .wrapp-select-menu .cs-box_selected').val('Корпоративным клиентам')){
            $('#private').hide();
            $('#corporative').show();
        };
    
        if($('.header-bottom .menu-mobil .wrapp-select-menu .cs-box_selected').val('Частным клиентам')){
            $('#private').show();
            $('#corporative').hide();
        };

        if($('.header-bottom .menu-mobil .wrapp-select-menu .cs-box_selected').val('Corporate customer')){
            $('#private').hide();
            $('#corporative').show();
        }
    
        if($('.header-bottom .menu-mobil .wrapp-select-menu .cs-box_selected').val('Private customers')){
            $('#private').show();
            $('#corporative').hide();
        }
    }

    

    $("#select").customSelect();

    // $('.top-menu a[href="#corporative"]').click(function(){
    //     $('.menu-private-clients').hide();
    //     $('.menu-corporat-clients').show();
    //     return false;
    // })

    // $('.top-menu a[href="#private"]').click(function(){
    //     $('.menu-private-clients').show();
    //     $('.menu-corporat-clients').hide();
    //     return false;
    // });

    $("#private").hide()

    
    $('.top-menu a.menu-corporative').click(function(){
        setTimeout(function(){
            $('.menu-private-clients').hide();
            $('.menu-corporat-clients').show();
        }, 500);
        $("#private").hide()
        $("#corporative").show();
        $(this).addClass('active');
        $('.top-menu a.menu-private').removeClass('active');
        // return false;
    })

    $('.top-menu a.menu-private').click(function(){
        setTimeout(function(){
            $('.menu-private-clients').show();
            $('.menu-corporat-clients').hide();;
        }, 500);
        $("#private").show()
        $("#corporative").hide();
        $(this).addClass('active');
        $('.top-menu a.menu-corporative').removeClass('active');
        
        // return false;
    });

    
    // console.log(window.location.href);

    /* header */ 

    if(window.location.pathname=='/'){
        $('.top-menu ul li a.menu-corporative').addClass('active');
        $('.menu-private-clients').hide();
        $('.menu-corporat-clients').show();
    }

    if(window.location.pathname=='/en/'){
        $('.top-menu ul li a.menu-corporative').addClass('active');
        $('.menu-private-clients').hide();
        $('.menu-corporat-clients').show();
    }

    // if(window.location.href.indexOf('/') >= 0){
    //     // $('.top-menu ul li a.menu-corporative').addClass('active');
    //     $('.menu-private-clients').hide();
    //     $('.menu-corporat-clients').show();
    // };

    if(window.location.href.indexOf('#corporative') >= 0){
        $('.top-menu ul li a.menu-corporative').addClass('active');
        $('.menu-private-clients').hide();
        $('.menu-corporat-clients').show();
        $("#private").hide()
        $("#corporative").show();
        $('.top-menu a.menu-private').removeClass('active');
    };

    if(window.location.href.indexOf('#private') >= 0){
        $('.top-menu ul li a.menu-private').addClass('active');
        $('.menu-private-clients').show();
        $('.menu-corporat-clients').hide();
        $("#private").show()
        $("#corporative").hide();
        $('.top-menu a.menu-corporative').removeClass('active');
    }

    if(window.location.href.indexOf('/o-banke/') >= 0){
        $('.top-menu ul li a.menu-bank').addClass('active');
        $('.top-menu ul li a.menu-corporative').removeClass('active');
    };

    if(window.location.href.indexOf('/chastnym-klientam/') >= 0){
        $('.menu-private-clients').show();
        $('.menu-corporat-clients').hide();
    };

    if(window.location.href.indexOf('/corporative-clients/') >= 0){
        $('.menu-private-clients').hide();
        $('.menu-corporat-clients').show();
    };

    /* end header */


    equalHeight();

    equalHeightMobil();


})

/*Вертикальное выравнивание текста слайдера*/
// function textSlideVertical(){
//     var textSlideHeight = $('.wrapp-slider .text-slide').outerHeight();
//     $('.wrapp-slider .text-slide').css({marginTop:-(textSlideHeight/2)});
// }


function equalHeight(){
    var max_col_height = 0; // максимальная высота, первоначально 0
	$('.news-main .wrapp-list-main .block-news').each(function(){ 
		if ($(this).height() > max_col_height) { 
			max_col_height = $(this).height(); 
		}
	});
    $('.news-main .wrapp-list-main .block-news').height(max_col_height);
    
}

function equalHeightMobil(){
    var max_col_height = 0; // максимальная высота, первоначально 0
	$('.mobil-news-main .news-main .block-news').each(function(){ 
		if ($(this).height() > max_col_height) { 
			max_col_height = $(this).height(); 
		}
	});
    $('.mobil-news-main .news-main .block-news').height(max_col_height);
    
}


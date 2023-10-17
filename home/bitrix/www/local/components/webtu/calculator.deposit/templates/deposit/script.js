window.loadFlag = false;

window.onload=function(){
    $('.check-box').click(function(){
      if ($(this).is('.currency')) {
        if ($(this).find('input').data('currency') == 'Руб.') {
          $('.calc-range-block_cur').hide();
          $('.calc-range-block_rub').show();
        } else {
          $('.calc-range-block_rub').hide();
          $('.calc-range-block_cur').show();
        }
      }
      $(this).closest('form.page-section').addClass('loading');
      if (!window.loadFlag) {
        setTimeout(change, 300);
      }
    });

    change();

    containerWidth ();
}

function change(){
    window.loadFlag = true;
    var currency = $('.currency input:checked').data('currency');
    $('.currency-text').text(currency);
    var prop = [];
    $('.prop').each(function(){
        if ($(this).find('input').is(':checked')){
            prop.push($(this).find('input').data('prop'));
        }
    });
    if (currency == 'Руб.') {
      var summInput = $('#summ');
    } else {
      var summInput = $('#summ_cur');
    }
    var summ = parseInt( summInput.val().replace(/\s/g, '') );
    var date = $('#date').val();
    var month = $('#month').val();

    $.ajax({
       type: "POST",
       url: "/local/php_interface/ajax/depositRecommend.php",
       data: {
           PROPERTIES: prop,
           SUM: summ,
           DATE: date,
           CURRENCY: currency,
       },
       dataType: "html",
       success: function (data) {
          if(data){
              $('#list').html(data);
          }
          containerWidth ();
          window.loadFlag = false;
          $('form.page-section').removeClass('loading');
       }
    });
}

function containerWidth () {

  if (document.querySelectorAll('.product-item').length > 0) {
    var container = document.querySelector('.product-items');
    var arItems = container.querySelectorAll('.product-item');
    if (arItems.length < 4) {
        var widthItem = arItems[0].offsetWidth;
        var style = arItems[0].currentStyle || window.getComputedStyle(arItems[0]);
        var marginItem = parseInt(style.marginRight);
        var widthContainer = (widthItem + marginItem) * arItems.length;
        container.style.position = "relative";
        container.style.left = marginItem / 2 + "px";
        container.style.marginLeft = "auto";
        container.style.marginRight = "auto";
        container.style.width = widthContainer + "px";
    }
  }

}


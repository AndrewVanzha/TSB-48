var arLine = [];
var arText = [];

function calculation(){
    var currency = $('.currency input:checked').data('currency');
    var type = $('.type input:checked').data('type');
    var sum = parseInt( $('#price').val().replace(/\s/g, '') );
    var date = $('#date').val();
    var percent = String($('.currency input:checked').data('percent')).replace(',', '.');
    var payMonth;
    arText = [['Месяц', 'Остаток по кредиту('+currency+')', 'Проценты('+currency+')', 'Погашение долга('+currency+')', 'Ежемесячный платеж('+currency+')']];

    //если список
    if ($('div').is('.items-list')) {
        percent = list(sum, date);
    }

    $('#column-percent').text(percent);

    var percentMonth = percent / 100 / 12;

    $('.cur').html(currency);

    if(type == "annuity"){
        payMonth = annuity(sum, date, percent, percentMonth);
        payMonthStr = String(payMonth).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
        textMonth = 'Сумма ежемесячного платежа: '+payMonthStr+' '+currency;
    }

    if(type == "differentiated"){
        differentiated(sum, date, percent, percentMonth);
        textMonth = '';
    }

    sumStr = String(sum).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
    

    $('#column-month').text(payMonthStr);
    $('#column-sum').text(sumStr);
    $('#column-date').text(date);
    var textPercent = 'Процентная ставка: '+percent+'%'
        textSum = 'Сумма кредита: '+sumStr+' '+currency,
        textDate = 'Срок кредита: '+date+' мес.';

    var docInfo = {

        info: {
            title:'График платежей',
            author:'tsbank',
            subject:'Theme',
            keywords:'кредит'
        },

        pageSize:'A4',
        pageOrientation:'portrait',//'landscape'
        pageMargins:[50,70,30,60],

        header:[
            {
                columns: [
                    {
                        image: 'data:image/png;base64,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',
                        width: 300,
                        margin: [10, 10, 10, 10],
                    },
                ]
            },
        ],

        footer:function(currentPage,pageCount) {
            return {
                text: currentPage + ' из ' + pageCount,
                alignment:'center',
                fontSize:16,
                margin:[0,30,10,50]
            }
        },

        content: [
            {
                text: textSum,
                bold:true,
            },
            {
                text: textDate,
                bold:true,
            },
            {
                text: textPercent,
                bold:true,
            },
            {
                text: textMonth,
                margin:[0,0,0,40],
                bold:true,
            },
            {
                text:'График платежей',
                fontSize:25,
                bold:true,
                alignment:'center',
                margin:[0,0,0,10],
            },

            {
                table:{
                    widths:['auto','auto','auto','auto','auto'],

                    body:arText,
                    headerRows:1
                }
            },
            {
                text: '*Вся информация носит справочный характер и не является публичной офертой.\n',
                margin:[0,40,0,0],
            },

        ],

        styles: {
        }
    }
    recommend(sum, date, currency);

    return docInfo;
}

function annuity(sum, date, percent, percentMonth){
    $('#column-month').parents('li.clearfix').show();
    var payMonth;//Платеж за месяц
    var payMainMonth;// Выплата по основному долгу за месяц
    var payPercentMonth;// Выплата по процентам за месяц
    var sumDebt = sum;// Остаток по кредиту
    var month = new Date();
    var options = {
        year: 'numeric',
        month: 'long',
    }

    payMonth = sum * ( percentMonth / (1 - Math.pow((percentMonth + 1), -date )) );
    for(var i=date; i>0; i--){

        payPercentMonth = sumDebt * percentMonth;
        payMainMonth = payMonth - payPercentMonth;
        sumDebt = sumDebt - payMainMonth;

        sumDebtStr =  String(sumDebt.toFixed(2)).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
        payPercentMonthStr = String(payPercentMonth.toFixed(2)).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
        payMainMonthStr = String(payMainMonth.toFixed(2)).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
        payMonthStr = String(payMonth.toFixed(2)).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");

        arLine = [month.toLocaleString("ru", options), sumDebtStr, payPercentMonthStr, payMainMonthStr, payMonthStr];
        arText.push(arLine);
        month.setMonth(month.getMonth() + 1);
    }
    payMonth = payMonth.toFixed(2);
    return payMonth;
}

function differentiated(sum, date, percent, percentMonth){
    $('#column-month').parents('li.clearfix').hide();
    var mainDebt = sum / date;// Размер основного платежа
    var sumDebt = sum;//Остаток задолженности на расчетную дату
    var sumDebtAft;//Остаток задолженности после платежа
    var sumPercent = 0;//Начисленные проценты
    var payMonth = 0;//Размер платежа на текущий месяц
    var month = new Date();
    var options = {
        year: 'numeric',
        month: 'long',
    }


    for(var i=date; i>0; i--){
        sumDebt = sum - (mainDebt * (date - i));
        sumPercent = sumDebt * (percentMonth);
        payMonth = mainDebt + sumPercent;
        sumDebtAft = sum - (mainDebt * (date - (i - 1)));

        sumDebtAftStr =  String(sumDebtAft.toFixed(2)).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
        sumPercentStr =  String(sumPercent.toFixed(2)).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
        mainDebtStr =  String(mainDebt.toFixed(2)).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
        payMonthStr =  String(payMonth.toFixed(2)).replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");


        arLine = [month.toLocaleString("ru", options), sumDebtAftStr, sumPercentStr, mainDebtStr, payMonthStr];
        arText.push(arLine);
        month.setMonth(month.getMonth() + 1);
    }

}

function recommend(sum, date, currency){
    var arProperties = [];
    $('.properties .check-box').each(function(){
        if($(this).find('input').is(':checked')){
            arProperties.push( $(this).find('span').html().trim() );
        }
    });
    $.ajax({
       type: "POST",
       url: "/local/php_interface/ajax/creditRecommend.php",
       data: {
           PROPERTIES: arProperties,
           SUM: sum,
           DATE: date,
           CURRENCY: currency,
       },
       dataType: "html",
       success: function (data) {
           if(data){
                $('#list').html(data);
            }
       }
    });
}

function pdfCreacte(){
    var docInfo = calculation();
    pdfMake.createPdf(docInfo).download('payments.pdf');
}

function list(sum, date){
    var arItem = [];

    $('.items-list .product-item').each(function(){
        var percentItem = String($('.currency input:checked').data('percent')).replace(',', '.');
        percentItem = parseFloat( percentItem );
        var sumItem = $(this).find('.credit_summ').data('value');
        var timeItem = $(this).find('.credit_time').data('value');
        var nameItem = $(this).find('h3 .aligner').html();

        arItem.push({percent: percentItem, time: timeItem, sum: sumItem, name: nameItem});

    });
    arItem.sort(compareItem);

    for(var i = 0; i<arItem.length; i++){
        if (sum > arItem[i].sum){
            continue;
        } else {
            if (date > arItem[i].time){
                continue;
            } else {
                percent = arItem[i].percent;
                break;
            }
        }

    }

    $('#column-percent').text(percent);
    return percent;
}

function change(){
    calculation();
}

function compareItem(itemA, itemB) {
  return itemA.percent - itemB.percent;
}

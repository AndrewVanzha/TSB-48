<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { ?>
    <? die(); ?>
<? } ?>
<!-- Styles -->
<style>
#chartdiv {
	width	: 100%;
	height	: 500px;
}																	
</style>
<!-- Resources -->
<script src="<?=$arResult["TEMPLATE_FOLDER"]?>/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?=$arResult["TEMPLATE_FOLDER"]?>/amcharts/serial.js" type="text/javascript"></script>
<script src="<?=$arResult["TEMPLATE_FOLDER"]?>/amcharts/lang/ru.js" type="text/javascript"></script>
<?
$json = json_encode($arResult['ITEMS']); 
?>
<!-- Chart code -->
<script>
// var chartData = generateChartData();
var chartData = <?php echo $json;?>;

var chart = AmCharts.makeChart("chartdiv", {
		type: "serial",
		dataDateFormat: "YYYY-MM-DD",
		theme: "default",
        language: "ru",
        dataProvider: chartData,
        categoryField: "date",
        categoryAxis: {
        	// minPeriod: "DD",
            // parseDates: true,
            // gridAlpha: 0.15,
            // minorGridEnabled: true,
            // axisColor: "#DADADA"
        },
        valueAxes: [{
            axisAlpha: 0.2,
            id: "v1"
        },{
            axisAlpha: 0.2,
            id: "v2"
        }],
        "legend": {
			"enabled": true,
		},
        graphs: [{
            title: "USD",
            id: "g1",
            valueAxis: "v1",
            valueField: "USD",
            bullet: "round",
            bulletBorderColor: "#FFFFFF",
            bulletBorderAlpha: 1,
            lineThickness: 2,
            lineColor: "#b5030d",
            negativeLineColor: "#0352b5",
            hideBulletsCount:30,
            balloonText: "[[category]]<br><b><span style='font-size:14px;'>Курс USD: [[value]]</span></b>"
        },
        {
            title: "EUR",
            id: "g2",
            valueAxis: "v1",
            valueField: "EUR",
            bullet: "round",
            bulletBorderColor: "#D8B572",
            bulletBorderAlpha: 1,
            lineThickness: 2,
            lineColor: "#D8B572",
            negativeLineColor: "#D8B572",
            hideBulletsCount:30,
            balloonText: "[[category]]<br><b><span style='font-size:14px;'>Курс EUR: [[value]]</span></b>"
        },
        {
            title: "GBP",
            id: "g3",
            valueAxis: "v1",
            valueField: "GBP",
            bullet: "round",
            bulletBorderColor: "#6DCFF6",
            bulletBorderAlpha: 1,
            lineThickness: 2,
            lineColor: "#6DCFF6",
            negativeLineColor: "#6DCFF6",
            hideBulletsCount:30,
            balloonText: "[[category]]<br><b><span style='font-size:14px;'>Курс GBP: [[value]]</span></b>"
        },
        {
            title: "CHF",
            id: "g4",
            valueAxis: "v1",
            valueField: "CHF",
            bullet: "round",
            bulletBorderColor: "#6A9F1A",
            bulletBorderAlpha: 1,
            lineThickness: 2,
            lineColor: "#6A9F1A",
            negativeLineColor: "#6A9F1A",
            hideBulletsCount:30,
            balloonText: "[[category]]<br><b><span style='font-size:14px;'>Курс CHF: [[value]]</span></b>"
        },
        {
            title: "JPY\271",
            id: "g5",
            valueAxis: "v1",
            valueField: "JPY",
            bullet: "round",
            bulletBorderColor: "#82CA9C",
            bulletBorderAlpha: 1,
            lineThickness: 2,
            lineColor: "#82CA9C",
            negativeLineColor: "#82CA9C",
            hideBulletsCount:30,
            balloonText: "[[category]]<br><b><span style='font-size:14px;'>Курс JPY: [[value]]</span></b>"
        },
        {
            title: "CNY\262",
            id: "g6",
            valueAxis: "v1",
            valueField: "CNY",
            bullet: "round",
            bulletBorderColor: "#fce621",
            bulletBorderAlpha: 1,
            lineThickness: 2,
            lineColor: "#fce621",
            negativeLineColor: "#fce621",
            hideBulletsCount:30,
            balloonText: "[[category]]<br><b><span style='font-size:14px;'>Курс CNY: [[value]]</span></b>"
        }
        ],
        chartCursor: {
            fullWidth:true,
            cursorAlpha:0.1
        },
        chartScrollbar: {
            scrollbarHeight: 40,
            color: "#FFFFFF",
            autoGridCount: true,
            graph: "g1"
        }
});

chart.addListener("rendered", zoomChart);
zoomChart();

// this method is called when chart is first inited as we listen for "rendered" event
function zoomChart() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    chart.zoomToIndexes(chartData.length - 40, chartData.length - 1);
}


</script>

<!-- HTML -->
<div class="page-container">

    <div class=" clearfix" style="margin-top: 50px; ">
        
        <h2 class="section-title page-title--2 page-title" style="margin-bottom: 0px;">
            <?=GetMessage('EXCHANGE_RATE_DYNAMICS')?>
        </h2>

    </div>
    
    <div id="chartdiv"></div>

    <p style="margin: 5px 48px; font-size: 16px;">1 - <?=GetMessage("CURS_COUNT_1")?></p>
	<!-- <p style="margin: 5px 48px 20px; font-size: 16px;">2 - <?//=GetMessage("CURS_COUNT_2")?></p>-->
	<?//редактировать в lang/ru/template.php и lang/en/template.php?>

</div>

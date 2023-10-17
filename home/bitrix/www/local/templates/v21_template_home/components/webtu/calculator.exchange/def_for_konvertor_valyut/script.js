$(document).ready(function () {
    $('#exchange-date').text($('.v21-exchange-info__date > span').text().replace('данные на ', ''));
});
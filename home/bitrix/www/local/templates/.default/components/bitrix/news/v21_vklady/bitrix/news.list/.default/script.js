$(function () {
    var activeTabs = $('.v21-tabs-header__item.js-v21-tabs-header-item.js-v21-tabs-toggle.is-active').data('tab-id');
    $('div[data-tab-id="' + activeTabs + '"]').addClass('is-active');
});
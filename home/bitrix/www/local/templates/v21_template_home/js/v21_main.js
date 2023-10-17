$(document).ready(function(){



(function(e, a) { for(var i in a) e[i] = a[i]; }(window, /******/ (function(modules) { // webpackBootstrap
/******/ 	// install a JSONP callback for chunk loading
/******/ 	function webpackJsonpCallback(data) {
/******/ 		var chunkIds = data[0];
/******/ 		var moreModules = data[1];
/******/ 		var executeModules = data[2];
/******/
/******/ 		// add "moreModules" to the modules object,
/******/ 		// then flag all "chunkIds" as loaded and fire callback
/******/ 		var moduleId, chunkId, i = 0, resolves = [];
/******/ 		for(;i < chunkIds.length; i++) {
/******/ 			chunkId = chunkIds[i];
/******/ 			if(Object.prototype.hasOwnProperty.call(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 				resolves.push(installedChunks[chunkId][0]);
/******/ 			}
/******/ 			installedChunks[chunkId] = 0;
/******/ 		}
/******/ 		for(moduleId in moreModules) {
/******/ 			if(Object.prototype.hasOwnProperty.call(moreModules, moduleId)) {
/******/ 				modules[moduleId] = moreModules[moduleId];
/******/ 			}
/******/ 		}
/******/ 		if(parentJsonpFunction) parentJsonpFunction(data);
/******/
/******/ 		while(resolves.length) {
/******/ 			resolves.shift()();
/******/ 		}
/******/
/******/ 		// add entry modules from loaded chunk to deferred list
/******/ 		deferredModules.push.apply(deferredModules, executeModules || []);
/******/
/******/ 		// run deferred modules when all chunks ready
/******/ 		return checkDeferredModules();
/******/ 	};
/******/ 	function checkDeferredModules() {
/******/ 		var result;
/******/ 		for(var i = 0; i < deferredModules.length; i++) {
/******/ 			var deferredModule = deferredModules[i];
/******/ 			var fulfilled = true;
/******/ 			for(var j = 1; j < deferredModule.length; j++) {
/******/ 				var depId = deferredModule[j];
/******/ 				if(installedChunks[depId] !== 0) fulfilled = false;
/******/ 			}
/******/ 			if(fulfilled) {
/******/ 				deferredModules.splice(i--, 1);
/******/ 				result = __webpack_require__(__webpack_require__.s = deferredModule[0]);
/******/ 			}
/******/ 		}
/******/
/******/ 		return result;
/******/ 	}
/******/
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// object to store loaded and loading chunks
/******/ 	// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 	// Promise = chunk loading, 0 = chunk loaded
/******/ 	var installedChunks = {
/******/ 		1: 0
/******/ 	};
/******/
/******/ 	var deferredModules = [];
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	var jsonpArray = window["webpackJsonp"] = window["webpackJsonp"] || [];
/******/ 	var oldJsonpFunction = jsonpArray.push.bind(jsonpArray);
/******/ 	jsonpArray.push = webpackJsonpCallback;
/******/ 	jsonpArray = jsonpArray.slice();
/******/ 	for(var i = 0; i < jsonpArray.length; i++) webpackJsonpCallback(jsonpArray[i]);
/******/ 	var parentJsonpFunction = oldJsonpFunction;
/******/
/******/
/******/ 	// add entry module to deferred list
/******/ 	deferredModules.push([15,0]);
/******/ 	// run deferred modules when ready
/******/ 	return checkDeferredModules();
/******/ })
/************************************************************************/
/******/ ({

/***/ 13:
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ 14:
/***/ (function(module, exports) {

/*----------------------------------------*/
/* HEADER SEARCH */
/*----------------------------------------*/
document.querySelectorAll('.js-v21-header-search-toggle').forEach(function (toggle) {
  toggle.addEventListener('click', function () {
    var searchForm = document.getElementById(toggle.getAttribute('href').substr(1));
    if (!searchForm) return;
    var searchInput = searchForm.querySelector('.js-v21-header-search-input');
    if (!searchInput) return;
    setTimeout(function () {
      searchInput.focus();
    }, 180);
  });
});

/***/ }),

/***/ 15:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// EXPORTS
__webpack_require__.d(__webpack_exports__, "tsb21", function() { return /* binding */ tsb21; });

// EXTERNAL MODULE: ./node_modules/normalize.css/normalize.css
var normalize = __webpack_require__(8);

// EXTERNAL MODULE: ./node_modules/tiny-slider/dist/tiny-slider.css
var tiny_slider = __webpack_require__(9);

// EXTERNAL MODULE: ./node_modules/js-datepicker/dist/datepicker.min.css
var datepicker_min = __webpack_require__(10);

// EXTERNAL MODULE: ./node_modules/choices.js/public/assets/styles/choices.min.css
var choices_min = __webpack_require__(11);

// EXTERNAL MODULE: ./node_modules/nouislider/dist/nouislider.css
var nouislider = __webpack_require__(12);

// EXTERNAL MODULE: ./src/scss/main.scss
var main = __webpack_require__(13);

// EXTERNAL MODULE: ./node_modules/tiny-slider/src/tiny-slider.js + 41 modules
var src_tiny_slider = __webpack_require__(3);

// EXTERNAL MODULE: ./node_modules/inputmask/dist/inputmask.js
var inputmask = __webpack_require__(4);
var inputmask_default = /*#__PURE__*/__webpack_require__.n(inputmask);

// EXTERNAL MODULE: ./node_modules/js-datepicker/dist/datepicker.min.js
var dist_datepicker_min = __webpack_require__(5);
var dist_datepicker_min_default = /*#__PURE__*/__webpack_require__.n(dist_datepicker_min);

// EXTERNAL MODULE: ./node_modules/choices.js/public/assets/scripts/choices.js
var scripts_choices = __webpack_require__(1);
var choices_default = /*#__PURE__*/__webpack_require__.n(scripts_choices);

// EXTERNAL MODULE: ./node_modules/nouislider/dist/nouislider.js
var dist_nouislider = __webpack_require__(6);
var dist_nouislider_default = /*#__PURE__*/__webpack_require__.n(dist_nouislider);

// EXTERNAL MODULE: ./node_modules/wnumb/wNumb.js
var wNumb = __webpack_require__(2);
var wNumb_default = /*#__PURE__*/__webpack_require__.n(wNumb);

// CONCATENATED MODULE: ./src/js/modal.js

/*-----------------------------------------------------*/
/* MODAL */
/*-----------------------------------------------------*/
var modal = ({
  closeAllModals: function closeAllModals() {
    // console.log('close them all');
    document.querySelectorAll('[class*="js-v21-modal"], .js-v21-overlay').forEach(function (item) {
      item.classList.remove('is-active');
      document.documentElement.style.overflow = 'unset';
    });
  },

  toggleModal: function toggleModal(id) {
    var modal = document.getElementById(id);
    if (!modal) return;
    var isActive = modal.classList.contains('is-active');
    this.closeAllModals();
    if (!isActive) {
      document.querySelectorAll(".js-v21-modal-toggle[href=\"#".concat(id, "\"]")).forEach(function (toggle) {
        toggle.classList.add('is-active');
      });
      modal.classList.add('is-active');
      var overlay = document.getElementById(modal.dataset.overlay);
      if (modal.dataset.overlay && overlay) {
        overlay.classList.add('is-active');
        document.documentElement.style.overflow = 'hidden';
      }
    }
  },

  init: function init() {

    var _this = this;
    document.querySelectorAll('.js-v21-modal-toggle').forEach(function (toggle) {
      toggle.addEventListener('click', function (e) {

        e.preventDefault();
        _this.toggleModal(toggle.getAttribute('href').substr(1));
      });
    });
    document.addEventListener('click', function (e) {
      if (!e.target.closest('[class*="js-v21-modal-"], [class*="qs"]')) {
        _this.closeAllModals();
      }
    });
    window.addEventListener('keyup', function (e) {
      if (e.key === 'Escape') _this.closeAllModals();
    });


  }
});

// EXTERNAL MODULE: ./node_modules/gsap/index.js + 2 modules
var gsap = __webpack_require__(0);

// EXTERNAL MODULE: ./node_modules/gsap/ScrollToPlugin.js
var ScrollToPlugin = __webpack_require__(7);

// CONCATENATED MODULE: ./src/js/dropdown.js

gsap["a" /* default */].registerPlugin(ScrollToPlugin["a" /* ScrollToPlugin */]);

/*----------------------------------------*/
/* DROPDOWN */
/*----------------------------------------*/
var dropdown = ({
  slideDown: function slideDown(item, duration, callback) {
    var target = document.querySelector(item);
    if (!target) return;
    target.style.display = 'block';
    target.style.height = 'auto';
    var targetHeight = target.offsetHeight;
    target.style.height = 0;
    target.style.overflow = 'hidden';
    gsap["a"].to(target, {
      duration: duration,
      height: "".concat(targetHeight, "px"),
      onComplete: function onComplete() {
        target.style.height = 'auto';
        target.style.overflow = '';
        if (callback) {
          callback();
        }
      }
    });
  },

  slideUp: function slideUp(item, duration, callback) {
    var target = document.querySelector(item);
    if (!target) return;
    target.style.overflow = 'hidden';
    gsap["a"].to(target, {
      duration: duration,
      height: 0,
      onComplete: function onComplete() {
        target.style.display = 'none';
        target.style.height = 'auto';
        target.style.overflow = '';
        if (callback) {
          callback();
        }
      }
    });
  },

  init: function init() {
    var _this = this;
    document.querySelectorAll('.js-v21-dropdown-toggle').forEach(function (toggle) {
      var duration = 0.36;
      toggle.addEventListener('click', function (e) {
        e.preventDefault();
        var active = toggle.classList.contains('is-active');
        var href = toggle.getAttribute('href');
        var target = document.querySelector(href);
        if (!target) return;
        if (toggle.dataset.dropdownGroup) {
          document.querySelectorAll("[data-dropdown-group=\"".concat(toggle.dataset.dropdownGroup, "\"]")).forEach(function (item) {
            if (item !== toggle) {
              var newTarget = document.querySelector(item.getAttribute('href'));
              if (newTarget) {
                _this.slideUp(item.getAttribute('href'), duration);
                newTarget.classList.remove('is-active');
              }
              item.classList.remove('is-active');
            }
          });
        }
        if (active) {
          _this.slideUp(toggle.getAttribute('href'), duration);
          target.classList.remove('is-active');
        } else {
          _this.slideDown(toggle.getAttribute('href'), duration);
          target.classList.add('is-active');
        }
        if (toggle.dataset.scrollAnchor) {
          var offset = toggle.closest(toggle.dataset.scrollAnchor).getBoundingClientRect().top + window.scrollY - document.querySelector('.v21-header-2').offsetHeight + 1;
          gsap["a"].to(window, {
            duration: 0.3,
            scrollTo: offset
          });
        }
        document.querySelectorAll(".js-v21-dropdown-toggle[href='".concat(href, "']")).forEach(function (item) {
          if (active) {
            item.classList.remove('is-active');
          } else {
            item.classList.add('is-active');
          }
        });
      });
    });
  }
});

// CONCATENATED MODULE: ./src/js/tabs.js

gsap["a" /* default */].registerPlugin(ScrollToPlugin["a" /* ScrollToPlugin */]);
/*----------------------------------------*/
/* TABS */
/*----------------------------------------*/
var js_tabs = ({
  showTab: function showTab(tabId) {
    var tab = document.querySelector("[data-tab-id='".concat(tabId, "']"));
    var tabs = tab.closest('.js-v21-tabs');
    if (!tab || !tabs) return;
    tabs.querySelectorAll('[data-tab-id]').forEach(function (item) {
      if (item.dataset.tabId.indexOf(tabId) + 1) {
        item.classList.add('is-active');
      } else {
        item.classList.remove('is-active');
      }
    });
    if (tabs.dataset.tabAnchor) {
      var offset = tabs.getBoundingClientRect().top + window.scrollY - document.querySelector('.js-v21-header').offsetHeight + 1;
      gsap["a"].to(window, {
        duration: 0.3,
        scrollTo: offset
      });
    }
  },

  showComboTab: function showComboTab(tabId, tabGroup) {
    var tab = document.querySelector("[data-tab-id='".concat(tabId, "']"));
    var tabs = tab.closest('.js-v21-tabs');
    if (!tab || !tabs) return;
    var tabQuery = [];
    tabs.querySelectorAll(".js-v21-tabs-toggle[data-tab-group='".concat(tabGroup, "']")).forEach(function (toggle) {
      if (toggle.dataset.tabId === tabId) {
        toggle.classList.add('is-active');
      } else {
        toggle.classList.remove('is-active');
      }
    });
    tabs.querySelectorAll('.js-v21-tabs-toggle.is-active').forEach(function (toggle) {
      tabQuery.push(toggle.dataset.tabId);
    });
    tabQuery = tabQuery.sort().join(' ');
    tabs.querySelectorAll('.js-v21-tabs-content').forEach(function (item) {
      if (item.dataset.tabId.split(' ').sort().join(' ') === tabQuery) {
        item.classList.add('is-active');
      } else {
        item.classList.remove('is-active');
      }
    });
  },

  init: function init() {
    var _this = this;
    document.querySelectorAll('.js-v21-tabs').forEach(function (tabs) {
      tabs.querySelectorAll('.js-v21-tabs-toggle').forEach(function (toggle) {
        toggle.addEventListener('click', function (e) {
          e.preventDefault();
          if (toggle.dataset.tabGroup) {
            _this.showComboTab(toggle.dataset.tabId, toggle.dataset.tabGroup);
          } else {
            _this.showTab(toggle.dataset.tabId);
          }
        });
      });
      tabs.querySelectorAll('.js-v21-tabs-selector').forEach(function (selector) {
        selector.addEventListener('change', function () {
          _this.showTab(selector.value);
        });
      });
    });
  }
});

// CONCATENATED MODULE: ./src/js/controls.js

/*----------------------------------------*/
/* INPUTMASK */
/*----------------------------------------*/
inputmask_default()().mask(document.querySelectorAll('[data-inputmask]'));

/*----------------------------------------*/
/* DATEPICKER */
/*----------------------------------------*/
document.querySelectorAll('.js-v21-datepicker').forEach(function (item) {
  var picker = dist_datepicker_min_default()(item, {
    formatter: function formatter(input, date) {
      var day = "0".concat(date.getDate()).slice(-2);
      var month = "0".concat(date.getMonth() + 1).slice(-2);
      var year = "".concat(date.getFullYear());
      input.value = "".concat(day, ".").concat(month, ".").concat(year);
    },
    maxDate: new Date(),
    showAllDates: true,
    startDay: 1,
    customDays: ['ВС', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'],
    customMonths: ['ЯНВ', 'ФЕВ', 'МАР', 'АПР', 'МАЙ', 'ИЮНЬ', 'ИЮЛЬ', 'АВГ', 'СЕН', 'ОКТ', 'НОЯ', 'ДЕК'],
    customOverlayMonths: ['ЯНВ', 'ФЕВ', 'МАР', 'АПР', 'МАЙ', 'ИЮНЬ', 'ИЮЛЬ', 'АВГ', 'СЕН', 'ОКТ', 'НОЯ', 'ДЕК'],
    overlayPlaceholder: 'Год в 4-х значном формате',
    overlayButton: 'Применить'
  });
  item.addEventListener('change', function () {
    var dateArray = item.value.split('.');
    var newDate = new Date(dateArray[2], dateArray[1] - 1, dateArray[0]);
    if (!Number.isNaN(newDate.getTime()) && newDate.getTime() < new Date().getTime()) {
      picker.setDate(newDate, true);
      return;
    }
    item.value = '';
  });
});

/*----------------------------------------*/
/* CUSTOM SELECT */
/*----------------------------------------*/
document.querySelectorAll('.js-v21-select').forEach(function (item) {
  new choices_default.a(item, {
    searchEnabled: false,
    itemSelectText: '',
    shouldSort: false
  });
});

/*----------------------------------------*/
/* STRING WITH SPACES */
/*----------------------------------------*/
document.querySelectorAll('.js-v21-string-spaces').forEach(function (item) {
  item.addEventListener('input', function () {
    item.value = item.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1').replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
  });
});

/*----------------------------------------*/
/* SYNC FIELD */
/*----------------------------------------*/
document.querySelectorAll('.js-v21-sync-field').forEach(function (item) {
  item.addEventListener('change', function () {
    var syncFrom = document.querySelector("[name=\"".concat(item.dataset.syncFrom, "\"]"));
    var syncTo = document.querySelector("[name=\"".concat(item.dataset.syncTo, "\"]"));
    if (!syncFrom || !syncTo) return;
    function syncInputs() {
      syncTo.value = syncFrom.value;
    }
    if (item.checked) {
      syncInputs();
      syncTo.setAttribute('readonly', true);
      syncFrom.addEventListener('input', syncInputs);
    } else {
      syncTo.removeAttribute('readonly');
      syncFrom.removeEventListener('input', syncInputs);
    }
  });
});

// CONCATENATED MODULE: ./src/js/sliders.js

/*----------------------------------------*/
/* WELCOME */
/*----------------------------------------*/
document.querySelectorAll('.js-v21-welcome').forEach(function (item) {
  var container = item.querySelector('.js-v21-welcome-slider');
  if (!container) return;
  var current = item.querySelector('.js-v21-welcome-current');
  var total = item.querySelector('.js-v21-welcome-total');
  var progress = item.querySelector('.js-v21-welcome-progress');
  var autoplayTime = 10800;
  var updateTime = 180;
  var autoplayTimer;
  var updateTimer;
  var percentage = 0;
  var slider = Object(src_tiny_slider["a"])({
    container: container,
    navPosition: 'bottom',
    nextButton: item.querySelector('.js-v21-welcome-next'),
    prevButton: item.querySelector('.js-v21-welcome-prev'),
    mode: 'gallery',
    mouseDrag: true,
    speed: 1440,
    preventActionWhenRunning: true,
    onInit: function onInit(data) {
      if (current) current.innerHTML = "0".concat(data.displayIndex).slice(-2);
      if (total) total.innerHTML = "0".concat(data.slideCount).slice(-2);
      percentage = 0;
      updateTimer = setInterval(function () {
        percentage += updateTime / autoplayTime * 100;
        progress.style.backgroundPositionX = "-".concat(percentage, "%");
      }, updateTime);
      autoplayTimer = setTimeout(function () {
        slider.goTo('next');
      }, autoplayTime);
    }
  });
  slider.events.on('indexChanged', function (data) {
    if (current) current.innerHTML = "0".concat(data.displayIndex).slice(-2);
  });
  slider.events.on('transitionStart', function () {
    clearInterval(updateTimer);
    clearTimeout(autoplayTimer);
    percentage = 0;
    progress.style.backgroundPositionX = "-".concat(percentage, "%");
  });
  slider.events.on('transitionEnd', function () {
    updateTimer = setInterval(function () {
      percentage += updateTime / autoplayTime * 100;
      progress.style.backgroundPositionX = "-".concat(percentage, "%");
    }, updateTime);
    autoplayTimer = setTimeout(function () {
      slider.goTo('next');
    }, autoplayTime);
  });
});

/*----------------------------------------*/
/* TABS HEADER */
/*----------------------------------------*/
document.querySelectorAll('.js-v21-tabs-header').forEach(function (item) {
  var container = item.querySelector('.js-v21-tabs-header-slider');
  if (!container) return;
  var slider = Object(src_tiny_slider["a"])({
    autoWidth: true,
    container: container,
    gutter: 24,
    loop: false,
    nav: false,
    nextButton: item.querySelector('.js-v21-tabs-header-next'),
    prevButton: item.querySelector('.js-v21-tabs-header-prev'),
    mouseDrag: true,
    speed: 180,
    preventActionWhenRunning: true
  });
  item.querySelectorAll('.js-v21-tabs-header-item').forEach(function (toggle) {
    toggle.addEventListener('click', function () {
      slider.goTo(toggle.dataset.slide);
    });
  });
});

// EXTERNAL MODULE: ./src/js/misc.js
var misc = __webpack_require__(14);

// CONCATENATED MODULE: ./src/js/calc.js

/*----------------------------------------*/
/* CALC FUNCTION */
/*----------------------------------------*/
function exchangeCalcInit(element, data) {
  var type = 'buy';
  var source = 0;
  var formatFloat = wNumb_default()({
    decimals: 2,
    thousand: ' '
  });
  var formatInt = wNumb_default()({
    decimals: 0,
    thousand: ' '
  });
  var params = [{
    currency: 'RUB',
    min: 100,
    max: 100000
  }, {
    currency: 'USD',
    min: 100,
    max: 100000
  }];
  var toggles = element.querySelectorAll('[name="v21_exCalcType"]');
  var sliders = [element.querySelector('.js-v21-exchange-calc-left-slider'), element.querySelector('.js-v21-exchange-calc-right-slider')];
  var selects = [element.querySelector('[name="v21_exCalcLeftSelect"]'), element.querySelector('[name="v21_exCalcRightSelect"]')];
  var inputs = [element.querySelector('[name="v21_exCalcLeftInput"]'), element.querySelector('[name="v21_exCalcRightInput"]')];
  var swap = element.querySelector('.js-v21-exchange-calc-swap');
  var choices = [];

  function clearDecimals(value) {
    var to = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
    if (to) {
      if (value === Math.round(value)) {
        return formatInt.to(value);
      }
      return formatFloat.to(value);
    }
    if (value === Math.round(value)) {
      return formatInt.from(value);
    }
    return formatFloat.from(value);
  }

  function update() {
    source = 0;
    type = element.querySelector('input[name="v21_exCalcType"]:checked').value;
    if (selects[0].value === selects[1].value) {
      choices[0].setChoiceByValue([params[1].currency]);
      choices[1].setChoiceByValue([params[0].currency]);
    }
    params[0].currency = selects[0].value;
    params[0].min = data[selects[0].value].min;
    params[0].max = data[selects[0].value].max;
    params[1].currency = selects[1].value;
    params[1].min = data[selects[0].value].min * data[selects[0].value][type][selects[1].value].value;
    params[1].max = data[selects[0].value].max * data[selects[0].value][type][selects[1].value].value;
    sliders.forEach(function (slider, index) {
      slider.noUiSlider.updateOptions({
        range: {
          min: params[index].min,
          max: params[index].max
        }
      });
    });
    element.querySelector('.js-v21-exchange-calc-left-min').innerHTML = clearDecimals(params[0].min);
    element.querySelector('.js-v21-exchange-calc-left-max').innerHTML = clearDecimals(params[0].max);
    element.querySelector('.js-v21-exchange-calc-right-min').innerHTML = clearDecimals(params[1].min);
    element.querySelector('.js-v21-exchange-calc-right-max').innerHTML = clearDecimals(params[1].max);
    element.querySelector('.js-v21-exchange-calc-course').innerHTML = data[selects[0].value][type][selects[1].value].caption;
  }

  function convert() {
    sliders[+!source].noUiSlider.set(formatFloat.from(inputs[source].value) * data[selects[source].value][type][selects[+!source].value].value);
  }

  toggles.forEach(function (toggle) {
    toggle.addEventListener('change', function () {
      update();
      convert();
    });
  });

  sliders.forEach(function (slider, index) {
    dist_nouislider_default.a.create(slider, {
      connect: [true, false],
      range: {
        min: params[index].min,
        max: params[index].max
      },
      start: [inputs[index].value] || false,
      step: 0.01,
      format: {
        to: function to(value) {
          return clearDecimals(value, true);
        },
        from: function from(value) {
          return clearDecimals(value, false);
        }
      }
    });
    slider.noUiSlider.on('update', function (values, handle) {
      inputs[index].value = values[handle];
    });
    slider.noUiSlider.on('slide', function () {
      source = index;
      convert();
    });
  });

  selects.forEach(function (select, index) {
    choices[index] = new choices_default.a(select, {
      searchEnabled: false,
      itemSelectText: '',
      shouldSort: false
    });
    select.addEventListener('change', function () {
      update();
      convert();
    });
  });

  inputs.forEach(function (input, index) {
    input.addEventListener('change', function () {
      sliders[index].noUiSlider.set(input.value);
    });
    input.addEventListener('focus', function () {
      source = index;
      input.addEventListener('change', convert);
    });
    input.addEventListener('blur', function () {
      source = 0;
      input.removeEventListener('change', convert);
    });
  });

  swap.addEventListener('click', function () {
    choices[0].setChoiceByValue([params[1].currency]);
    choices[1].setChoiceByValue([params[0].currency]);
    update();
    convert();
  });

  update();
  convert();
}

/*----------------------------------------*/
/* CALC INIT */
/*----------------------------------------*/
var calcElement = document.querySelector('#v21_exCalc');
var calcUrl = calcElement ? calcElement.dataset.url : false;
if (calcElement) {
    exchangeCalcInit(calcElement, monetaryRate);
    calcElement.classList.add('is-active');
}

// CONCATENATED MODULE: ./src/index.js

// inits
modal.init();
dropdown.init();
js_tabs.init();

// exports
var tsb21 = {
  tns: src_tiny_slider["a"],
  inputmask: inputmask_default.a,
  datepicker: dist_datepicker_min_default.a,
  choices: choices_default.a,
  noUiSlider: dist_nouislider_default.a,
  wNumb: wNumb_default.a,
  modal: modal,
  dropdown: dropdown,
  tabs: js_tabs
};

/***/ })

/******/ })));

});
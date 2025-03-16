/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/admin/modules/bkb_cat_sort.js":
/*!*******************************************!*\
  !*** ./src/admin/modules/bkb_cat_sort.js ***!
  \*******************************************/
/***/ (() => {

jQuery(document).ready(function ($) {
  $(function () {
    function _bkb_cat_lists() {
      var output = "";
      var count = 0;
      $(".bkb_cat").find("li").each(function () {
        output += $(this).data("value") + ",";
        count++;
      });
      if (count > 0) {
        output = output.substr(0, output.length - 1);
      }
      $(".kb_cat").val("").val(output);
    }
    setTimeout(function () {
      $("span[data-vc-ui-element=button-save]").on("click", function () {
        _bkb_cat_lists();
      });
    }, 0);
    $("#sortable1, #sortable2").sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
  });
});

/***/ }),

/***/ "./src/admin/modules/bkb_counter_sort.js":
/*!***********************************************!*\
  !*** ./src/admin/modules/bkb_counter_sort.js ***!
  \***********************************************/
/***/ (() => {

jQuery(document).ready(function ($) {
  $(function () {
    function _bkb_counter_lists() {
      var output = "";
      var count = 0;
      $(".bkb_counter").find("li").each(function () {
        output += $(this).data("value") + ",";
        count++;
      });
      if (count > 0) {
        output = output.substr(0, output.length - 1);
      }
      $(".kb_counter").val("").val(output);
    }
    setTimeout(function () {
      $("span[data-vc-ui-element=button-save]").on("click", function () {
        _bkb_counter_lists();
      });
    }, 0);
    $("#sortable1").sortable().disableSelection();
  });
});

/***/ }),

/***/ "./src/admin/modules/bkb_tabs_sort.js":
/*!********************************************!*\
  !*** ./src/admin/modules/bkb_tabs_sort.js ***!
  \********************************************/
/***/ (() => {

jQuery(document).ready(function ($) {
  $(function () {
    function _bkb_tabs_lists() {
      var output = "";
      var count = 0;
      $(".bkb_tabs").find("li").each(function () {
        output += $(this).data("value") + ",";
        count++;
      });
      if (count > 0) {
        output = output.substr(0, output.length - 1);
      }
      $(".kb_tabs").val("").val(output);
    }
    setTimeout(function () {
      $("span[data-vc-ui-element=button-save]").on("click", function () {
        _bkb_tabs_lists();
      });
    }, 0);
    $("#sortable1").sortable().disableSelection();
  });
});

/***/ }),

/***/ "./src/admin/modules/bkb_tags_sort.js":
/*!********************************************!*\
  !*** ./src/admin/modules/bkb_tags_sort.js ***!
  \********************************************/
/***/ (() => {

jQuery(document).ready(function ($) {
  $(function () {
    function _bkb_tags_lists() {
      var output = "";
      var count = 0;
      $(".bkb_tags").find("li").each(function () {
        output += $(this).data("value") + ",";
        count++;
      });
      if (count > 0) {
        output = output.substr(0, output.length - 1);
      }
      $(".kb_tags").val("").val(output);
    }
    setTimeout(function () {
      $("span[data-vc-ui-element=button-save]").on("click", function () {
        _bkb_tags_lists();
      });
    }, 0);
    $("#sortable1, #sortable2").sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
  });
});

/***/ }),

/***/ "./src/admin/modules/installation_counter.js":
/*!***************************************************!*\
  !*** ./src/admin/modules/installation_counter.js ***!
  \***************************************************/
/***/ (() => {

;
(function ($) {
  function bkbm_kavc_installation_counter() {
    return $.ajax({
      type: "POST",
      url: ajaxurl,
      data: {
        action: "bwl_installation_counter",
        // this is the name of our WP AJAX function that we'll set up next
        product_id: KAFWPBAdminData.product_id // change the localization variable.
      },

      dataType: "JSON"
    });
  }
  if (typeof KAFWPBAdminData.installation != "undefined" && KAFWPBAdminData.installation != 1) {
    $.when(bkbm_kavc_installation_counter()).done(function (response_data) {
      // console.log(response_data)
    });
  }
})(jQuery);

/***/ }),

/***/ "./src/admin/styles/admin.scss":
/*!*************************************!*\
  !*** ./src/admin/styles/admin.scss ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!**********************************!*\
  !*** ./src/admin/admin_index.js ***!
  \**********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_admin_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/admin.scss */ "./src/admin/styles/admin.scss");
/* harmony import */ var _modules_installation_counter__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/installation_counter */ "./src/admin/modules/installation_counter.js");
/* harmony import */ var _modules_installation_counter__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_modules_installation_counter__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _modules_bkb_cat_sort__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/bkb_cat_sort */ "./src/admin/modules/bkb_cat_sort.js");
/* harmony import */ var _modules_bkb_cat_sort__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_modules_bkb_cat_sort__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _modules_bkb_counter_sort__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./modules/bkb_counter_sort */ "./src/admin/modules/bkb_counter_sort.js");
/* harmony import */ var _modules_bkb_counter_sort__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_modules_bkb_counter_sort__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _modules_bkb_tabs_sort__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./modules/bkb_tabs_sort */ "./src/admin/modules/bkb_tabs_sort.js");
/* harmony import */ var _modules_bkb_tabs_sort__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_modules_bkb_tabs_sort__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _modules_bkb_tags_sort__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./modules/bkb_tags_sort */ "./src/admin/modules/bkb_tags_sort.js");
/* harmony import */ var _modules_bkb_tags_sort__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_modules_bkb_tags_sort__WEBPACK_IMPORTED_MODULE_5__);
// Load Stylesheets.


// Load JavaScripts





})();

/******/ })()
;
//# sourceMappingURL=admin.js.map
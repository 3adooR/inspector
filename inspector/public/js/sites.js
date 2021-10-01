"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/sites"],{

/***/ "./resources/js/base.js":
/*!******************************!*\
  !*** ./resources/js/base.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "csrf": () => (/* binding */ csrf),
/* harmony export */   "loaderShow": () => (/* binding */ loaderShow),
/* harmony export */   "loaderHide": () => (/* binding */ loaderHide)
/* harmony export */ });
/** CSRF-token **/
var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
/** ID loader element **/

var loaderID = 'loader';
/** Add loader overlay **/

var loaderShow = function loaderShow() {
  var loader = document.createElement('div');
  loader.setAttribute('id', loaderID);
  loader.innerHTML = "<svg version=\"1.1\" id=\"L6\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 100 100\" enable-background=\"new 0 0 100 100\" xml:space=\"preserve\">\n       <rect fill=\"none\" stroke=\"#fff\" stroke-width=\"4\" x=\"25\" y=\"25\" width=\"50\" height=\"50\">\n        <animateTransform\n         attributeName=\"transform\"\n         dur=\"0.5s\"\n         from=\"0 50 50\"\n         to=\"180 50 50\"\n         type=\"rotate\"\n         id=\"strokeBox\"\n         attributeType=\"XML\"\n         begin=\"rectBox.end\"/>\n        </rect>\n        <rect x=\"27\" y=\"27\" fill=\"#fff\" width=\"46\" height=\"50\">\n        <animate\n         attributeName=\"height\"\n         dur=\"1.3s\"\n         attributeType=\"XML\"\n         from=\"50\"\n         to=\"0\"\n         id=\"rectBox\"\n         fill=\"freeze\"\n         begin=\"0s;strokeBox.end\"/>\n         </rect>\n    </svg>";
  document.body.append(loader);
};
/** Remove loader **/

var loaderHide = function loaderHide() {
  return document.getElementById(loaderID).remove();
};

/***/ }),

/***/ "./resources/js/sites.js":
/*!*******************************!*\
  !*** ./resources/js/sites.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _base__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./base */ "./resources/js/base.js");

document.querySelectorAll('.sites-item-delete').forEach(function (item) {
  item.addEventListener('click', function () {
    return (0,_base__WEBPACK_IMPORTED_MODULE_0__.loaderShow)();
  });
});

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ var __webpack_exports__ = (__webpack_exec__("./resources/js/sites.js"));
/******/ }
]);
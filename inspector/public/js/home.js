"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/home"],{

/***/ "./resources/js/auth.js":
/*!******************************!*\
  !*** ./resources/js/auth.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "auth": () => (/* binding */ auth)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _base__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./base */ "./resources/js/base.js");


function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


/**
 * Отправка запроса на бек
 * @param url
 * @param accessKey
 * @returns {Promise<any>}
 */

function authRequest(_x, _x2) {
  return _authRequest.apply(this, arguments);
}
/**
 * Авторизация по ключу
 * @param authRoute
 * @param accessKey
 */


function _authRequest() {
  _authRequest = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee(url, accessKey) {
    var response;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return fetch(url, {
              headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": _base__WEBPACK_IMPORTED_MODULE_1__.csrf
              },
              method: "post",
              credentials: "same-origin",
              body: JSON.stringify({
                key: accessKey
              })
            });

          case 2:
            response = _context.sent;
            _context.next = 5;
            return response.json();

          case 5:
            return _context.abrupt("return", _context.sent);

          case 6:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }));
  return _authRequest.apply(this, arguments);
}

var auth = function auth(authRoute, accessKey) {
  if (authRoute.length && accessKey.length === 10) {
    (0,_base__WEBPACK_IMPORTED_MODULE_1__.loaderShow)();
    authRequest(authRoute, accessKey).then(function (data) {
      if (data.success && data.redirect) {
        self.location.href = data.redirect;
      } else {
        (0,_base__WEBPACK_IMPORTED_MODULE_1__.loaderHide)();

        if (data.errors) {
          for (var _i = 0, _Object$entries = Object.entries(data.errors); _i < _Object$entries.length; _i++) {
            var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
                key = _Object$entries$_i[0],
                value = _Object$entries$_i[1];

            console.error("".concat(key, ": ").concat(value));
          }
        }
      }
    });
  } else {
    console.error('Не верный ключ доступа', accessKey);
  }
};

/***/ }),

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

/***/ "./resources/js/home.js":
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _auth__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./auth */ "./resources/js/auth.js");

var elemAccessKey = document.querySelector('#access input');
elemAccessKey.addEventListener('keypress', function (e) {
  if (e.key === 'Enter') {
    var authRoute = elemAccessKey.getAttribute('data-auth-route');
    var accessKey = elemAccessKey.value;

    if (authRoute.length && accessKey.length) {
      (0,_auth__WEBPACK_IMPORTED_MODULE_0__.auth)(authRoute, accessKey);
    }
  }
});
elemAccessKey.focus();

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["/js/vendor"], () => (__webpack_exec__("./resources/js/home.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
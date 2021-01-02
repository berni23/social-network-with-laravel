/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/home.js":
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

var postId = document.getElementById('post-id');
var body = document.querySelector('body');
var modalComment = document.getElementById('modal-comment');
var modalDelete = document.getElementById('modal-delete');
var formDelete = document.getElementById('form-delete');
document.querySelector('main').addEventListener('click', function (event) {
  var list = event.target.classList;

  if (list.contains('modal-open-comment')) {
    event.preventDefault();
    toggleModal(modalComment);
    postId.value = event.target.closest('.post').getAttribute('data-post');
  } else if (event.target.id == "comment-close") {
    event.preventDefault();
    toggleModal(modalComment);
  } else if (list.contains('post-edit-menu')) {
    event.target.querySelector('.dropdown-content').classList.toggle('block');
  } else if (list.contains('modal-open-deletePost')) {
    toggleModal(modalDelete);
    postId = event.target.closest('.post').getAttribute('data-post');
    formDelete.action = "posts/delete/".concat(postId);
  }
});

document.onkeydown = function (evt) {
  evt = evt || window.event;
  var isEscape = false;
  if ("key" in evt) isEscape = evt.key === "Escape" || evt.key === "Esc";else isEscape = evt.keyCode === 27;
  if (isEscape && document.body.classList.contains('modal-active')) toggleModal();
};

function toggleModal(modal) {
  modal.classList.toggle('opacity-0');
  modal.classList.toggle('pointer-events-none');
  body.classList.toggle('modal-active');
}

/***/ }),

/***/ 2:
/*!************************************!*\
  !*** multi ./resources/js/home.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/berni/Assembler/projects/social-network-with-laravel/resources/js/home.js */"./resources/js/home.js");


/***/ })

/******/ });
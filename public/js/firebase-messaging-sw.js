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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/firebase-messaging-sw.js":
/*!***********************************************!*\
  !*** ./resources/js/firebase-messaging-sw.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("/*\nGive the service worker access to Firebase Messaging.\nNote that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.\n*/\nimportScripts('https://www.gstatic.com/firebasejs/7.8.0/firebase-app.js');\nimportScripts('https://www.gstatic.com/firebasejs/7.8.0/firebase-messaging.js');\n/*\nInitialize the Firebase app in the service worker by passing in the messagingSenderId.\n* New configuration for app@pulseservice.com\n*/\n\nfirebase.initializeApp({\n  apiKey: \"AIzaSyDJXcfxyBvl1CGK9ArAPKkGpwu2rcNjf3I\",\n  authDomain: \"hsi-ophthalmology.firebaseapp.com\",\n  databaseURL: \"https://hsi-ophthalmology.firebaseio.com\",\n  projectId: \"hsi-ophthalmology\",\n  storageBucket: \"hsi-ophthalmology.appspot.com\",\n  messagingSenderId: \"892523160631\",\n  appId: \"1:892523160631:web:657db2ca63df242a3a8bb2\",\n  measurementId: \"G-4NXRESMTJY\"\n});\n/*\nRetrieve an instance of Firebase Messaging so that it can handle background messages.\n*/\n\nvar messaging = firebase.messaging();\nmessaging.setBackgroundMessageHandler(function (payload) {\n  console.log('[firebase-messaging-sw.js] Received background message ', payload); // Customize notification here\n\n  var notificationTitle = 'Background Message Title';\n  var notificationOptions = {\n    body: 'Background Message body.',\n    icon: '/firebase-logo.png'\n  };\n  return self.registration.showNotification(notificationTitle, notificationOptions);\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZmlyZWJhc2UtbWVzc2FnaW5nLXN3LmpzPzMzMTYiXSwibmFtZXMiOlsiaW1wb3J0U2NyaXB0cyIsImZpcmViYXNlIiwiaW5pdGlhbGl6ZUFwcCIsImFwaUtleSIsImF1dGhEb21haW4iLCJkYXRhYmFzZVVSTCIsInByb2plY3RJZCIsInN0b3JhZ2VCdWNrZXQiLCJtZXNzYWdpbmdTZW5kZXJJZCIsImFwcElkIiwibWVhc3VyZW1lbnRJZCIsIm1lc3NhZ2luZyIsInNldEJhY2tncm91bmRNZXNzYWdlSGFuZGxlciIsInBheWxvYWQiLCJjb25zb2xlIiwibG9nIiwibm90aWZpY2F0aW9uVGl0bGUiLCJub3RpZmljYXRpb25PcHRpb25zIiwiYm9keSIsImljb24iLCJzZWxmIiwicmVnaXN0cmF0aW9uIiwic2hvd05vdGlmaWNhdGlvbiJdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7QUFJQUEsYUFBYSxDQUFDLDBEQUFELENBQWI7QUFDQUEsYUFBYSxDQUFDLGdFQUFELENBQWI7QUFFQTs7Ozs7QUFJQUMsUUFBUSxDQUFDQyxhQUFULENBQXVCO0FBQ25CQyxRQUFNLEVBQUUseUNBRFc7QUFFbkJDLFlBQVUsRUFBRSxtQ0FGTztBQUduQkMsYUFBVyxFQUFFLDBDQUhNO0FBSW5CQyxXQUFTLEVBQUUsbUJBSlE7QUFLbkJDLGVBQWEsRUFBRSwrQkFMSTtBQU1uQkMsbUJBQWlCLEVBQUUsY0FOQTtBQU9uQkMsT0FBSyxFQUFFLDJDQVBZO0FBUW5CQyxlQUFhLEVBQUU7QUFSSSxDQUF2QjtBQVdBOzs7O0FBR0EsSUFBTUMsU0FBUyxHQUFHVixRQUFRLENBQUNVLFNBQVQsRUFBbEI7QUFFQUEsU0FBUyxDQUFDQywyQkFBVixDQUFzQyxVQUFTQyxPQUFULEVBQWtCO0FBQ3REQyxTQUFPLENBQUNDLEdBQVIsQ0FBWSx5REFBWixFQUF1RUYsT0FBdkUsRUFEc0QsQ0FFdEQ7O0FBQ0EsTUFBTUcsaUJBQWlCLEdBQUcsMEJBQTFCO0FBQ0EsTUFBTUMsbUJBQW1CLEdBQUc7QUFDMUJDLFFBQUksRUFBRSwwQkFEb0I7QUFFMUJDLFFBQUksRUFBRTtBQUZvQixHQUE1QjtBQUtBLFNBQU9DLElBQUksQ0FBQ0MsWUFBTCxDQUFrQkMsZ0JBQWxCLENBQW1DTixpQkFBbkMsRUFDSEMsbUJBREcsQ0FBUDtBQUVELENBWEQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvZmlyZWJhc2UtbWVzc2FnaW5nLXN3LmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiLypcbkdpdmUgdGhlIHNlcnZpY2Ugd29ya2VyIGFjY2VzcyB0byBGaXJlYmFzZSBNZXNzYWdpbmcuXG5Ob3RlIHRoYXQgeW91IGNhbiBvbmx5IHVzZSBGaXJlYmFzZSBNZXNzYWdpbmcgaGVyZSwgb3RoZXIgRmlyZWJhc2UgbGlicmFyaWVzIGFyZSBub3QgYXZhaWxhYmxlIGluIHRoZSBzZXJ2aWNlIHdvcmtlci5cbiovXG5pbXBvcnRTY3JpcHRzKCdodHRwczovL3d3dy5nc3RhdGljLmNvbS9maXJlYmFzZWpzLzcuOC4wL2ZpcmViYXNlLWFwcC5qcycpO1xuaW1wb3J0U2NyaXB0cygnaHR0cHM6Ly93d3cuZ3N0YXRpYy5jb20vZmlyZWJhc2Vqcy83LjguMC9maXJlYmFzZS1tZXNzYWdpbmcuanMnKTtcblxuLypcbkluaXRpYWxpemUgdGhlIEZpcmViYXNlIGFwcCBpbiB0aGUgc2VydmljZSB3b3JrZXIgYnkgcGFzc2luZyBpbiB0aGUgbWVzc2FnaW5nU2VuZGVySWQuXG4qIE5ldyBjb25maWd1cmF0aW9uIGZvciBhcHBAcHVsc2VzZXJ2aWNlLmNvbVxuKi9cbmZpcmViYXNlLmluaXRpYWxpemVBcHAoe1xuICAgIGFwaUtleTogXCJBSXphU3lESlhjZnh5QnZsMUNHSzlBckFQS2tHcHd1MnJjTmpmM0lcIixcbiAgICBhdXRoRG9tYWluOiBcImhzaS1vcGh0aGFsbW9sb2d5LmZpcmViYXNlYXBwLmNvbVwiLFxuICAgIGRhdGFiYXNlVVJMOiBcImh0dHBzOi8vaHNpLW9waHRoYWxtb2xvZ3kuZmlyZWJhc2Vpby5jb21cIixcbiAgICBwcm9qZWN0SWQ6IFwiaHNpLW9waHRoYWxtb2xvZ3lcIixcbiAgICBzdG9yYWdlQnVja2V0OiBcImhzaS1vcGh0aGFsbW9sb2d5LmFwcHNwb3QuY29tXCIsXG4gICAgbWVzc2FnaW5nU2VuZGVySWQ6IFwiODkyNTIzMTYwNjMxXCIsXG4gICAgYXBwSWQ6IFwiMTo4OTI1MjMxNjA2MzE6d2ViOjY1N2RiMmNhNjNkZjI0MmEzYThiYjJcIixcbiAgICBtZWFzdXJlbWVudElkOiBcIkctNE5YUkVTTVRKWVwiXG59KTtcblxuLypcblJldHJpZXZlIGFuIGluc3RhbmNlIG9mIEZpcmViYXNlIE1lc3NhZ2luZyBzbyB0aGF0IGl0IGNhbiBoYW5kbGUgYmFja2dyb3VuZCBtZXNzYWdlcy5cbiovXG5jb25zdCBtZXNzYWdpbmcgPSBmaXJlYmFzZS5tZXNzYWdpbmcoKTtcblxubWVzc2FnaW5nLnNldEJhY2tncm91bmRNZXNzYWdlSGFuZGxlcihmdW5jdGlvbihwYXlsb2FkKSB7XG4gIGNvbnNvbGUubG9nKCdbZmlyZWJhc2UtbWVzc2FnaW5nLXN3LmpzXSBSZWNlaXZlZCBiYWNrZ3JvdW5kIG1lc3NhZ2UgJywgcGF5bG9hZCk7XG4gIC8vIEN1c3RvbWl6ZSBub3RpZmljYXRpb24gaGVyZVxuICBjb25zdCBub3RpZmljYXRpb25UaXRsZSA9ICdCYWNrZ3JvdW5kIE1lc3NhZ2UgVGl0bGUnO1xuICBjb25zdCBub3RpZmljYXRpb25PcHRpb25zID0ge1xuICAgIGJvZHk6ICdCYWNrZ3JvdW5kIE1lc3NhZ2UgYm9keS4nLFxuICAgIGljb246ICcvZmlyZWJhc2UtbG9nby5wbmcnXG4gIH07XG5cbiAgcmV0dXJuIHNlbGYucmVnaXN0cmF0aW9uLnNob3dOb3RpZmljYXRpb24obm90aWZpY2F0aW9uVGl0bGUsXG4gICAgICBub3RpZmljYXRpb25PcHRpb25zKTtcbn0pOyAiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/firebase-messaging-sw.js\n");

/***/ }),

/***/ 1:
/*!*****************************************************!*\
  !*** multi ./resources/js/firebase-messaging-sw.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/admin/HSI/restful/resources/js/firebase-messaging-sw.js */"./resources/js/firebase-messaging-sw.js");


/***/ })

/******/ });
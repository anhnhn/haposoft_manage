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

/***/ "./resources/js/admin/js/admin-project-user.js":
/*!*****************************************************!*\
  !*** ./resources/js/admin/js/admin-project-user.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var baseUrl = window.location.origin;
  $('#projectId').on('change', function () {
    $('#tableAssign tbody').empty();
    $('#userId').empty();
    $('#paginate').empty();
    var projectId = $('#projectId').val();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "GET",
      url: baseUrl + '/haposoft_manage/public/admin/ajax/getProjectById/' + projectId,
      success: function success(data) {
        var htmlTable = '';
        var htmlSelect = '';
        var project = data.project;
        var users = data.project.users;
        var usersDeduplicate = deduplicate(users);
        $.each(users, function (i, user) {
          htmlTable += "<tr>\n                        <td>".concat(project.name, "</td>\n                        <td class=\"start-date-user\" >").concat(user.pivot.start_date, "</td>\n                        <td class=\"end-date-user\" >").concat(user.pivot.end_date, "</td>\n                        <td>").concat(user.name, "</td>\n                        <td class=\"d-flex\">\n                            <button class=\"fa fa-edit btn-warning btn update-user\" role=\"button\" type=\"submit\" title=\"Edit\" value=\"").concat(user.id, "\"></button>\n                            <button class=\"fa fa-remove btn-danger btn delete-user\" role=\"button\" type=\"submit\" title=\"Delete\" value=\"").concat(user.id, "\"></button>\n                        </td>\n                        </tr>");
        });
        $.each(usersDeduplicate, function (i, user) {
          htmlSelect += "<option value=\"".concat(user.id, "\">").concat(user.name, "</option>");
        });
        $('#tableAssign').append(htmlTable);
        $('#userId').append(htmlSelect);
      },
      error: function error(e) {}
    });
  });
  $('#tableAssign tbody').on('click', '.delete-user', function () {
    if (confirm("Delete User?")) {
      var projectId = $('#projectId').val();
      var userId = $(this).attr('value');
      var startDate = $(this).closest('tr').find('.start-date-user').text();
      var endtDate = $(this).closest('tr').find('.end-date-user').text();
      var node = this;
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'DELETE',
        url: baseUrl + '/haposoft_manage/public/admin/ajax/destroyUser/' + userId + '+' + projectId + '+' + startDate + '+' + endtDate,
        success: function success(data) {
          $(node).closest("tr").remove();

          if ($('#departmentId').val(-1)) {
            $('#user_id option[value=' + userId + ']').remove();
          }
        },
        error: function error(e) {}
      });
    }
  });
  $('#tableAssign tbody').on('click', '.update-user', function () {
    var projectId = $('#projectId').val();
    var userId = $(this).attr('value');
    var startDate = $(this).closest('tr').find('.start-date-user').text();
    var endtDate = $(this).closest('tr').find('.end-date-user').text();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'GET',
      url: baseUrl + '/haposoft_manage/public/admin/ajax/editUser/' + userId + '+' + projectId + '+' + startDate + '+' + endtDate,
      success: function success(data) {
        window.location.href = data.url;
      },
      error: function error(e) {}
    });
  });
  $('#departmentId').on('change', function () {
    $('#userId').empty();
    $('#paginate').empty();
    var departmentId = $('#departmentId').val();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "GET",
      url: baseUrl + '/haposoft_manage/public/admin/ajax/getUserById/' + departmentId,
      success: function success(data) {
        var htmlSelect = '';
        var users = data.department.users;
        $.each(users, function (i, user) {
          htmlSelect += "<option value=\"".concat(user.id, "\">").concat(user.name, "</option>");
        });
        $('#userId').append(htmlSelect);
      },
      error: function error(e) {}
    });
  });
  $('#assign').on('click', function (e) {
    e.preventDefault();
    var formData = new FormData($('form#formAddUser')[0]);
    var projectId = $('#projectId').val();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: $('#formAddUser').attr('action'),
      processData: false,
      contentType: false,
      data: formData,
      success: function success(data) {
        if (data.projects != null) {
          $('#showMessage').empty();
          $('#userId').empty();
          $('#departmentId').val(-1);
          var htmlTable = '';
          var htmlSelect = '';
          var htmlMessage = '';
          var project = data.projects;
          var users = data.projects.users;
          var user = users[users.length - 1];
          var usersDeduplicate = deduplicate(users);
          var message = data.message;
          htmlTable += "<tr>\n                        <td>".concat(project.name, "</td>\n                        <td class=\"start-date-user\">").concat(user.pivot.start_date, "</td>\n                        <td class=\"end-date-user\">").concat(user.pivot.end_date, "</td>\n                        <td>").concat(user.name, "</td>\n                        <td class=\"d-flex\">\n                            <button class=\"fa fa-edit btn-warning btn update-user\" role=\"button\" type=\"submit\" title=\"Update\" value=\"").concat(user.id, "\"></button>\n                            <button class=\"fa fa-remove btn-danger btn delete-user\" role=\"button\" type=\"submit\" title=\"Delete\" value=\"").concat(user.id, "\"></button>\n                        </td>\n                        </tr>");
          $.each(usersDeduplicate, function (i, user) {
            htmlSelect += "<option value=\"".concat(user.id, "\">").concat(user.name, "</option>");
          });
          htmlMessage += "<h4 class=\"alert alert-success\">".concat(message, "<h4>");
          $('#showMessage').append(htmlMessage);
          $('#tableAssign').append(htmlTable);
          $('#userId').append(htmlSelect);
          $('.alert-success').fadeIn().delay(2000).fadeOut();
        } else {
          $('.alert-danger').remove();
          var htmlError = '';
          htmlError += "<h4 class=\"alert alert-danger\">".concat(data.message, "</h4>");
          $('#showMessage').append(htmlError);
          $('.alert-danger').fadeIn().delay(2000).fadeOut();
        }
      },
      error: function error(data) {
        if (data.status === 422) {
          $('.form-control').removeClass('is-invalid');
          $('.alert-danger').remove();
          var errors = data.responseJSON.errors;
          var keys_errors = Object.keys(errors);

          for (var i = 0; i < keys_errors.length; i++) {
            var element = $('[name="' + keys_errors[i] + '"]');
            element.addClass('is-invalid');
            element.after("<div class=\"alert alert-danger\">".concat(errors[keys_errors[i]][0], "</div>"));
          }

          $('.alert-danger').fadeIn().delay(3000).fadeOut();
        }

        if (data.status === 404) {
          $('#projectId').removeClass('is-invalid');
          $('#userId').removeClass('is-invalid');
          $('.alert-danger').remove();
          $('#projectId').addClass('is-invalid');
          $('#projectId').after("<div class=\"alert alert-danger\">Please chose Project</div>");
          $('#userId').addClass('is-invalid');
          $('#userId').after("<div class=\"alert alert-danger\">Please chose User</div>");
          $('.alert-danger').fadeIn().delay(5000).fadeOut();
        }
      }
    });
  });

  function deduplicate(users) {
    var isExist = function isExist(users, user) {
      for (var i = 0; i < users.length; i++) {
        if (users[i].id === user.id) return true;
      }

      return false;
    };

    var usersDeduplicate = [];
    users.forEach(function (element) {
      if (!isExist(usersDeduplicate, element)) {
        usersDeduplicate.push(element);
      }
    });
    return usersDeduplicate;
  }

  $("select").each(function () {
    $(this).val($(this).find('option[selected]').val());
  });
});

/***/ }),

/***/ 1:
/*!***********************************************************!*\
  !*** multi ./resources/js/admin/js/admin-project-user.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\haposoft_manage\resources\js\admin\js\admin-project-user.js */"./resources/js/admin/js/admin-project-user.js");


/***/ })

/******/ });
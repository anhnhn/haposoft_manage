$(document).ready(function () {

    var baseUrl = window.location.origin;

    $('#projectId').on('change', function () {
        $('#tableAssign tbody').empty();
        $('#userId').empty();
        $('#paginate').empty();
        var projectId = $('#projectId').val();
        $.ajax({
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "GET",
            url: baseUrl + '/haposoft_manage/public/admin/ajax/getProjectById/' + projectId,
            success: function (data) {
                var htmlTable = '';
                var htmlSelect = '';
                var project = data.project;
                var users = data.project.users;
                let usersDeduplicate = deduplicate(users);

                $.each(users, function (i, user) {
                    htmlTable += `<tr>
                        <td>${project.name}</td>
                        <td class="start-date-user" >${user.pivot.start_date}</td>
                        <td class="end-date-user" >${user.pivot.end_date}</td>
                        <td>${user.name}</td>
                        <td class="d-flex">
                            <button class="fa fa-edit btn-warning btn update-user" role="button" type="submit" title="Edit" value="${user.id}"></button>
                            <button class="fa fa-remove btn-danger btn delete-user" role="button" type="submit" title="Delete" value="${user.id}"></button>
                        </td>
                        </tr>`;
                });
                $.each(usersDeduplicate, function (i, user) {
                    htmlSelect += `<option value="${user.id}">${user.name}</option>`;
                });
                $('#tableAssign').append(htmlTable);
                $('#userId').append(htmlSelect);
            },
            error: function (e) {
            }
        });
    });

    $('#tableAssign tbody').on('click', '.delete-user', function () {
        if (confirm("Delete User?")) {
            var projectId = $('#projectId').val();
            var userId = $(this).attr('value');
            let startDate = $(this).closest('tr').find('.start-date-user').text();
            let endtDate = $(this).closest('tr').find('.end-date-user').text();
            var node = this;
            $.ajax({
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'DELETE',
                url: baseUrl + '/haposoft_manage/public/admin/ajax/destroyUser/' + userId + '+' + projectId + '+' + startDate + '+' + endtDate,
                success: function (data) {
                    $(node).closest("tr").remove();
                    if($('#departmentId').val(-1)) {
                        $('#user_id option[value=' + userId + ']').remove();
                    }
                },
                error: function (e) {

                }
            });
        }
    });

    $('#tableAssign tbody').on('click', '.update-user', function () {
            var projectId = $('#projectId').val();
            var userId = $(this).attr('value');
            let startDate = $(this).closest('tr').find('.start-date-user').text();
            let endtDate = $(this).closest('tr').find('.end-date-user').text();
            $.ajax({
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'GET',
                url: baseUrl + '/haposoft_manage/public/admin/ajax/editUser/' + userId + '+' + projectId + '+' + startDate + '+' + endtDate,
                success: function (data) {
                    window.location.href = data.url;
                },
                error: function (e) {
                }
            });
    });

    $('#departmentId').on('change', function () {
        $('#userId').empty();
        $('#paginate').empty();
        var departmentId = $('#departmentId').val();
        $.ajax({
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "GET",
            url: baseUrl + '/haposoft_manage/public/admin/ajax/getUserById/' + departmentId,
            success: function (data) {
                var htmlSelect = '';
                var users = data.department.users;
                $.each(users, function (i, user) {
                    htmlSelect += `<option value="${user.id}">${user.name}</option>`;
                });
                $('#userId').append(htmlSelect);
            },
            error: function (e) {
            }
        });
    });

    $('#assign').on('click', function (e) {
        e.preventDefault();
        var formData = new FormData($('form#formAddUser')[0]);
        var projectId = $('#projectId').val();
        $.ajax({
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "POST",
            url: $('#formAddUser').attr('action') ,
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {
                if(data.projects != null) {
                    $('#userId').empty();
                    $('#departmentId').val(-1);
                    var htmlTable = '';
                    var htmlSelect = '';
                    var project = data.projects;
                    var users = data.projects.users;
                    var user = users[users.length-1];
                    var usersDeduplicate = deduplicate(users);
                    var message = data.message;
                    alert (message);
                    htmlTable += `<tr>
                        <td>${project.name}</td>
                        <td class="start-date-user">${user.pivot.start_date}</td>
                        <td class="end-date-user">${user.pivot.end_date}</td>
                        <td>${user.name}</td>
                        <td class="d-flex">
                            <button class="fa fa-edit btn-warning btn update-user" role="button" type="submit" title="Update" value="${user.id}"></button>
                            <button class="fa fa-remove btn-danger btn delete-user" role="button" type="submit" title="Delete" value="${user.id}"></button>
                        </td>
                        </tr>`;
                    $.each(usersDeduplicate, function (i, user) {
                        htmlSelect += `<option value="${user.id}">${user.name}</option>`;
                    });
                    $('#tableAssign').append(htmlTable);
                    $('#userId').append(htmlSelect);
                }
                else {
                    $('.alert-danger').remove();
                    var htmlError = '';
                    htmlError += `<h4 class="alert alert-danger">${data.message}</h4>`;
                    $('#showMessage').append(htmlError);
                    $('.alert-danger').fadeIn().delay(5000).fadeOut();
                }

            },
            error: function (data) {
                if (data.status === 422) {
                    $('.form-control').removeClass('is-invalid');
                    $('.alert-danger').remove();
                    let errors = data.responseJSON.errors;
                    let keys_errors = Object.keys(errors);
                    for (let i = 0; i < keys_errors.length; i++) {
                        let element = $('[name="' + keys_errors[i] + '"]');
                        element.addClass('is-invalid');
                        element.after(`<div class="alert alert-danger">${errors[keys_errors[i]][0]}</div>`);
                    }
                    $('.alert-danger').fadeIn().delay(3000).fadeOut();
                }
                if (data.status === 404) {
                    $('#projectId').removeClass('is-invalid');
                    $('#userId').removeClass('is-invalid');
                    $('.alert-danger').remove();
                    $('#projectId').addClass('is-invalid');
                    $('#projectId').after(`<div class="alert alert-danger">Please chose Project</div>`);
                    $('#userId').addClass('is-invalid');
                    $('#userId').after(`<div class="alert alert-danger">Please chose User</div>`);
                    $('.alert-danger').fadeIn().delay(5000).fadeOut();
                }
            }
        });
    });

    function deduplicate(users) {
        let isExist = (users, user) => {
            for(let i = 0; i < users.length; i++) {
                if (users[i].id === user.id) return true;
            }
            return false;
        };
        let usersDeduplicate = [];
        users.forEach(element => {
            if(!isExist(usersDeduplicate, element)) usersDeduplicate.push(element);
        });
        return usersDeduplicate;
    }
});

$(document).ready(function () {

    let baseUrl = window.location.origin;

    $('#projectId').on('change', function () {
        $('#tableAssign tbody').empty();
        $('#userId').empty();
        $('#paginate').empty();
        let projectId = $('#projectId').val();
        $.ajax({
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "GET",
            url: baseUrl + '/haposoft_manage/public/admin/ajax/getProjectById/' + projectId,
            success: function (data) {
                let htmlTable = '';
                let htmlSelect = '';
                let project = data.project;
                let users = data.project.users;
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
            let projectId = $('#projectId').val();
            let userId = $(this).attr('value');
            let startDate = $(this).closest('tr').find('.start-date-user').text();
            let endtDate = $(this).closest('tr').find('.end-date-user').text();
            let node = this;
            $.ajax({
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'DELETE',
                url: baseUrl + '/haposoft_manage/public/admin/ajax/destroyUser/' + userId + '+' + projectId + '+' + startDate + '+' + endtDate,
                success: function (data) {
                    $(node).closest("tr").remove();
                    if ($('#departmentId').val(-1)) {
                        $('#user_id option[value=' + userId + ']').remove();
                    }
                },
                error: function (e) {

                }
            });
        }
    });

    $('#tableAssign tbody').on('click', '.update-user', function () {
        let projectId = $('#projectId').val();
        let userId = $(this).attr('value');
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
        let departmentId = $('#departmentId').val();
        $.ajax({
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "GET",
            url: baseUrl + '/haposoft_manage/public/admin/ajax/getUserById/' + departmentId,
            success: function (data) {
                let htmlSelect = '';
                let users = data.department.users;
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
        let formData = new FormData($('form#formAddUser')[0]);
        let projectId = $('#projectId').val();
        $.ajax({
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "POST",
            url: $('#formAddUser').attr('action'),
            processData: false,
            contentType: false,
            data: formData,
            success: function (data) {
                if (data.projects != null) {
                    $('#showMessage').empty();
                    $('#userId').empty();
                    $('#departmentId').val(-1);
                    let htmlTable = '';
                    let htmlSelect = '';
                    let htmlMessage = '';
                    let project = data.projects;
                    let users = data.projects.users;
                    let user = users[users.length - 1];
                    let usersDeduplicate = deduplicate(users);
                    let message = data.message;
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
                    htmlMessage += `<h4 class="alert alert-success">${message}<h4>`;
                    $('#showMessage').append(htmlMessage);
                    $('#tableAssign').append(htmlTable);
                    $('#userId').append(htmlSelect);
                    $('.alert-success').fadeIn().delay(2000).fadeOut();
                } else {
                    $('.alert-danger').remove();
                    let htmlError = '';
                    htmlError += `<h4 class="alert alert-danger">${data.message}</h4>`;
                    $('#showMessage').append(htmlError);
                    $('.alert-danger').fadeIn().delay(2000).fadeOut();
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
            for (let i = 0; i < users.length; i++) {

                if (users[i].id === user.id) return true;
            }
            return false;
        };
        let usersDeduplicate = [];
        users.forEach(element => {
            if (!isExist(usersDeduplicate, element))
            {
                usersDeduplicate.push(element);
            }
        });
        return usersDeduplicate;
    }

    $("select").each(function () {
        $(this).val($(this).find('option[selected]').val());
    });
});

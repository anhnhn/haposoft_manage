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
                $.each(users, function (i, user) {
                    htmlTable += `<tr>
                        <td>${project.name}</td>
                        <td>${user.pivot.start_date}</td>
                        <td>${user.pivot.end_date}</td>
                        <td>${user.name}</td>
                        <td class="d-flex">
                            <button class="fa fa-edit btn-warning btn update-user" role="button" type="submit" title="Edit" value="${user.id}"></button>
                            <button class="fa fa-remove btn-danger btn deleteUser" role="button" type="submit" title="Delete" value="${user.id}"></button>
                        </td>
                        </tr>`;
                    htmlSelect += `<option value="${user.id}">${user.name}</option>`;
                });

                $('#tableAssign').append(htmlTable);
                $('#userId').append(htmlSelect);
            },
            error: function (e) {
            }
        });
    });

    $('#tableAssign tbody').on('click', '.deleteUser', function () {
        if (confirm("Delete User?")) {
            var projectId = $('#projectId').val();
            var userId = $(this).attr('value');
            var node = this;
            $.ajax({
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'DELETE',
                url: baseUrl + '/haposoft_manage/public/admin/ajax/destroyUser/' + userId + '+' + projectId,
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
            console.log(userId);
            $.ajax({
                headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'GET',
                url: baseUrl + '/haposoft_manage/public/admin/ajax/editUser/' + userId + '+' + projectId,
                success: function (data) {

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
                console.log(data);
                $('#userId').empty();
                $('#departmentId').val(-1);
                var htmlTable = '';
                var htmlSelect = '';
                var project = data.projects;
                var users = data.projects.users;
                var user = users[users.length-1];
                    htmlTable += `<tr>
                        <td>${project.name}</td>
                        <td>${user.pivot.start_date}
                        </td>
                        <td>${user.pivot.end_date}</td>
                        <td>${user.name}</td>
                        <td class="d-flex">
                            <button class="fa fa-edit btn-warning btn" role="button" type="submit" title="Update" value="${user.id}"></button>
                            <button class="fa fa-remove btn-danger btn deteUser" role="button" type="submit" title="Delete" value="${user.id}"></button>
                            
                        </td>
                        </tr>`;
                $.each(users, function (i, user) {
                    htmlSelect += `<option value="${user.id}">${user.name}</option>`;
                });
                $('#tableAssign').append(htmlTable);
                $('#userId').append(htmlSelect);
            },
            error: function (e) {
            }
        });
    });
});

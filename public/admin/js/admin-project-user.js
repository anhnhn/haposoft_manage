$(document).ready(function () {

    var baseUrl = window.location.origin;

    $('#project_id').on('change', function () {
        $('#tableAssign tbody').empty();
        $('#user_id').empty();
        $('#paginate').empty();
        var projectId = $('#project_id').val();
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
                        <td>${user.pivot.start_date}(u)</td>
                        <td>${user.pivot.end_date}(u)</td>
                        <td>${user.name}</td>
                        <td class="d-flex">
                            <a href="" class="fa fa-search btn btn-info" role="button" title="Show"></a>
                            <button class="fa fa-edit btn-warning btn" role="button" type="submit" title="Edit" value="${user.id}"></button>
                            <button class="fa fa-remove btn-danger btn deleteUser" role="button" type="submit" title="Delete" value="${user.id}"></button>
                        </td>
                        </tr>`;
                    htmlSelect += `<option value="${user.id}">${user.name}</option>`;
                });

                $('#tableAssign').append(htmlTable);
                $('#user_id').append(htmlSelect);
            },
            error: function (e) {
            }
        });
    });

    $('#tableAssign tbody').on('click', '.deleteUser', function () {
        if (confirm("Delete User?")) {
            var projectId = $('#project_id').val();
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
                    if($('#department_id').val(-1)) {
                        $('#user_id option[value=' + userId + ']').remove();
                    }
                },
                error: function (e) {
                }
            });
        }
    });

    $('#department_id').on('change', function () {
        $('#user_id').empty();
        $('#paginate').empty();
        var departmentId = $('#department_id').val();
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
                $('#user_id').append(htmlSelect);
            },
            error: function (e) {
            }
        });
    });

    $('#addUser').on('click', function (e) {
        e.preventDefault();
        var formData = new FormData($('form#formAddUser')[0]);
        var projectId = $('#project_id').val();

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
                $('#user_id').empty();
                $('#department_id').val(-1);
                var htmlTable = '';
                var htmlSelect = '';
                var project = data.projects;
                var users = data.projects.users;
                var user = users[users.length-1];
                    htmlTable += `<tr>
                        <td>${project.name}</td>
                        <td>${user.pivot.start_date}(u)</td>
                        <td>${user.pivot.end_date}(u)</td>
                        <td>${user.name}</td>
                        <td class="d-flex">
                            <a href="" class="fa fa-search btn btn-info" role="button" title="Show"></a>
                            <a href="" class="fa fa-edit btn-warning btn" role="button" title="Edit"></a>
                            <button class="fa fa-remove btn-danger btn deleteUser" role="button" type="submit" title="Delete" value="${user.id}"></button>
                        </td>
                        </tr>`;
                $.each(users, function (i, user) {
                    htmlSelect += `<option value="${user.id}">${user.name}</option>`;
                });
                $('#tableAssign').append(htmlTable);
                $('#user_id').append(htmlSelect);
            },
            error: function (e) {
            }
        });
    });
});

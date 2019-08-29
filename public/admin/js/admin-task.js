$(document).ready(function () {
    var baseUrl = window.location.origin;

    $('#projectId').on('change', function () {
        $('#userId').empty();
        var projectId = $('#projectId').val();
        $.ajax({
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "GET",
            url: baseUrl + '/haposoft_manage/public/admin/ajax/getUserByProjectId/' + projectId,
            success: function (data) {
                var htmlSelect = '';
                var users = data.project.users;
                $.each(users, function (i, user) {
                    htmlSelect += `<option value="${user.id}">${user.name}</option>`;
                });
                $('#userId').append(htmlSelect);
            },
            error: function (e) {
            }
        });
    });
});
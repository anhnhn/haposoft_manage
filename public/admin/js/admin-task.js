$(document).ready(function () {
    let baseUrl = window.location.origin;

    $('#taskProjectId').on('change', function () {
        $('#userId').empty();
        let projectId = $('#taskProjectId').val();
        $.ajax({
            headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: "GET",
            url: baseUrl + '/haposoft_manage/public/admin/ajax/getUserByProjectId/' + projectId,
            success: function (data) {
                let htmldefault = '<option value="" selected>No User</option>';
                let htmlSelect = '';
                let users = data.project.users;
                let usersDeduplicate = deduplicate(users);
                console.log(usersDeduplicate);
                $.each(usersDeduplicate, function (i, user) {
                    htmlSelect += `<option value="${user.id}">${user.name}</option>`;
                });
                $('#userId').append(htmldefault);
                $('#userId').append(htmlSelect);
            },
            error: function (e) {
            }
        });
    });

    function deduplicate(users) {
        let isExist = (users, user) => {
            for (let i = 0; i < users.length; i++) {
                if (users[i].user_id === user.user_id) return true;
            }
            return false;
        };
        let usersDeduplicate = [];
        users.forEach(element => {
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
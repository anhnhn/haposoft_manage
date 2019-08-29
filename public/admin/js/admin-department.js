$(document).ready(function () {
    // var baseUrl = window.location.origin;
    //
    // $('#tableDepartment tbody').on('click', '.edit-department', function () {
    //     var departmentId = $(this).attr('value');
    //     $.ajax({
    //         headers:
    //             {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //         type: 'GET',
    //         url: baseUrl + '/haposoft_manage/public/admin/departments/' + departmentId + '/edit',
    //         success: function (data) {
    //             var department = data.department;
    //             var test = '{{ route( "departments.update", ":departmentId") }}';
    //             test = test.replace(':departmentId', department.id);
    //             var csrf = '{{ csrf_field() }}';
    //             $("#departmentName_" + departmentId).empty();
    //             var htmltd = `     <input type="text" id="inputNameDepartment" value="${department.name}">
    //                               <button class="btn-primary btn save-department" role="button" title="save" value ="${department.id}">save</button>
    //                           `
    //             $("#departmentName_" + departmentId).append(htmltd);
    //         },
    //     });
    // });
    // $('#tableDepartment tbody').on('click', '.save-department', function (e) {
    //     e.preventDefault();
    //     var formData = new FormData($('form#formDepartment')[0]);
    //     var departmentId = $(this).attr('value');
    //     $.ajax({
    //         headers:
    //             {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //         type: "PUT",
    //         url: $('#formDepartment').attr('action') ,
    //         processData: false,
    //         contentType: false,
    //         data: formData,
    //         success: function (data) {
    //             console.log(data);
    //         },
    //     });
    // });
});
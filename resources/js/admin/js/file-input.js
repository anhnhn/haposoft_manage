$(document).ready(function () {
    let baseUrl = window.location.origin;

    $('.alert-success').fadeIn().delay(1000).fadeOut();
    $('.alert-danger').fadeIn().delay(5000).fadeOut();
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#image').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatar").change(function() {
        readURL(this);
    });

    $('.btn-delete').on('click', function () {
        let name = $('.btn-delete').data('name');
        let r = confirm(`Do you want delete ${name} ?`);
        if (r === true) {
           $(this).parent().submit();
        }
    });
});
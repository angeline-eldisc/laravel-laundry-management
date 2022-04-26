$(document).ready(function() {
    $('#select2_type').select2({
        placeholder: "-- Select Laundry Type --"
    });
});

$(document).ready(function() {
    $('#select2_member_id').select2({
        placeholder: "-- Select Member --"
    });
});

$(document).ready(function() {
    $('#select2_package_id').select2({
        placeholder: "-- Select Package --"
    });
});

$(document).ready(function() {
    $('#select2_paid_status').select2({
        placeholder: "-- Select Payment --"
    });
});

function readURL() {
    var input = this;
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(input).prev().attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(function () {
    $(".uploads").change(readURL)
    $("#f").submit(function(){
        return false
    })
})

$(document).ready(function(e) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $("#img_profile").change(function() {
        let reader = new FileReader();
        reader.onload = e => {
            $(".imgProfile").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });
});

///////////////// Llamado de funciones en el Home /////////////////
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches(".dropbtn")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
            }
        }
    }
};
$(".imgProfile").click(function() {
    $("#img_profile").click();
});
$(".mostrarFormulario").click(function(){
$(".formularioOpinion").removeClass('d-none');
$(".mostrarFormulario").addClass('d-none');
});
$(".close-modal").click(function(){
$(".formularioOpinion").addClass('d-none');
$(".mostrarFormulario").removeClass('d-none');
});
    $(document).ready(function() {
      $('.thumbs').lightGallery({
        download: false,
        thumbnail: true,
        exThumbImage: 'data-exthumbimage',
        counter: false
    });
    });
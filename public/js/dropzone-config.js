var CSRF_TOKEN = document.querySelector('input[name="_token"]').getAttribute("value");  
Dropzone.autoDiscover = false;
var place_id = document.getElementById('place_id').getAttribute("value");
var myDropzone = new Dropzone("div#mydropzone", { 
  url: route('places.addimage', {place_id: place_id} ),
  headers: {
  'x-csrf-token': CSRF_TOKEN,
},
maxFilesize: 5,
uploadMultiple: true,
parallelUploads: 15,
maxFiles: 15,
acceptedFiles: ".png,.jpg,.jpeg",
addRemoveLinks: true,
autoProcessQueue: false,

  removedfile: function(file) {
  var name = file.name; 
    if (name) {
      $.ajax({
        type: 'GET',
        url: "/images/remove/"+name,
        dataType: 'json'
      });
    }
    var _ref;
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  },

  
  init: function() {
    var submitButton = document.querySelector("#submit-all");
      useDropzone = this;
      submitButton.addEventListener("click", function(e) {
      useDropzone.processQueue();
  });
  this.on("sending", function(file, xhr, formData) {
    var Submit = false;
    $('form').submit(function(e){
      if(!Submit){
      e.preventDefault();
    }      
    });
    var x = document.getElementsByClassName("ImageActive");
    if(x.length == '1'){
    var name = x[0].id;
    formData.append("activeImage", name);
    }
  });
  this.on("success", function(){
    Submit = true;
    $('form').submit();
    window.location.href = route('places.index');
  });
  this.on("addedfile", function(file) {
    $(file.previewElement).attr("id", file.name);
          file.previewElement.addEventListener("click", function() {
            var x = document.getElementsByClassName("ImageActive");
            if(x.length == '0'){
            file.previewElement.className += " ImageActive";
            }
            if(x.length == '1'){
            x[0].classList.remove("ImageActive");
            file.previewElement.className += " ImageActive";
            }
          });
  });


}
});
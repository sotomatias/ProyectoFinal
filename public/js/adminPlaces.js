$(document).ready(function(e) {
    $(".accordion-toggle").click(function() {
        if ($(this).attr("aria-expanded") == "true") {
            $(this)
                .children()
                .css("background-color", "#FFF");
        } else {
            $(this)
                .children()
                .css("background-color", "#DDD");
        }
    });
    var CSRF_TOKEN = document
        .querySelector('input[name="_token"]')
        .getAttribute("value");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN
        }
    });
    $(document).on("click", "a.jquery-postback", function(e) {
        e.preventDefault();

        var $this = $(this);

        $.post({
            type: $this.data("method"),
            url: $this.attr("href")
        }).done(function() {
            if ($this.data("method") == "patch") {
                var ID = $this.data("imgid");
                var x = document.getElementsByClassName("ImageActive");
                var IDElement = document.getElementById(ID);
                if (x.length == "0") {
                    IDElement.className += " ImageActive";
                }
                if (x.length == "1") {
                    x[0].classList.remove("ImageActive");
                    IDElement.className += " ImageActive";
                }
            }
            if ($this.data("method") == "delete") {
                var ID = $this.data("imgid");
                var IDElement = document.getElementById(ID);
                IDElement.remove();
                var IDElement = document.getElementsByClassName(ID);
                $("." + ID).remove();
            }
        });
    });
});

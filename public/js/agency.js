(function($) {
    "use strict"; // Start of use strict

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
        if (
            location.pathname.replace(/^\//, "") ==
                this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate(
                    {
                        scrollTop: target.offset().top - 54
                    },
                    1000,
                    "easeInOutExpo"
                );
                return false;
            }
        }
    });
    // Closes responsive menu when a scroll trigger link is clicked

    $(".js-scroll-trigger").click(function() {
        $(".navbar-collapse").collapse("hide");
    });
    $("body").click(function() {
        $(".navbar-collapse").collapse("hide");
    });
    $(".js-scroll-trigger").click(function() {
        $("#navbarResponsive").removeClass("show");
    });
    // Activate scrollspy to add active class to navbar items on scroll
    var host = "http://proyectofinal.laravel.test/";
    if (host == window.location.href) {
        $("body").scrollspy({
            target: "#mainNav",
            offset: 56
        });
    }
    // Collapse Navbar
    var navbarCollapse = function() {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);
})(jQuery); // End of use strict
function toggleMenu() {
    var navbarResponsive = document.getElementById("navbarResponsive");
    if ($("#navbarResponsive").hasClass("show")) {
        $("#navbarResponsive").css("display", "none");
        $("#navbarResponsive").removeClass("show");
    }
}

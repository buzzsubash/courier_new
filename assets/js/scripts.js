$(function() {

	toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "rtl": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    // scroll to top
    $(document).scroll(function(){
        if($(this).scrollTop() > 150)
            $('.scrolltoTop').addClass("show");
        else
            $('.scrolltoTop').removeClass("show");
    });

    $('.scrolltoTop').on("click", function(){
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });
});
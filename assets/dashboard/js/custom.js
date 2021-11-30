$(function() {
    "use strict";

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



//=======>>> Dashboard Functions

    var $toast;

    $('#featureFile').on('click', function(e){
        var el = $('.filetype-menu');
        $('#cstm-search').val("");
        $('.cstm-list li').removeClass("hide");
        $('.filetype-list').animate({ scrollTop:0 }, 1);

        if(el.hasClass("hide"))
            el.removeClass("hide");
        else
            el.addClass("hide");
        e.stopPropagation();
    });

    $(window).on('click', function(){
        $('.filetype-menu').addClass('hide');
    });

    $('.filetype-menu').on('click', function(e){
        e.stopPropagation();
    });

    $('#cstm-search').on("change keyup", function(){
        var search = $(this).val().toLowerCase().trim();

        if(search){
            $.each($('.cstm-list li'), function(k,v){
                var val = $(this).text().toLowerCase().trim();
                if(val.indexOf(search) == -1)
                    $(v).addClass('hide');
                else
                    $(v).removeClass('hide');
            });
        }

        $('.nothing_found').remove();
        if($('.cstm-list li').length == $('.cstm-list li.hide').length)
            $('.cstm-menu').append('<span class="nothing_found">Nothing Found!</span>');
    });

    $('.filetype-list li').on('click', function(){
        var val = $(this).data("id");
        
        if(val){
            $.ajax({
                url: base_url + 'ajax/change_featured_file',
                type: 'post',
                dataType : 'json',
                data : { id:val },
                success: function(r){
                    if(r.status){
                        $('#featureFile').text(r.title);
                        $('.filetype-menu').addClass('hide');
                        $toast = toastr['success']('Successfully changed the featured file type');
                    } else{
                        $toast = toastr['error']('An error occurred, please reload the page and try again');
                    }
                }, error: function(e){
                    console.log(e.responseText);
                }
            });
        } else{
            $toast = toastr['error']('An error occurred, please reload the page and try again');
        }
    });



//=======>>> Select Image

    // add/edit file extension
    $('.select-image-container').on("click", function(){
        $('.image-preview').addClass("hide");
        $('.image-default').css("opacity", "1");
        $('.select-image').trigger("click");
    });

    $('.select-image').on("change", function(){
        var container = $(this).data("preview");
        imagePreview(this, container);
    });

    window.imagePreview = function(input, container) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var src = e.target.result;
                $("." + container).attr("src", src).removeClass("hide");
                $(".image-default").css("opacity", "0");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // platform / software page
    $('.form-image').on("click", function(){
        var container = $(this).data("preview");
        $("." + container).attr("src", "").addClass("hide");
        $(this).val("");
    });

    $('.form-image').on("change", function(){
        var container = $(this).data("preview");
        imagePreview(this, container);
    });

    window.imagePreview2 = function(input, container) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var src = e.target.result;
                $("." + container).attr("src", src).removeClass("hide");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    

//=======>>> Add / Edit File Extension

    var $toast;

    $('#softwareSelected').on('click', function(e){
        var el = $('.software-menu');
        $('#cstm-search').val("");
        $('.cstm-list li').removeClass("hide");
        $('.software-list').animate({ scrollTop:0 }, 1);
        
        if(el.hasClass("hide"))
            el.removeClass("hide");
        else
            el.addClass("hide");
        e.stopPropagation();
    });

    $(window).on('click', function(){
        $('.software-menu').addClass('hide');
    });

    $('.software-menu').on('click', function(e){
        e.stopPropagation();
    });

    $('.software-list li').on('click', function(){
        var val = $(this).data("id"),
            text = $(this).text();

        if(!$(".software-" + val).length){
            var html = '<div class="software-item software-'+ val +'">' +
                '<input type="hidden" name="software[]" value="'+ val +'">' +
                '<span>'+ text +'</span>' +
                '<a href="javascript:void(0)" class="remove-item">x</a>' +
            '</div>';
            $('.software-container').append( html ).removeClass("hide");
            $('.software-menu').addClass("hide");
        }
    });

    $(document).on("click", '.remove-item', function(){
        $(this).parent().remove();
        if(!$('input[name="software[]"]').length) $('.software-container').addClass("hide");
    });

    window.validation = function(){
        if(!$('input[name="software[]"]').length){
            var $toast = toastr['error']('Please select software for the file extension');
            return false;
        }
    } 
});
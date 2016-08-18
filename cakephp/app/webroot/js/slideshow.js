$(function() {

    var current_id;
    var item_cnt = $('.view-imgwrap img').length - 1;
    
    $('.modal-open').click(function() {
        $('body').append('<div id="modal-overlay"></div>');
        $('#modal-overlay').fadeIn('slow');

        getclass = $(this).attr('class');
        current_id = getclass.match(/([0-9]+)/)[0];
        // show images
        showImage();
    });

    $(document).on('click', '#next', function() {
        current_id++;
        showImage();
    });

    $(document).on('click', '#prev', function() {
        current_id--;
        showImage();
    });

    // delete modal-overlay, modal-contents
    $(document).on('click', '#modal-overlay', function() {
        $('#modal-contents, #modal-overlay').fadeOut('slow', function() {
            $('#modal-overlay').remove();
        });
    });

    function showImage() {
        img_src = $('.view-imgwrap img').eq(current_id).attr('src');
        $('#modal-contents #img-block').empty().append('<img src="' + img_src + '" />');
        centeringModalContents();
        $('#modal-contents').fadeOut(0);
        $('#modal-contents').fadeIn('slow');

        $('#navi').empty();
        // get arrow position
        center = ($('#modal-contents').css('height').replace('px', '') / 2) - 20;
        if (current_id == 0) {
            $('#navi').append('<a id="next" href="javascript:void(0);"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>');
            $('#navi #next').css({'top': center});
        } else if (current_id == item_cnt) {
            $('#navi').append('<a id="prev" href="javascript:void(0);"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>');
            $('#navi #prev').css({'top': center});
        } else {
            $('#navi').append('<a id="prev" href="javascript:void(0);"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>');
            $('#navi').append('<a id="next" href="javascript:void(0);"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>');
            $('#navi #prev').css({'top': center});
            $('#navi #next').css({'top': center});
        }
    }

    function centeringModalContents() {
        var w = $(window).width();
        var h = $(window).height();
        var cw = $('#modal-contents').outerWidth();
        var ch = $('#modal-contents').outerHeight();
        var pxleft = (w - cw) / 2;
        var pxtop = (h - ch) / 2;
        $('#modal-contents').css({'left':pxleft, 'top':pxtop});
    }
})
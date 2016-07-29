$(function() {
    $('.modal-open').click(function(){
        // オーバーレイ用の要素を追加
        $('body').append('<div class="modal-overlay"></div>');
        // オーバーレイをフェードイン
        $('.modal-overlay').fadeIn('slow');
        // モーダルコンテンツのIDを取得
        var modal = '#' + $(this).attr('data-target');
        // モーダルコンテンツの表示位置を設定
        modalResize();
         // モーダルコンテンツフェードイン
        $(modal).fadeIn('slow');
        // 「.modal-overlay」あるいは「.modal-close」をクリック
        $('.modal-overlay, .modal-close').off().click(function(){
            // モーダルコンテンツとオーバーレイをフェードアウト
            $(modal).fadeOut('slow');
            $('.modal-overlay').fadeOut('slow',function(){
                // オーバーレイを削除
                $('.modal-overlay').remove();
            });
        });

        // リサイズしたら表示位置を再取得
        $(window).on('resize', function(){
            modalResize();
        });

        // モーダルコンテンツの表示位置を設定する関数
        function modalResize(){
            // ウィンドウの横幅、高さを取得
            var w = $(window).width();
            var h = $(window).height();

            // モーダルコンテンツの表示位置を取得
            var x = (w - $(modal).outerWidth(true)) / 2;
            var y = (h - $(modal).outerHeight(true)) / 2;

            // モーダルコンテンツの表示位置を設定
            $(modal).css({'left': x + 'px','top': y + 'px'});
        }

    var current_id = $(this).attr('class');
        current_id = current_id.match(/([0-9]+)/)[0];
        // block id
        var block_id = $(this).parent('div').attr('id');
        var obj = $('div#' + block_id);
        var tags = obj.html();
        console.log(tags);
        var arr = tags.match(/img src="(.*?)"/g);
        var img_src = {};

        for (i = 0; i < arr.length; i++) {
            img_src[i] = arr[i].match(/img src="(.*?)"/)[1];
        }

        dispImage();

        function dispImage() {
            $('div#img-block').empty();
            $('div#img-block').append('<img src="' + img_src[current_id] + '" />');
            var img = new Image();
            img.src = convertAbsUrl(img_src[current_id]);
            $('.modal-content').css('max-width', img.width);
            $('.modal-content').css('max-height', img.height);
            modalResize();

            if (current_id == 0) {
                if (arr.length > 1) {
                    $('div#img-block').append('<a id="next_img" href="javascript:void(0)">next</a>');
                }
            } else if(current_id == arr.length - 1) {
                $('div#img-block').append('<a id="prev_img" href="javascript:void(0)">prev</a>');
            } else {
                $('div#img-block').append('<a id="next_img" href="javascript:void(0)">next</a>');
                $('div#img-block').append('<a id="prev_img" href="javascript:void(0)">prev</a>');
            }
        }

        function convertAbsUrl(src){
            return $('<a>').attr('href', src).get(0).href;
        }

        $(document).on('click', '#next_img', function() {
            current_id ++;
            dispImage();
        });
        $(document).on('click', '#prev_img', function() {
            current_id --;
            dispImage();
        });
  });
});
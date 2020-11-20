// loader
$(window).on('load', function() {
    $('#loader-bg').hide();
});

//navigation
$(function() {
    $(".nav-button").on("click", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(".nav-wrap")
                .addClass("close")
                .removeClass("open");
        } else {
            $(this).addClass("active");
            $(".nav-wrap")
                .addClass("open")
                .removeClass("close");
        }

        // ページ内リンクで閉じる
        $('.nav a').on('click', function() {
            if (window.innerWidth <= 768) {
                $('.nav-button').click();
            }
        });
    });
});


//スムーススクロール for jquery1
$(function() {
    // #で始まるアンカーをクリックした場合に処理
    $('a[href^=#]').click(function() {
        // スクロールの速度
        var speed = 400; // ミリ秒
        // アンカーの値取得
        var href = $(this).attr("href");
        // 移動先を取得
        var target = $(href == "#" || href == "" ? 'html' : href);
        // 移動先を数値で取得
        var position = target.offset().top;
        // スムーススクロール
        $('body,html').animate({ scrollTop: position }, speed, 'swing');
        return false;
    });
});

//ページトップ
$(function() {
    var topBtn = $('.pagetop'); //idは自分のサイトに合わせて変更
    topBtn.hide();
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) { //トップから200pxにした
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
});
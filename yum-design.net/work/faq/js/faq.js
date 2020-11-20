// Accordion
// https://flex-box.net/accordion/
$(function() {
    //中のコンテンツを隠す
    $(".faq-accordion-content").css("display", "none");
    //タイトルがクリックされたら
    $(".js-accordion-title").click(function() {
        //クリックしたjs-accordion-title以外の全てのopenを取る
        $(".js-accordion-title").not(this).removeClass("open");
        //クリックされたtitle以外のcontentを閉じる
        $(".js-accordion-title").not(this).next().slideUp(300);
        //thisにopenクラスを付与
        $(this).toggleClass("open");
        //thisのcontentを展開、開いていれば閉じる
        $(this).next().slideToggle(300);
    });
});


// ページ内リンクスムーススクロール
// https://senoweb.jp/note/fixheader-anchorlink/
$(function() {
    var windowWidth = $(window).width();
    var headerHight = 70;
    $('a[href^="#"]').click(function() {
        var speed = 400;
        var href = $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top - headerHight;
        $("html, body").animate({ scrollTop: position }, speed, "swing");
        return false;
    });
});

// ヘッダーの高さ分だけコンテンツを下げる
// https://web.runland.co.jp/blog_cate2/post-1818
$(function() {
    var height = $(".faqHeader").height();
    $("body").css("margin-top", height);
});
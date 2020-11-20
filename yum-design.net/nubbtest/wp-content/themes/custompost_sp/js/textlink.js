/*　
リンクテキストのあるli全体をクリック（タップ）できるように
http://www.webcreatorbox.com/tech/smartphone-snippets/
*/

$(function(){
     $(".clickable").click(function(){
         window.location=$(this).find("a").attr("href");
         return false;
    });
});

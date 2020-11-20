/*
Urgent news ticker
http://bxslider.com/

「スライドのティッカー」
http://www.ar-ch.org/mt/archives/2010/07/jquery.html
*/

$(function(){
$('ul#news03').bxSlider({
controls: false,
speed: 700,
pager: false,
auto: true,
pause: 5000
});
});



/*
jquery.title.js

部員名鑑
要素の高さを揃えるjQueryプラグイン
http://urin.take-uma.net/Entry/13/
*/
$(function(){
  $(".memberslist_student").tile(3);
});
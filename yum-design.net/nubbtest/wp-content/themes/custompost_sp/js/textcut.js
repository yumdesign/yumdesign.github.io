/*
text cut
文字列を特定の文字数でカットして末尾に「…」などを追加
http://black-flag.net/jquery/20121114-4332.html
*/

$(function(){
	var $setElm = $('ul#spTopTicker li');
	var cutFigure = '34'; // カットする文字数
	var afterTxt = ' …'; // 文字カット後に表示するテキスト

	$setElm.each(function(){
		var textLength = $(this).text().length;
		var textTrim = $(this).text().substr(0,(cutFigure))

		if(cutFigure < textLength) {
			$(this).html(textTrim + afterTxt).css({visibility:'visible'});
		} else if(cutFigure >= textLength) {
			$(this).css({visibility:'visible'});
		}
	});
});

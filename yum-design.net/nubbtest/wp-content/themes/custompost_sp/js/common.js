/*
accordion
*/

$(document).ready(function(){
    $('.accordionHead').click(function() {
    	$('.accordionHead').removeClass("selected").next().slideUp();
        $(this).toggleClass("selected").next().slideToggle();
    }).next().hide();
});

$(document).ready( function() {

  // Sticky Header
  $(window).scroll(function(){
    var sticky = $('header'),
        scroll = $(window).scrollTop();

    if (scroll >= 100) sticky.addClass('fixHeader');
    else sticky.removeClass('fixHeader');
  });


})
$(window).load( function(){ 


})

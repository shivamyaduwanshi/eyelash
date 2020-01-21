$(document).ready(function(){
	  $('.toggle-btn').click(function() {
	  // $('body').addClass('toggle-class');
	  $("body").toggleClass("toggle-nav");
	});
});

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();    
    if (scroll >= 80) {
        $("body").addClass("scrolled");
    }
    else{
    	$("body").removeClass("scrolled");
    }
});
/**************/
// $(document).ready(function () {
//     $('#buy-now, #home-popup').modal({
//            backdrop: 'static',
//            keyboard: false
//     });
// });
$(document).ready(function() {
	$('.navigation ul li > a:not(:only-child)').click(function(e) {
	  	$(this).siblings('.nav-dropdown').toggle();
		if ($(this).children('.drop-arrow').hasClass('active')) {
			$(this).removeClass('active');
			$(this).children('.drop-arrow').removeClass('active');
		} else {
			$('.nav-list a').removeClass('active');
			$(this).toggleClass('active');
			$(this).children('.drop-arrow').toggleClass('active');
		}
		$('.nav-dropdown').not($(this).siblings()).hide();
		$('.drop-arrow').not($(this).children()).removeClass('active');
	    e.stopPropagation();
	});
	$('html').click(function() {
    	$('.nav-dropdown').hide();
		$('.nav-list a').removeClass('active');
		$('.drop-arrow').removeClass('active');
    });
	$('#nav-toggle').on('click', function() {
  		this.classList.toggle('active');
	});
	$('#nav-toggle').click(function() {
  		$('nav ul.nav-list').toggleClass('active');
	});
	$(document).keyup(function(e){
	    if (e.keyCode === 27) {
			if ($('.drop-arrow').hasClass('active')) {
				$('.drop-arrow').removeClass('active');
				$('.nav-dropdown').hide();
			}
			if ($('#nav-toggle').hasClass('active')) {
			  	$('#nav-toggle').removeClass('active');
			}
			if ($('nav ul.nav-list').hasClass('active')) {
			  	$('nav ul.nav-list').removeClass('active');
			}
		}
	});
});

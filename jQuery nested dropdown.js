$(document).ready(function() {
	$('.menu a').click(function(e) {

		e.preventDefault();

		if($(this).hasClass('activado')) {

			$(this).removeClass('activado');
			$(this).next().slideUp();

		} else {

			// $('.menu li ul').slideUp();
			$('.menu li a').removeClass('activado');
			$(this).addClass('activado');
			$(this).next().slideDown();
			
		}

		// $('.menu li ul li a').click(function() {
		// 	window.location.href = $(this).attr('href');
		// });

	});
});
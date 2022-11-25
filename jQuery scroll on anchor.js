(function ($) {
			$(document).on('click', 'a.menu-link', function (e) {
				e.preventDefault();
				var id = $(this).attr('href');
				$('html,body').animate({ scrollTop: $(id).offset().top - 100 }, 500);
			});
		})(jQuery);
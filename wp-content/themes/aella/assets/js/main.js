(function($) {
	"use strict";
	$(document).ready(function() {

		$(".js-filter-days-classes a").click(function(e) {
			e.preventDefault();
			$(".js-filter-days-classes a.active").removeClass();
			$(this).addClass("active");
		});
		
		$('.js-filter-classes-type').on('change', function() {
			$('.single-class').show();

			if ($(this).val() == "all") {
				$('.single-class').show();
			} else {
				$('.single-class[data-class!="' + $(this).val() + '"]').hide();
			}
		});
		
	});

})(jQuery);

(function($) {
    function elementHasErrors() {
		console.log(this);
		return $(this).siblings('.errors').length > 0;
	}

    $.fn.zforms = function(options) {
		$('.zforms-component', this).has('.errors').addClass('zforms-error-wrapper');
		$('.zforms-element', this).has('.errors')
			.find('input,select,textarea').tipsy({
				title: function() {return $(this).siblings('.errors').text()},
				fade: true,
				html: true,
				trigger: 'focus',
				gravity: 'w'
			}).addClass('zforms-error-on-input');

		var toggleContainerFocus = function(evt) {
			$(evt.target).parents('.zforms-component:first').toggleClass('zforms-component-active');
		};

		$('input:text,textarea,select', this).focus(toggleContainerFocus).blur(toggleContainerFocus);
    };
    
    $.fn.zforms.defaults = {
    };
   
})(jQuery);


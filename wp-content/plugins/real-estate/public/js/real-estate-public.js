(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	/** When acf object is loaded */
	$( window ).load(function() {

		$('.acf-form').on('submit', function(e){
			e.preventDefault();

			let $form = $(e.target);

			$.ajax({
				url: real_estate_ajax_object.ajax_url,
				method: 'post',
				data: {
					'action': 'acf_filter_ajax_handler',
					'data': $form.serialize()
				},
				success: function(result) {
					let data = jQuery.parseJSON(result);
					$('.real-estate-objects-list').html(data.content);
					// acf.validation.toggle($form, 'unlock');
				}
			});
		});


		$('.real-estate-objects-list').on('click', 'a.page-numbers', function(e) {
			e.preventDefault();
			
			let $form = $('#acf-form');

			$.ajax({
				url: real_estate_ajax_object.ajax_url + new URL(e.target.href).search,
				method: 'post',
				data: {
					'action': 'acf_filter_ajax_handler',
					'data': $form.serialize()
				},
				success: function(result) {
					let data = jQuery.parseJSON(result);
					$('.real-estate-objects-list').html(data.content);
				}
			});

		});
	});

})( jQuery );

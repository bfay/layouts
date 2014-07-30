// Color picker script

jQuery(document).ready(function($) {

	$(document).on('socialbar-cell.dialog-open, iconbox-cell.dialog-open', function() {

		var $colorPickerInput = $('#colorbox .js-ddl-color-field');
		var $hiddenInput = $('#colorbox .js-ddl-color-value');

		// set the value for colorpicker input
		$colorPickerInput.val( $hiddenInput.val() );

		// set the value for the hidden input
		$colorPickerInput.wpColorPicker({

			palletes: true,
			change: function() {

				$hiddenInput.val( $(this).val() );
			}
		});

	});

});
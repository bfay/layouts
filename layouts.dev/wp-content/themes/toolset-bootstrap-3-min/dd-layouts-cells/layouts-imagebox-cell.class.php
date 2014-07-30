<?php
/*
 * Image-box cell type.
 * Bootstrap thumbnail component that displays box with image, header and text. Suitable for callout boxes, key features, services showcase etc.
 *
 */

if ( ! function_exists('register_imagebox_cell_init') )
{
	function register_imagebox_cell_init() {
		if ( function_exists('register_dd_layout_cell_type') ) {
			register_dd_layout_cell_type ('imagebox-cell',
				array(
					'name'					   => __('Image-box', 'wpbootstrap'),
					'icon-css'				   => 'icon-picture',
					'description'			   => __('A cell that displays box with image, header and text. Suitable for callout boxes, key features, services showcase etc.', 'wpbootstrap'),
					'category'				   => __('Example cells', 'wpbootstrap'),
					'category-icon-css'		   => 'icon-sun',
					'button-text'			   => __('Assign imagebox cell', 'wpbootstrap'),
					'dialog-title-create'	   => __('Create a new imagebox cell', 'wpbootstrap'),
					'dialog-title-edit'		   => __('Edit imagebox cell', 'wpbootstrap'),
					'dialog-template-callback' => 'imagebox_cell_dialog_template_callback',
					'cell-content-callback'	   => 'imagebox_cell_content_callback',
					'cell-template-callback'   => 'imagebox_cell_template_callback',
					'preview-image-url'		   => get_template_directory_uri() . '/dd-layouts-cells/images/layouts-imagebox-cell.jpg',
					'register-scripts'		   => array(
						array( 'ddl_media_uploader_js', get_template_directory_uri() . '/dd-layouts-cells/js/ddl-media-uploader.js', array( 'jquery' ), WPDDL_VERSION, true ),
					),
				)
			);
		}
	}
	add_action( 'init', 'register_imagebox_cell_init' );


	function imagebox_cell_dialog_template_callback() {
		ob_start();
		?>

		<h3>
			<?php the_ddl_cell_info('name'); ?>
		</h3>
		<ul class="ddl-form">
			<li>
				<label for="<?php the_ddl_name_attr('box_title'); ?>"><?php _e('Cell title', 'wpbootstrap') ?>:</label>
				<input type="text" name="<?php the_ddl_name_attr('box_title'); ?>">
			</li>
			<li class="js-ddl-media-field">
				<label for="<?php the_ddl_name_attr('box_image'); ?>"><?php _e('Image URL', 'wpbootstrap') ?>:</label>
				<input type="text" class="js-ddl-media-url" name="<?php the_ddl_name_attr('box_image'); ?>" />
				<div class="ddl-form-button-wrap">
					<button class="button js-ddl-add-media"
							data-uploader-title="<?php _e('Choose an image', 'wpbootstrap') ?>"
							data-uploader-button-text="<?php _e('Insert image URL', 'wpbootstrap') ?>">
							<?php _e('Choose an image', 'wpbootstrap') ?>
					</button>
				</div>
			</li>
			<li>
				<label for="<?php the_ddl_name_attr('box_content'); ?>"><?php _e('Cell content', 'wpbootstrap') ?>:</label>
				<textarea name="<?php the_ddl_name_attr('box_content'); ?>" rows="4"></textarea>
			</li>
		</ul>

		<?php
		return ob_get_clean();
	}


	// Callback function for displaying the cell in the editor.
	function imagebox_cell_template_callback() {
		return 'box_title';
	}


	// Callback function for display the cell in the front end.
	function imagebox_cell_content_callback() {
		ob_start();
		?>

		<div class="thumbnail">
			<img src="<?php the_ddl_field('box_image'); ?>">
			<div class="caption text-center">
				<h3>
					<?php the_ddl_field('box_title'); ?>
				</h3>
				<p>
					<?php the_ddl_field('box_content'); ?>
				</p>
			</div>
		</div>

		<?php
		return ob_get_clean();
	}
}
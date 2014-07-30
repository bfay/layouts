<?php
/*
 * Theme footer cell type.
 * Displays current theme basic footer with two credits area.
 *
 */

if ( ! function_exists('register_footer_cell_init') ) {
	function register_footer_cell_init() {
		if ( function_exists('register_dd_layout_cell_type') ) {
			register_dd_layout_cell_type('footer-cell',
				array(
					'name'						=> __('Theme footer', 'wpbootstrap'),
					'description'				=> __('Displays current theme basic footer with two credits area.', 'wpbootstrap'),
					'category'					=> __('Theme cells', 'wpbootstrap'),
					'category-icon-url'			=> get_template_directory_uri() . '/theme-options/bootstrap-grid/img/icon-16-insert-grid.png',
					'button-text'				=> __('Assign theme footer cell', 'wpbootstrap'),
					'dialog-title-create'		=> __('Create a new footer cell', 'wpbootstrap'),
					'dialog-title-edit'			=> __('Edit footer cell', 'wpbootstrap'),
					'dialog-template-callback'	=> 'footer_cell_dialog_template_callback',
					'cell-content-callback'		=> 'footer_cell_content_callback',
					'cell-template-callback'	=> 'footer_cell_template_callback'
				)
			);
		}
	}
	add_action( 'init', 'register_footer_cell_init' );


	function footer_cell_dialog_template_callback() {
		ob_start();
		?>

		<h3>
			<?php the_ddl_cell_info('name'); ?>
		</h3>
		<div class="ddl-form">
			<p>
				<label for="<?php the_ddl_name_attr('credits_left'); ?>"><?php _e('Left footer area', 'wpbootstrap'); ?></label>
				<textarea name="<?php the_ddl_name_attr('credits_left'); ?>" rows="4"></textarea>
			</p>
			<p>
				<label for="<?php the_ddl_name_attr('credits_right'); ?>"><?php _e('Right footer area', 'wpbootstrap'); ?></label>
				<textarea name="<?php the_ddl_name_attr('credits_right'); ?>" rows="4"></textarea>
			</p>
		</div>

		<?php
		return ob_get_clean();
	}


	function footer_cell_template_callback() {
		return 'name';
	}


	function footer_cell_content_callback() {
		ob_start();
		?>

		<?php do_action('wpbootstrap_before_footer'); ?>
		<footer id="footer" class="muted">
			<p class="pull-left">
				<?php the_ddl_field('credits_left'); ?>
			</p>
			<p class="pull-right">
				<?php the_ddl_field('credits_right'); ?>
			</p>
		</footer>
		<?php do_action( 'wpbootstrap_after_footer' ); ?>

		<?php
		$content = ob_get_clean();
		return $content;
	}

}
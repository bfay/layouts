<?php
/*
 * Theme Site title cell type.
 * Bootstrap theme Site title and description.
 *
 */

if ( ! function_exists('register_site_title_cell_init') ) {
	function register_site_title_cell_init() {
		if ( function_exists('register_dd_layout_cell_type') ) {
			register_dd_layout_cell_type ('site-title-cell',
				array(
					'name'						=> __('Theme Site title', 'wpbootstrap'),
					'description'				=> __('Bootstrap theme Site title and description.', 'wpbootstrap'),
					'category'					=> __('Theme cells', 'wpbootstrap'),
					'category-icon-url'			=> get_template_directory_uri() . '/theme-options/bootstrap-grid/img/icon-16-insert-grid.png',
					'button-text'				=> __('Assign Theme Site title cell', 'wpbootstrap'),
					'dialog-title-create'		=> __('Create a new Theme Site title cell', 'wpbootstrap'),
					'dialog-title-edit'			=> __('Edit Theme Site title cell', 'wpbootstrap'),
					'dialog-template-callback'	=> 'site_title_cell_dialog_template_callback',
					'cell-content-callback'		=> 'site_title_cell_content_callback',
					'cell-template-callback'	=> 'site_title_cell_template_callback'
				)
			);
		}
	}
	add_action( 'init', 'register_site_title_cell_init' );


	function site_title_cell_dialog_template_callback() {
		return '';
	}


	function site_title_cell_template_callback() {
		return 'name';
	}


	function site_title_cell_content_callback() {
		ob_start();
		?>

		<h1 class="site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a>
		</h1>
		<h2 class="site-description">
			<?php bloginfo('description'); ?>
		</h2>

		<?php
		return ob_get_clean();
	}

}
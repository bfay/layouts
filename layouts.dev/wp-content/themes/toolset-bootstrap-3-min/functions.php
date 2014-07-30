<?php

if ( is_admin() ) {

	require_once dirname(__FILE__) . '/theme-options/bootstrap-grid/grid-options.php';
	new WPBT_theme();
}


// Include custom nav walker
require_once('bs-nav-walker.php');

// Set default attributes for wp_nav_menu() function:
if ( ! function_exists( 'wpbootstrap_nav_menu_defaults' ) ) {

	function wpbootstrap_nav_menu_defaults( $args = '' ) {

		$nav_menu_args['container'] = false;

		if ( ! $args['items_wrap'] ) {
			$nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
		}
		if ( ! $args['walker'] ) {
			$nav_menu_args['walker'] = new Wpbootstrap_Nav_Walker();
		}
		return array_merge( $args, $nav_menu_args );
	}

	if ( has_nav_menu( 'header-menu' ) ) {
		add_filter( 'wp_nav_menu_args', 'wpbootstrap_nav_menu_defaults' );
	}
}


// Includes gallery walker
require_once( 'bs-gallery.php' );

// Enable Bootstrap's thumbnails component on [gallery]
add_theme_support( 'bootstrap-gallery' );


// Include theme options/theme-options/inc/
if ( ! function_exists('optionsframework_init') ) {

	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/theme-options/inc/' );
	require_once dirname(__FILE__) . '/theme-options/inc/options-framework.php';

	function wpbootstrap_get_setting( $option, $id ) {

		if ( is_array(of_get_option( $option )) ) {

			if ( array_key_exists( $id, of_get_option( $option ) )) {
				$setting = of_get_option( $option );
				return $setting [ $id ];

			} else {
				return false;
			}

		}
		return true;
	}

}


// Check if uses Layouts template
function wp_bootstrap_is_layout_page_template() {

	if ( ! function_exists( 'is_ddlayout_template' ) ) {
		return false;
	}

	return is_ddlayout_template();
}

// Set max content width
if ( ! isset( $content_width ) ) {
	$content_width = 770;
}


// Basic theme setup
if ( ! function_exists('wpbootstrap_setup_theme') ) {

	function wpbootstrap_setup_theme() {

		// Define /lang/ directory for translations
		load_theme_textdomain('wpbootstrap', get_template_directory() . '/languages');

		// Add editor-style.css for WordPress editor
		add_editor_style('editor-style.css');

		// Adds RSS feed links
		add_theme_support('automatic-feed-links');
		add_theme_support('woocommerce');

		// Add support for post formats: http://codex.wordpress.org/Post_Formats
		add_theme_support('post-formats', array(
			'aside', 'image', 'link', 'quote', 'status', 'gallery'
		));

		// Add support for custom background
		add_theme_support('custom-background', array(
			'default-color' => 'fff',
		));

		// Add support fot post thumbnails
		add_theme_support('post-thumbnails');

		// Register nav menu
		register_nav_menus(array(
			'header-menu' => __('Header Menu', 'wpbootstrap'),
		));

		add_theme_support( 'bootstrap-gallery' );


	}

	add_action('after_setup_theme', 'wpbootstrap_setup_theme');
}


// Registers main widget area
if ( ! function_exists('wpbootstrap_register_sidebar') ) {

	function wpbootstrap_register_sidebar() {

		register_sidebar(array(
			'name'			=> __('Widgets area', 'wpbootstrap'),
			'id'			=> 'sidebar',
			'description'	=> __('Widgets area can be used with the Layouts plugin to display widgets of your choice within custom drag&drop cell.', 'wpbootstrap'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3>',
		));

	}

	add_action('widgets_init', 'wpbootstrap_register_sidebar');
}


// Support for Bootstrap Pager.
// More info: http://twitter.github.com/bootstrap/components.html#pagination
if ( ! function_exists('wpbootstrap_content_nav') ) {

	function wpbootstrap_content_nav() {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) : ?>

			<ul class="pager" role="navigation">
				<li class="previous">
					<?php echo str_replace('<a href', '<a rel="prev" href', get_next_posts_link('&larr; ' . __('Olders posts', 'wpbootstrap'))) ?>
				</li>
				<li class="next">
					<?php echo str_replace('<a href', '<a rel="next" href', get_previous_posts_link(__('Newer posts', 'wpbootstrap') . ' &rarr;')) ?>
				</li>
			</ul>

		<?php endif;
	}

}

// Adds 'jumbotron' class for sticky posts.
// More info: http://twitter.github.com/bootstrap/components.html#typography
if ( ! function_exists( 'wpbootstrap_sticky_post' ) ) {

	function wpbootstrap_sticky_post( $classes ) {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			$classes[] = 'jumbotron';
		}
		return $classes;
	}

	add_filter( 'post_class', 'wpbootstrap_sticky_post' );
}


// Adds 'table' class for <table> tags. Bootstrap needs an additional 'table' class to style tables.
// More info: http://twitter.github.com/bootstrap/base-css.htm
if ( ! function_exists('wpbootstrap_add_table_class') ) {

	function wpbootstrap_add_table_class( $content ) {
		$table_has_class = preg_match( '/<table class="/', $content );	// FIXME: regex to skip additional elements between table and class

		if ( $table_has_class ) {
			$content = str_replace( '<table class="', '<table class="table ', $content );

		} else {
			$content = str_replace( '<table', '<table class="table"', $content );
		}
		return $content;
	}

	add_filter( 'the_content', 'wpbootstrap_add_table_class' );
	add_filter( 'comment_text', 'wpbootstrap_add_table_class' );
}


// Pagination function.
// Thanks to: https://gist.github.com/3774261
if ( ! function_exists('wpbootstrap_link_pages') ) {

	function wpbootstrap_link_pages( $args = '') {

		$defaults = array(
			'before'			=> '<ul class="pagination">',
			'after'				=> '</ul>',
			'next_or_number'	=> 'number',
			'nextpagelink'		=> __('Next page', 'wpbootstrap'),
			'previouspagelink'	=> __('Previous page', 'wpbootstrap'),
			'pagelink'			=> '%',
			'echo'				=> 1
		);

		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );

		global $page, $numpages, $multipage, $more, $pagenow;

		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace ('%', $i, $pagelink );
					$output .= ' ';
					if ( $i != $page || ( ( !$more ) && ( $page == 1 ) ) )
						$output .= '<li>' . _wp_link_page( $i );
					else
						$output .= '<li class="active"><a href="#">';

					$output .= $j;
					if ( $i != $page || ( ( !$more ) && ( $page == 1 ) ) )
						$output .= '</a>';
					else
						$output .= '</a></li>';
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more) {
						$output .= _wp_link_page( $i );
						$output .= $previouspagelink . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $nextpagelink . '</a>';
					}
					$output .= $after;
				}
			}
		}
		if ( $echo )
			echo $output;

		return $output;
	}
}


/**
 * Returns classes for the bootstrap navbar
 *
 */
if ( ! function_exists('wpbootstrap_get_nav_menu_classes') ) {

	function wpbootstrap_get_nav_menu_classes() {

		$wpbootstrap_navbar_classes = 'navbar';

		if ( of_get_option('navbar_style') === 'menu_static' ) {
			$wpbootstrap_navbar_classes = $wpbootstrap_navbar_classes . ' navbar-default navbar-static-top';
		}
		elseif ( of_get_option('navbar_style') === 'menu_fixed_top' ) {
			$wpbootstrap_navbar_classes = $wpbootstrap_navbar_classes . ' navbar-default navbar-fixed-top';
		}
		elseif ( of_get_option('navbar_style') === 'menu_fixed_bottom' ) {
			$wpbootstrap_navbar_classes = $wpbootstrap_navbar_classes . ' navbar-fixed-bottom';
		}
		if ( of_get_option('navbar_inverted')) {
			$wpbootstrap_navbar_classes = $wpbootstrap_navbar_classes . ' navbar-inverse';
		}
		return $wpbootstrap_navbar_classes;
	}

}


/*
 * Make WordPress comments template Bootstrap compatibile using Media object component.
 * More info: http://twitter.github.com/bootstrap/components.html#media
 *
 */

/** COMMENTS WALKER */
class Wpbootstrap_Comments extends Walker_Comment {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;
		?>
		<ul class="children list-unstyled media">
			<?php
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1;
			?>
		</ul><!-- .children -->
		</div><!-- .media-body -->
		<?php
	}

	/** START_EL */
	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		global $post
		?>

		<li class="media" id="comment-<?php comment_ID(); ?>">
			<span class="pull-left <?php echo ( $comment->user_id === $post->post_author ? 'thumbnail' : '' ); ?>">
				<?php
				if ( $comment->user_id === $post->post_author) {
					echo get_avatar( $comment, 54 );
				} else {
					echo get_avatar( $comment, 64 );
				}
				?>
			</span>
			<div class="media-body">
				<h4 class="media-heading">
					<?php
					printf('<cite>%1$s %2$s</cite>', get_comment_author_link(), ( $comment->user_id === $post->post_author ) ? '<span class="bypostauthor label label-info"> ' . __('Post author', 'wpbootstrap') . '</span>' : ''
					);
					?>
				</h4>
				<?php
				printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url(get_comment_link( $comment->comment_ID )),
						get_comment_time('c'), sprintf( '%1$s ' . __('at', 'wpbootstrap') . ' %2$s', get_comment_date(), get_comment_time() )
				);
				?>

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="alert alert-info comment-awaiting-moderation">
						<?php _e('Your comment is awaiting moderation.', 'wpbootstrap'); ?>
					</p>
				<?php endif; ?>

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<div class="reply">
					<a class="btn btn-default btn-xs edit-link" href="<?php echo get_edit_comment_link(); ?>"><?php _e('Edit', 'wpbootstrap') ?></a>
					<?php
					comment_reply_link(array_merge( $args,
							array(
								'reply_text' => '<span class="btn btn-default btn-xs">' . __('Reply', 'wpbootstrap') . '</span>',
								'after'      => '',
								'depth'      => $depth,
								'max_depth'	 => $args['max_depth'],
					)));
					?>
				</div><!-- .reply -->

				<?php if ( empty( $args['has_children']) ) : ?>
			</div> <!-- .media-body -->
			<?php endif; ?>

			<?php
		}

		function end_el( &$output, $comment, $depth = 0, $args = array() ) {
			?>
		</li> <!-- .media -->
		<?php
	}

}

// Changes the default comment form textarea markup
if ( ! function_exists('wpbootstrap_comment_form') ) {

	function wpbootstrap_comment_form( $defaults ) {

		$defaults['comment_field'] = ''
				. '<div class="comment-form-comment form-group">'
					. '<label for="comment">' . __('Comment', 'wpbootstrap') . '</label>'
					. '<textarea id="comment" class="form-control" name="comment" rows="8" aria-required="true"></textarea>'
				. '</div>';
		$defaults['comment_notes_after'] = ''
				. '<p class="form-allowed-tags help-block">'
				. sprintf(__('You may use these', 'wpbootstrap') . ' <abbr title="HyperText Markup Language">HTML</abbr> ' . __('tags and attributes:', 'wpbootstrap'). '%s',
						'<pre>' . allowed_tags() . '</pre>')
				. '</p>';

		return $defaults;
	}

	add_filter( 'comment_form_defaults', 'wpbootstrap_comment_form' );
}

// Changes the default comment form fields markup
// Thanks to http://www.codecheese.com/2013/11/wordpress-comment-form-with-twitter-bootstrap-3-supports/
if ( ! function_exists('wpbootstrap_comment_form_fields') ) {

	function wpbootstrap_comment_form_fields( $defaults ) {

		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

		$defaults    =  array(
			'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name', 'wpbootstrap' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
						'<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
			'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'wpbootstrap' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
						'<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
			'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'wpbootstrap' ) . '</label> ' .
						'<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
		);

		return $defaults;
	}

	add_filter( 'comment_form_default_fields', 'wpbootstrap_comment_form_fields' );
}

// Changes comments form submit button
if ( ! function_exists('wpbootstrap_comment_button') ) {

	function wpbootstrap_comment_button() {
		echo '<button class="btn btn-default" type="submit">' . __( 'Post comment', 'wpbootstrap' ) . '</button>';
	}
	add_action( 'comment_form', 'wpbootstrap_comment_button' );
}


// Changes the default password protection form markup
if ( ! function_exists( 'wpbootstrap_password_form' ) ) {

	function wpbootstrap_password_form() {

		global $post;
		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
		$form = '<form class="protected-post-form form-inline" role="form" action="' . get_option( 'siteurl' ) . '/wp-login.php?action=postpass" method="post">'
				. '<div class="alert alert-info alert-dismissable">'
				. '<button type="button" class="close" data-dismiss="alert">&times;</button>'
				. '<strong>' . __( 'This post is password protected.', 'wpbootstrap' ) . '</strong> ' . __( "To view it please enter your password below", 'wpbootstrap' )
				. '</div>'
				. '<div class="form-group">'
				. '<label class="sr-only" for="' . $label . '">' . __( "Password: ", 'wpbootstrap' ) . '</label>'
				. '<input type="password" class="form-control" placeholder="Password" name="post_password" id="' . $label . '" />'
				. '</div>'
				. '<button type="submit" class="btn btn-default"/>' . __( 'Submit', 'wpbootstrap' ) . '</button>'
				. '</form>';

		return $form;
	}

	add_filter( 'the_password_form', 'wpbootstrap_password_form' );
}

// removes invalid rel="category tag" attribute from the links
if ( ! function_exists('wpbootstrap_remove_category_rel') ) {

	function wpbootstrap_remove_category_rel( $link ) {
		$link = str_replace( 'rel="category tag"', "", $link );
		return $link;
	}

	add_filter( 'the_category', 'wpbootstrap_remove_category_rel' );
}


// Enqueue styles and scripts
if ( ! function_exists('wpbootstrap_register_scripts') ) {

	function wpbootstrap_register_scripts() {
		if ( ! is_admin() ) {

			// Deregister scripts
			wp_deregister_script('wpbootstrap_user_scripts_js');

			// Deregister styles
			wp_deregister_style('wpbootstrap_bootstrap_main_css');
			wp_deregister_style('wpbootstrap_bootstrap_responsive_css');

			// Register Twitter Bootstrap CSS files
			wp_register_style('wpbootstrap_bootstrap_main_css', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', false, null);
			wp_register_style('wpbootstrap_bootstrap_theme_css', get_template_directory_uri() . '/bootstrap/css/bootstrap-theme.min.css', array('wpbootstrap_bootstrap_main_css'), null);

			// Register Twitter Bootstrap JS
			wp_register_script('wpbootstrap_bootstrap_js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'), null, true);

			// Enqueue comments script
			if ( is_single() && comments_open() && get_option('thread_comments') ) {
				wp_enqueue_script('comment-reply');
			}

			// Enqueue Twitter Bootstrap CSS files
			wp_enqueue_style('wpbootstrap_bootstrap_main_css');
			wp_enqueue_style('wpbootstrap_bootstrap_theme_css');

			// Eneuqueu Twitter Bootstrap JS
			wp_enqueue_script('wpbootstrap_bootstrap_js');

			if ( wp_style_is('wpbootstrap_user_style_css', 'registered') ) {
				wp_enqueue_style('wpbootstrap_user_style_css');
			}

			// Eneuqueu user sctips
			wp_enqueue_script('wpbootstrap_user_scripts_js');
		}
	}

	add_action( 'wp_enqueue_scripts', 'wpbootstrap_register_scripts' );
}

// Enqueue custom CSS for theme options
if ( ! function_exists('wpbootstrap_register_options_scripts') ) {

	function wpbootstrap_register_options_scripts() {
		wp_register_style('wpbootstrap_options_css', get_template_directory_uri() . '/theme-options/css/optionsframework-custom.css');
		wp_register_style('wpbootstrap_alerts_css', get_template_directory_uri() . '/theme-options/css/bootstrap-alerts.css');
		wp_enqueue_style('wpbootstrap_options_css');
		wp_enqueue_style('wpbootstrap_alerts_css');
		wp_enqueue_style('wp-pointer');
		wp_enqueue_script('wp-pointer');
	}

	add_action( 'admin_enqueue_scripts', 'wpbootstrap_register_options_scripts' );
}


if ( ! function_exists('wpbootstrap_get_wordpress_base_path') ) {

	function wpbootstrap_get_wordpress_base_path() {
		$dir = dirname(__FILE__);
		do {
			if ( file_exists( $dir . "/wp-load.php") ) {
				return $dir;
			}
		}
		while ( $dir = realpath( "$dir/..") );
		return null;
	}

}


// Add classes to body tag
if ( ! function_exists('wpbootstrap_add_body_class') ) {

	function wpbootstrap_add_body_class( $classes ) {

		if ( of_get_option('navbar_style') === 'menu_fixed_top' ) {
			$classes[] = 'menu-fixed-top';
		}

		return $classes;
	}
}

add_filter( 'body_class', 'wpbootstrap_add_body_class' );


// WooCommerce support
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


// Load custom cells types for Layouts plugin from the /dd-layouts-cells/ directory
/*if ( class_exists( 'WPDD_Layouts' ) && ! function_exists( 'include_ddl_layouts' ) ) {

	function include_ddl_layouts( $tpls_dir = '' ) {

		$path    = realpath( dirname(__FILE__) . $tpls_dir );
		$objects = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $path, RecursiveDirectoryIterator::SKIP_DOTS ) );

		foreach ( $objects as $name=>$object) {

			if ( $object->getExtension() === 'php' ) {

				require_once $name;
			}
		}
	}

	include_ddl_layouts('/dd-layouts-cells/');
}*/
if( class_exists( 'WPDD_Layouts' ) && !function_exists( 'include_ddl_layouts' ) ) {
	function include_ddl_layouts( $tpls_dir = '' ) {
		$dir_str = dirname(__FILE__) . $tpls_dir;
		$dir = opendir( $dir_str );
		while( ( $currentFile = readdir($dir) ) !== false ) {
			if ( is_file($dir_str.$currentFile) ) {
				include $dir_str.$currentFile; 
			}
			
		}
			closedir($dir); 
		}
	include_ddl_layouts('/dd-layouts-cells/'); 
}

// Import layouts
// We don't include embedded layouts in the minimal version right now.
// We'll check for the plugin version and then import the theme functions.

if ( defined('WPDDL_VERSION') ) {

	require_once WPDDL_ABSPATH . '/ddl-theme.php';

	// Add theme export menu.
	require_once WPDDL_ABSPATH . '/theme/wpddl.theme-support.class.php';
}

if ( class_exists('WPDD_Layouts') && function_exists('ddl_import_layouts_from_theme_dir') ) {

	function import_layouts() {
		global $wpddlayout;

		if ( ! $wpddlayout->upload_options->get_options('upload_options') ) {

			ddl_import_layouts_from_theme_dir();
			$wpddlayout->upload_options->update_options('upload_options', 'yes');
		}
	}
	add_action( 'init', 'import_layouts', 99 );


	function reset_ddl_layout_options() {
		global $wpddlayout;
		$wpddlayout->upload_options->delete_options('upload_options');
	}
	
	add_action( 'switch_theme', 'reset_ddl_layout_options' );
	
	ddlayout_set_framework ('bootstrap-3');

}

// Declare Bootstrap version the theme is built with
if( function_exists('ddlayout_set_framework'))
{
	ddlayout_set_framework('bootstrap-3');
}

if( function_exists('add_ddl_support')) {
	// Add support for the Post Content and Post Loop cells
	add_ddl_support('post-content-cell');
	add_ddl_support('post-loop-cell');
}
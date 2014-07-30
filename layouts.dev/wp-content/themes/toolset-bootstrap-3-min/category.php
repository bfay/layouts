<?php
/**
 * The template for displaying Categories.
 *
 */

function wp_bootstrap_category_loop() {
	
	    if ( have_posts() ) {

			if ( wpbootstrap_get_setting( 'titles_settings', 'display_categories_header' ) ) {
				?>

				<h1 class="category-title">
					<?php printf( __( 'Category:', 'wpbootstrap' ) . ' %s', single_cat_title( '', false ) ); ?>
				</h1>

				<?php
			}

			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;

			wpbootstrap_content_nav();
		}
	}

get_header( 'layouts' ); ?>

    <?php if ( function_exists( 'the_ddlayout' ) ) : ?>

    	 <?php the_ddlayout( '', array('post-loop-callback' => 'wp_bootstrap_category_loop') ); 
   		else: ?>

        <h1>
        	<?php _e('This template requires the Drag and Drop Layout plugin.', 'wpbootstrap'); ?>
        </h1>

    <?php endif; ?>

<?php get_footer( 'layouts' );?>
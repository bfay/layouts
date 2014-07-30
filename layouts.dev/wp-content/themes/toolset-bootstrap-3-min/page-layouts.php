<?php
/**
 * Template Name: Layouts page template
 * 
 */

function wp_bootstrap_content_output() {
    while ( have_posts() ) : the_post();
        get_template_part( 'content', 'page' );
    endwhile;
}

get_header( 'layouts' ); ?>

    <?php if ( function_exists( 'the_ddlayout' ) ) : ?>

    	<?php the_ddlayout( 'page-layout', array('post-content-callback' => 'wp_bootstrap_content_output') ); // Loads 'page-layout' layout by default ?>

    <?php else: ?>

        <h1>
        	<?php _e('This template requires the Drag and Drop Layout plugin.', 'wpbootstrap'); ?>
        </h1>

    <?php endif; ?>

<?php get_footer( 'layouts' );
?>
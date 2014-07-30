<?php
/**
 * The 404 page not found template
 * 
 */

get_header( 'layouts' ); ?>

    <?php if ( function_exists( 'the_ddlayout' ) ) : ?>

    	 <?php the_ddlayout( '404-page-layout', array('post-loop-callback' => 'wp_bootstrap_content_output') ); // Loads '404-page-layout' layout by default ?>

    <?php else: ?>

        <h1>
        	<?php _e('This template requires the Drag and Drop Layout plugin.', 'wpbootstrap'); ?>
        </h1>

    <?php endif; ?>

<?php get_footer( 'layouts' );

function wp_bootstrap_content_output() {
	
    while ( have_posts() ) : the_post();
     
       		get_template_part( 'content', get_post_format() );
       
     endwhile;

}
?>

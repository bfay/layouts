<?php
/**
 * The main template
 * 
 */

function wp_bootstrap_index_loop() {
    
    while ( have_posts() ) : the_post();
     
            get_template_part( 'content', get_post_format() );
       
     endwhile;

     wpbootstrap_content_nav();
}

get_header( 'layouts' ); ?>

    <?php if ( function_exists( 'the_ddlayout' ) ) : ?>

    	 <?php the_ddlayout( 'home', array('post-loop-callback' => 'wp_bootstrap_index_loop') ); // Loads 'home' layout by default ?>

    <?php else: ?>

        <h1>
        	<?php _e('This template requires the Drag and Drop Layout plugin.', 'wpbootstrap'); ?>
        </h1>

    <?php endif; ?>

<?php get_footer( 'layouts' );?>

<?php
/**
 * The Template for displaying all single posts.
 * Layouts supported.
 *
 */

if ( defined( 'WPDDL_VERSION' ) && is_ddlayout_assigned() ) {			// Layouts activated

	function wp_bootstrap_content_output() {
		while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );
		endwhile;
	}

	get_header( 'layouts' );
	the_ddlayout( 'post-layout', array('post-content-callback' => 'wp_bootstrap_content_output') );
	get_footer( 'layouts' );


} else {									// Layouts deactivated

	get_header();

	while ( have_posts() ) : the_post();

		get_template_part( 'content', get_post_format() );
	endwhile;

	get_footer();

}
<?php
/**
 * The template for displaying tag archive page
 *
 */

function wp_bootstrap_tag_loop() {
 if ( have_posts() ) : ?>

	<?php if ( wpbootstrap_get_setting( 'titles_settings', 'display_tags_header' ) ) : ?>
		<header class="page-header">
			<h1 class="tag-title">
				<?php printf( __( 'Tag:', 'wpbootstrap' ) . ' %s', single_tag_title( '', false ) ); ?>
			</h1>
		</header>
	<?php endif; ?>

	<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );
		endwhile;
		wpbootstrap_content_nav();
	?>

<?php endif;

}

get_header( 'layouts' ); ?>

    <?php if ( function_exists( 'the_ddlayout' ) ) : ?>

    	 <?php the_ddlayout( '', array('post-loop-callback' => 'wp_bootstrap_tag_loop') ); // Loads 'two-columns' layout by default ?>

    <?php else: ?>

        <h1>
        	<?php _e('This template requires the Drag and Drop Layout plugin.', 'wpbootstrap'); ?>
        </h1>

    <?php endif; ?>

<?php get_footer( 'layouts' );
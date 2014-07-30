<?php
/**
 * The template for displaying Search results.
 *
 */


function wp_bootstrap_search_loop() {
 if ( wpbootstrap_get_setting( 'titles_settings', 'display_search_header' ) ) : ?>
	<header class="page-header">
		<h1>
			<?php printf( __( 'Search Results for: ', 'wpbootstrap' ) . ' %s', '<span>' . get_search_query() . '</span>' ); ?>
		</h1>
	</header>
<?php endif; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'content' ); ?>
	<?php endwhile; ?>

	<?php wpbootstrap_content_nav(); ?>

	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<div class="entry-content">
				<div class="alert alert-warning alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php _e( 'No results were found for: "<strong>' . get_search_query() . '"</strong>', 'wpbootstrap' ); ?>
				</div>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- .post .no-results -->

	<?php endif;
}

get_header( 'layouts' ); ?>

    <?php if ( function_exists( 'the_ddlayout' ) ) : ?>

    	 <?php the_ddlayout( '', array('post-loop-callback' => 'wp_bootstrap_search_loop') ); // Loads 'two-columns' layout by default ?>

    <?php else: ?>

        <h1>
        	<?php _e('This template requires the Drag and Drop Layout plugin.', 'wpbootstrap'); ?>
        </h1>

    <?php endif; ?>

<?php get_footer( 'layouts' );


<?php
/**
 * The template for displaying Archives.
 *
 */

function wp_bootstrap_archive_loop() {
	
	    if ( have_posts() ) : ?>

		<?php if ( wpbootstrap_get_setting('titles_settings', 'display_archives_header') ): ?>
			<h1 class="archive-title">
				<?php
					if ( is_day() ) :
						printf( __( 'Daily Archives:', 'wpbootstrap' ) . ' %s', get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives:', 'wpbootstrap' ) . ' %s', date_i18n('F Y', get_post_time()) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives:', 'wpbootstrap' ) . ' %s', date_i18n('Y', get_post_time()) );
					else :
						_e( 'Archives', 'wpbootstrap' );
					endif;
				?>
			</h1>
		<?php endif; ?>

		<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format() );
			endwhile;
			wpbootstrap_content_nav();
		

		endif;
	}

get_header( 'layouts' ); ?>

    <?php if ( function_exists( 'the_ddlayout' ) ) : ?>

    	 <?php the_ddlayout( '', array('post-loop-callback' => 'wp_bootstrap_archive_loop') ); 
      else: ?>

        <h1>
        	<?php _e('This template requires the Drag and Drop Layout plugin.', 'wpbootstrap'); ?>
        </h1>

    <?php endif; ?>

<?php get_footer( 'layouts' );?>
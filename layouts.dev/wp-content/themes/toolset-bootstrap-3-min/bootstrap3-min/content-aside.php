<?php
/**
 * The template for displaying posts in the Aside post format
 *
 */
?>

<article id="post-<?php the_ID(); ?>"<?php post_class( 'clearfix' ) ?> >

	<header>
		<?php if ( !is_single() ) : ?>
			<?php
			if ( ( wpbootstrap_get_setting( 'titles_settings', 'display_categories_post_titles' ) && is_category() )
					|| ( wpbootstrap_get_setting( 'titles_settings', 'display_tags_post_titles' ) && is_tag() )
					|| ( wpbootstrap_get_setting( 'titles_settings', 'display_archives_post_titles' ) && is_archive() && (!is_tag() && !is_category() ) )
					|| ( wpbootstrap_get_setting( 'titles_settings', 'display_home_post_titles' ) && is_home() ) ) :
				?>
				<h2 class="entry-title">
					<a href="<?php the_permalink() ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to', 'wpbootstrap' ) . ' %s', the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>
	<?php endif; ?>
		<?php endif; ?>
		<?php get_template_part( 'entry-meta' ); ?>
	</header>

	<div class="entry-content well well-lg">
<?php the_content( '<span class="btn btn-sm btn-info pull-right">' . __( 'Read more', 'wpbootstrap' ) . '&raquo;</span>' ); ?>
	</div><!-- .entry-content -->
	<div class="entry-footer">
<?php edit_post_link( __( 'Edit page', 'wpbootstrap' ), '<p class="btn btn-sm btn-default">', '</p>' ); ?>
	</div><!-- .entry-footer -->

<?php wpbootstrap_link_pages(); ?>
</article><!-- #post-## -->
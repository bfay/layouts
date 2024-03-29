<?php
/**
 * The template for displaying posts in the Gallery post format
 *
 */
?>

<article <?php post_class( 'clearfix' ) ?> id="post-<?php the_ID(); ?>">

	<?php if ( is_single() ) : ?>
	<header class="page-header">
		<?php if ( wpbootstrap_get_setting( 'titles_settings', 'display_single_post_titles' ) ) : ?>
		<h1>
			<?php the_title(); ?>
		</h1>
		<?php endif; ?>
		<?php else : ?>
			<?php
			if (
				// for categories
				( wpbootstrap_get_setting( 'titles_settings', 'display_categories_post_titles' ) && is_category() ) ||
				// for tags
				( wpbootstrap_get_setting( 'titles_settings', 'display_tags_post_titles' ) && is_tag() ) ||
				// for archives. There is an additional condition needed because is_archive() returns true not only for archives but for tags and categories as well
				( wpbootstrap_get_setting( 'titles_settings', 'display_archives_post_titles' ) && is_archive() && ( ! is_tag() && ! is_category() ) ) ||
				// for homepage blog index
				( wpbootstrap_get_setting( 'titles_settings', 'display_home_post_titles' ) && is_home() )
			) :
			?>
		<header>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to', 'wpbootstrap' ) . ' %s', the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php endif; ?>
		<?php endif; ?>
		<?php get_template_part( 'entry-meta' ); ?>
	</header>

	<div class="entry-content">
		<?php the_content( '<span class="btn btn-sm btn-primary pull-right">' . __( 'Read more', 'wpbootstrap' ) . '&raquo;</span>' ); ?>
		<?php edit_post_link( __( 'Edit page', 'wpbootstrap' ), '<p class="btn btn-sm btn-default">', '</p>' ); ?>
	</div><!-- .entry-content -->

<?php wpbootstrap_link_pages(); ?>
</article>
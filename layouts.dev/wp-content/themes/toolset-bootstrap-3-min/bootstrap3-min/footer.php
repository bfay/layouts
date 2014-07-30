<?php
/**
 * The template for displaying the footer.
 *
 */
?>
			</section><!-- #content -->
		</div><!-- #main -->

		<?php
		do_action( 'wpbootstrap_before_footer' );
		do_action( 'wpbootstrap_after_footer' );
		?>

	</div><!-- .container -->

	<?php
	do_action( 'wpbootstrap_before_wp_footer' );
	wp_footer();
	do_action( 'wpbootstrap_after_wp_footer' );
	?>

	</body>
</html>
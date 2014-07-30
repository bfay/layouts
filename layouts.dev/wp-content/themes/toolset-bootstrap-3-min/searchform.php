<?php
/**
 * The template for displaying Search form.
 *
 */
?>

<form id="searchform" class="form-inline" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<div class="form-group">
		<label class="sr-only" for="s"><?php _e('Search for:', 'wpbootstrap') ?></label>
		<input type="search" name="s" id="s" class="form-control">
	</div>
	<button type="submit" class="btn btn-default"><?php _e('Search', 'wpbootstrap') ?></button>
</form><!-- #searchform -->
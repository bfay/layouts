<nav class="<?php echo wpbootstrap_get_nav_menu_classes(); ?>" role="navigation">
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only"><?php _e('Toggle navigation', 'wpbootstrap'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php if ( of_get_option('navbar_title') ) : ?>
				<a class="navbar-brand" href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<div class="collapse navbar-collapse" id="nav-main">

			<?php
				wp_nav_menu(array(
					'theme_location' => 'header-menu',
					'depth'          => 3,
					'menu_class'     => 'nav navbar-nav',
					'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
					'walker'         => new Wpbootstrap_Nav_Walker(),
				));
			?><!-- #nav-main -->

			<?php if ( of_get_option('navbar_search') ) : ?>
				<form class="navbar-form navbar-right" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
					<div class="form-group">
						<input type="text" name="s" id="s" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default"><?php _e('Search', 'wpbootstrap'); ?></button>
				</form>
			<?php endif; ?>

		</div><!-- .navbar-collapse -->
	</div><!-- .container -->
</nav><!-- .navbar -->
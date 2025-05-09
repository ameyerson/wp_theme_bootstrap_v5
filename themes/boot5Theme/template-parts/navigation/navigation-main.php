<?php

	$header_logo = get_field('theme_logo', 'option');
	if ($header_logo) {
		$img_src = wp_get_attachment_image_url($header_logo, 'large_thumbnail', false);
		$img_alt = get_post_meta($header_logo , '_wp_attachment_image_alt', true) ? get_post_meta($header_logo , '_wp_attachment_image_alt', true) : get_bloginfo('name');
	}

?>

<a class="visually-hidden-focusable" href="#content">Skip to main content</a>

<nav class="navbar navbar-expand-md">

	<div class="container">

		<a class="navbar-brand" href="<?php echo get_home_url(); ?>">

			<?php if ($header_logo) : ?>

				<img src="<?php echo $img_src ?>" alt="<?php echo $img_alt ?>" width="300">

			<?php else: ?>

				<span class="h2"><?php echo get_bloginfo('name'); ?></span>

			<?php endif; ?>

		</a>
		
		<!-- TOGGLE BUTTON -->
		<button class="navbar-toggler collapsed hidden-print" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">

		  	<div></div>

		</button>


		<div id="main-nav" class="collapse navbar-collapse hidden-print">

			<?php
			    wp_nav_menu( array(
			        'theme_location'   		=> 'header-nav',
			        'depth'             	=> 2,
			        'container'         	=> false,
			        'menu_class'        	=> 'navbar-nav ms-auto mb-2 mb-md-0',
			        'fallback_cb' 			=> '__return_false',
			        'walker'            	=> new theme_Main_Navwalker()
			    	)
			    );
			?>

		</div>
	</div>

</nav>
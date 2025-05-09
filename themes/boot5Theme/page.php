<?php get_header(); ?>

<?php if (function_exists('theme_breadcrumbs')) {
	theme_breadcrumbs(); 
} ?>

	<article class="page">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

						<?php if (get_the_content() !== '') : ?>
								
						<!-- main editor content -->

						<section id="main-content" class="page-section bkg-white">

							<div class="container">

						<?php 

							the_content();

						?>

							</div>

						</section>
						<?php endif; //(get_the_content() !== '') : ?>

						<!-- Page Layouts -->
						<?php
						    if( have_rows('layout') ):

						        // Loop through rows.
						        while ( have_rows('layout') ) : the_row();
						            $layout = get_row_layout();

						            get_template_part( 'template-parts/components/content', $layout ); 
						            // var_dump($layout);

						        // End loop.
						        endwhile;

						    else :
						        // Do something...
						    endif;
						?>

				<?php endwhile;
			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif; ?>

	</article>

<?php get_footer(); ?>
<?php get_header(); ?>

<?php if (function_exists('theme_breadcrumbs')) {
	theme_breadcrumbs(); 
} ?>

	<div class="container">


	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


			<div class="row gx-4">

				<div class="col-lg-9 col-xl-9">

					<article class="page has-sidebar">

						<h1 class="page-header section-title"><?php the_title();?></h1>

						<?php if (function_exists('usaaef_post_meta')) {
							usaaef_post_meta(); 
						} ?>

						<section id="main-content" class="page-section">
						
							<?php the_content('Read More...'); ?>

						</section>
									
					</article>

					<aside>
					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					?>
					</aside>

					<?php if (function_exists('theme_post_navigation')) {
						theme_post_navigation();
					} ?>

				</div>

				<div class="col-lg-3 col-xl-3 mt-2">
				
					<?php get_sidebar(); ?>

				</div>

			</div>

		<?php endwhile; ?>

	<?php else :

		get_template_part( 'template-parts/post/content', 'none' );

	endif; ?>


	</div>


<?php get_footer(); ?>
<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage bootstrap5 theme
 * @since 1.0
 * @version 1.0
 */
global $wp_query;
get_header(); ?>

	<?php if (function_exists('theme_breadcrumbs')) {
		theme_breadcrumbs(); 
	} ?>


		<div class="container">

		<?php if ( have_posts() ) : ?>

			<div class="row gx-4">

				<div class="col-lg-8 col-xl-9 order-2 order-lg-1">

					<div class="page has-sidebar">

						<section id="article-header">

								<header class="page">

									<h1 class="page-title section-title">Posts</h1>
																
								</header>
															
						</section>
						<section id="posts-list" class="page-section pt-2">

					<?php while ( have_posts() ) : the_post(); ?>

							<?php 

								get_template_part( 'template-parts/post/content' );

							?>

					<?php endwhile; ?>
						</section>

						<section id="tax-pager" class="page-section p-0">

							<div class="container">

								<?php

									the_posts_pagination( array(
										'prev_text' 			=> '<i class="fa-solid fa-angle-left"></i>',
										'next_text' 			=> '<i class="fa-solid fa-angle-right"></i>',
										'aria_label'			=>  single_post_title('', false),
										'screen_reader_text'	=>  single_post_title('', false) . ' navigation'
									) );

								?>

							</div>

						</section>

					</div>

				</div>

			</div>

		<?php else : ?>

			<?php get_template_part( 'template-parts/post/content', 'none' ); ?>

		<?php endif; ?>

		</div>

<?php get_footer(); ?>


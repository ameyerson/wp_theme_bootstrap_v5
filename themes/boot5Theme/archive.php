<?php
/**
 * The template for displaying archive pages
 *
 */

global $wp_query;

get_header(); ?>

	<?php if (function_exists('usaaef_breadcrumbs')) {
		usaaef_breadcrumbs(); 
	} ?>

		<div class="container">

		<?php if ( have_posts() ) : ?>

			<div class="row gx-4">

				<div class="col-lg-8 col-xl-9 order-2 order-lg-1">

					<div class="page has-sidebar">

						<section id="article-header">

							<header class="page-header">
								<?php the_archive_title( '<h1 class="page-title section-title">', '</h1>' ); ?>
							</header><!-- .page-header -->

							<?php
								the_archive_description( '<div class="taxonomy-description">', '</div>' );
							?>

						</section>
						<section id="posts-list" class="page-section pt-2">

					<?php while ( have_posts() ) : the_post(); ?>

							<?php 

								get_template_part( 'template-parts/post/content' );

							?>

					<?php endwhile; ?>
						</section>

					<?php if ($wp_query->max_num_pages > 1) : ?>

						<section id="tax-pager" class="page-section p-0">

							<div class="container">

								<?php

									the_posts_pagination( array(
										'prev_text' 			=> '<i class="las la-angle-left"></i>',
										'next_text' 			=> '<i class="las la-angle-right"></i>',
										'aria_label'			=>  single_post_title('', false),
										'screen_reader_text'	=>  single_post_title('', false) . ' navigation'
									) );

								?>

							</div>

						</section>

					<?php endif; //($wp_query->max_num_pages > 1) ?>

						<section id="tax-pages" class="page-section">

							<?php

								$page = get_query_var('paged');
								$total = $wp_query->found_posts;
								$offset = (get_query_var('paged')) ? get_query_var('paged') - 1 : 0;

								$first = 1 + get_option( 'posts_per_page' ) * ($offset);
								$last = (($first + get_option( 'posts_per_page' ) - 1) < $total) ? $first + get_option( 'posts_per_page' ) - 1 : $total;

								echo 'Showing ' . $first;
								echo ($last !== $first) ? ' - ' . $last : '';
								echo ' of ' . $total;

							?>

						</section>

					</div>

				</div>


				<div class="col-lg-4 col-xl-3 order-1 order-lg-2">
					<?php 
						$sidebartype = false;
						if (is_home() || is_category()) $sidebartype = 'blog';
						if (is_tag()) $sidebartype = 'tag';
						if (is_date()) $sidebartype = 'date';
						if (is_author()) $sidebartype = 'author';
				
					if ($sidebartype) get_template_part( 'template-parts/post/sidebar', $sidebartype);  ?>

				</div>

			</div>

		<?php else : ?>
			
			<?php get_template_part( 'template-parts/post/content', 'none' ); ?>

		<?php endif; ?>

		</div>

<?php get_footer(); ?>

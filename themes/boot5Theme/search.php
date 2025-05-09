<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 */

global $wp_query;

$unique_id = 'search-form-' . bin2hex(random_bytes(2));
?>

	<?php if (function_exists('theme_breadcrumbs')) {
		theme_breadcrumbs(); 
	} ?>

	<section id="article-header" class="page-section">

		<div class="container">

			<div class="row gx-4">

				<div class="col-lg-8">

					<header class="page">

						<h1 class="page-title">Search Results</h1>

						<form role="search" id="<?php echo $unique_id; ?>" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

							<label for="<?php echo $unique_id; ?>-input">Search</label>

							<div class="d-flex">
						        <input type="search" id="<?php echo $unique_id; ?>-input"class="search-field" placeholder="What can we help you find?" value="<?php echo get_search_query(); ?>" name="s" />

						    	<button type="submit" class="search-submit ms-lg-4">
						            <span class="d-none d-lg-block">Search</span><i class="las la-search ms-lg-2"></i>
						        </button>
						    </div>

						    <div class="d-md-flex w-100 align-items-start justify-content-between">

						        <div class="search-results-label">
					        	<?php

					        		$total = $wp_query->found_posts;

					        		echo '<strong>' . $total . '</strong>&nbsp;result';
					        		echo ($total > 1) ? 's' : ''; 
					        		if (get_search_query() !== '') echo '&nbsp;for \'' . get_search_query() . '\'';
					        	?>

						        </div>

						    </div><!-- /.d-flex -->


						</form>
													
					</header>

				</div>

			</div>

		</div>
														
	</section>

<div class="container">

	<div class="row gx-4">

		<div class="col-lg-8">

	<?php if ( have_posts() ) : ?>

			<section id="posts-list" class="page-section">

		<?php while ( have_posts() ) : the_post(); 	?>

				<article id="post-<?php the_ID(); ?>">

					<div class="article-inner">

						<header class="entry-header">

							<?php

								$title = theme_emphasize( get_the_title(), get_search_query() );

								echo sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">%s', esc_url( get_permalink() ), $title ) . '</a></h3>';

							?>
						</header><!-- .entry-header -->

						<div class="entry-content">

							<?php 

								the_excerpt('Read More...'); 
							?>

						</div><!-- .entry-content -->

					</div>

				</article><!-- #post-<?php the_ID(); ?> -->

		<?php endwhile; ?>

			</section>

		<?php if ($wp_query->max_num_pages > 1) : ?>

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
					echo ' of ' . $total . '      result';
					if ($total > 1) echo 's';
					if (get_search_query() !== '') echo '&nbsp;for \'' . get_search_query() . '\'';

				?>

			</section>

		<?php else : ?>

			<section id="main-content" class="page-section">

				<p>No results found.</p>

				<div class="spacer-section page-section bkg-white" role="presentation"></div>

			</section>

		<?php endif; ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>


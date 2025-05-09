<?php
/**
 * Template part for displaying posts on archive
 *
 */

	global $post;

	$img_alt = $post->post_title;
	$thumbnail = get_post_thumbnail_id($post->ID) ?: false;
	if (!$thumbnail) {
		$img_src = get_stylesheet_directory_uri() . '/assets/images/image-placeholder.jpg';
	}
	if ($thumbnail) {
		$img_src = wp_get_attachment_image_url($thumbnail, 'medium', false);
		$img_alt = get_post_meta($thumbnail , '_wp_attachment_image_alt', true) ?: $post->post_title;
	}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="row">

		<div class="col-md-4">

			<a href="<?php echo get_permalink(); ?>" class="image-wrapper" rel="bookmark"><img src="<?php echo $img_src; ?>" class="archive-thumbnail" width=275 height=185 alt="<?php echo $img_alt; ?>" /></a>

		</div>

		<div class="col-md-8">
			<header class="entry-header">

				<?php

					the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					echo '<div class= "date">' . get_the_time('l F d, Y') . '</div>';
				?>
			</header><!-- .entry-header -->

			<div class="entry-content">

				<?php 

					the_excerpt('Read More...'); 
				?>

			</div><!-- .entry-content -->

		</div>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->

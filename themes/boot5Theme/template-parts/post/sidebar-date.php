<?php 

	$icon = get_field('home_sidebar_icon', 'option');
	if ($icon) {
		$img_src = wp_get_attachment_image_url($icon, 'thumbnail', false);
		$img_alt = get_post_meta($icon , '_wp_attachment_image_alt', true) ?: single_post_title('', false);
	}

?>

<aside id="secondary" class="blog-sidebar dropdown-sidebar" aria-label="Life Event Sidebar">

  	<a class="h3 expanded" href="#" role="button" id="CategoryLink" data aria-expanded="true" >
    	<?php if ($icon) : ?>
    		<img src="<?php echo $img_src; ?>" height="30" width="30" alt="<?php echo $img_alt; ?>" />
    	<?php endif; ?> Dates
  	</a>

	<ul class="list-unstyled sidebar-dropdown" id="category-nav" aria-labelledby="CategoryLink">

		<?php get_calendar(); ?>

	</ul>

</aside><!-- #secondary -->
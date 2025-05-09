<?php

	$social_links = get_field('footer-social-link', 'option'); 


	if ($social_links && (count($social_links) > 0)) : //var_dump($social_links); 

?>


<ul class="footer-social-content icon-text-list">

	<li><span class="h5">Follow Us</span></li> 

	<?php foreach ($social_links as $link) : ?>

	<li class="list-group-item">
		<a href="<?php echo $link['link_url'] ?>" class="d-flex align-items-center" target="_blank" rel="noopener noreferrer">
			<i class="<?php echo $link['icon'] ?>" aria-label="<?php echo $link['link_text'] ?> logo"></i>
			<span><?php echo $link['link_text'] ?></span>
		</a>
	</li>

	<?php endforeach; ?>

</ul>


<?php endif; ?>
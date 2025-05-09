<?php get_template_part( 'template-parts/header/header', 'top' ); ?> 

<?php
	global $post;

	$extra_classes = array();
	$extra_classes = implode(' ',$extra_classes);

	$data_scrollspy = (true) ? 'data-bs-spy="scroll" data-bs-target="#main" data-bs-rootMargin="-50%"' : false;

?>

<body <?php body_class($extra_classes); echo ($data_scrollspy) ?: ''; ?>>

<!-- Google Tag Manager (noscript) -->

	<div id="page" class="site">

		<header id="global-header">

			<div class="navigation-top">

				<?php get_template_part( 'template-parts/navigation/navigation', 'main' ); ?>

			</div><!-- .navigation-top -->

		</header>


		<div id="content" class="site-content">

			<main class="global">

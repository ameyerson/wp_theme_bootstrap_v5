<?php if ( is_active_sidebar( 'sidebar-widgets' )  ) : ?>
	<aside id="secondary" class="sidebar widget-area hidden-print" role="complementary">
		<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
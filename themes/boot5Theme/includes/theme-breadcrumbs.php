<?php
/**
 * Breadcrumbs
 * 
**/

if ( ! function_exists( 'get_theme_breadcrumbs' ) && ! is_admin() ) { 

	function get_theme_breadcrumbs( $args = array() ) {

		$args = wp_parse_args( $args, array(
				'breadcrumb_class'	=> 'breadcrumb',
				'active_class'		=> 'active',
				'home_text' 		=> '<i class="fas fa-home"><span class="visually-hidden-focusable">Home</span></i>',
				'category_text' 	=> 'Archives for %s',
				'tag_text' 			=> 'Posts tagged %s',
				'author_text' 		=> 'Posted by %s',
				'search_text' 		=> 'Search results for \'%s\'',
				'paged_text' 		=> 'Page %s',
				'404_text' 			=> 'Error 404',
				'link_structure'	=> '<li class="breadcrumb-item"><a href="%1$s">%2$s</a></li>',
				'current_structure'	=> '<li class="breadcrumb-item active">%s</li>'
				
		) );

		// Get the query & post information
		global $post;
		wp_reset_query();

		// Do not display on the homepage
		if ( !is_front_page() ) {

			// Build the breadcrumbs
			$markup = '<div class="breadcrumb-wrapper hidden-print">';
			$markup .= '<div class="container">';
			$markup .= '<ol class="' . $args['breadcrumb_class'] . '">';

			//Home page
			$markup .= '<li class="breadcrumb-item"><a href="' . get_home_url() . '">' . $args['home_text'] . '</a></li>';

			
			//category archive
			if ( is_category() ) { 

				$markup .= sprintf($args['link_structure'],get_permalink( get_option('page_for_posts' )), get_the_title(get_option('page_for_posts' )));

				$cat = get_queried_object();

				if ($cat->parent != 0) {
					$parent_cats = get_category_parents($cat->parent, TRUE, '');
					$parent_cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', '<li class="breadcrumb-item"><a$1>$2</a></li>', $parent_cats);
					$markup .= $parent_cats;
				}
				if ( get_query_var('paged') ) {
					$markup .= sprintf($args['link_structure'], get_category_link($cat->term_id), $cat->name) . sprintf($args['current_structure'], sprintf($args['paged_text'], get_query_var('paged')));
				} else {
					$markup .= sprintf($args['current_structure'], sprintf($args['category_text'], single_cat_title('', false)));
				}

			//tag archives
			} else if ( is_tag() ) { 

				$markup .= sprintf($args['link_structure'],get_permalink( get_option('page_for_posts' )), get_the_title(get_option('page_for_posts' )));

				$tag = get_queried_object();

				if ( get_query_var('paged') ) {
					$markup .= sprintf($args['link_structure'], get_tag_link($tag->term_id), $tag->name) . sprintf($args['current_structure'], sprintf($args['paged_text'], get_query_var('paged')));
				} else {
					$markup .= sprintf($args['current_structure'], sprintf($args['tag_text'], $tag->name));
				}

			//author
			} else if ( is_author() ) {

				$markup .= sprintf($args['link_structure'],get_permalink( get_option('page_for_posts' )), get_the_title(get_option('page_for_posts' )));

				$author = get_queried_object();
				if ( get_query_var('paged') ) {
					$markup .= sprintf($args['link_structure'], get_author_posts_url($author->ID), $author->display_name) . sprintf($args['current_structure'], sprintf($args['paged_text'], get_query_var('paged')));
				} else {
					$markup .= sprintf($args['current_structure'], sprintf($args['author_text'], $author->display_name));
				}

			//404
			} else if ( is_404() ) {

				$markup .= sprintf($args['current_structure'], $args['404_text']);

			//search
			} else if ( is_search() ) {

				if ( get_query_var('paged') ) {
					$markup .= sprintf($args['link_structure'], '/?s=' . urlencode(get_search_query()), sprintf($args['search_text'], get_search_query())) . sprintf($args['current_structure'], sprintf($args['paged_text'], get_query_var('paged')));
				} else {
					$markup .= sprintf($args['current_structure'], sprintf($args['search_text'], get_search_query()));
				}

			//dates
			} else if ( is_day() ) {

				$markup .= sprintf($args['link_structure'],get_permalink( get_option('page_for_posts' )), get_the_title(get_option('page_for_posts' )));

				$markup .= sprintf($args['link_structure'], get_year_link(get_the_time('Y')), get_the_time('Y'));
				$markup .= sprintf($args['link_structure'], get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
				$markup .= sprintf($args['current_structure'], get_the_time('d'));

			} else if ( is_month() ) {

				$markup .= sprintf($args['link_structure'],get_permalink( get_option('page_for_posts' )), get_the_title(get_option('page_for_posts' )));

				$markup .= sprintf($args['link_structure'], get_year_link(get_the_time('Y')), get_the_time('Y'));
				$markup .= sprintf($args['current_structure'], get_the_time('F'));

			} else if ( is_year() ) {

				$markup .= sprintf($args['link_structure'],get_permalink( get_option('page_for_posts' )), get_the_title(get_option('page_for_posts' )));

				$markup .= sprintf($args['current_structure'], get_the_time('Y'));

			//single	
			} else if ( is_single() && !is_attachment() ) {

				if ( get_post_type() != 'post' ) { 
					$post_type = get_post_type_object(get_post_type());
					
					if ($post_type->name == 'resource') {

						//resource single

						$markup .= sprintf($args['link_structure'], '/tools/', "Tools");
						$resource_type = get_the_terms(get_the_ID(), 'resource_type')[0];
						$label = get_field('plural_label', $resource_type) ?: $resource_type->name . 's';
						$slug = 'tools/' . $resource_type->slug;
						$markup .= sprintf($args['link_structure'], home_url('/'). $slug . '/', $label);
						// $label = $resource_type->name;
					} else { 

						//custom post type single
						
						$slug = $post_type->rewrite['slug'];
						$label = $post_type->label;
						$markup .= sprintf($args['link_structure'], home_url('/'). $slug . '/', $label);
					}

					$markup .= sprintf($args['current_structure'], get_the_title());

				} else {
					//single post
					if ( get_option( 'show_on_front' ) == 'page' ) {
						if (get_option('page_for_posts' )) {

							$markup .= sprintf($args['link_structure'],get_permalink( get_option('page_for_posts' )), get_the_title(get_option('page_for_posts' )));
						}
					}

					$markup .= sprintf($args['current_structure'], get_the_title());
				}

			//index page
			}  else if (is_home()) {

				if ( get_query_var('paged') ) {

					$markup .= sprintf($args['link_structure'],get_permalink( get_option('page_for_posts' )), get_the_title(get_option('page_for_posts' ))) . sprintf($args['current_structure'], sprintf($args['paged_text'], get_query_var('paged')));

				} else {

					$markup .= sprintf($args['current_structure'], get_the_title(get_option('page_for_posts' )));
				}

			} else if ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {  

				//custom post type archive
				$term_object = get_queried_object();
				$label = $post_type->label;
				$archive = get_post_type_archive_link($post_type->name);


				if ( get_query_var('paged') ) {
					$markup .= sprintf($args['link_structure'], $archive, $label) . sprintf($args['current_structure'], sprintf($args['paged_text'], get_query_var('paged')));
				} else {
					$markup .= sprintf($args['current_structure'], $label);
				}

			} else if ( is_page() && !($post->post_parent) ) {

				$markup .= sprintf($args['current_structure'], get_the_title());

			} else if ( is_page() && $post->post_parent ) {

				$parent_id = $post->post_parent;

				if ($parent_id != get_option('page_on_front')) {

					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						if ($parent_id != get_option('page_on_front')) {

							$breadcrumbs[] = sprintf($args['link_structure'], get_permalink($page->ID), get_the_title($page->ID));
							
						}
						$parent_id = $page->post_parent;
					}
					
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						$markup .= $breadcrumbs[$i];
					}
				}

				$markup .= sprintf($args['current_structure'], get_the_title());

			}	

			$markup .= '</ol></div></div>';
			return $markup;
		}
	}
}

if ( ! function_exists( 'theme_breadcrumbs' ) && ! is_admin() ) {

	function theme_breadcrumbs( $args = array() ) {

		echo get_theme_breadcrumbs( $args );

	}
}
<?php

/**
 * Post Navigation
 * Previous and next post link
**/

if ( ! function_exists( 'get_theme_post_navigation' ) && ! is_admin() ) {

	function get_theme_post_navigation( $args = array() ) {

		$args = wp_parse_args( $args, array(
				'prev_text'          => '%title',
				'next_text'          => '%title',
				'wrapper_class'		 =>  'pager',
				'screen_reader_text' => 'Post navigation',
		) );

		$navigation = '';
		$previous   = get_previous_post_link( '%link', $args['prev_text'] );
		$next       = get_next_post_link( '%link', $args['next_text'] );

	 
		// Only add markup if there's somewhere to navigate to.
		if ( $previous || $next ) {
			$navigation = '<nav class="posts-navigation hidden-print"><h2 class="visually-hidden">'. $args['screen_reader_text'] . '</h2><ul class="d-flex flex-row justify-content-between align-items-center w-100 p-0 ' . $args['wrapper_class'] . '" style="list-style: none">';
			if ($previous) {
				$navigation .= '<li class="float-start w-50 pe-3 mb-0 d-flex align-items-center"><i class="fa-solid fa-angle-left pe-2"></i>' . $previous . '</li>';
			} else {
				$navigation .= '<li class="float-start w-50 pe-3 mb-0 d-flex align-items-center"></li>';
			}
			if ($next) {
				$navigation .= '<li class="float-end  w-50 ps-3 mb-0 d-flex d-flex align-items-center justify-content-end">' . $next . '<i class="fa-solid fa-angle-right ps-2"></i></li>';
			}
			$navigation .= '</ul></nav>';
		}
	 
		return $navigation;
	}

}
if ( ! function_exists( 'theme_post_navigation' ) && ! is_admin() ) {

	function theme_post_navigation( $args = array() ) {

		echo get_theme_post_navigation( $args );

	}
}

/**
 * Post Meta
 * 
**/
if ( ! function_exists( 'theme_post_meta' ) && ! is_admin() ) {

	function theme_post_meta( ) {

		global $post;

		$meta_markup = '<div>';
		$meta_markup .= 'by <a href="' . get_author_posts_url( $post->post_author) . '">' . get_user_by( 'ID', $post->post_author )->display_name . '</a>';
		$meta_markup .= ' on <span class= "date">' . get_the_time('l F d, Y') . '</span><br/>';

		$categories_list = get_the_category_list(', ' );
		$tags_list = get_the_tag_list('', ', ', '');

		if ( $categories_list ) {
			$meta_markup .= 'Posted in Category: ' . $categories_list;
		}

		if ($categories_list && $tags_list) {
			$meta_markup .= '<br/>';
		}

		if ( $tags_list ) {
			$meta_markup .= 'Tagged with : ' . $tags_list;
		}
		$meta_markup .= '</div>';

		echo $meta_markup;

	}
}


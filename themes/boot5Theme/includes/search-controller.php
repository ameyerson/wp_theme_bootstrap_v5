<?php

function theme_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'theme_search_join' );

function theme_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() && !(isset($filter_type))) { 
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'theme_search_where' );

function theme_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) { 
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'theme_search_distinct' );

/**
 * Adds emphasis to the parts passed in $content that are equal to $search_query.
 *
 * @param $content The content to alter.
 * @param $search_query The search query to match against.
 *
 * @return string The emphasized text.
 */

function string_length_longer_than_one_check($term) {
    return strlen($term) > 1;
}

function theme_emphasize( $content, $search_query ) {

    if ($search_query == '') {
        return $content;
    }
    $keys = array_map( 'preg_quote', explode(" ", $search_query ) );
    $keys = array_filter($keys, 'string_length_longer_than_one_check');
    return preg_replace( '/(' . implode('|', $keys ) .')/iu', '<strong class="search-excerpt">\0</strong>', $content );
}

/**
 * Creates a custom read more link.
 *
 * @return string The read more link.
 */
function modify_read_more_link() {
    return ' <a class="more-link" href="' . get_permalink() . '">Continue reading</a>';
}

/**
 * Allows for excerpt generation outside the loop.
 *
 * @param string $text  The text to be trimmed
 * @return string       The trimmed text
 */
function theme_trim_excerpt( $text = '' ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);

    $excerpt_length = apply_filters('excerpt_length', 30); 

    $trimmed = wp_trim_words( $text, $excerpt_length, '' );

    if(str_word_count($text) > $excerpt_length){
        $trimmed .= ' ...';
    }

    if ( is_search() ) {
        $trimmed = theme_emphasize( $trimmed, get_search_query() );
    }

    return $trimmed;
}
add_filter('wp_trim_excerpt', 'theme_trim_excerpt');
<?php

/**
* Theme setup
*/
function theme_setup() {

// Enable plugins to manage the document title
// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support( 'title-tag' );


// Register wp_nav_menu() menus
// http://codex.wordpress.org/Function_Reference/register_nav_menus
  add_theme_support( 'menus' );

// Enable post thumbnails
// http://codex.wordpress.org/Post_Thumbnails
// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
// http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support( 'post-thumbnails' );

// custom logo support
// https://codex.wordpress.org/Theme_Logo
  add_theme_support( 'custom-logo' );


// Enable HTML5 markup support
// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );

}

add_post_type_support( 'page', 'excerpt' );

add_action( 'after_setup_theme', 'theme_setup');

    
/**
* Theme assets
*/
function theme_styles_scripts() {

    //jquery
    //modernizer

    //for Bootstrap
    wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', [ 'jquery' ], false, '2.9.2'); 
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js', [ 'jquery' ], false, '5.2.2'); 

    //page specific js
    // if (is_front_page()) {
    //   // wp_enqueue_script('video-js', get_stylesheet_directory_uri() . '/assets/js/libraries/video.js', [ 'jquery' ], false, ''); 
    // }

    //theme js
    wp_enqueue_script( 'theme_js', get_stylesheet_directory_uri() . '/assets/js/site.js', [ 'jquery' ], '6.2.3', true );
    wp_enqueue_script( 'theme_datalayer', get_stylesheet_directory_uri() . '/assets/js/datalayer.js', [ 'jquery', 'theme_js' ], null, true );

    // enqueue fonts
    wp_enqueue_style('fontawesome', get_stylesheet_directory_uri() . '/lib/fontawesome-free-6.7.2/css/all.min.css', false, null);

    // Theme stylesheet.
    wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), '6.7.2' );

    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );

}

if (!is_admin()) add_action("wp_enqueue_scripts", "theme_styles_scripts", 11);


// ******************* Login Screen ****************** //

function theme_login_styles() { 

    $theme_logo = get_field('th_inverted_logo', 'option');
    if ($theme_logo) :
        $logo_src = wp_get_attachment_image_url($theme_logo, 'large_thumbnail', false);

?>
     <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo $logo_src ?>);
            background-size: 152px;
            height: 55px;
            width: 152px;
        }
    </style>
<?php 
    endif;
}

// Change login logo
add_action( 'login_enqueue_scripts', 'theme_login_styles' );

// Change login logo url
function theme_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'theme_logo_url' );

// Change login logo title
function theme_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertitle', 'theme_logo_url_title' );


// ******************* Add Custom Menus ****************** //

add_theme_support( 'menus' );
register_nav_menu( 'header-nav', 'Header Navigiation' );
register_nav_menu( 'footer-nav', 'Footer Navigiation' );


// ******************* Add Post Thumbnails ****************** //

add_theme_support( 'post-thumbnails' );

if ( function_exists( 'add_image_size' ) ) {

add_image_size( 'large_thumbnail', 415, 415, false);

}

// ******************* Add Theme Options Menu ****************** //

add_action('acf/init', 'theme_acf_op_init');
function theme_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_sub_page') ) {

        $parent = acf_add_options_page(array(
            'page_title'  => __('Theme General Settings'),
            'menu_title'  => __('Theme Settings'),
            'redirect'    => false,
        ));
        $child = acf_add_options_sub_page(array(
            'page_title'  => __('Logo Settings'),
            'menu_title'  => __('Logo Assets'),
            'parent_slug' => $parent['menu_slug'],
        ));
        $child = acf_add_options_sub_page(array(
            'page_title'  => __('Social Settings'),
            'menu_title'  => __('Social Settings'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }
}

function theme_widgets_init() {
  register_sidebar( array(
    'name'          => 'Blog Sidebar',
    'id'            => 'sidebar-widgets',
    'description'   => 'Add widgets here to appear in your sidebar.',
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ) );
}
add_action('widgets_init','theme_widgets_init');

// Callback function to insert 'styleselect' into the $buttons array
function theme_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Register our callback to the appropriate filter
add_filter( 'mce_buttons_2', 'theme_mce_buttons_2' );

/**
 * Add styles/classes to the "Styles" drop-down
 */ 
function theme_mce_before_init( $init_array ) {  
    // Define the style_formats array
    $style_formats = array(  
        // Each array child is a format with it's own settings
        array(  
            'title' => 'Lead Paragraph',  
            'selector' => 'p',  
            'classes' => 'lead',            
        ),  
        array(  
            'title' => 'Section Title',  
            'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img',
            'classes' => 'section-title',            
        ),  
        array(  
            'title' => 'H5 Style Div',  
            'block' => 'div',  
            'classes' => 'h5',
            'wrapper' => true,   
        ),  
        array(  
            'title' => 'Arrow Link',  
            'selector' => 'a',  
            'classes' => 'arrow-link',            
        ),
        array(  
            'title' => 'Download Link',  
            'selector' => 'a',  
            'classes' => 'download-link',            
        ),
        array(  
            'title' => 'External Link',  
            'selector' => 'a',  
            'classes' => 'external-link',            
        ),
        array(  
            'title' => 'Button Link',  
            'selector' => 'a',  
            'classes' => 'btn btn-secondary',            
        ),
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = wp_json_encode( $style_formats );  
    
    return $init_array;  
  
} 

add_filter( 'tiny_mce_before_init', 'theme_mce_before_init' );

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    
    // Remove from TinyMCE
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
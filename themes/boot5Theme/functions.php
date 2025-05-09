<?php

// * Please note that missing files will produce a fatal error. * //
$theme_includes = [

    'includes/site-init.php', //wordpress setup
    // 'includes/theme-post-type.php', //post type 
    'includes/blog-template-tags.php', //post nav
    'includes/theme-breadcrumbs.php', //breadcrumbs
    'includes/theme-shortcodes.php', //icon-callout
    'includes/theme_navwalker.php', //nav walker
    'includes/search-controller.php', //function for site search
    // 'includes/admin-utility.php',
];

foreach ($theme_includes as $file) {

    if (!$filepath = locate_template($file)) {

        trigger_error(sprintf('Error locating %s for inclusion', $file), E_USER_ERROR);

    }

    require_once $filepath;
}
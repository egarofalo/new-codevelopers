<?php

use function Codevelopers\WpElementor\Helpers\Asset\google_fonts;
use function Codevelopers\WpElementor\Helpers\Asset\scripts;
use function Codevelopers\WpElementor\Helpers\Asset\vendor_scripts;
use function Codevelopers\WpElementor\Helpers\Asset\styles;
use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;

/**
 * Loading translations.
 * https://developer.wordpress.org/themes/functionality/internationalization/#loading-translations
 */
add_action('after_setup_theme', function () {
    load_theme_textdomain('wpelementor', get_template_directory() . '/languages');
});

/**
 * Create custom navigation menus in the dashboard for use in the theme.
 * http://codex.wordpress.org/Function_Reference/register_nav_menus
 */
add_action('after_setup_theme', function () {
    $navMenus = [
        // Primary navigation menu.
        'primary_navigation' => __('Primary navigation', 'wpelementor'),
        // Primary navigation menu for small and medium devices (mobile).
        'primary_navigation_mobile' => __('Primary navigation for mobile devices', 'wpelementor'),
    ];

    register_nav_menus($navMenus);
});

/**
 * Register the dynamic sidebar.
 * https://developer.wordpress.org/reference/functions/register_sidebar
 */
add_action('widgets_init', function () {
    register_sidebar([
        'name' => __('Primary', 'wpelementor'),
        'id' => 'primary_sidebar',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ]);
});

/**
 * Enqueue your styles in this method.
 * https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 */
add_action('wp_enqueue_scripts', function () {
    styles();
    google_fonts();
});

/**
 * Enqueue the vendor shared scripts here.
 * https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
add_action('wp_enqueue_scripts', function () {
    vendor_scripts();
}, 0);

/**
 * Enqueue your scripts in this method.
 * https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
add_action('wp_enqueue_scripts', function () {
    scripts();
});

/**
 * Change the main query in the search page.
 */
add_action('pre_get_posts', function ($query) {
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    $post_types = ['post'];

    if (is_search()) {
        $query->set('post_type', $post_types);
    }
});

/**
 * Add the site header contents.
 */
add_action('wpelementor_site_header_contents', function () {
    get_template_part('header/primary-navbar');
    get_template_part('header/title');
});

/**
 * Add the static sidebar content here.
 */
add_action('wpelementor_static_sidebar_content', function () {
    // add contents here...
});

/**
 * Add contents before the primary navbar collapse.
 */
add_action('wpelementor_before_primary_navbar_collapse', function () {
    // add contents here...
});

/**
 * Add contents after the primary navbar collapse.
 */
add_action('wpelementor_after_primary_navbar_collapse', function () {
    // add contents here...
});

/**
 * Add contents before the site footer contents.
 */
add_action('wpelementor_before_site_footer_contents', function () {
    // add contents here...
});

/**
 * Add contents after the site footer contents.
 */
add_action('wpelementor_after_site_footer_contents', function () {
    // add contents here...
});

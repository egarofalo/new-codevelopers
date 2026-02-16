<?php

namespace Codevelopers\WpElementor\Helpers\Navbar;

use Codevelopers\WpElementor\External\WP_Bootstrap_Navwalker;

/**
 * Displays the Primary Navbar.
 */
function primary_navbar()
{
    wp_nav_menu([
        'echo' => true,
        'theme_location' => 'primary_navigation',
        'depth' => 2,
        'container' => false,
        'menu_class' => 'navbar-nav ms-auto d-none d-md-flex',
        'fallback_cb' => 'Codevelopers\WpElementor\External\WP_Bootstrap_Navwalker::fallback',
        'walker' => new WP_Bootstrap_Navwalker,
    ]);
}

/**
 * Displays the Primary Navbar for mobile.
 */
function primary_navbar_mobile()
{
    wp_nav_menu([
        'echo' => true,
        'theme_location' => 'primary_navigation_mobile',
        'depth' => 2,
        'container' => false,
        'menu_class' => 'navbar-nav me-auto d-md-none',
        'fallback_cb' => 'Codevelopers\WpElementor\External\WP_Bootstrap_Navwalker::fallback',
        'walker' => new WP_Bootstrap_Navwalker,
    ]);
}

/**
 * Displays the Footer Navbar.
 */
function footer_navbar()
{
    wp_nav_menu([
        'echo' => true,
        'theme_location' => 'footer_navigation',
        'depth' => 1,
        'container' => false,
        'menu_class' => 'navbar-footer',
    ]);
}

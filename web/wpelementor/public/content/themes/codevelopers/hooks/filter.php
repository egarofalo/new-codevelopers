<?php

use function Codevelopers\WpElementor\Helpers\Asset\global_fonts;
use function Codevelopers\WpElementor\Helpers\String\str_concat;

/**
 * Hide dynamic sidebar in certain pages.
 */
add_filter('wpelementor_hide_dynamic_sidebar', function ($name) {
    return in_array(true, [
        // add conditionals here...
    ], true);
});

/**
 * Show static sidebar in certain pages.
 */
add_filter('wpelementor_show_static_sidebar', function () {
    return in_array(true, [
        // add conditionals here...
    ], true);
});

/**
 * Filter the site title.
 */
add_filter('wpelementor_site_title', function (string $title) {
    // change the site title here...
    return $title;
});

/**
 * Add Google Fonts additional tags.
 */
add_filter('style_loader_tag', function ($html, $handler) {
    if ($handler === "google-fonts") {
        $html = str_concat(
            '<link rel="preconnect" href="https://fonts.googleapis.com">',
            '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>',
            $html
        );
    }

    return $html;
}, 10, 2);

/**
 * Prevent Elementor from loading global fonts.
 */
add_filter('style_loader_tag', function ($html, $handler) {
    foreach (global_fonts() as $slug => $url) {
        if (preg_match("/elementor\-gf\-.*{$slug}/", $handler)) {
            return '';
        }
    }

    return $html;
}, 10, 2);

/**
 * Add integrity check into font awesome link tag.
 */
add_filter('style_loader_tag', function ($html, $handle) {
    if ($handle === 'font-awesome-7') {
        $html = preg_replace('/\/>$/', str_concat(
            'integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"',
            ' />'
        ), $html);
    }

    return $html;
}, 10, 2);

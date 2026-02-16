<?php

use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;

get_header();

if (is_archive() || is_home() || is_search()) :
    // Elementor `archive` location
    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('archive')) :
        get_template_part('fallbacks/archive');
    endif;
elseif (is_singular()) :
    // Elementor `single` location
    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single')) :
        get_template_part('fallbacks/single');
    endif;
else :
    // Elementor `404` location
    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single')) :
        get_template_part('fallbacks/404');
    endif;
endif;

get_footer();

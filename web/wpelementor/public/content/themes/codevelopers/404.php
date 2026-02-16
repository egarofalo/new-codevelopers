<?php

use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;

get_header();

// Elementor `single` location
if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single')) :
    get_template_part('fallbacks/404');
endif;

get_footer();

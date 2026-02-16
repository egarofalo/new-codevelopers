<?php

use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;

get_header();

// Elementor `archive` location
if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('archive')) :
    get_template_part('fallbacks/archive');
endif;

get_footer();

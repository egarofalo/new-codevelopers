<?php

use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;

get_header();

// Elementor `page` location
if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('page')) :
    get_template_part('fallbacks/page');
endif;

get_footer();

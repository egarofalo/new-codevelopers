<?php

use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part('header/head'); ?>

<body <?php body_class() ?>>
    <?php
    wp_body_open();

    // Elementor `header` location
    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('header')) :
        get_template_part('header/header');
    endif;
    ?>
    <div class="site-body">
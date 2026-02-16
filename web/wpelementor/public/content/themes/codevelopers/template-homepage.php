<?php

/**
 * Template Name: Homepage
 */

use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;

get_header() ?>

<main class="site-main" role="main">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('content/content', 'page');
    endwhile;
    ?>
</main>

<?php get_footer();

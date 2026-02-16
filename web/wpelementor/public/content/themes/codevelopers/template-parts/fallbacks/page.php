<?php

use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;
use function Codevelopers\WpElementor\Helpers\TemplateTags\site_main_row_container_class;
use function Codevelopers\WpElementor\Helpers\TemplateTags\site_main_col_container_class;
?>
<div class="container-xxl">
    <div <?php site_main_row_container_class() ?>>
        <div <?php site_main_col_container_class() ?>>
            <main class="site-main" role="main">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('content/content', 'page');
                endwhile;

                // If comments are open or we have at least one comment, load the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </main>
        </div>

        <?php get_template_part('sidebar/sidebar', 'primary') ?>
    </div>
</div>
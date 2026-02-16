<?php

use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;
?>
<div class="grid">
    <?php while (have_posts()) : the_post(); ?>
        <div class="grid-item <?php echo get_post_type() ?>-grid-item">
            <?php get_template_part('content/content-loop', get_post_type()) ?>
        </div>
    <?php endwhile; ?>
</div>
<?php

use function Codevelopers\WpElementor\Helpers\ConditionalTags\has_static_sidebar;
use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;

if (has_static_sidebar()) : ?>
    <aside class="sidebar-area static-sidebar">
        <?php get_template_part('sidebar/sidebar', 'static') ?>
    </aside>
<?php endif;

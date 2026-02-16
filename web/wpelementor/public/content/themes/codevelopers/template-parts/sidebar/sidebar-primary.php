<?php

use function Codevelopers\WpElementor\Helpers\ConditionalTags\has_dynamic_sidebar;
use function Codevelopers\WpElementor\Helpers\TemplateTags\primary_sidebar_container_class;

if (has_dynamic_sidebar('primary_sidebar')) : ?>
    <div <?php primary_sidebar_container_class() ?>>
        <aside class="sidebar-area primary-sidebar" role="complementary">
            <?php dynamic_sidebar('primary_sidebar') ?>
        </aside>
    </div>
<?php endif; ?>
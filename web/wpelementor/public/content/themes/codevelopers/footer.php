<?php

use function Codevelopers\WpElementor\Helpers\TemplateTags\get_template_part;

get_sidebar() ?>
</div><!-- .site-body -->
<?php
// Elementor `footer` location
if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('footer')) :
    get_template_part('footer/footer');
endif;

wp_footer();
?>
</body>

</html>
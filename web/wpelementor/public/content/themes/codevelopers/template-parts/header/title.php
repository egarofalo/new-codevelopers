<?php

use function Codevelopers\WpElementor\Helpers\TemplateTags\site_title;
?>
<div class="site-title">
    <?php if (is_page_template('template-image-header.php')) : ?>
        <div class="image-header">
            <?php $bg = wp_get_attachment_image_url(get_field('image_header'), 'image-header') ?>
            <div class="image-header__background d-none d-md-block" style='background-image: url("<?php echo $bg ?>")'></div>

            <?php $bg_mobile = wp_get_attachment_image_url(get_field('image_header'), 'image-header-mobile') ?>
            <div class="image-header__background d-block d-md-none" style='background-image: url("<?php echo $bg_mobile ?>")'></div>

            <div class="image-header__title">
                <?php echo apply_filters('wpelementor_site_title', site_title(false)) ?>
            </div>
        </div>
    <?php else : ?>
        <div class="container-xxl">
            <?php echo apply_filters('wpelementor_site_title', site_title(false)) ?>
        </div>
    <?php endif; ?>
</div>
<?php

use function Codevelopers\WpElementor\Helpers\Navbar\primary_navbar,
    Codevelopers\WpElementor\Helpers\Navbar\primary_navbar_mobile;
?>

<nav class="navbar navbar-expand-md bg-body-tertiary">
    <div class="container-xxl">
        <a class="navbar-brand" href="<?php echo esc_url(home_url()) ?>">
            <?php
            if (has_custom_logo()) :
                $custom_logo_id = get_theme_mod('custom_logo');
                echo wp_get_attachment_image(
                    $custom_logo_id,
                    'full',
                    false,
                    ['class' => 'img-fluid custom-logo']
                );
            else :
                bloginfo();
            endif;
            ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNavbar" aria-controls="primaryNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="primaryNavbar" class="collapse navbar-collapse">
            <?php
            do_action('wpelementor_before_primary_navbar_collapse');
            primary_navbar();
            primary_navbar_mobile();
            do_action('wpelementor_after_primary_navbar_collapse');
            ?>
        </div>
    </div>
</nav>
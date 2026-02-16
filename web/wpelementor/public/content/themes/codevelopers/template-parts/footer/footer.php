<footer class="site-footer" role="contentinfo">
    <div class="site-footer__contents">
        <div class="container-xxl">
            <?php do_action('wpelementor_before_site_footer_contents') ?>

            <div class="site-footer__logo">
                <?php
                if (get_theme_mod('alt_logo')) :
                    $alt_logo_id = get_theme_mod('alt_logo');
                    echo wp_get_attachment_image(
                        $alt_logo_id,
                        'thumbnail',
                        false,
                        ['class' => 'img-fluid alt-logo']
                    );
                else :
                ?>
                    <p class="font-weight-bold mb-0"><?php bloginfo('name') ?></p>
                <?php endif; ?>
            </div>

            <?php do_action('wpelementor_after_site_footer_contents') ?>
        </div>
    </div>

    <div class="site-footer__vendor">
        <div class="container-xxl">
            <a href="https://codevelopers.tech" target="_blank" rel="noopener noreferrer">codevelopers</a>
        </div>
    </div>
</footer><!-- .site-footer -->
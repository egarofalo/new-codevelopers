<?php

/** @var array $args */
extract($args);

if (in_array(true, [$facebook_url, $instagram_url, $linkedin_url])) :
?>
    <div class="site-footer__social-media mt-4">
        <ul class="list-unstyled d-flex justify-content-center gap-3 mb-0">
            <?php if ($facebook_url) : ?>
                <li>
                    <a href="<?php echo esc_url($facebook_url) ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-facebook-f fa-lg"></i>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($instagram_url) : ?>
                <li>
                    <a href="<?php echo esc_url($instagram_url) ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-instagram fa-lg"></i>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($linkedin_url) : ?>
                <li>
                    <a href="<?php echo esc_url($linkedin_url) ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-linkedin-in fa-lg"></i>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
<?php
endif;

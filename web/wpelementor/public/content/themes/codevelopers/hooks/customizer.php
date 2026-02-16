<?php

/**
 * Create alternative logo setting.
 */
add_action('customize_register', function ($wp_customize) {
    // add a setting for the site logo
    $wp_customize->add_setting('alt_logo');
    // Add a control to upload the logo
    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'alt_logo',
            [
                'label' => __('Upload alternative logo', 'wpelementor'),
                'section' => 'title_tagline',
                'settings' => 'alt_logo',
                'mime_type' => 'image',
            ]
        )
    );
});

<?php

namespace Codevelopers\WpElementor\Helpers\Asset;

$assets = json_decode(file_get_contents(get_template_directory() . '/dist/mix-manifest.json'), true);

/**
 * Get an asset file with version added.
 */
function asset($filename)
{
    global $assets;

    return get_template_directory_uri() . '/dist/' . ltrim($assets['/' . trim($filename, '/')], '/');
}

/**
 * Enqueues your styles.
 */
function styles()
{
    // Add fontawesome
    wp_enqueue_style('font-awesome-7', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css');

    // Add site styles
    wp_enqueue_style('main', asset('styles/main.css'), ['font-awesome-7']);
}

/**
 * Enqueue the vendor scripts used in all pages.
 */
function vendor_scripts()
{
    // Add manifest.js
    wp_enqueue_script('manifest', asset('scripts/manifest.js'));

    // Add vendor.js
    wp_enqueue_script('vendor', asset('scripts/vendor.js'), ['manifest', 'jquery'], false, true);
}

/**
 * Enqueues your scripts.
 */
function scripts()
{
    // Add main.js
    wp_enqueue_script('main', asset('scripts/main.js'), ['jquery'], false, true);

    // Add forms.js
    wp_enqueue_script('forms', asset('scripts/forms.js'), ['jquery'], false, true);

    // Add comment-reply js
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

/**
 * Returns global fonts slug and url.
 * 
 * @return array
 */
function global_fonts()
{
    return [
        'coda' => 'https://fonts.googleapis.com/css2?family=Coda:wght@400;800&display=swap',
        'inter' => 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap',
    ];
}

/**
 * Enqueues Google Fonts.
 *
 * @return void
 */
function google_fonts()
{
    foreach (global_fonts() as $font => $url) {
        wp_enqueue_style("google-fonts-{$font}", $url);
    }
}

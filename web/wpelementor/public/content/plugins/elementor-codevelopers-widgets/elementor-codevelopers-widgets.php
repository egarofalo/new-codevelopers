<?php

/**
 * Plugin Name: Elementor codevelopers Widgets
 * Description: This plugin includes codevelopers Widgets for Elementor.
 * Plugin URI:  https://codevelopers.tech/
 * Version:     1.0.0
 * Author:      Lic. Edgardo Garofalo
 * Author URI:  https://codevelopers.tech/
 * Text Domain: elementor-codevelopers-widgets
 *
 * Requires Plugins: elementor
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Register codevelopers Widgets.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_codevelopers_widgets($widgets_manager)
{
    require_once(__DIR__ . '/widgets/codevelopers-icons-list.php');

    $widgets_manager->register(new \Codevelopers\Elementor\Widgets\Codevelopers_Icons_List());
}
add_action('elementor/widgets/register', 'register_codevelopers_widgets');

/**
 * Register widget styles.
 * 
 * Enqueue widget styles on the frontend.
 */
function codevelopers_register_widget_styles()
{
    wp_enqueue_style(
        'codevelopers-elementor-widgets-style',
        plugins_url('assets/css/widgets.css', __FILE__),
        [],
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'codevelopers_register_widget_styles');

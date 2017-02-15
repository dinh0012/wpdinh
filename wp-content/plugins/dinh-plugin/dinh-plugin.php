<?php
/**
 * @package Kenshin Widget
 * @version 0.1
 */
/*
Plugin Name: Dinh Plugin
Plugin URI: http://laptrinhweb.org
Description: Đây là một plugin dùng để tương tác vói Widget API.
Author: dinh0012
Version: 0.1
Author URI: None
*/

define('WIDGET_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WIDGET_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WIDGET_VIEWS_DIR', WIDGET_PLUGIN_DIR . '/views/');
define('WIDGET_INCLUDES_DIR', WIDGET_PLUGIN_DIR . '/includes/');
define('WIDGET_DIR', WIDGET_PLUGIN_DIR . '/widgets');
if (!is_admin()) {
}

require_once WIDGET_DIR . '/widget_demo.php';
require_once WIDGET_DIR . '/members.php';
require_once WIDGET_DIR . '/hot_news.php';
add_action('widgets_init', 'create_widget');
function create_widget()
{
    register_widget('Widget_Demo');
    register_widget('Members');
    register_widget('Hot_News');
}

function create_youtube_shortcode($args, $content)
{
    $content = '<iframe src="//www.youtube.com/embed/' . $args['id'] . '" height=" ' . $args['height'] . '" width="' . $args['width'] . '" allowfullscreen="" frameborder="0"></iframe>';
    return $content;
}

add_shortcode('youtube', 'create_youtube_shortcode');

function create_banner_shortcode($args, $content)
{
    $content = '<iframe src="//www.youtube.com/embed/' . $args['id'] . '" height=" ' . $args['height'] . '" width="' . $args['width'] . '" allowfullscreen="" frameborder="0"></iframe>';
    return $content;
}

add_shortcode('youtube', 'create_youtube_shortcode');

//******************************************************************
// WP API

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
/*function example_add_dashboard_widgets() {

    wp_add_dashboard_widget(
        'example_dashboard_widget',         // Widget slug.
        'Example Dashboard Widget',         // Title.
        'example_dashboard_widget_function' // Display function.
    );
}*/
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets');

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function example_dashboard_widget_function()
{

    // Display whatever it is you want to show.
    echo "Hello World, I'm a great Dashboard Widget";
}

function example_add_dashboard_widgets()
{
    wp_add_dashboard_widget('example_dashboard_widget', 'Example Dashboard Widget', 'example_dashboard_widget_function');

    // Globalize the metaboxes array, this holds all the widgets for wp-admin

    global $wp_meta_boxes;

    // Get the regular dashboard widgets array
    // (which has our new widget already but at the end)

    $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

    // Backup and delete our new dashboard widget from the end of the array

    $example_widget_backup = array('example_dashboard_widget' => $normal_dashboard['example_dashboard_widget']);
    unset($normal_dashboard['example_dashboard_widget']);

    // Merge the two arrays together so our widget is at the beginning

    $sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);

    // Save the sorted array back into the original metaboxes

    $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}


function remove_dashboard_meta()
{
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');//since 3.8
}

add_action('admin_init', 'remove_dashboard_meta');
add_option('name', 'dinh0012');
//setting API

//=====================================================
// Phương thức validate_setting
//=====================================================

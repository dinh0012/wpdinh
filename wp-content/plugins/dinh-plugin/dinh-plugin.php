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
define('WIDGET_VIEWS_DIR', WIDGET_PLUGIN_DIR . '/views');
 
define('WIDGET_INCLUDES_DIR', WIDGET_PLUGIN_DIR .'/includes');
define('WIDGET_DIR', WIDGET_PLUGIN_DIR . '/widgets');
 
 
if(!is_admin()){
  }

require_once WIDGET_DIR. '/widget_demo.php';
require_once WIDGET_DIR. '/members.php';
add_action( 'widgets_init', 'create_widget' );
function create_widget() {
        register_widget('Widget_Demo');
         register_widget('Members');
}

function create_youtube_shortcode( $args, $content ) {
        $content = '<iframe src="//www.youtube.com/embed/'.$args['id'].'" height=" '.$args['height'].'" width="'.$args['width'].'" allowfullscreen="" frameborder="0"></iframe>';
 return $content;
}
add_shortcode('youtube', 'create_youtube_shortcode');

function create_banner_shortcode( $args, $content ) {
        $content = '<iframe src="//www.youtube.com/embed/'.$args['id'].'" height=" '.$args['height'].'" width="'.$args['width'].'" allowfullscreen="" frameborder="0"></iframe>';
 return $content;
}
add_shortcode('youtube', 'create_youtube_shortcode');
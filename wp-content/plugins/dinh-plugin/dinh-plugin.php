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
 
define('KENSHIN_WIDGET_PLUGIN_URL', plugin_dir_url(__FILE__));
define('KENSHIN_WIDGET_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('KENSHIN_WIDGET_VIEWS_DIR', KENSHIN_WIDGET_PLUGIN_DIR . '/views');
 
define('KENSHIN_WIDGET_INCLUDES_DIR', KENSHIN_WIDGET_PLUGIN_DIR .'/includes');
define('KENSHIN_WIDGET_DIR', KENSHIN_WIDGET_PLUGIN_DIR . '/widgets');
 
 
 
 
if(!is_admin()){
    require_once KENSHIN_WIDGET_INCLUDES_DIR. '/frontend.php';
    new KenshinFrontend();
}else{
    require_once KENSHIN_WIDGET_INCLUDES_DIR. '/backend.php';
    new KenshinBackend();
}
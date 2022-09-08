<?php
/*
Plugin Name: Cakes
Description:
Version: 1
Author: aliarshad
*/
//menu items
include_once 'func.php';
add_action('admin_menu','cakes_menu');
function cakes_menu() {

    add_menu_page('Cakes', //page title
        'Cakes', //menu title
        'manage_options', //capabilities
        'cakes_list', //menu slug
        'cakes_list' //function
    );
    add_submenu_page(null, //parent slug
        'Cake Details', //page title
        'Details', //menu title
        'manage_options', //capability
        'cake_view', //menu slug
        'cake_view'); //function


}
add_action( 'wp_enqueue_scripts', 'custom_plugin_assets' );
function custom_plugin_assets() {
    wp_enqueue_style( 'custom-cake-css', plugins_url( '/style-admin.css' , __FILE__ ));
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'cake-list.php');
require_once(ROOTDIR . 'cake-details.php');

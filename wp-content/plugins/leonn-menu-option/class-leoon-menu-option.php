<?php
/**
 * Leoon_Menu_Option
 *
 * @package           leoon-menu-option
 * @author            Leonardo H. Noering
 * @copyright         2023 Leoon
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Leoon_Menu_Option
 * Plugin URI:        https://example.com/plugin-name
 * Description:       Simple plugin to create menu option.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.0
 * Author:            Leonardo H. Noering
 * Author URI:        https://example.com
 * Text Domain:       plugin-slug
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://example.com/my-plugin/
 */
 
 if(!defined('ABSPATH')) {
     die; // Die if accessed directly.
 }
 
 
 /**
  * Leoon_Menu_Option Class
  *
  * @class Leoon_Menu_Option
  */
 
 class Leoon_Menu_Option {
 
    /*
     * Consructors are magical functions
     * They are executed when you instantiate a object.
     * It initializes our object.
     * Call your function inside Consrtuctor to execute immediately.
     * Use $this for the reference of an object
     *
     * >> to-do all the thigs you need when create the object.
     * 
     */
    function __construct() {
    }

    /**
     * 
     * 
     * >> to-do all the things to run
     */
    function execute() {
        // executes our message function.
        add_action( 'admin_menu', [ $this, 'add_menu' ] ); //admin
    }

    function add_menu() {
        /**
         * string $page_title,
         * string $menu_title,
         * string $capability,
         * string $menu_slug,
         * callable $function = '',
         * string $icon_url = '',
         * int $position = null
         */
        add_menu_page(
            'Sample Options',
            'Sample Admin Menu',
            'manage_options',
            plugin_dir_path(__FILE__) . 'admin/view.php',
            null,
            plugin_dir_url(__FILE__) . 'images/icon_menu_option.png',
            20
        );
    }
 }
 
 // check if our class exists
 if(class_exists('Leoon_Menu_Option')) {
    // instantiate the class.
    $leoonMenuOption = new Leoon_Menu_Option();
    $leoonMenuOption->execute();
 }
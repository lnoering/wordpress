<?php
/**
 * Leoon_Disable_Admin_Bar
 *
 * @package           leoon-disable-admin-bar
 * @author            Leonardo H. Noering
 * @copyright         2023 Leoon
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Leoon_Disable_Admin_Bar
 * Plugin URI:        https://example.com/plugin-name
 * Description:       Simple plugin to disable the admin bar to all users.
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
  * Leoon_Disable_Admin_Bar Class
  *
  * @class Leoon_Disable_Admin_Bar
  */
 
 class Leoon_Disable_Admin_Bar {
 
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

        //disable the admin top bar at frontend.
        add_filter('show_admin_bar', '__return_false');     
    }

 
 }
 
 
 // check if our class exists
 if(class_exists('Leoon_Disable_Admin_Bar')) {
    // instantiate the class.
    $leoonDisableAdminBar = new Leoon_Disable_Admin_Bar();
    $leoonDisableAdminBar->execute();
 }
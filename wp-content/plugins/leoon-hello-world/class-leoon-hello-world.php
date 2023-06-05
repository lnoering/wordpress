<?php
/**
 * Plugin Name
 *
 * @package           leoon-hello-world
 * @author            Leonardo H. Noering
 * @copyright         2023 Leoon
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Leoon_Hello_World
 * Plugin URI:        https://example.com/plugin-name
 * Description:       Simple plugin to show one message.
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
  * HelloWorld_Plugin Class
  *
  * @class HelloWorld_Plugin
  */
 
 class Leoon_Hello_World {
 
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
        $this->show();
    }
 
    /**
     * 
     * 
     * >> show message function
     */
    function show() {
        echo "First plugin with Hello World";
    }
 
 }
 
 
 // check if our class exists
 if(class_exists('Leoon_Hello_World')) {
    // instantiate the class.
    $leoonHelloWorld = new Leoon_Hello_World();
    $leoonHelloWorld->execute();
 }
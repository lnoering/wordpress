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

    const TABLE_NAME = "leoon_menu_option";

    public $options;

    public $plugin;
 
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
        $this->plugin = plugin_basename( __FILE__ );

        global $leoon_menu_option_db_version;
        $leoon_menu_option_db_version = '1.1';
    }



    /**
     * 
     * 
     * >> to-do all the things to run
     */
    function execute() {

        register_activation_hook( __FILE__, [ $this, 'create_plugin_table'] );

        // to control the update database
        add_action( 'plugins_loaded', [$this, 'myplugin_update_db_check'] );

        // executes our message function.
        add_action( 'admin_menu', [ $this, 'add_menu' ] ); //admin
        add_action( 'admin_init', [ $this, 'page_init_options' ] );

        // Add link at plugin list (Activate/Deactivate/Delete) more Leoon Menu Settings to go to the settings.
        add_filter( 'plugin_action_links_' . $this->plugin, [ $this, 'plugin_links' ]);
    }

    function plugin_links( $links ) {
        $link = '<a href="admin.php?page=leonn-menu-option/admin/view.php">Leoon Menu Settings</a>';
        array_push( $links, $link );
        return $links;
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
        $this->options = get_option( 'leoon_menu_option_name' );

    }


    /**
     * Register and add settings
     */
    public function page_init_options()
    {        

        register_setting(
            'leoon_menu_option_group', // Option group
            'leoon_menu_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'leoon_menu_option_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'leoon_menu_option_page' // Page
        );  

        add_settings_field(
            'lmo_text', // ID
            'Option Text', // Title 
            array( $this, 'text_callback' ), // Callback
            'leoon_menu_option_page', // Page
            'leoon_menu_option_id' // Section           
        );      

        add_settings_field(
            'lmo_number', 
            'Option Number', 
            array( $this, 'number_callback' ), 
            'leoon_menu_option_page', 
            'leoon_menu_option_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['lmo_number'] ) )
            $new_input['lmo_number'] = absint( $input['lmo_number'] );

        if( isset( $input['lmo_text'] ) )
            $new_input['lmo_text'] = sanitize_text_field( $input['lmo_text'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function number_callback()
    {
        printf(
            '<input type="number" id="lmo_number" name="leoon_menu_option_name[lmo_number]" value="%s" />',
            isset( $this->options['lmo_number'] ) ? esc_attr( $this->options['lmo_number']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function text_callback()
    {
        printf(
            '<input type="text" id="lmo_text" name="leoon_menu_option_name[lmo_text]" value="%s" />',
            isset( $this->options['lmo_text'] ) ? esc_attr( $this->options['lmo_text']) : ''
        );
    }

    public function create_plugin_table() {

        global $leoon_menu_option_db_version;
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . self::TABLE_NAME;

        $sql = "CREATE TABLE $table_name (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        text text NOT NULL,
        number int(11) NOT NULL,
        PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        dbDelta( $sql );
        add_option( 'leoon_menu_option_db_version', $leoon_menu_option_db_version );
    }

    public function update_plugin_table() {
        global $wpdb;
        global $leoon_menu_option_db_version;

        $installed_ver = get_option( "leoon_menu_option_db_version" );

        if ( $installed_ver != $leoon_menu_option_db_version ) {

            $table_name = $wpdb->prefix . self::TABLE_NAME;

            // SQL to change the table
            $sql = "";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            update_option( "leoon_menu_option_db_version", $leoon_menu_option_db_version );
        }
    }

    function myplugin_update_db_check() {
        global $leoon_menu_option_db_version;
        if ( get_site_option( 'leoon_menu_option_db_version' ) != $leoon_menu_option_db_version ) {
            $this->update_plugin_table();
        }
    }
    
 }
 
 // check if our class exists
 if(class_exists('Leoon_Menu_Option')) {
    // instantiate the class.
    $leoonMenuOption = new Leoon_Menu_Option();
    $leoonMenuOption->execute();
 }
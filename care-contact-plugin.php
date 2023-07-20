<?php
/**
* Plugin Name: Care Contact Plugin
* Version: 1.0
* Description:  This is a contact plugin for a pharmacy
* Author: Careforte Pharmacy
*/

if ( !defined( 'ABSPATH' ) ) {
    die( 'You may not be here' );
}
;

if ( !class_exists( 'ContactPlugin' ) ) {
    class ContactPlugin {
        public function __construct() {
            // Corrected method name with double underscores ( __ )
            define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

            require_once( MY_PLUGIN_PATH . '/vendor/autoload.php' );
            // Added a forward slash before 'vendor'
        }

        public function initialize() {
            include_once MY_PLUGIN_PATH . 'includes/utilities.php';
            include_once MY_PLUGIN_PATH . 'includes/options-page.php';
            include_once MY_PLUGIN_PATH . 'includes/contact-form.php';
        }
    }

    $contactPlugin = new ContactPlugin();
    $contactPlugin->initialize();
}

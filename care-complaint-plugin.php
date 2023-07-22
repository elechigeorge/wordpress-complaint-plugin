<?php
/**
 * Plugin Name: Care Contact Plugin
 * Version: 1.1
 * Description:  This is a contact plugin for a pharmacy
 * Author: Careforte Pharmacy
 */

if (!defined('ABSPATH')) {
    die('You may not be here');
}

if (!class_exists('ContactPlugin')) {
    class ContactPlugin
    {
        public function __construct()
        {
            define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));

            require_once MY_PLUGIN_PATH . '/vendor/autoload.php';
        }

        public function initialize()
        {
            include_once MY_PLUGIN_PATH . 'includes/utilities.php';
            include_once MY_PLUGIN_PATH . 'includes/options-page.php';
            include_once MY_PLUGIN_PATH . 'includes/contact-form.php';

            // Step 1: Add the activation hook and function here
            register_activation_hook(__FILE__, array($this, 'care_contact_plugin_activate'));
        }

        // Step 2: Add the care_contact_plugin_activate() function here
        public function care_contact_plugin_activate()
        {
            $this->care_create_complaint_form_page();
            flush_rewrite_rules();
        }

        // Step 3: Add the care_create_complaint_form_page() function here
        public function care_create_complaint_form_page()
        {
            // Check if the page already exists before creating a new one
            $complaint_form_page = get_page_by_title('Customer Complaint Form');

            if (!$complaint_form_page) {
                // Create the page post object
                $complaint_form_page = array(
                    'post_title' => 'Customer Complaint Form',
                    'post_content' => '[complaint_form]',
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'post_author' => 1,
                );

                // Insert the post into the database
                $complaint_form_page_id = wp_insert_post($complaint_form_page);

                // Optionally, set a page template
                // update_post_meta($complaint_form_page_id, '_wp_page_template', 'page-templates/complaint-form-template.php');
            }
        }

        // Step 4 (Optional): Add the deactivation hook and function here
        public function care_contact_plugin_deactivate()
        {
            $this->care_remove_complaint_form_page();
            flush_rewrite_rules();
        }

        // Step 5 (Optional): Add the care_remove_complaint_form_page() function here
        public function care_remove_complaint_form_page()
        {
            // Get the page ID of the customer complaint form page
            $complaint_form_page = get_page_by_title('Customer Complaint Form');

            if ($complaint_form_page) {
                // Delete the page
                wp_delete_post($complaint_form_page->ID, true);
            }
        }
    }

    $contactPlugin = new ContactPlugin();
    $contactPlugin->initialize();
}

<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'after_setup_theme', 'load_carbon_fields' );
add_action( 'carbon_fields_register_fields', 'create_options_page' );

function load_carbon_fields() {
    \Carbon_Fields\Carbon_Fields::boot();
}
;

function create_options_page () {
    Container::make( 'theme_options', 'Care Complaint Form' )
    ->set_icon('dashicons-welcome-write-blog')
    ->add_fields( array(
        Field::make( 'checkbox', 'contact_plugin_show_content', 'Enable or Disable the form' )
        ->set_option_value( 'yes' ),

        Field::make( 'text', 'contact_plugin_recepients_email', __( 'Recepient Email' ) ) -> set_attribute( 'placeholder', 'name@rmail.com' ),

        Field::make( 'textarea', 'contact_plugin_message', __( 'Confirmation Messages' ) ) -> set_help_text( 'Message the submitter will receive' )
    ) );
}
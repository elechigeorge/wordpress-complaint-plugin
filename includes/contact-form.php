<?php

add_action( 'rest_api_init', 'create_rest_endpoint' );
add_shortcode( 'complaint_form', 'show_contact_form' );


function show_contact_form() {
    $api_url = get_rest_url(null, 'v1/contact-form/submit');

    ob_start();

    // Include the template file, and its PHP code will be executed
    include MY_PLUGIN_PATH . 'templates/complaint-form.php';

    // Get the contents of the included template file
    $html = ob_get_clean();

    $html = str_replace('{{API_URL}}', esc_url($api_url), $html);

    return $html;
}
;

function create_rest_endpoint () {
    register_rest_route( 'v1/contact-form', 'submit', array (
        'methods' => 'POST',
        'callback' => 'handle_enquiry'
    ) );
}
;

function handle_enquiry () {
    echo 'Hello';
}
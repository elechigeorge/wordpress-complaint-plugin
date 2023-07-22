<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

add_action('rest_api_init', 'create_rest_endpoint');
add_shortcode('complaint_form', 'show_contact_form');

function show_contact_form()
{
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

function create_rest_endpoint()
{
    register_rest_route('v1/contact-form', 'submit', array(
        'methods' => 'POST',
        'callback' => 'handle_enquiry',
    ));
}
;

function handle_enquiry()
{
    // Check if the form was submitted via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Assuming you have form fields named 'name', 'email', 'phone', and 'message'
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        // Initialize a new PHPMailer instance
        $mailer = new PHPMailer(true);

        try {
            // Server settings
            $mailer->SMTPDebug = 0; // Set to 2 for debugging (will print debug output)
            $mailer->isSMTP();
            $mailer->Host = ''; // Replace with your SMTP server address
            $mailer->SMTPAuth = true;
            $mailer->Username = ''; // Replace with your SMTP username
            $mailer->Password = ''; // Replace with your SMTP password
            $mailer->SMTPSecure = 'tls';
            $mailer->Port = 587;

            // Sender and recipient settings
            $mailer->setFrom('carefortepharm@gmail.com', 'Customer Feedback');
            $mailer->addAddress($email, $name); // Replace with the recipient's email address and name

            // Email content
            $mailer->isHTML(true);
            $mailer->Subject = 'New Complaint Received';
            $mailer->Body = "Name: $name<br>Email: $email<br>Phone: $phone<br>Message: $message";

            // Send the email
            $mailer->send();

            // Return a response to the user
            return new WP_REST_Response(array('message' => 'Complaint received. Thank you for contacting us!'));
        } catch (Exception $e) {
            // Handle any exceptions or errors that occur during sending
            return new WP_Error('email_error', 'Failed to send email. Please try again later.', array('status' => 500));
        }
    } else {
        // Return an error if the request method is not POST
        return new WP_Error('invalid_method', 'Invalid request method.', array('status' => 405));
    }
}

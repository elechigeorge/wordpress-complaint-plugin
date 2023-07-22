

<!DOCTYPE html>
<html>
<head>
<title>Contact Form</title>
<style>
/* CSS styles for the form */
form {
    max-width: 100vw;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f8f8f8;
    box-shadow: 0 0 10px rgba( 0, 0, 0, 0.1 );
}

label {
    display: block;
    margin-bottom: 5px;
}

input[ type = 'text' ],
input[ type = 'phone' ],
input[ type = 'email' ],
textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

textarea {
    resize: vertical;
}

input[ type = 'submit' ] {
    background-color: #4CAF50;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 3px;
}

input[ type = 'submit' ]:hover {
    background-color: #45a049;
}
/* Loading spinner */
.loading-spinner {
        display: none; /* Hidden by default */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        border: 6px solid #f3f3f3;
        border-top: 6px solid #3498db;
        border-radius: 50%;
        animation: spin 1.5s linear infinite;
        z-index: 9999;
    }

    /* Animation for the loading spinner */
    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    /* Confirmation modals */
    .confirmation-modal {
        display: none; /* Hidden by default */
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        max-width: 400px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        z-index: 9999;
    }

    /* Style for success modal */
    .confirmation-modal.success {
        border-color: #4caf50;
    }

    /* Style for error modal */
    .confirmation-modal.error {
        border-color: #e74c3c;
    }

    /* Close button for the confirmation modals */
    .confirmation-modal .close-button {
        position: absolute;
        top: 5px;
        right: 5px;
        font-size: 18px;
        cursor: pointer;
    }
</style>
</head>
<body>


<form action='{{API_URL}}' method = 'post' id='enquiry_form'>
<label for = 'name'>Name:</label>
<input type = 'text' name = 'name' id = 'name' required>
<br>
<label for = 'email'>Email:</label>
<input type = 'email' name = 'email' id = 'email' required>
<br>
<label for = 'phone'>Phone:</label>
<input type = 'phone' name = 'phone' id = 'phone' required>
<br>
<label for = 'message'>Message:</label>
<textarea name = 'message' id = 'message' rows = '4' required></textarea>
<br>
<input type = 'submit' value = 'Submit'>
<div class="loading-spinner" style="display: none;">
        <!-- Add your loading spinner here, e.g., a CSS spinner or an animated GIF -->
    </div>
    <!-- Success modal -->
    <div class="confirmation-modal success" style="display: none;">
        <!-- Success message -->
        <p>The complaint has been received. Thank you for contacting us!</p>
        <!-- Close button for success modal -->
        <span class="close-button" onclick="closeModal(this)">&times;</span>
    </div>
    <!-- Error modal -->
    <div class="confirmation-modal error" style="display: none;">
        <!-- Error message -->
        <p>Failed to submit the form. Please try again later.</p>
        <!-- Close button for error modal -->
        <span class="close-button" onclick="closeModal(this)">&times;</span>
    </div>
</form>

</body>

</html>

<script>
   jQuery(document).ready(function($) {
    $('#enquiry_form').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var loadingSpinner = $('.loading-spinner');
        var successModal = $('.confirmation-modal.success');
        var errorModal = $('.confirmation-modal.error');

        // Show loading spinner while the form is being processed
        loadingSpinner.show();

        $.ajax({
          type: "POST",
          url: form.attr("action"),
          data: form.serialize(),
          success: function(response) {
                // Hide the loading spinner
                loadingSpinner.hide();
                // Show the success modal
                successModal.show();
            },
            error: function(error) {
                // Hide the loading spinner
                loadingSpinner.hide();
                // Show the error modal
                errorModal.show();
            }
        })

    });

    // Function to handle modal close button
    function closeModal(button) {
        // Find the parent element (i.e., the modal) of the clicked button
        var modal = $(button).parent();
        // Hide the modal when the close button is clicked
        modal.hide();
    }

    // Bind click event to close buttons
    $('.close-button').on('click', function() {
        closeModal(this);
    });
});
</script>



<!DOCTYPE html>
<html>
<head>
<title>Contact Form</title>
<style>
/* CSS styles for the form */
form {
    max-width: 400px;
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
</form>

</body>

</html>

<script>
   jQuery(document).ready(function($) {
    $('#enquiry_form').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        $.ajax({
          type: "POST",
          url: form.attr("action"),
          data: form.serialize()
        })
        
    });
});
</script>
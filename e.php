<?php
// emailus.php
include 'config.php';  // Include the database connection file

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the message from the form
    $message = htmlspecialchars($_POST['message']);  // Sanitize input to avoid XSS

    // Prepare SQL to insert message into the database
    $sql = "INSERT INTO new_table (message) VALUES (:message)";
    $stmt = $pdo->prepare($sql);

    // Bind the message parameter
    $stmt->bindParam(':message', $message);

    // Execute the query
    if ($stmt->execute()) {
        // If insertion is successful, redirect to a success page
        header('Location: success.php'); // Redirect to success page
        exit; // Exit to ensure the script stops
    } else {
        // If there was an error, show a failure message
        echo "There was an error submitting your message.";
    }
} else {
    // If the form has not been submitted yet, show the form
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Us - Email Us</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .form-container {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 300px;
            }
            label {
                font-weight: bold;
            }
            textarea {
                width: 100%;
                height: 150px;
                margin: 10px 0;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                resize: none;
            }
            button {
                width: 100%;
                padding: 10px;
                background-color: #007BFF;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="form-container">
            <h2>Contact Us</h2>
            <form method="POST" action="">
                <label for="message">Your Message:</label>
                <textarea name="message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </body>
    </html>
<?php
}
?>

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Get the submitted message
    $message = trim($_POST['message']);  // Trim spaces

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "emailus";

    try {
        // Create a connection to the database using PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to insert the message into the table
        $sql = "INSERT INTO new_table (message) VALUES (:message)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);
        // Bind the message parameter
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Display success message
        $successMessage = "Your message has been sent successfully!";
    } catch (PDOException $e) {
        // If there's an error, display the error message
        $errorMessage = "Error: " . $e->getMessage();
    }
    
    // Close the connection
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Website - Contact Us</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling: Full page background */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('bgc.jpg'); /* Full background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }

        /* Navigation Bar */
        nav {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            padding: 1rem 2rem;
            width: 100%;
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav__logo a {
            color: #fff;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .nav__links {
            list-style-type: none;
            display: flex;
            gap: 2rem;
        }

        .nav__links .link {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
        }

        .nav__links .link:hover {
            text-decoration: underline;
        }

        /* Contact Section */
        .contact-section {
            text-align: center;
            margin: 80px 0; /* Added space for the fixed navbar */
            padding: 60px 20px;
            background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background */
            color: white;
            border-radius: 8px;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            font-size: 2rem;
        }

        /* Contact Cards */
        .contact {
            display: inline-block;
            width: 30%;
            margin: 10px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .contact:hover {
            transform: translateY(-10px);
        }

        .contact img {
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .contact img:hover {
            transform: scale(1.1);
        }

        .contact h3 {
            margin-bottom: 10px;
            font-size: 1.3rem;
        }

        .contact p {
            color: #eee;
            font-size: 1.1rem;
        }

        .contact a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        /* Textarea Styling */
        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            resize: none;
        }

        /* Button Styling */
        button {
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .contact {
                width: 80%;
                margin-bottom: 20px;
            }

            .nav__links {
                flex-direction: column;
                gap: 1rem;
                justify-content: flex-start;
            }

            .contact-section {
                padding: 40px 20px;
                width: 90%;
            }
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav>
    <div class="nav__logo">
        <a href="#">Travel.co</a>
    </div>
    <ul class="nav__links">
        <li><a href="Website.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="offers.html" >Offers</a></li>
    </ul>
</nav>

<!-- Contact Section -->
<div class="contact-section">
    <h2>Contact Us</h2>

    <!-- Contact Card 1: Email -->
    <div class="contact">
        <img src="email.jpg" alt="Email Icon"> <!-- Replace with your image -->
        <h3>Email Us</h3>
        <!-- PHP Form for Email Us -->
        <form action="" method="POST">
            <textarea name="message" placeholder="Enter your message" required></textarea><br><br>
            <button type="submit" name="submit">Send Message</button>
        </form>

        <?php if (isset($successMessage)) { ?>
            <p style="color: green; text-align: center;"><?php echo $successMessage; ?></p>
        <?php } ?>

        <?php if (isset($errorMessage)) { ?>
            <p style="color: red; text-align: center;"><?php echo $errorMessage; ?></p>
        <?php } ?>
    </div>

    <!-- Contact Card 2: Phone -->
    <div class="contact">
        <img src="phone.jpg" alt="Phone Icon"> <!-- Replace with your image -->
        <h3>Call Us</h3>
        <p><a href="tel:+123456789">09922503843</a></p>
    </div>

    <!-- Contact Card 3: Location -->
    <div class="contact">
        <img src="location.jpg" alt="Location Icon"> <!-- Replace with your image -->
        <h3>Visit Us</h3>
        <p>Malungon, Sarangani Province</p>
    </div>
</div>

</body>
</html>

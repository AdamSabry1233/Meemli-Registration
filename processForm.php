<?php



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



// Include PHPMailer autoloader
require("vendor/autoload.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $parentEmail = $_POST['parentEmail'];
    $reenterParentEmail = $_POST['reenterParentEmail'];
    $parentName = $_POST['parentName'];
    $phoneNumber = $_POST['phoneNumber'];
    $childName = $_POST['childName'];
    $childGrade = $_POST['childGrade'];
    $childSchool = $_POST['childSchool'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $programs = is_array($_POST['programs']) ? implode(", ", $_POST['programs']) : $_POST['programs'];
    $timePreference = is_array($_POST['timePreference']) ? implode(", ", $_POST['timePreference']) : $_POST['timePreference'];
    $additionalDetails = $_POST['additionalDetails'];

    // Create a connection
    $conn = new mysqli('localhost', 'root', '', 'meemli');
    if ($conn->connect_error) {
        die('Connection failed : ' . $conn->connect_error);
    } else {
        // Insert data into the database
        $stmt = $conn->prepare('INSERT INTO signup (parentEmail, reenterParentEmail, parentName, phoneNumber, childName, childGrade, childSchool, city, state, programs, timePreference, additionalDetails) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("sssissssssss", $parentEmail, $reenterParentEmail, $parentName, $phoneNumber, $childName, $childGrade, $childSchool, $city, $state, $programs, $timePreference, $additionalDetails);
        $stmt->execute();

        // Send confirmation email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = "smtp.gmail.com";  // Replace with your SMTP server
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Sender and recipient settings
            $mail->setFrom('programs@meemli.org', 'Meemli'); // Replace with your email and name
           // $mail->addAddress('programs@meemli.org');
            $mail->addAddress($parentEmail);

            // SMTP username and password (using API key)
            $mail->Username = 'simba.the.warrior@gmail.com';  // Replace with your SMTP key name
            $mail->Password = 'xjyu rnqy liox pnpe';

            // Content
            $mail->isHTML(true);
            //$mail->Subject = 'Confirmation for Meemli Summer Programs';
            $mail->Body = "
                <h1>Thank You for signing up for Meemli Summer Programs!</h1>
                <p><strong>Selected Programs:</strong> $programs</p>
                <p>We will contact you with more details before enrolling your child.</p>
                <p>Thank you for your interest!</p>

                <hr>

                <p>For any inquiries, please contact us at <a href='mailto:info@meemli.org'>info@meemli.org</a></p>
                <p>Visit our website: <a href='https://www.meemli.org'>www.meemli.org</a></p>
            ";

            $mail->send();
        } catch (Exception $e) {
            // Handle exceptions
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Display thank you message and follow-up
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thank You!</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Thank You for Submitting!</h1>
        <p>We will be reaching out to you soon.</p>
    </body>
    </html>';

    // Close the connection
    $conn->close();
}
?>

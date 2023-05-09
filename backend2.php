<?php
// Include PHPMailer library files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

// Get the form data from the POST request
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$driver_license = $_POST['driver-license'];
$experience = $_POST['experience'];
$endorsements = $_POST['endorsements'];
$references = $_POST['references'];

// Get the file data from the POST request
$uploaded_file = $_FILES['resume']['tmp_name'];
$file_name = $_FILES['resume']['name'];

// Set the recipient email address
$to = "youremail@example.com";

// Set the subject of the email
$subject = "Truck Driver Job Application";

// Create a new PHPMailer instance
$mail = new PHPMailer();

// Set the mailer to use SMTP
$mail->isSMTP();

// Set the SMTP host
$mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server address

// Set the SMTP authentication type
$mail->SMTPAuth = true;

// Set the SMTP username and password
$mail->Username = 'yourusername@gmail.com'; // Replace with your Gmail address
$mail->Password = 'yourpassword'; // Replace with your Gmail password

// Set the SMTP port
$mail->Port = 587; // Replace with your SMTP server port

// Set the encryption method to TLS
$mail->SMTPSecure = 'tls';

// Set the sender email address and name
$mail->setFrom($email, $name);

// Set the recipient email address and name
$mail->addAddress($to);

// Set the email subject
$mail->Subject = $subject;

// Build the email body
$message = "Name: $name<br>";
$message .= "Email: $email<br>";
$message .= "Phone: $phone<br>";
$message .= "Driver's License Number: $driver_license<br>";
$message .= "Years of Truck Driving Experience: $experience<br>";
$message .= "CDL Endorsements: $endorsements<br>";
$message .= "References:<br>$references<br>";

// Add the email body to the PHPMailer instance
$mail->Body = $message;

// Add the attachment file to the PHPMailer instance
$mail->addAttachment($uploaded_file, $file_name);

// Set the email format to HTML
$mail->isHTML(true);

// Send the email
if ($mail->send()) {
    echo "Application submitted successfully.";
} else {
    echo "Error submitting application.";
}
?>

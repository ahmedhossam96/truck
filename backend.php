<?php

// Set the recipient email address
$to = "ahmedhossamm1996@gmail.com";

// Set the subject of the email
$subject = "Truck Driver Job Application";

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
$file_type = $_FILES['resume']['type'];
$file_size = $_FILES['resume']['size'];

// Build the email message
$message = "Name: $name\n";
$message .= "Email: $email\n";
$message .= "Phone: $phone\n";
$message .= "Driver's License Number: $driver_license\n";
$message .= "Years of Truck Driving Experience: $experience\n";
$message .= "CDL Endorsements: $endorsements\n";
$message .= "References:\n$references\n\n";

// Open and read the uploaded file
$file = fopen($uploaded_file, 'rb');
$data = fread($file, filesize($uploaded_file));
fclose($file);

// Build the email attachment
$boundary = uniqid();
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
$message .= "--$boundary\r\n";
$message .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
$message .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
$message .= "Content-Transfer-Encoding: base64\r\n\r\n";
$message .= chunk_split(base64_encode($data));
$message .= "--$boundary--";

// Send the email
if (mail($to, $subject, $message, $headers)) {
echo "Application submitted successfully.";
} else {
echo "Error submitting application.";
}

?>
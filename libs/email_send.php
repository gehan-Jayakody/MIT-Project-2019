<?php
// core configuration
include_once "../config/core.php";

ini_set('SMTP', 'localhost');
ini_set('smtp_port', '25');
ini_set('sendmail_from', 'mitgroup04@gmail.com');

$to = $_SESSION['emalrcpt'];

$subject = $_SESSION['subject'];
$message = $_SESSION['message'];

$headers = "From: <NDBS BackOffice>mitgroup04@gmail.com\r\n";
$headers .= "Reply-To: <NDBS Operations>mitgroup04@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

if(mail($to, $subject, $message, $headers)){
	echo "E-mail Sent Successfully..!!!";
}
else {
	echo "E-mail Sending Failed..!!!";
}

?>
<?php
include 'config.php';
require __DIR__ . '/vendor/autoload.php';

//function to connect to database
function connectDB()
{
    global $mysqli, $host, $user, $password, $db;

    //connect to mysqli server and select database
    $mysqli = mysqli_connect($host, $user, $password, $db);

    //stop script execution if connection fails
    if (mysqli_connect_errno()) {
        printf("DB Connect failed:  %s\n", mysqli_connect_error());
        exit();
    }
}

//check email address
function checkEmail($email)
{
    global $mysqli, $safe_email, $check_res;

    //check that email is not already captured
    $safe_email = mysqli_real_escape_string($mysqli, $email);
    $check_sql = "SELECT id FROM SUBSCRIBERS
        WHERE email = '" . $safe_email . "'";
    $check_res = mysqli_query($mysqli, $check_sql) or die(json_encode(['error' => mysqli_error($mysqli)]));
}

function sendEmail($to, $subject, $body)
{
    try
    { // Create SMTP Transport
        $transport = new Swift_SmtpTransport('thefungist.com', 465, 'ssl');

        // Authentication
        $transport->setUsername('anyvoice@thefungist.com');
        $transport->setPassword('Anyvoice1');

        // Mailer
        $mailer = new Swift_Mailer($transport);

        // Message
        $message = new Swift_Message();

        // Subject
        $message->setSubject($subject);

        // Sender
        $message->setFrom(['anyvoice@thefungist.com' => 'Anyvoice App']);

        // Recipients
        $message->addTo($to);

        // Body
        $message->setBody($body, 'text/html');

        // Send the message
        $result = $mailer->send($message);} catch (Exception $exc) {

        echo json_encode([
            'error' => $exc->getMessage(),
        ]);
    }
}
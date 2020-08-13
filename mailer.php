<?php
require __DIR__ . '/vendor/autoload.php';

try {
//get JSON data from post request
    $request = file_get_contents('php://input');

    // Raise exception if page is visited manually
    if (null == $request) {
        throw new Exception('No request sent');
    }

    // decode JSON data from post request
    $data = json_decode($request, true);
    [
        'to' => $to,
        'subject' => $subject,
        'body' => $body,
    ] = $data;

// Create SMTP Transport
    $transport = new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl');

// Authentication
    $transport->setUsername('username@user.com');
    $transport->setPassword('password');

// Mailer
    $mailer = new Swift_Mailer($transport);

// Message
    $message = new Swift_Message();

// Subject
    $message->setSubject($subject);

// Sender
    $message->setFrom(['username@user.com' => 'Anyvoice App']);

// Recipients
    $message->addTo($to);

// Body
    $message->setBody($body, 'text/html');

// Send the message
    $result = $mailer->send($message);
    echo json_encode([
        'message' => 'Email Sent Successfully!',
    ]);
} catch (Exception $exc) {

    echo json_encode([
        'message' => $exc->getMessage(),
    ]);
}
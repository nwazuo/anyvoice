<?php
require __DIR__ . '/vendor/autoload.php';
include 'commons_include.php';

try {
    // get JSON data from post request
    $request = $_POST['email'];
    var_dump($request);

    // raise exception if page is visited manually
    if ($request == false) {
        throw new Exception('No request sent');
    }

    //decode JSON data from post request
    $email = $_POST['email'];

    //connect to database
    connectDB();

    //check that email is in list
    checkEmail($email);

    //get number of results and do action
    if (mysqli_num_rows($check_res) < 1) {
        //free result
        mysqli_free_result($check_res);

        //add record
        $add_sql = "INSERT INTO subscribers (email)
                    VALUES('" . $safe_email . "')";
        $add_res = mysqli_query($mysqli, $add_sql)
        or die(json_encode(['error' => mysqli_error($mysqli)]));

        //send mail
        sendEmail($email, 'No subject', 'Just testing stuff out');

        //success message
        echo json_encode([
            'message' => 'Thank you for subscribing, check your mailbox',
        ]);
    } else {
        //send failure message
        echo json_encode(['message' => 'You are already subscribed']);
    }
} catch (Exception $exc) {
    echo json_encode([
        'error' => $exc->getMessage(),
    ]);
}
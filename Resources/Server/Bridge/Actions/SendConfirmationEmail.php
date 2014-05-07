<?php

//bool mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]]

include_once '../Core/autoload.php';

$response = array();

if (!empty($_POST['facebook_user_id']) && !empty($_POST['facebook_user_arr'])) {

    $user = new Classes_User($_POST['facebook_user_id']);
    $user->getProfile();

	//-- Prepare email fields
	$email['recipient'] = $user->profile['email'];
	$email['subject'] = 'GCSA Mobile Confirmation';
	$email['message'] = 'Hello ' . $user->profile['first_name'] . ' ' . $user->profile['last_name'] . '!' . "\n\n" . 'Your confirmation code is: <strong>' . $user->profile['activation_code'] . '</strong>';
	$email['headers'] = "MIME-Version: 1.0" . "\r\n";
	$email['headers'] .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$email['headers'] .= 'From: <gcsa-mobile@greenville.edu>';

	//-- Actually send them their email!
    if (mail($email['recipient'], $email['subject'], $email['message'], $email['headers'])) {
        $response = array('status' => 'email_sent', 'email' => $email, 'fb_user' => $_POST['facebook_user_arr'], 'profile' => $user->profile);
    } else {
        $response = array('error' => 'php_mail');
    }

	//-- And then return something [s]pretty[/s] to the client.
	echo json_encode($response);
}
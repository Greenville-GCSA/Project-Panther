<?php

//bool mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]]

$response = array();
if (!empty($_POST['member_type'])) {

	//-- Get a random sequence
	require_once('Classes/GenerateRandomSequence.php');
	$options = array('sequence_length' => 4, 'repeat_ints' => true);
	$randomSequence = new GenerateRandomSequence($options);
	$randomSequence->getRandomSequence();

	//-- Prepare email fields
	$email['subject'] = 'GCSA Mobile Confirmation';
	$email['message'] = 'Hello {first_name} {last_name}!' . "\n\n" . 'Your confirmation code is: <strong>' . $randomSequence->getSequenceString() . '</strong>';
	$email['headers'] = "MIME-Version: 1.0" . "\r\n";
	$email['headers'] .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$email['headers'] .= 'From: <gcsa-mobile@greenville.edu>';

	//-- Determine what their email address will be, based on member type.
	if ($_POST['member_type'] == 1 && !empty($_POST['student_id'])) {
		$email['recipient'] = $_POST['student_id'] . '@panthers.greenville.edu';
	} else if ($_POST['member_type'] == 2 && (!empty($_POST['faculty_staff_first_name']) && !empty($_POST['faculty_staff_last_name']))) {
		$email['recipient'] = strtolower($_POST['faculty_staff_first_name'] . '.' . $_POST['faculty_staff_last_name']) . '@greenville.edu';
	}

	//-- Actually send them their email! We should *always* have a recipient, but never can be too careful.
	if (!empty($email['recipient'])) {
		if (mail($email['recipient'], $email['subject'], $email['message'], $email['headers']))
		    $response = array('status' => 'email_sent', 'email' => $email);
		else
		    $response = array('error' => 'php_mail');
	} else {
		$response['error'] = 'undefined';
	}

	//-- And then return something [s]pretty[/s] to the client.
	echo prepareOutputArray($response);
}

function prepareOutputArray($array) {
	return json_encode($array);
}
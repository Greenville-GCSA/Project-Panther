<?php

/*
 * Hours of Operation Requirements:
 * - Replace any spaces with an underscore for parsing.
 * - All open and close times will be strings based on military (24-hour) time format.
 * - For extensibility purposes, each day of the week is given its own object.
 * - All array elements should be fully lowercase.
 * - Phone numbers should be formatted as such: (618) 664-7077.
 * - All URLs should be full (including the protocol: http://).
 * - Phone, email, and website are optional and may be omitted or set to a null value.
 */
$building_hours = array(
	'it_department' => array(
		'hours' => array(
			'sunday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'monday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'tuesday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'wednesday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'thursday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'friday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'saturday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
		),
		'phone_number' => '(618) 664-7077',
		'email_address' => 'itsuppport@greenville.edu',
		'website' => 'http://it.greenville.edu',
	),
	'library' => array(
		'hours' => array(
			'sunday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'monday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'tuesday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'wednesday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'thursday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'friday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'saturday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
		),
		'phone_number' => '(618) 664-7077',
		'email_address' => 'libraryt@greenville.edu',
		'website' => 'http://library.greenville.edu',
	),
	'annex' => array(
		'hours' => array(
			'sunday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'monday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'tuesday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'wednesday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'thursday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'friday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
			'saturday' => array(
				'open' => '9:30',
				'close' => '21:30',
			),
		),
		'phone_number' => '(618) 664-7077',
		'email_address' => 'annex@greenville.edu',
		'website' => 'http://annex.greenville.edu',
	),
);

require('PHPArrayToJSON.php');
$jsonObject = new PHPArrayToJSON();
$jsonObject->set_json($building_hours);
echo '<textarea style="width:75%; height: 450px;">', $jsonObject->get_json(), '</textarea>';
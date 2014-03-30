<?php

require_once("../Classes/GenerateRandomSequence.php");
$randomSequence = new GenerateRandomSequence(array(8, 'repeat_ints' => true));

$randomSequence->getRandomSequence();

echo '
	<strong>Sequence Length:</strong> ', $randomSequence->getSequenceLength(), '
	<br />
	<strong>Sequence Map:</strong> ', print_r($randomSequence->getSequenceMap()), '
	<br />
	<strong>Sequence String:</strong> ', $randomSequence->getSequenceString(), '
	<br />
	<strong>Repeat Integers:</strong> ', $randomSequence->getRepeatInts() === true ? 'Yes' : 'No', '
';

echo '<br /><br />';

$randomSequence2 = new GenerateRandomSequence(array('sequence_length' => 5, 'repeat_ints' => false));

$randomSequence2->getRandomSequence();

echo '
	<strong>Sequence Length:</strong> ', $randomSequence2->getSequenceLength(), '
	<br />
	<strong>Sequence Map:</strong> ', print_r($randomSequence2->getSequenceMap()), '
	<br />
	<strong>Sequence String:</strong> ', $randomSequence2->getSequenceString(), '
	<br />
	<strong>Repeat Integers:</strong> ', $randomSequence2->getRepeatInts() === true ? 'Yes' : 'No', '
';
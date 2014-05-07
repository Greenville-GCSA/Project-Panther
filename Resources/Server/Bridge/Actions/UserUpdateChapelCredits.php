<?php
include_once '../Core/autoload.php';
if (!empty($_POST['user_id']) && isset($_POST['credits_primary']) && isset($_POST['credits_elective']) && isset($_POST['credits_total']) && isset($_POST['no_row'])) {
	$user = new Classes_User($_POST['user_id'], 'local');
	$user->updateChapelCredits($_POST['credits_primary'], $_POST['credits_elective'], $_POST['credits_total'], $_POST['no_row']);
	$response = array('message' => 'chapel_credits_updated');
} else {
	$response = array('message' => 'invalid_post_elements');
}
echo json_encode($response);
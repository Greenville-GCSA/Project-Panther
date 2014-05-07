<?php
include_once '../Core/autoload.php';
if (!empty($_POST['facebook_user_id']) && !empty($_POST['facebook_user_arr'])) {
    $user = new Classes_User($_POST['facebook_user_id']);
    if ($user->activateUser() == true) {
        $user->getProfile();
        $response = array('success' => 'user_activated', 'fb_user' => $_POST['facebook_user_arr'], 'profile' => $user->profile);
    } else {
        $response = array('error' => 'activation_failed');
    }
    echo json_encode($response);
}
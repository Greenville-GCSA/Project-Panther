<?php
include_once '../Core/autoload.php';
$_POST['facebook_user_id'] = !empty($_POST['facebook_user_id']) ? (int) $_POST['facebook_user_id'] : '';
if (!empty($_POST['facebook_user_id'])) {
    $user = new Classes_User($_POST['facebook_user_id']);
    $user->getProfile();
    echo json_encode($user->profile);
}
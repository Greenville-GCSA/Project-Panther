<?php
include '../Core/autoload.php';
if (!empty($_POST['facebook_user_id'])) {
    $user = new Classes_User($_POST['facebook_user_id']);
    $is_existing = $user->checkIsExistingUser();
    echo json_encode(array('is_existing' => $is_existing));
}
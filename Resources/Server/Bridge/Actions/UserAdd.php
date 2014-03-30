<?php
include '../Core/autoload.php';
if (!empty($_POST['new_user']) && !empty($_POST['facebook_user_id']) && !empty($_POST['facebook_access_token'])) {
    $user = new Classes_User($_POST['facebook_user_id']);
    $is_existing = $user->checkIsExistingUser();
    if ($is_existing === false) {
        $user_fields = array(
            'facebook_user_id' => $_POST['facebook_user_id'],
            'facebook_access_token' => $_POST['facebook_access_token'],
            'activation_code' => $_POST['activation_code'],
            'is_activated' => 0,
        );
        if (!empty($_POST['member_type']) && $_POST['member_type'] == 1) {
            if (!empty($_POST['student_id'])) {
                $user_fields['greenville_student_id'] = $_POST['student_id'];
                $user_fields['user_type'] = 1;
            } else {
                $response = array('error' => 'empty_student_id');
            }
        } else if (!empty($_POST['member_type']) && $_POST['member_type'] == 2) {
            if (!empty($_POST['faculty_staff_first_name']) && !empty($_POST['faculty_staff_last_name'])) {
                $user_fields['greenville_facstaff_first_name'] = $_POST['faculty_staff_first_name'];
                $user_fields['greenville_facstaff_last_name'] = $_POST['faculty_staff_last_name'];
                $user_fields['user_type'] = 2;
            } else {
                $response = array('error' => 'empty_facstaff');
            }
        }
        if ($user->addNew($user_fields) == true) {
            $response = array('success' => 'user_added');
        } else {
            $response = array('error' => 'add_failed');
        }
    }
    else {
        $response = array('error' => 'existing_user');
    }
} else {
    $response = array('error' => 'invalid_facebook_auth');
}
echo json_encode($response);

/*

//- - - Fake Data - - -\\
$_POST['new_user'] = true;
$_POST['facebook_user_id'] = 1958578373;
$_POST['facebook_access_token'] = 'fji518dhifdhjk15879513hkdjanlkfsjks';
$_POST['activation_code'] = mt_rand(1000, 9999);

$test = 'faculty-staff';
if ($test == 'student') {
    $_POST['type_student'] = 1;
    $_POST['student_id'] = 20130904;
} else {
    $_POST['type_faculty-staff'] = 1;
    $_POST['faculty_staff_first_name'] = 'Becky';
    $_POST['faculty_staff_last_name'] = 'Kerle';
}
*/
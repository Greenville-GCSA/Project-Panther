<?php

include '../Core/autoload.php';

class Classes_User {

    public $facebook_user_id, $database;
    public $profile, $global_bind;
    public $tables, $fb_identity_clause;

    public function __construct($facebook_user_id) {
        $this->database = new Core_Classes_Database('mysql:host=localhost;dbname=lab360_gcsa-mobile', 'lab360_gcsa', 'yahP9KF583xAz3jS');
        $this->facebook_user_id = $facebook_user_id;
        $this->global_bind = array(
            ':facebook_user_id' => $this->facebook_user_id
        );
        $this->tables = array(
            'users' => 'gcsa_users',
            'log' => 'gcsa_log_users'
        );
        $this->fb_identity_clause = 'facebook_user_id = :facebook_user_id';
    }

    public function addNew($user) {
        if ($this->database->insert($this->tables['users'], $user) !== 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIsExistingUser() {
        $select_columns = 'COUNT(id) AS count';
        //-- !!TODO: Check to see if the student id exists with another Facebook account. Same with Faculty Name / Last Name.
        $num_rows = $this->database->select($this->tables['users'], $this->fb_identity_clause, $this->global_bind, $select_columns);
        if ($num_rows[0]['count'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getProfile() {
        $this->profile = $this->database->select($this->tables['users'], $this->fb_identity_clause, $this->global_bind);
        $this->profile = $this->profile[0];
        if ($this->profile['user_type'] == 1) {
            $this->profile['user_type'] = array('id' => 1, 'text' => 'Student');
        } else if ($this->profile['user_type'] == 2) {
            $this->profile['user_type'] = array('id' => 1, 'text' => 'Faculty / Staff');
        }
        return $this->profile;
    }

    /* These methods set and update Facebook Access Tokens */
    public function setFacebookAccessToken($facebook_access_token) {
        $this->profile['facebook_access_token'] = $facebook_access_token;
        $this->updateFacebookAccessToken();
    }

    public function updateFacebookAccessToken() {
        $update_fields = array('facebook_access_token' => $this->profile['facebook_access_token']);
        $this->database->update($this->tables['users'], $update_fields, $this->fb_identity_clause, $this->global_bind);
    }

    /* These methods set and update User Activation Codes */
    public function setActivationCode($activation_code) {
        $this->profile['activation_code'] = $activation_code;
        $this->updateActivationCode();
    }

    public function updateActivationCode() {
        $update_fields = array('activation_code' => $this->profile['activation_code']);
        $this->database->update($this->tables['users'], $update_fields, $this->fb_identity_clause, $this->global_bind);
    }

    public function checkActivationCode($activation_code) {
        if ($activation_code === $this->profile['activation_code']) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserActivationStatus() {
        if (!empty($this->profile['is_activated'])) {
            return true;
        } else {
            return false;
        }
    }

    public function activateUser() {
        $update_fields = array('is_activated' => 1);
        $this->database->update($this->tables['users'], $update_fields, $this->fb_identity_clause, $this->global_bind);
    }
    
}
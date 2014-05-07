<?php

include_once '../Core/autoload.php';

class Classes_User {

    public $user_id, $id_type;
    public $profile, $global_bind;
    public $database, $tables;
	public $identity_clause;

    public function __construct($user_id, $id_type = 'facebook') {

        $this->database = new Core_Classes_Database('mysql:host=localhost;dbname=lab360_gcsa-mobile', 'lab360_gcsa', 'yahP9KF583xAz3jS');

		$this->user_id = $user_id;
		$this->id_type = $id_type;

		$this->global_bind = array(
			':resolved_user_id' => $this->user_id
		);

		switch ($this->id_type) {
			case 'facebook':
				$this->identity_clause = 'facebook_user_id = :resolved_user_id';
				break;
			case 'local':
				$this->identity_clause = 'id = :resolved_user_id';
				break;
		}

        $this->tables = array(
            'users' => 'gcsa_users',
            'log' => 'gcsa_log_users',
			'chapel_credit' => 'gcsa_chapel_credit'
        );

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
        $num_rows = $this->database->select($this->tables['users'], $this->identity_clause, $this->global_bind, $select_columns);
        if ($num_rows[0]['count'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getProfile() {
		$query = array(
			'tables' => $this->tables['users'] . ' AS u LEFT JOIN ' . $this->tables['chapel_credit'] . ' AS cc ON (u.id = cc.users_id)',
			'select' => 'u.*, IFNULL(cc.users_id, \'true\') AS no_row, IFNULL(cc.credits_primary, 0) AS credits_primary, IFNULL(cc.credits_elective, 0) AS credits_elective, IFNULL(cc.credits_total, 0) AS credits_total'
		);
        $this->profile = $this->database->select($query['tables'], $this->identity_clause, $this->global_bind, $query['select']);
        $this->profile = $this->profile[0];
        if ($this->profile['user_type'] == 1) {
            $this->profile['user_type'] = array('id' => 1, 'text' => 'Student');
            $this->profile['email'] = $this->profile['greenville_student_id'] . '@panthers.greenville.edu';
        } else if ($this->profile['user_type'] == 2) {
            $this->profile['user_type'] = array('id' => 1, 'text' => 'Faculty / Staff');
            $this->profile['email'] = $this->profile['greenville_facstaff_first_name'] . '.' . $this->profile['greenville_facstaff_last_name'] . '@greenville.edu';
        }
		$this->profile['credits_remaining'] = 32 - $this->profile['credits_total'];
        return $this->profile;
    }

    /* These methods set and update Facebook Access Tokens */
    public function setFacebookAccessToken($facebook_access_token) {
        $this->profile['facebook_access_token'] = $facebook_access_token;
        $this->updateFacebookAccessToken();
    }

    public function updateFacebookAccessToken() {
        $update_fields = array('facebook_access_token' => $this->profile['facebook_access_token']);
        $this->database->update($this->tables['users'], $update_fields, $this->identity_clause, $this->global_bind);
    }

    /* These methods set and update User Activation Codes */
    public function setActivationCode($activation_code) {
        $this->profile['activation_code'] = $activation_code;
        $this->updateActivationCode();
    }

    public function updateActivationCode() {
        $update_fields = array('activation_code' => $this->profile['activation_code']);
        $this->database->update($this->tables['users'], $update_fields, $this->identity_clause, $this->global_bind);
    }

	public function updateChapelCredits($primary, $elective, $total =  null, $no_row) {
		if ($total === null) {
			$total = $primary + $elective;
		}
		$database_fields = array(
			'users_id' => $this->user_id,
			'credits_primary' => $primary,
			'credits_elective' => $elective,
			'credits_total' => $total
		);
		if ($no_row == 'true') {
			$this->database->insert($this->tables['chapel_credit'], $database_fields);
		} else {
			$this->database->update($this->tables['chapel_credit'], $database_fields, 'users_' . $this->identity_clause, $this->global_bind);
		}
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
        if ($this->database->update($this->tables['users'], $update_fields, $this->identity_clause, $this->global_bind) == true) {
            return true;
        } else {
            return false;
        }
    }
    
}
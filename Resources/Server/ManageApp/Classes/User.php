<?php

class Classes_User {

	public $user_profile;

	public function __construct() {
		$this->user_profile = array(
			'is_logged' => false,
			'permissions' => array(),
			'is_super_admin' => false
		);
	}

	public function getProfile() {
		return $this->user_profile;
	}
}
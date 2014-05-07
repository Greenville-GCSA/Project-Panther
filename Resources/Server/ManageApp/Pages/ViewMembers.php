<?php

class Pages_ViewMembers extends Abstracts_Pages {

	public $database, $page, $settings;

	protected $members;

	public function __construct(Classes_UseDatabase $database) {
		$this->database = $database;
		$this->page = array(
			'url' => array(
				'title' => 'View App Members',
				'key' => 'viewMembers',
			),
			'tagline' => 'Below is a list of members who have registered on the app!',
			'wrapper_id' => 'viewMembers',
		);
		$this->settings = $this->getSettings();
		$this->getAllMembers();
	}

	public function head() {}

	public function prepend() {}

	public function content() {
		echo '
	<pre>', print_r($this->members), '</pre>
		';
	}

	public function append() {}

	private function getAllMembers($start = 0, $end = 25) {
		$query = array(
			'tables' => '',
			'columns' => array(),
			'conditions' => '',
			'params' => array()
		);

		$query['tables'] .= 'gcsa_users AS users';
		$query['tables'] .= ' LEFT JOIN gcsa_log_users AS log_users ON (users.id = log_users.users_id)';

		$query['columns'][] .= 'users.*';
		$query['columns'] = array_merge($query['columns'], array('log_users.operating_system', 'log_users.os_version', 'log_users.app_version', 'log_users.device_uid'));

		$query['params'][':start'] = $start;
		$query['params'][':end'] = $end;

		$results = $this->database->select($query);
		foreach ($results as $value) {
			$this->members[$value['id']] = $value;
		}
		return $this->members;
	}

}
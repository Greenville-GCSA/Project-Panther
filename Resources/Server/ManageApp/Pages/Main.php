<?php

class Pages_Main extends Abstracts_Pages {

	public $page, $settings;

	public function __construct() {
		$this->page = array(
			'url' => array(
				'title' => 'Home',
				'key' => 'main',
			),
			'tagline' => 'What would you like to do?',
			'wrapper_id' => 'main',
		);
		$this->settings = $this->getSettings();
	}

	public function head() {}

	public function prepend() {}

	public function content() {
		echo '
	<ul id="actions">
		<li><a href="index.php?page=createNewEvent">Create New Event</a></li>
		<li><a href="index.php?page=generateEventQrCode">Generate Event QR Code</a></li>
		<li class="divider"></li>
		<li class="divider"></li>
		<li><a href="index.php?page=viewMembers">View App Members</a></li>
		<li><a href="index.php?page=manageSpecialUsers">Manage Special Users</a></li>
		<li class="divider"></li>
		<li class="divider"></li>
		<li><a href="index.php?page=manageBuildingHours">Manage Building Hours</a></li>
		<li><a href="#">Generate Reports</a></li>
	</ul>
	<br class="clear" />
		';
	}

	public function append() {}

}
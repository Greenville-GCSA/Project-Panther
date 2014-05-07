<?php
error_reporting(E_ALL);
class Pages_GenerateEventQrCode extends Abstracts_Pages {

	public $event, $allEvents, $database, $page, $settings;

	public function __construct(Classes_UseDatabase $database) {
		$this->database = $database;
		$this->page = array(
			'url' => array(
				'title' => 'Generate Event QR Code',
				'key' => 'generateEventQrCode',
			),
			'tagline' => 'Below you are able to generate QR Codes for Events!',
			'wrapper_id' => 'generate-event-qr-code',
		);
		$this->settings = $this->getSettings();

		$this->allEvents = $this->getAllEvents();

		if (!empty($_REQUEST['eventId'])) {
			$this->event = $this->getEventData($_REQUEST['eventId']);
		}
	}

	public function head() {
		echo '
	<script src="../ManageApp/Plugins/QRCode/jquery.qrcode.js"></script>
	<script src="../ManageApp/Plugins/QRCode/qrcode.js"></script>
	<script src="../ManageApp/Plugins/QRCode/scripts.js"></script>
	<style>
		select#eventId {
			width: 90%;
			padding: 20px;
			margin: 0 auto 0 auto;
			display: block;
			font-size: 25pt;
			height: 50px;
			text-align: center;

		}
		.custSubmitButton {
			display: block;
			margin: 0 auto 0 auto;
			font-size: 25pt;
			height: 50px;
			width: auto;
		}

		#qr-container {
			/* Nothing for now, I suppose... */
		}

		#qr-container > * {
			display: block;
			margin: 0 auto 0 auto;
			text-align: center;
		}

		.control {
			position: absolute;
			background-color: #f8f8f8;
			top: 0;
			width: 190px;
			box-shadow: 0 0 32px rgba(0,0,0,0.5);
			overflow: hidden;
			text-align: left;
		}

		.control.left {
			left: 0;
		}

		.control.right {
			right: 0;
		}

		hr {
			margin: 12px 0 0;
			padding: 0;
			border: none;
			height: 1px;
			background-color: rgba(0,0,0,0.1);
		}

		label {
			font-size: 10px;
			color: #bbb;
			padding: 12px 4px 0 4px;
		}

		html.opera label[for="radius"] {
			color: #e55;
		}

		#download {
			text-align: center;
			font-weight: bold;
			text-decoration: none;
			display: block;
			color: #555;
			background-color: #ddd;
			margin: 4px;
			padding: 8px 0;
			border: 1px solid #ddd;
			cursor: pointer;
		}

		input, textarea, select {
			font-family: Ubuntu;
			display: block;
			background-color: #fff;
			margin: 2px;
			padding: 0 2px;
			border: 1px solid #ddd;
			width: 180px;
			height: 22px;
		}

		#text {
			height: 48px;
		}

		input[type="range"] {
			-webkit-appearance: none;
			cursor: pointer;
		}
		input::-webkit-slider-thumb {
			-webkit-appearance: none;
			width: 16px;
			height: 16px;
			border-radius: 3px;
			background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #aaa), color-stop(1, #aaa) );
		}
		.control {
			padding: 10px;
		}
	</style>
		';
	}

	public function prepend() {}

	public function content() {
		if (!empty($this->event)) {
			echo '
	<div id="qr-container"></div>

	<div class="control left">
		<label for="size">SIZE:</label>
		<input id="size" type="range" value="400" min="100" max="1000" step="50">
		<label for="fill">FILL</label>
		<input id="fill" type="color" value="#333333">
		<label for="background">BACKGROUND</label>
		<input id="background" type="color" value="#ffffff">
		<label for="text">CONTENT</label>
		<!--<textarea id="text">', sha1(mt_rand(1000, 9999) . $this->event['geo_cords_latitude'] . $this->event['id'] . $this->event['geo_cords_longitude'] . mt_rand(1000, 9999)), '</textarea>-->
		<textarea id="text">id=', $this->event['id'], '&amp;lat=', $this->event['geo_cords_latitude'], '&amp;long=', $this->event['geo_cords_longitude'], '</textarea>
		<hr>
		<label for="minversion">MIN VERSION:</label>
		<input id="minversion" type="range" value="6" min="1" max="10" step="1">
		<label for="eclevel">ERROR CORRECTION LEVEL</label>
		<select id="eclevel">
			<option value="L">L - Low (7%)</option>
			<option value="M">M - Medium (15%)</option>
			<option value="Q">Q - Quartile (25%)</option>
			<option value="H" selected="selected">H - High (30%)</option>
		</select>
		<label for="quiet">QUIET ZONE:</label>
		<input id="quiet" type="range" value="1" min="0" max="4" step="1">
		<label for="radius">CORNER RADIUS (not in Opera):</label>
		<input id="radius" type="range" value="50" min="0" max="50" step="10">
		<hr>
		<a id="download" download="qrcode.png">DOWNLOAD</a>
	</div>

	<div class="control right">
		<label for="mode">MODE</label>
		<select id="mode">
			<option value="0">0 - Normal</option>
			<option value="1" selected="selected">1 - Label-Strip</option>
			<option value="2">2 - Label-Box</option>
		</select>
		<hr>
		<label for="msize">SIZE:</label>
		<input id="msize" type="range" value="11" min="0" max="40" step="1">
		<label for="mposx">POS X:</label>
		<input id="mposx" type="range" value="50" min="0" max="100" step="1">
		<label for="mposy">POS Y:</label>
		<input id="mposy" type="range" value="50" min="0" max="100" step="1">
		<hr>
		<label for="label">LABEL</label>
		<input id="label" type="text" value="', $this->event['name'], '">
		<label for="font">FONT NAME</label>
		<input id="font" type="text" value="Ubuntu">
		<label for="fontcolor">FONT COLOR:</label>
		<input id="fontcolor" type="color" value="#ff9818">
	</div>
			';
		} else if (empty($this->event) && !empty($this->allEvents)) {
			echo '
		<form action="index.php" method="get">
			<input type="hidden" id="page" name="page" value="generateEventQrCode">
			<select id="eventId" name="eventId">
				<option value="" selected>Select An Event...</option>
				<optgroup label="Events:">';
				foreach ($this->allEvents as $value) {
					echo '
					<option value="', $value['id'], '">', $value['name'], ' (' , ($value['event_type'] == 1 ? 'Athletic' : 'Educational'), ' Event) on ', $value['datetime_start'], '</option>
					';
				}
				echo '
				</optgroup>
			</select>
			<br>
			<input type="submit" value="Generate QR Code!" class="custSubmitButton">
		</form>
			';
		}
	}

	public function append() {}

	private function getAllEvents() {

		$query['tables'] = 'gcsa_events AS events';

		$query['columns'] = array('events.id, events.name, events.datetime_start, events.geo_cords_latitude, events.geo_cords_longitude, events.geo_location_address, events.event_type');

		$results = $this->database->select($query);
		foreach ($results as $value) {
			$this->allEvents[$value['id']] = $value;
		}
		return $this->allEvents;
	}

	private function getEventData($eventId) {

		$query['tables'] = 'gcsa_events AS events';

		$query['columns'] = array('events.id, events.name, events.datetime_start, events.geo_cords_latitude, events.geo_cords_longitude, events.geo_location_address, events.event_type');

		$query['conditions'] = 'events.id = :event_id';

		$query['params'][':event_id'] = $eventId;

		$results = $this->database->select($query);
		foreach ($results as $value) {
			$this->event = $value;
		}
		return $this->event;
	}

	private function addNewQrChecksum() {
		$salt = array(mt_rand(1000, 9999), mt_rand(1000, 9999));
		$table = 'gcsa_qr_checksums';
		$fields = array(
			'id_event' => $this->event['id'],
			'hash' => $salt[0] . $this->event['geo_cords_latitude'] . $this->event['id'] . $this->event['longitude'] . $salt[1],
			'salt' => implode('_', $salt),
		);
		$result = $this->database->insert($table, $fields);
		return $result;
	}
}
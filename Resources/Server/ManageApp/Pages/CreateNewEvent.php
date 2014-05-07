<?php

class Pages_CreateNewEvent extends Abstracts_Pages {

	public $database, $page, $settings;

	protected $members;

	public function __construct(Classes_UseDatabase $database) {
		$this->database = $database;
		$this->page = array(
			'url' => array(
				'title' => 'Create New Event',
				'key' => 'createNewEvent',
			),
			'tagline' => 'Below is the form to create a new GCSA Sponsored Event!',
			'wrapper_id' => 'create-new-event',
		);
		$this->settings = $this->getSettings();
	}

	public function head() {
		echo '
	<link rel="stylesheet" href="../ManageApp/CSS/dark-hive/jquery-ui-1.10.4.custom.min.css">
	<script src="../ManageApp/JavaScript/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="../ManageApp/Plugins/DateTimePicker/jquery-ui-timepicker-addon.js"></script>
	<style>
		#create-new-event_wrapper {
			font-family: "Englebert", sans-serif;
		}

		select {
			font-size: 15pt;
			padding: 15px;
		}

		label {
			font-weight: bold;
			font-size: 20pt;
			color: #555;
			cursor: pointer;
			line-height: 28px;
		}

		input {
			font-size: 25pt;
			border: 1px dotted #999;
			padding: 5px;
			background: #e6e6e6;
			color: #999;
		}
		input[type=submit] {
			margin-top: 12px;
		}
		input[type=submit]:hover {
			cursor: pointer;
			color: #555;
		}
		input:focus {
			color: #555;
		}

		.form_container {
			margin-top: 12px;
		}
		.field_desc {
			color: #999;
			font-size: 15pt;
			width: 75%;
			line-height: 24px;
		}
		.field_extra {
			display: inline-block;
			margin-top: 4px;
			color: #999;
		}
		.location_field {
			border-left: 4px solid #555;
			margin-left: 25px;
			padding-left: 20px;
			padding-top: 1px;
			padding-bottom: 12px;
		}
		.location_field input {
			width: 71.5%;
			margin-left: -14px;
		}
		#gcsa_datetime_start:hover, #gcsa_datetime_end {
			cursor: pointer;
		}
		.latitude_longitude_suggestion {
			color: #555;
			line-height: 18px;
			display: block;
			margin-top: 10px;
			margin-bottom: 10px;
		}

		/* css for timepicker */
		.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
		.ui-timepicker-div dl { text-align: left; }
		.ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
		.ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
		.ui-timepicker-div td { font-size: 90%; }
		.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

		.ui-timepicker-rtl{ direction: rtl; }
		.ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
		.ui-timepicker-rtl dl dt{ float: right; clear: right; }
		.ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }
	</style>
	<script>
		jQuery(document).ready(function($) {
			$("#location").change(function() {
				$(".location_field").hide(function() {
					if ($("#location").val() == "cords") {
						$("#location_cords_cont").slideDown("slow");
					} else if ($("#location").val() == "approx") {
						$("#gcsa_geo_location_address_container").slideDown("slow");
					} else {
						$(".location-field").slideUp("slow");
					}
				});
			});
			$("#gcsa_datetime_start, #gcsa_datetime_end").datetimepicker({
				dateFormat: "MM d, yy",
				timeFormat: "\'at\' hh:mm",
				parseDate: "yy-mm-dd",
				parseTime: "HH:mm"
			});

		});
	</script>
		';
	}

	public function prepend() {}

	public function content() {
		echo '
			<form action="', $_SERVER['PHP_SELF'], '" method="post">
				<!-- Event Name -->
				<div id="gcsa_events_name_container" class="form_container">
					<div class="floatleft" style="width: 50%; margin-top: 5px;">
						<label for="gcsa_events_name">Event Name:</label>
						<div class="field_desc">The name of the event.</div>
					</div>
					<div class="floatright" style="width: 50%;">
						<input type="text" id="gcsa_events_name" name="gcsa_events_name">
					</div>
					<br class="clear" />
				</div>
				<!-- The Date and Time the Event Starts -->
				<div id="events_datetime_start" class="form_container">
					<div class="floatleft" style="width: 50%; margin-top: 5px;">
						<label for="gcsa_datetime_start">Start Date and Time:</label>
						<div class="field_desc">The date and time the event begins.</div>
					</div>
					<div class="floatright" style="width: 50%;">
						<input type="text" id="gcsa_datetime_start" name="gcsa_datetime_start" readonly="readonly">
						<span class="field_extra"><strong>24-Hour Format:</strong> yyyy-mm-dd hh:mm:ss</span>
					</div>
					<br class="clear" />
				</div>
				<!-- The Date and Time the Event Ends -->
				<div id="events_datetime_end" class="form_container">
					<div class="floatleft" style="width: 50%; margin-top: 5px;">
						<label for="gcsa_datetime_end">End Date and Time:</label>
						<div class="field_desc">The date and time the event ends.</div>
					</div>
					<div class="floatright" style="width: 50%;">
						<input type="text" id="gcsa_datetime_end" name="gcsa_datetime_end" readonly="readonly">
						<span class="field_extra"><strong>24-Hour Format:</strong> yyyy-mm-dd hh:mm:ss</span>
					</div>
					<br class="clear" />
				</div>
				<div id="location_cont" class="form_container">
					<div class="floatleft" style="width: 50%; margin-top: 5px;">
						<label for="location">Location Type:</label>
						<div class="field_desc">The type of location for the event. Either coordinates or an address.</div>
					</div>
					<div class="floatright" style="width: 50%; margin-top: 5px;">
						<select id="location" name="location">
							<option value="">Select Type...</option>
							<optgroup label="Types:">
								<option value="cords">Geographic Coordinates</option>
								<option value="approx">Approximate Address</option>
							</optgroup>
						</select>
					</div>
					<br class="clear" />
				</div>
				<div id="location_cords_cont" class="form_container location_field hidden">
					<span class="latitude_longitude_suggestion">To get a accurate latitude and longitude, please find the event...<br>location on <a href="http://maps.google.com" target="_blank">Google Maps</a> and then copy the latitude and longitude.</span>
					<div id="events_latitude" class="form_container">
						<div class="floatleft" style="width: 50%; margin-top: 5px;">
							<label for="gcsa_events_geo_cords_latitude">Latitude:</label>
							<div class="field_desc">The latitude of the event. A buffer will be added to allow for buildings.</div>
						</div>
						<div class="floatright" style="width: 50%; margin-top: 5px;">
							<input type="text" id="gcsa_events_geo_cords_latitude" name="gcsa_events_geo_cords_latitude">
						</div>
						<br class="clear" />
					</div>
					<div id="events_longitude" class="form_container">
						<div class="floatleft" style="width: 50%; margin-top: 5px;">
							<label for="gcsa_events_geo_cords_longitude">Longitude:</label>
							<div class="field_desc">The longitude of the event. A buffer will be added to allow for buildings.</div>
						</div>
						<div class="floatright" style="width: 50%; margin-top: 5px;">
							<input type="text" id="gcsa_events_geo_cords_longitude" name="gcsa_events_geo_cords_longitude">
						</div>
						<br class="clear" />
					</div>
				</div>
				<div id="gcsa_geo_location_address_container" class="form_container location_field hidden">
					<span class="latitude_longitude_suggestion">Enter the event address below, it must be exact (including City, State, and Zip Code.) If you do not know the exact address,<br>please find the event location on <a href="http://maps.google.com" target="_blank">Google Maps</a> and enter the approximate address below.</span>
					<div class="floatleft" style="width: 50%; margin-top: 5px;">
						<label for="gcsa_geo_location_address">Approximate Address:</label>
						<div class="field_desc">An approximate or estimated address of the event (include city, state, and zip code.)</div>
					</div>
					<div class="floatright" style="width: 50%; margin-top: 5px;">
						<input type="text" id="gcsa_geo_location_address" name="gcsa_geo_location_address">
					</div>
					<br class="clear" />
				</div>
				<div id="pantherpoints_athletic_points_container" class="form_container">
					<div class="floatleft" style="width: 50%; margin-top: 5px;">
						<label for="gcsa_pantherpoints_athletic">Athletic PantherPoints:</label>
						<div class="field_desc">How many Athletic PantherPoints to award to students who attend.</div>
					</div>
					<div class="floatright" style="width: 50%; margin-top: 5px;">
						<input type="number" id="gcsa_pantherpoints_athletic" name="gcsa_pantherpoints_athletic">
					</div>
					<br class="clear" />
				</div>
				<div id="gcsa_pantherpoints_educational_container" class="form_container">
					<div class="floatleft" style="width: 50%; margin-top: 5px;">
						<label for="gcsa_pantherpoints_educational">Educational PantherPoints:</label>
						<div class="field_desc">How many Educational PantherPoints to award to students who attend.</div>
					</div>
					<div class="floatright" style="width: 50%; margin-top: 5px;">
						<input type="number" id="gcsa_pantherpoints_educational" name="gcsa_pantherpoints_educational">
					</div>
					<br class="clear" />
				</div>
				<div id="events_submit">
					<input type="submit" value="Add Event!" />
				</div>
			</form>
		';
	}

	public function append() {}

}
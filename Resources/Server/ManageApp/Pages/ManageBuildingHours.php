<?php

class Pages_ManageBuildingHours extends Abstracts_Pages {

	public $database, $page, $settings;
    public $buildings, $selectedBuilding;

	public function __construct(Classes_UseDatabase $database) {
		$this->database = $database;
		$this->page = array(
			'url' => array(
				'title' => 'Manage Building Hours',
				'key' => 'manage_building_hours',
			),
			'tagline' => 'Below you are able to manage the GC Building Hours!',
		);
		$this->settings = $this->getSettings();
		$this->buildings = $this->getAllBuildings();
	}

	public function head() {
    	echo '
	<link rel="stylesheet" href="../ManageApp/CSS/dark-hive/jquery-ui-1.10.4.custom.min.css">
	<script src="../ManageApp/JavaScript/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="../ManageApp/Plugins/DateTimePicker/jquery-ui-timepicker-addon.js"></script>
    <style>
        .building .title {
            font-size: 32pt;
            text-align: center;
            font-weight: bold;
            font-family: "Englebert",sans-serif;
            font-weight: bold;
            color: #555;
            margin-top: 18px;
            line-height: 50px;
            margin-bottom: 6px;
        }
        .custom_table {
            width: 100%;
            border: 1px solid #999;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            border-collapse: collapse;
        }
        .custom_table th {
            font-family: "Englebert",sans-serif;
            color: #555;
            text-align: center;
            padding: 10px;
            background: #e4e4e4;
            font-weight: bold;
            font-size: 18pt;
        }
        .custom_table td {
            border-top: 1px solid #999;
            padding: 10px;
            text-align: center;
        }
        .custom_table td:nth-child(1), .th_first {
            text-transform: capitalize;
            font-size: 17pt;
            font-family: "Englebert",sans-serif;
            color: #555;
            line-height: 22px;
        }
        .custom_table td:nth-child(2), .th_second {
            border-left: 1px solid #999;
            border-right: 1px solid #999;
        }
        .custom_table td:nth-child(3), .th_third {
            border-right: 1px solid #999;
        }
        .custom_table td input[type=text] {
            width: 60%;
            padding: 6px;
            text-align: center;
            font-size: 10pt;
        }
        .custom_table tr:first-child th:first-child {
            font-size: 26pt !important;
            line-height: 38px;
        }
        .custom_table tr:nth-child(odd) {
            background: #eee;
        }
        input[type=submit] {
            font-family: "Englebert",sans-serif;
            font-size: 25pt;
            padding: 10px;
            width: 100%;
            margin-top: 12px;
            color: #555;
            background: #ccc;
            line-height: 22px;
            padding-top: 16px;
            border: 1px solid #eee;
        }
        input[type=submit]:hover, #add-new-row:hover {
            color: #999;
            cursor: pointer;
        }
        input[disabled=disabled] {
            background: #ddd;
        }

		/* Timepicker */
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

        /* Datepicker */
        table.ui-datepicker-calendar {
            color: #999 !important;
        }

        input.datepicker, input.timepicker, input.datetimepicker {
            cursor: text;
        }
    </style>
    <script>
    jQuery(document).ready(function($) {
        $("#select_building").change(function(e) {
            if ($(this).val() != "") {
                $("#submit_button").removeAttr("disabled");
            }
        });
        $("input.datepicker, input.timepicker, input.datetimepicker").attr("readonly", "readonly");
        $(".datepicker").datepicker({
            minDate: 0
        });
        $(".timepicker").timepicker({
				timeFormat: "hh:mmtt",
				parseTime: "HH:mm"
        });
        $(".is_closed").on("change", function(e) {
            if ($(this).is(":checked")) {
                var thisId = $(this).attr("id");
                thisId = thisId.replace("day_", "row_");
                thisId = thisId.replace("_is_closed", "");
                $("tr#" + thisId + " input[type=text]").val("").attr("disabled", "disabled");
            } else {
                var thisId = $(this).attr("id");
                thisId = thisId.replace("day_", "row_");
                thisId = thisId.replace("_is_closed", "");
                $("tr#" + thisId + " input[type=text]").removeAttr("disabled");
            }
        });
        $("td#add-new-row").on("click", function(e) {
            $("table#special_hours tbody").append(\'<tr><td class="th_first"><input type="text" class="datepicker"></td><td class="th_second"><input type="text" class="timepicker"></td><td class="th_third"><input type="text" class="timepicker"></td><td><input type="checkbox"></td></tr>\');
            $(".datepicker").datepicker({
                minDate: 0
            });
            $(".timepicker").timepicker({
				timeFormat: "hh:mmtt",
				parseTime: "HH:mm"
            });
        });
    });
    </script>
    	';
	}

	public function prepend() {}

	public function content() {
        if ($this->buildingController() === 'main') {
            $this->templateSelectBuilding();
        } else {
            $this->templateModifyBuildingHours();
        }
	}

    private function buildingController() {
        if (!empty($_POST['select_building'])) {
            $_POST['select_building'] = str_replace('building_', '', $_POST['select_building']);
            if (array_key_exists($_POST['select_building'], $this->buildings)) {
                $this->selectedBuilding = $this->buildings[$_POST['select_building']];
                return 'building';
            } else {
                return 'main';
            }
        } else {
            return 'main';
        }
    }

    private function templateSelectBuilding() {
        echo '
    <form action="', $this->settings['url'], '" method="post">
        <select id="select_building" name="select_building">
            <option value="">Select a Building...</option>
            <optgroup label="Buildings:">';
            foreach ($this->buildings as $key => $value) {
                echo '<option value="building_', $key, '">', $value['name'], '</option>';
            }
            echo '</optgroup>
        </select>
        <input type="submit" value="Modify Building Hours!" id="submit_button" disabled="disabled">
    </form>';
    }

    private function templateModifyBuildingHours() {
        $building = $this->selectedBuilding;
        $days = array(
            1 => 'sunday',
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday'
        );

        echo '
    <div id="building_', $building['id'], '" class="building">
        <div class="title">', $building['name'], '</div>
        <form action="', $this->settings['url'], '" method="post">
            <div class="floatleft" style="width: 49%;">
                <table id="traditional_hours" class="custom_table">
                    <thead>
                        <tr>
                            <th colspan="4">Traditional Hours</th>
                        </tr>
                        <tr>
                            <th scope="col">Day</th>
                            <th scope="col">Opens At</th>
                            <th scope="col">Closes At</th>
                            <th scope="col">Closed</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach ($days as $key => $day) {
                        echo '
                        <tr id="row_', $key, '">
                            <td class="th_first">', $day, '</td>
                            <td class="th_second">
                                <input type="text" class="timepicker">
                            </td>
                            <td class="th_third">
                                <input type="text" class="timepicker">
                            </td>
                            <td>
                                <input type="checkbox" id="day_', $key, '_is_closed" name="day_', $key, '_is_closed" class="is_closed">
                            </td>
                        </tr>';
                        }
                        echo '
                    </tbody>
                </table>
            </div>
            <div class="floatright" style="width: 49%;">
                <table id="special_hours" class="custom_table">
                    <thead>
                        <tr>
                            <th colspan="4">Special Hours</th>
                        </tr>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Opens At</th>
                            <th scope="col">Closes At</th>
                            <th scope="col">Closed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="th_first"><input type="text" class="datepicker"></td>
                            <td class="th_second"><input type="text" class="timepicker"></td>
                            <td class="th_third"><input type="text" class="timepicker"></td>
                            <td><input type="checkbox"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" id="add-new-row">&laquo; Add Another Row &raquo;</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br class="clear">
            <input type="submit" value="Save Hours!">
        </form>
    </div>
        ';
    }

	public function append() {}

	private function getAllBuildings() {
		$query['tables'] = 'gcsa_buildings';
		$query['columns'] = array('id', 'building_key', 'name', 'phone', 'email', 'website', 'address');
		$results = $this->database->select($query);
		foreach ($results as $value) {
			$this->buildings[$value['id']] = $value;
			$this->buildings[$value['id']]['hours'] = array('traditional' => array(), 'special' => array());
		}
		unset($query);
        $query['tables'] = 'gcsa_buildings_hours';
        $query['columns'] = array('buildings_id', 'day', 'hours_open AS open', 'hours_close AS close');
		$results = $this->database->select($query);
		foreach ($results as $value) {
			$this->buildings[$value['buildings_id']]['hours']['traditional'][$value['day']] = array('open' => $value['open'], 'close' => $value['close']);
		}
		unset($query);
		$query['tables'] = 'gcsa_buildings_hours_exceptions';
		$query['columns'] = array('buildings_id', 'date', 'hours_open AS open', 'hours_close AS close');
		$results = $this->database->select($query);
		foreach ($results as $value) {
			$this->buildings[$value['buildings_id']]['hours']['special'][$value['date']] = array('open' => $value['open'], 'close' => $value['close']);
		}
		return $this->buildings;
	}

}
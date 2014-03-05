<?php
/*
 * PHP Array to JSON String
 *
 * Written by: Matthew P. Kerle
 * Email: creativewebdsign@gmail.com
 */
class PHPArrayToJSON {
	public $json_string = '';
	public function set_json($php_array, $use_utf8 = true)
	{
		if ($use_utf8 === true) {
			$this->json_string = utf8_encode(json_encode($php_array));
		} else {
			$this->json_string = json_encode($php_array);
		}
	}
	public function get_json()
	{
		return $this->json_string;
	}
}
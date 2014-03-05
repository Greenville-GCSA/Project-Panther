<?php

/*
 * Compile HTML
 * - This is a simple class that is used to take semantic markup and compile it
 * - into a single line, stripping \n, \t, and \r.
 */
class CompileHTML {
	public $compiled_html;
	public function set_html($inputted_markup) {
		$this->compiled_html = $inputted_markup;
	}
	public function get_html() {
		$this->compiled_html = str_replace(array("\n", "\t", "\r"), '', $this->compiled_html);
		return $this->compiled_html;
	}
}
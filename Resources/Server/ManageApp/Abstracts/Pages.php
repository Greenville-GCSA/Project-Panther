<?php

//-- Abstract Class: Abstracts/Pages
abstract class Abstracts_Pages {

	//-- All of the abstract (required) methods.
	abstract public function __construct();
	abstract public function head();
	abstract public function prepend();
	abstract public function content();
	abstract public function append();

	//-- Common and accessible methods.
	public function titleUrl() {
		echo $this->page['url']['title'];
	}

	public function titlePage() {
		echo $this->page['tagline'];
	}

	public function getWrapperId() {
		echo $this->page['wrapper_id'];
	}

	public function getSettings() {
		return array(
			'url' => 'index.php?page=' . $this->page['url']['key'],
		);
	}
}
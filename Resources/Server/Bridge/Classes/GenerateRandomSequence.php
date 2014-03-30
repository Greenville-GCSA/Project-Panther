<?php

class GenerateRandomSequence {

	public $sequence_length, $sequence_map, $sequence_string;
	public $sequence_set;
	public $lower_bounds, $top_bounds, $repeat_ints;

	public function __construct($options = array('sequence_length' => 4, 'repeat_ints' => true)) {
		$this->sequence_length = !empty($options[0]) ? $options[0] : (!empty($options['sequence_length']) ? $options['sequence_length'] : 4);
		$this->sequence_map    = array(0, 0, 0, 0);
		$this->sequence_string = "0000";
		$this->sequence_set    = false;

		$this->lower_bounds    = 0;
		$this->top_bounds      = 9;
		$this->repeat_ints  = isset($options[1]) ? $options[1] : (isset($options['repeat_ints']) ? $options['repeat_ints'] : true);
	}

	/* The length of the sequence (4 by default) */
	public function setSequenceLength($sequence_length) {
		$this->sequence_length = (int) $sequence_length;
	}

	public function getSequenceLength() {
		return $this->sequence_length;
	}

	/* An array of each individual item in the sequence */
	public function setSequenceMap($sequence_string) {
		$this->sequence_map = str_split($sequence_string);
	}

	public function getSequenceMap() {
		return $this->sequence_map;
	}

	/* A string of the integers */
	public function setSequenceString($sequence_string) {
		$this->sequence_string = $sequence_string;
	}

	public function getSequenceString() {
		return $this->sequence_string;
	}

	public function setSequenceSet($sequence_set) {
		$this->sequence_set = $sequence_set;
	}

	public function getSequenceSet() {
		return $this->sequence_set;
	}

	/* The boundaries of the integers */
	public function setBounds($lower_bounds, $top_bounds) {
		$this->lower_bounds = $lower_bounds;
		$this->top_bounds   = $top_bounds;
	}

	public function getLowerBounds() {
		return $this->lower_bounds;
	}

	public function getTopBounds() {
		return $this->top_bounds;
	}

	public function getBounds() {
		return array('lower' => $this->lower_bounds, 'top' => $this->top_bounds);
	}

	/* Getter and Setter for Duplicating Integers within the sequence */
	public function setRepeatInts($repeat_ints) {
		$this->repeat_ints = $repeat_ints;
	}

	public function getRepeatInts() {
		return $this->repeat_ints;
	}

	public function generateSequence() {
		$current_sequence = array();
		for ($iteration = 0; $iteration < $this->sequence_length; ++$iteration) {
			$current_sequence[] = $this->generateRandomInteger($current_sequence);
		}
		$this->setSequenceString(implode("", $current_sequence));
		$this->setSequenceMap($this->sequence_string);
		$this->setSequenceSet(true);
	}

	public function generateRandomInteger($current_sequence) {
		if ($this->repeat_ints === false) {
			do {
				$integer = mt_rand($this->lower_bounds, $this->top_bounds);
			} while (in_array($integer, $current_sequence));
		} else {
			$integer = mt_rand($this->lower_bounds, $this->top_bounds);
		}
		return $integer;
	}

	public function getRandomSequence() {
		$this->generateSequence();
	}

}
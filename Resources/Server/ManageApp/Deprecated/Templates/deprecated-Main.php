<?php

class Templates_Main {

	private $metaElements;
	private $externalStyling, $internalStyling;
	private $externalScripting, $internalScripting;

	private $cssProcessVariables;
	private $cssVariables;

	private $preserveWhitespace;
	private $cssPreProcessor;
	public function __construct($preserve_whitespace = false, $cssProcessVariables = true) {
		$this->preserveWhitespace  = $preserve_whitespace;
		$this->cssProcessVariables = $cssProcessVariables;
		$this->cssVariables        = self::getCssVariables();
	}

	public function headElement() {
		echo $this->getDocumentMetaMarkup();
		echo $this->setExternalStyling();

		echo $this->documentInlineStyling();
		echo $this->documentExternalScripting();
		echo $this->documentInternalScripting();
	}

	//--- Document Meta Tags
	public function setDocumentMeta() {
		$this->metaElements = array(
			'charset="utf8"',
		);
	}

	public function getDocumentMetaMarkup() {
		$response = '';
		foreach ($this->metaElements as $e) {
			if ($this->preserveWhitespace == true) {
				$response .= "\n";
			}
			$response .= '<meta ' . $e . '>';
		}
		return $response;
	}

	//--- Style Sheets
	public function setExternalStyling() {
		$this->externalStyling = array(
			'http://fonts.googleapis.com/css?family=Englebert',
		);
	}

	public function getExternalStylingMarkup() {
		$response = '';
		foreach ($this->externalStyling as $e) {
			if ($this->preserveWhitespace == true) {
				$response .= "\n";
			}
			$response .= '<link href="' . $e . '">';
		}
		return $response;
	}

	public function setInternalStyling() {
		$this->internalStyling = '

		';
	}

	public static function getCssVariables() {
		$cssVariables = array(
			'color' => array(
				'dark_grey' => '#555',
				'light_grey' => '#999',
			),
			'font' => array(
				'main' => '"Englebert", sans-serif',
			),
			'border' => array(
				'main' => '4px dotted #999',
			),
		);
		$response = array();
		foreach ($cssVariables as $key => $value) {
			if (is_array($value)) {
				foreach ($value as $subKey => $subValue) {
					$response[$key . '[' . $subKey . ']'] = $subValue;
				}
			}
		}
		return $response;
	}
}
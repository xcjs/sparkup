<?php

namespace XCJS\Sparkup;

/**
 * 
 * @package Sparkup
 */
class TextNode {
	
	// Member Variables -------------------------------------------------------/
	private $text = null;

	private $writeModes = array(
		'encoded',
		'raw',
		'stripped'
	);
	private $writeMode = null;

	// Public Members ---------------------------------------------------------/

	public function __construct($text) {
		$this->text = $text;
		$this->WriteMode('encoded');
	}

	public function write() {
		switch($this->writeMode) {
			default:
				return '';
			break;

			case 'encoded':
				return htmlspecialchars($this->text);
			break;

			case 'raw':
				return $this->text;
			break;

			case 'stripped':
				return strip_tags($this->text);
			break;
		}
	}	

	public function writeLine() {
		return $this->write() . "\n";
	}

	// Properties -------------------------------------------------------------/

	// Essentially the same as writing in raw mode, but provides an accessible 
	// property
	public function Text($text = null) {
		if(isset($text)) {
			if(is_string($text)) {
				$this->text = $text;
			}
			else
				throw new \Exception('Property "Text" must be a string.');				
		}
		else
			return $this->text;
	}

	public function WriteMode($mode = null) {
		if(isset($mode)) {
			if(is_string($mode) && in_array($mode, $this->writeModes))
				$this->writeMode = $mode;
			else
				throw new \Exception('Property "WriteMode" must be a string and one of the following values: ' . implode(', ', $this->writeModes));
		}
		else
			return $this->writeMode;
	}
}

?>
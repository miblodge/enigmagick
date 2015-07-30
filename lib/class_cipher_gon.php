<?php
	//echo ' test 23';

	require_once 'class_cipher.php';

	class cipher_gon extends cipher {		
		public $values2char = array (
		);

		public $char2values = array (
			'O' => -12,
			'P' => -11,
			'Q' => -10,
			'R' => -9,
			'S' => -8,
			'T' => -7,
			'U' => -6,
			'V' => -5,
			'W' => -4,
			'X' => -3,
			'Y' => -2,
			'Z' => -1,
			'N' => 0,
			'B' => 1,
			'C' => 2,
			'D' => 3,
			'E' => 4,
			'F' => 5,
			'G' => 6,
			'H' => 7,
			'I' => 8,
			'J' => 9,
			'K' => 10,
			'L' => 11,
			'M' => 12,
			'A' => 13
		);

		function __construct($text_source = '',$file_source = '') {
			$this->values2char = array_flip($this->char2values);

			if($text_source != '') {
				$words = explode(' ',$text_source);
				foreach($words as $word) $this->text[] = $word;
			} else {
				if($file_source == '') $file_source = 'liberal.txt';
				
				$source = dirname(__FILE__).'/../texts/'.$file_source;
				$lines = file($source, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

				foreach($lines as $line) {
					$words = explode(' ',$line);
					foreach($words as $word) $this->text[] = $word;
				}
			} 
		}

		public function getMatchesFromText($value) {
			// We need to use the negative values version...
			return $this->getMatchesFromTextNegValues($value);				
		}
	}	

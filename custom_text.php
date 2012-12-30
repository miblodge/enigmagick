<?php
	$search = '';
	$text_source = '';
	if(isset($_REQUEST["search_text"])) $search = $_REQUEST["search_text"]; 
	if(isset($_REQUEST["text_source"])) $text_source = $_REQUEST["text_source"]; 


	if(trim($text_source) == '') {
		$text_source = '';
		$source_name = 'Liber Al';
	} else {
		$source_name = 'Custom Text';
	} 

	//echo $search.' ';

	require_once 'lib/class_cipher_alw.php';

	$cipher = new cipher_alw($text_source);

	//print_r($cipher);
	$search_value = 0;
	$matches = array();	
	
	if($search != '') $search_value = $cipher->calculateValue($search);
	if($search_value > 0) {
		$matches = $cipher->getMatchesFromText($search_value);
		$triangle = $cipher->getTriangle($search);
	} else {
		// Check if search is numeric and if so evaluate...
		if((int)$search == $search) {
			$search_value = (int)$search;
			$matches = $cipher->getMatchesFromText($search_value);
			$search = $matches[0];
			$triangle = $cipher->getTriangle($search);
		}
	}	

	$form = 'custom';

	include 'theme/default/page.php';
?>

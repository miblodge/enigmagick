<?php
	$search = '';
	if(isset($_GET["search_text"])) $search = $_GET["search_text"]; 

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

	include('themes/default/page.php');
?>

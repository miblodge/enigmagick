<?php
	$search = '';
	$text_source = '';
	$file_source = '';
	if(isset($_REQUEST["search_text"])) $search = trim($_REQUEST["search_text"]); 
	if(isset($_REQUEST["file_source"])) $file_source = $_REQUEST["file_source"]; 

	if(trim($file_source) == '') {
		$file_source = '';
		$source_name = 'Liber Al';
	} else {
		$source_name = $file_source;
	} 

	//echo $file_source.' ';

	require_once 'lib/class_cipher_alw.php';

	$cipher = new cipher_alw('',$file_source);

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

	$form = 'advanced';
	$form_action = 'advanced.php';
	//$source_files = glob('texts/' . "*.txt");
	$source_files = array();

	if (is_dir('texts')) {
		if ($dh = opendir('texts')) {
			while (($file = readdir($dh)) !== false) {
				if(substr($file,-4) == '.txt') $source_files[] = $file;
			}
        		closedir($dh);
    		}
	}

	include 'theme/default/page.php';
?>

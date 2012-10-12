<?php
/*
Script detect lang v 0.1

Created by Nicolas Marin Torres
nicolas@archivados.com
http://www.nicolasmarin.com/
*/


function get_words($text) {
	$text = mb_strtolower($text, 'utf-8');
	$words = mb_split(' +', $text);
	return $words;
}

function detect_lang($text) {
	$languages = array();
	if ($dh = opendir("stop/")) {
        	while (($file = readdir($dh)) !== false) {
        		if (!is_dir("stop/".$file) && $file!="." && $file!="..")
        		$languages[] = $file;
        	}
        }
        
	$stop_words = array();

	foreach($languages as $language) {
		$gestor = @fopen("stop/$language", "r");
		if ($gestor) {
			while (($buffer = fgets($gestor, 4096)) !== false) {
				if(!isset($stop_words[$language]))
					$stop_words[$language] = $buffer;
				else
					$stop_words[$language] .= " $buffer";
			}
		}
	
	}

	$scores = array();
	
	$words = get_words($text);

	foreach($words as $word) {
		//echo "$word<br>";
		foreach($languages as $language) {
			if(strpos($stop_words[$language], $word) !== FALSE)
				$scores[$language] += 1;
			
		}
	}
	
	arsort($scores);
	//print_r($scores);
	return key($scores);
}

?>

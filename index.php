<?php
/*
Script detect lang v 0.1

Created by Nicolas Marin Torres
nicolas@archivados.com
http://www.nicolasmarin.com/
*/

include("detect.php");

$url = "http://www.archivados.com/";

echo "lang(<a href='$url' target='_blank'>$url</a>): ".detect_lang(strip_tags(file_get_contents($url)));

?>

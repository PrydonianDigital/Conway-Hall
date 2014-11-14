<?php 

$line = file_get_contents("http://countdown.tfl.gov.uk/stopBoard/{$_GET['stop']}/");

echo $line;

?>
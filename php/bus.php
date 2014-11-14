<?php 



$line = file_get_contents("http://countdown.tfl.gov.uk/markers/swLat/{$_GET['swLat']}/swLng/{$_GET['swLng']}/neLat/{$_GET['neLat']}/neLng/{$_GET['neLng']}/");


echo $line;

?>
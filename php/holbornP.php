<?php 

$station = file_get_contents("http://cloud.tfl.gov.uk/TrackerNet/PredictionDetailed/{$_GET['id']}/{$_GET['station']}");

$simpleXml = simplexml_load_string($station);

$json = json_encode($simpleXml);

echo $json;

?>
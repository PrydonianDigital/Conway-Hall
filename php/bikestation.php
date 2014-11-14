<?php 

$line = file_get_contents("http://www.tfl.gov.uk/tfl/syndication/feeds/cycle-hire/livecyclehireupdates.xml");

$simpleXml = simplexml_load_string(trim($line));

$terminalName = "{$_GET['dock']}";

$dock = $simpleXml->xpath("//station[terminalName='$terminalName']");

$json = json_encode($dock);

echo $json;

?>
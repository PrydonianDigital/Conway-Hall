<?php 
class TransportAPI { 

    var $version = "0.1";
    var $api_key = "YOUR API KEY"; 
    var $app_id = "YOUR APP ID"; 

    public function __construct($set_api_key, $set_app_id) {
        $this->api_key=$set_api_key; 
        $this->app_id=$set_app_id; 
    }

    function localSummaryWidget($lat, $lon, $radius,
                                $minlat, $minlon, $maxlat, $maxlon,
                                $place ){ 

        $url  = "http://transportapi.com/v3/";
        $url .= "uk/all/summary.html";
        $url .= "?mode=passthru300x300";
        $url .= "&lat=" . $lat;
        $url .= "&lon=" . $lon;
        $url .= "&minlat=" . $minlat;
        $url .= "&minlon=" . $minlon;
        $url .= "&maxlat=" . $maxlat;
        $url .= "&maxlon=" . $maxlon;
        $url .= "&place=" . urlencode($place);
        $url .= "&api_key=" . $this->api_key;
        $url .= "&app_id=" . $this->app_id;

        $content = file_get_contents($url);

        if ($content === false) {
           return "Transport information currently unavailable";
        } else {
           //Uncomment to debug $content = "<a href='$url'>SOURCE URL</a><br>" . $content;
           return $content;
        } 
    } 
} 
?>


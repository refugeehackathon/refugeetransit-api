<?php
require_once('httpful.phar');
require_once('GeoJsonBuilder.php');

class DrupalConnector
{
    private $baseUrl = "https://migrationmulti.tem.li";
    private $apiUrl = "/rest";
	private $lang = "";

	function __construct($lang) {
      $this->lang = '/' . $lang;
   }


    //get Cities as GeoJson
    public function getCities()
    {
        $response = $this->callApi("/list/city");
        $nodes = $response["nodes"];

	return json_encode($nodes);
    }

    //get POIs as GeoJson
    public function getPois()
    {
        $response = $this->callApi("/list/POI");
        $nodes = $response["nodes"];
        $GeoJsonBuilder = new GeoJsonBuilder();

        for($i = 0; $i < count($nodes); $i++)
        {
            $GeoJsonBuilder->addPoint($nodes[$i]["type"], $nodes[$i]["latitude"], $nodes[$i]["longitude"], array("info", "type"), array($nodes[$i]["info"], $nodes[$i]["type"]));
        }

        return $GeoJsonBuilder->result();
    }


    public function callApi($requestUrl)
    {
        $requestUrl = $this->baseUrl . $this->lang . $this->apiUrl . $requestUrl;
        $response = \Httpful\Request::get($requestUrl)->expectsJson()->send();
        $transform =  json_encode($response->body);
        $content = json_decode($transform, true);

        return $content;
    }

    private function formatResponse($response)
    {
        $object = array();
        $object["title"] = $response["title"];
        $object["content"] = $response["revisions"][0]["*"];
        return $this->parseMWContent(json_encode($object));
    }

}

?>

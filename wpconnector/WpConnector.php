<?php
require_once('./httpful.phar');

class WpConnector
{
    private $baseUrl = "";
    private $wpApiUrl = "/wp-json";

    function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl + $wpApiUrl;
    }



    public function getAllPosts()
    {
        $response = callApi($this->baseUrl + "/posts");
        return $response;
    }



    private function callApi($url)
    {
        $response = \Httpful\Request::get($url)->send();
        return $response->body;
    }

}




?>
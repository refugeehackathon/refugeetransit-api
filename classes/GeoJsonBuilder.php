<?php

class GeoJsonBuilder
{
	public $GeoJson = null;
	public $FeatureCollection = null;

	function __construct()
	{
		$this->GeoJson = array();
		$this->FeatureCollection = array();

	}

	//adds a point to GeoJson, returns a bool value
	public function addPoint($type, $coordinate1, $coordinate2, $propertyNames, $propertyValues)
	{
		$point = array();
		$geometry = array();
		$properties = new stdClass();

		//create Point type
		$point["type"] = "Feature";

		//create Point geometry
		$geometry["type"] = "Point";
		$geometry["coordinates"] = array((float)$coordinate1, (float)$coordinate2);
		$point["geometry"] = $geometry;

		//create properties
		if( (count($propertyNames)) == (count($propertyValues)) )
		{
			for($i = 0; $i < count($propertyNames); $i++)
			{
				$properties->$propertyNames[$i] = $propertyValues[$i];
			}
		}
		else
		{
			return false;
		}
		$point["properties"] = $properties;
		array_push($this->FeatureCollection, $point);


		return true;
	}

	public function result()
	{
		$result = array();
		$result["type"] = "FeatureCollection";
		$result["features"] = $this->FeatureCollection;
		return json_encode($result);
	}
}

?>
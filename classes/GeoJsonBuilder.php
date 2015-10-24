<?php

class GeoJsonBuilder
{
	public $GeoJson = null;

	function __construct()
	{
		$this->GeoJson = array();
	}

	//adds a point to GeoJson, returns a bool value
	public function addPoint($type, $coordinate1, $coordinate2, $propertyNames, $propertyValues)
	{
		$point = array();
		$geometry = array();
		$properties = new stdClass();

		//create Point type
		$point["type"] = $type;

		//create Point geometry
		$geometry["type"] = "Point";
		$geometry["coordinates"] = array($coordinate1, $coordinate2);
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
		array_push($this->GeoJson, $point);


		return true;

	}

}

?>
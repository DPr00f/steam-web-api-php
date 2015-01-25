<?php


abstract class UnitTestCase extends PHPUnit_Framework_TestCase{
	protected $steamApiKey;

	public function __construct(){
		$key = getenv('STEAM_API_KEY');
		if(!$key){
			$key = require __DIR__ . "/../test-steam-api-key.php";
		}
		$this->steamApiKey = $key;
	}

}
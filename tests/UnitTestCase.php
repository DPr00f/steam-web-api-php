<?php


abstract class UnitTestCase extends PHPUnit_Framework_TestCase{
	protected $steamApiKey;

	public function __construct(){
		$this->steamApiKey = require __DIR__ . "/../test-steam-api-key.php";
	}

}
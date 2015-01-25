<?php
namespace SteamApi;

use SteamApi\Client;

class ClientTest extends \UnitTestCase {
	/**
	* @expectedException InvalidArgumentException
	**/
	public function testInvalidArgumentException(){
		new Client();
	}

	/**
	* @expectedException SteamApi\Exceptions\ApiCallFailedException
	**/
	public function testInvalidResponse(){
		$client = new Client($this->steamApiKey);
		$client->setUpClient();
	}

	/**
	* @expectedException SteamApi\Exceptions\ApiArgumentRequiredException
	**/
	public function testArgumentRequired(){
		$client = new Client($this->steamApiKey);
		$client->setUpService();
	}
}

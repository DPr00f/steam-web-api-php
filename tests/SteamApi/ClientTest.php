<?php
namespace SteamApi;

class ClientTest extends \UnitTestCase {
	
	public function testTest(){
		$steamApi = new \SteamApi\Client();

		$this->assertEquals($steamApi->test(), $this->steamApiKey);
	}
}
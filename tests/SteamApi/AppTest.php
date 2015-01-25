<?php
namespace SteamApi;

use SteamApi\App;

class AppTest extends \UnitTestCase {
	
	private $app;

	public function setUp()
	{
		$this->app = new App($this->steamApiKey);
	}

	public function testBuildUrl(){
		$this->assertEquals($this->app->buildUrl(), 'http://api.steampowered.com/ISteamApps/');
	}

	public function testAppDetails(){
		$result = $this->app->appDetails(620);
		$this->assertEquals($result->name, 'Portal 2');
	}

	public function testGetServersAtAddress(){
		$servers = $this->app->GetServersAtAddress('127.0.0.1');
		$this->assertGreaterThanOrEqual(0, count($servers));
	}

	public function testGetAppList(){
		$result = $this->app->GetAppList();
		$this->assertGreaterThanOrEqual(1000, count($result));
	}

	public function testUpToDateCheck(){
		$result = $this->app->UpToDateCheck(620, 1);
		// TODO: Implement
		// Don't know how to use this one.
	}
}
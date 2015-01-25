<?php
namespace SteamApi;

use SteamApi\User\Stats;

class StatsTest extends \UnitTestCase {
	
	private $stats;

	public function setUp()
	{
		$this->stats = new Stats($this->steamApiKey, '76561197963455129');
	}

	public function testBuildUrl(){
		$this->assertEquals($this->stats->buildUrl(), 'http://api.steampowered.com/ISteamUserStats/');
	}

	public function testGetGlobalStatsForGame(){
		$result = $this->stats->GetGlobalStatsForGame(17740, array('global.map.emp_isle'));
		$this->assertGreaterThanOrEqual(100, $result->{'global.map.emp_isle'}->total);
	}

	public function testGetNumberOfCurrentPlayers(){
		$result = $this->stats->GetNumberOfCurrentPlayers(620);
		$this->assertGreaterThanOrEqual(0, $result);
	}

	public function testGetSchemaForGame(){
		$result = $this->stats->GetSchemaForGame(620);
		$this->assertEquals($result->gameName, 'Portal 2');
	}

	public function testGetPlayerAchievements(){
		$achievements = $this->stats->GetPlayerAchievements(620);
		$this->assertGreaterThanOrEqual(50, count($achievements));
	}

	public function testGetGlobalAchievementPercentagesForApp(){
		$result = $this->stats->GetGlobalAchievementPercentagesForApp(620);
		$this->assertGreaterThanOrEqual(50, count($result));
	}

	public function testGetUserStatsForGame(){
		$result = $this->stats->GetUserStatsForGame(620);
		$this->assertEquals($result->gameName, 'Portal 2');
	}
}
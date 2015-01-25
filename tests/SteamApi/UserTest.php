<?php
namespace SteamApi;

class UserTest extends \UnitTestCase {

	private $user;
	public function setUp(){
		$this->user = new \SteamApi\User($this->steamApiKey, '76561197963455129');
	}

	public function testBuildUrl(){
		$this->assertEquals($this->user->buildUrl(), 'http://api.steampowered.com/ISteamUser/');
	}

	public function testSteamIdIsSet(){
		$this->assertEquals($this->user->getSteamId(), '76561197963455129');
	}

	public function testGetPlayerBans(){
		$result = $this->user->GetPlayerBans();
		$this->assertEquals($result->steamId, '76561197963455129');
		$this->assertEquals($result->communityBanned, false);
		$this->assertEquals($result->VACBanned, false);
		$this->assertEquals($result->numberOfVACBans, 0);
		$this->assertEquals($result->daysSinceLastBan, 0);
		$this->assertEquals($result->economyBan, 'none');
	}

	public function testMultipleGetPlayerBans(){
		$result = $this->user->GetPlayerBans('76561197963455129,76561197988736941');
		$this->assertEquals($result[0]->communityBanned, false);
		$this->assertEquals($result[0]->VACBanned, false);
		$this->assertEquals($result[0]->numberOfVACBans, 0);
		$this->assertEquals($result[0]->daysSinceLastBan, 0);
		$this->assertEquals($result[0]->economyBan, 'none');
		
		$this->assertEquals($result[1]->communityBanned, false);
		$this->assertEquals($result[1]->VACBanned, false);
		$this->assertEquals($result[1]->numberOfVACBans, 0);
		$this->assertEquals($result[1]->daysSinceLastBan, 0);
		$this->assertEquals($result[1]->economyBan, 'none');
	}

	public function testGetPlayerSummaries(){
		$result = $this->user->GetPlayerSummaries();
		$this->assertEquals($result->profileUrl, 'http://steamcommunity.com/id/pr00fgames/');
	}

	public function testMultipleGetPlayerSummaries(){
		$result = $this->user->GetPlayerSummaries('76561197988736941,76561197963455129');
		$this->assertTrue($result[0]->profileUrl === 'http://steamcommunity.com/id/dorsiguer/' || $result[0]->profileUrl == 'http://steamcommunity.com/id/pr00fgames/');
		$this->assertTrue($result[1]->profileUrl === 'http://steamcommunity.com/id/dorsiguer/' || $result[1]->profileUrl == 'http://steamcommunity.com/id/pr00fgames/');
	}

	public function testGetFriendList(){
		$result = $this->user->GetFriendList();
		$this->assertGreaterThanOrEqual(20, $result);
	}
}
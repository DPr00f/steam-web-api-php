<?php

namespace SteamApi;

use SteamApi\Player;

class PlayerTest extends \UnitTestCase {
	
	private $player;

	public function setUp()
	{
		$this->player = new Player($this->steamApiKey, '76561197963455129');
	}

	public function testBuildUrl(){
		$this->assertEquals($this->player->buildUrl(), 'http://api.steampowered.com/IPlayerService/');
	}

	public function testGetSteamLevel() {
        $result = $this->player->GetSteamLevel();
        $this->assertGreaterThanOrEqual(20, $result, "Player level is invalid");
    }

    public function testGetPlayerLevelDetails() {
        $result = $this->player->GetPlayerLevelDetails();
        $this->assertObjectHasAttribute('playerXp', $result, "No playerXp");
        $this->assertObjectHasAttribute('playerLevel', $result, "No playerLevel");
        $this->assertObjectHasAttribute('xpToLevelUp', $result, "No xpToLevelUp");
        $this->assertObjectHasAttribute('xpForCurrentLevel', $result, "No xpForCurrentLevel");
        $this->assertObjectHasAttribute('currentLevelMin', $result, "No currentLevelMin");
        $this->assertObjectHasAttribute('currentLevelMax', $result, "No currentLevelMax");
        $this->assertObjectHasAttribute('percentThroughLevel', $result, "No percentThroughLevel");
    }

    public function testGetBadges() {
        $result = $this->player->GetBadges();
        $this->assertGreaterThanOrEqual(19, count($result));
    }

    public function testGetCommunityBadgeProgress(){
        $result = $this->player->GetCommunityBadgeProgress();
        $this->assertGreaterThanOrEqual(0, count($result->quests));
    }

    public function testGetOwnedGames(){
        $result = $this->player->GetOwnedGames();
        $this->assertGreaterThanOrEqual(346, count($result));
    }

    public function testGetRecentlyPlayedGames(){
        $result = $this->player->GetRecentlyPlayedGames();
        $this->assertGreaterThanOrEqual(0, count($result));
    }

    public function testIsPlayingSharedGame(){
        $result = $this->player->IsPlayingSharedGame(620);
        $this->assertGreaterThanOrEqual(0, count($result));
    }
}
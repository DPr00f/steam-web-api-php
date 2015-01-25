<?php

namespace SteamApi\User;

use SteamApi\Client;
use SteamApi\Containers\Achievement;
use SteamApi\Interfaces\User\IStats;

class Stats extends Client implements IStats {
	protected $interface = 'ISteamUserStats';

	public function __construct($steamApiKey, $steamId = null){
		parent::__construct($steamApiKey);
		$this->setSteamId($steamId);
	}

	public function setSteamId($steamId) {
		$this->steamId = $steamId;
	}

	public function getSteamId() {
		return $this->steamId;
	}

	public function GetGlobalStatsForGame($appId, array $statsName){
		$this->method  = __FUNCTION__;
		$this->version = 'v0001';

		$count = count($statsName);
		$arguments = [
			'count'   => $count,
			'appid'   => $appId,
			'l'       => 'english'
		];

		for($i = 0; $i < $count; $i++){
			$arguments['name['.$i.']'] = $statsName[$i];
		}

		$client = $this->setUpClient($arguments)->response;

		return $client->globalstats;
	}

	public function GetNumberOfCurrentPlayers($appId){
		$this->method  = __FUNCTION__;
		$this->version = 'v0001';

		$arguments = [
			'appid'   => $appId,
		];

		$client = $this->setUpClient($arguments)->response;

		return $client->player_count;
	}

	public function GetSchemaForGame($appId){
		$this->method  = __FUNCTION__;
		$this->version = 'v0002';

		$arguments = [
			'appid'   => $appId,
		];

		$client = $this->setUpClient($arguments);

		return $client->game;
	}

	public function GetPlayerAchievements($appId, $steamId = null)
	{
		$this->method  = __FUNCTION__;
		$this->version = 'v0001';

		if(is_null($steamId)){
			$steamId = $this->steamId;
		}

		$arguments = [
			'steamid' => $steamId,
			'appid'   => $appId,
			'l'       => 'english'
		];

		$client = $this->setUpClient($arguments)->playerstats;

		$achievements = $this->convertToObjects($client->achievements);

		return $achievements;
	}

	public function GetGlobalAchievementPercentagesForApp($gameId)
	{
		$this->method  = __FUNCTION__;
		$this->version = 'v0002';

		$arguments = [
			'gameid' => $gameId,
			'l'      => 'english'
		];

		$client = $this->setUpClient($arguments)->achievementpercentages;

		return $client->achievements;
	}

	public function GetUserStatsForGame($appId, $steamId = null)
	{
		$this->method  = __FUNCTION__;
		$this->version = 'v0002';

		if(is_null($steamId)){
			$steamId = $this->steamId;
		}

		$arguments = [
			'steamid' => $steamId,
			'appid'   => $appId,
			'l'       => 'english'
		];

		$client = $this->setUpClient($arguments)->playerstats;

		return $client;
	}

	protected function convertToObjects($achievements)
	{
		$cleanedAchievements = array();

		foreach ($achievements as $achievement) {
			$cleanedAchievements[] = new Achievement($achievement);
		}

		return $cleanedAchievements;
	}
}
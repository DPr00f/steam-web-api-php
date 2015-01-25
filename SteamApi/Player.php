<?php
namespace SteamApi;

use SteamApi\Client;
use SteamApi\Containers\Game;
use SteamApi\Containers\Player\Level;
use SteamApi\Interfaces\IPlayer;

class Player extends Client implements IPlayer {

	protected $interface = 'IPlayerService';

	protected $isService = true;

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

	public function GetSteamLevel()
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 1;

		// Set up the arguments
		$arguments = ['steamId' => $this->steamId];
		$arguments = json_encode($arguments);

		// Get the client
		$client = $this->setUpService($arguments)->response;

		return intval($client->player_level);
	}

	public function GetPlayerLevelDetails()
	{

		// Set up the api details
		$this->method  = 'GetBadges';
		$this->version = 1;

		// Set up the arguments
		$arguments = ['steamId' => $this->steamId];
		$arguments = json_encode($arguments);

		$details = $this->setUpService($arguments)->response;

		$details = new Level($details);

		return $details;
	}

	public function GetBadges()
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 1;

		// Set up the arguments
		$arguments = ['steamId' => $this->steamId];
		$arguments = json_encode($arguments);

		// Get the client
		$client = $this->setUpService($arguments)->response;
		return $client->badges;
	}

	public function GetCommunityBadgeProgress($badgeId = null)
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 1;

		// Set up the arguments
		$arguments   = ['steamId' => $this->steamId];
		if ($badgeId != null) $arguments['badgeid'] = $badgeId;
		$arguments   = json_encode($arguments);

		// Get the client
		$client = $this->setUpService($arguments)->response;

		return $client;
	}

	public function GetOwnedGames($includeAppInfo = true, $includePlayedFreeGames = false, $appIdsFilter = array())
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 1;

		// Set up the arguments
		$arguments                                                           = ['steamId' => $this->steamId];
		if ($includeAppInfo) $arguments['include_appinfo']                   = $includeAppInfo;
		if ($includePlayedFreeGames) $arguments['include_played_free_games'] = $includePlayedFreeGames;
		if (count($appIdsFilter) > 0) $arguments['appids_filter']            = $appIdsFilter;
		$arguments                                                           = json_encode($arguments);

		// Get the client
		$client = $this->setUpService($arguments)->response;

		// Clean up the games
		$games = $this->convertToObjects($client->games);

		return $games;
	}

	public function GetRecentlyPlayedGames($count = null)
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 1;

		// Set up the arguments
		$arguments                                = ['steamId' => $this->steamId];
		if (!is_null($count)) $arguments['count'] = $count;
		$arguments                                = json_encode($arguments);

		// Get the client
		$client = $this->setUpService($arguments)->response;

		if ($client->total_count > 0) {
			// Clean up the games
			$games = $this->convertToObjects($client->games);

			return $games;
		}

		return null;
	}

	public function IsPlayingSharedGame($appIdPlaying)
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 1;

		// Set up the arguments
		$arguments = [
			'steamId'       => $this->steamId,
			'appid_playing' => $appIdPlaying
		];
		$arguments = json_encode($arguments);

		// Get the client
		$client = $this->setUpService($arguments)->response;

		return $client->lender_steamid;
	}

	protected function convertToObjects($games)
	{
		$cleanedGames = array();

		foreach ($games as $game) {
			$cleanedGames[] = new Game($game);
		}

		usort($cleanedGames, function($a, $b)
		{
		    return strcmp($a->name, $b->name);
		});

		return $cleanedGames;
	}
}
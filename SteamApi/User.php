<?php
namespace SteamApi;

use SteamApi\Interfaces\IUser;
use SteamApi\Client;

class User extends Client implements IUser {
	protected $interface = 'ISteamUser';

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


	public function GetPlayerBans($steamId = null){
		$this->method  = __FUNCTION__;
		$this->version = 'v1';

		if ($steamId == null) {
			$steamId = $this->steamId;
		}

		// Set up the arguments
		$arguments = [
			'steamids' => $steamId
		];

		// Get the client
		$client = $this->setUpClient($arguments);

		$bans = $this->convertToObjects($client->players, '\SteamApi\Containers\Player\Bans');
		
		return count($bans) === 1 ? $bans[0] : $bans;
	}
	
	public function GetPlayerSummaries($steamId = null)
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 'v0002';

		if ($steamId == null) {
			$steamId = $this->steamId;
		}

		// Set up the arguments
		$arguments = [
			'steamids' => $steamId
		];

		// Get the client
		$client = $this->setUpClient($arguments)->response;

		// Clean up the games
		$players = $this->convertToObjects($client->players);

		return count($players) == 1 ? $players[0] : $players;
	}

	public function GetFriendList($relationship = 'all')
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 'v0001';

		// Set up the arguments
		$arguments = [
			'steamid' => $this->steamId,
			'relationship' => $relationship
		];

		// Get the client
		$client = $this->setUpClient($arguments)->friendslist;

		// Clean up the games
		$steamIds = array();

		foreach ($client->friends as $friend) {
			$steamIds[] = $friend->steamid;
		}

		$friends = $this->GetPlayerSummaries(implode(',', $steamIds));

		return $friends;
	}

	public function GetUserGroupList($steamId = null)
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 'v0001';

		if ($steamId == null) {
			$steamId = $this->steamId;
		}

		// Set up the arguments
		$arguments = [
			'steamid' => $steamId
		];

		// Get the client
		$client = $this->setUpClient($arguments)->response;

		return $client->groups;
	}

	public function ResolveVanityUrl($vanityUrl)
	{
		// Set up the api details
		$this->method  = __FUNCTION__;
		$this->version = 'v0001';

		// Set up the arguments
		$arguments = [
			'vanityurl' => $vanityUrl
		];

		// Get the client
		$client = $this->setUpClient($arguments)->response;

		return property_exists($client, 'steamid') ? strval($client->steamid) : null;
	}

	protected function convertToObjects($players, $class = '\SteamApi\Containers\Player')
	{
		$cleanedPlayers = array();

		foreach ($players as $player) {
			$cleanedPlayers[] = new $class($player);
		}

		return $cleanedPlayers;
	}
}
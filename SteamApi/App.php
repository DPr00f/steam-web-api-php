<?php

namespace SteamApi;

use SteamApi\Client;
use SteamApi\Containers\App as AppContainer;
use SteamApi\Interfaces\IApp;

class App extends Client implements IApp {

	protected $interface = 'ISteamApps';

	public function __construct($steamApiKey)
	{
		parent::__construct($steamApiKey);
	}

	public function appDetails($appid)
	{
		$this->url        = 'http://store.steampowered.com/';
		$this->interface  = 'api';
		$this->method     = 'appdetails';
		$this->version    = null;

		$arguments = [
			'appids' => $appid
		];

		$client = $this->setUpClient($arguments);
		$apps   = $this->convertToObjects($client);

		return count($apps) == 1 ? $apps[0] : $apps;
	}

	public function GetAppList()
	{
		$this->url        = "http://api.steampowered.com/";
		$this->interface  = 'ISteamApps';
		$this->method     = __FUNCTION__;
		$this->version    = 'v0002';

		$client = $this->setUpClient();

		return $client->applist->apps;
	}

	public function GetServersAtAddress($addressOrIp)
	{
		$this->url        = "http://api.steampowered.com/";
		$this->interface  = 'ISteamApps';
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';

		$arguments = [
			'addr' => $addressOrIp
		];

		$client = $this->setUpClient($arguments)->response;

		return $client->servers;
	}

	public function UpToDateCheck($appId, $version){
		$this->url        = "http://api.steampowered.com/";
		$this->interface  = 'ISteamApps';
		$this->method     = __FUNCTION__;
		$this->version    = 'v0001';

		$arguments = [
			'appid' => $appId,
			'version' => $version
		];

		$client = $this->setUpClient($arguments)->response;

		return $client;

	}

	protected function convertToObjects($apps)
	{
		$cleanedApps = array();

		foreach ($apps as $app) {
			$cleanedApps[] = new AppContainer($app->data);
		}

		usort($cleanedApps, function($a, $b)
		{
		    return strcmp($a->name, $b->name);
		});

		return $cleanedApps;
	}
}
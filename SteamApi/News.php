<?php
namespace SteamApi;

use SteamApi\Client;
use SteamApi\Interfaces\INews;

class News extends Client implements INews {

	protected $interface = 'ISteamNews';

	public function GetNewsForApp($appId, $count = 5, $maxLength = null)
	{
		// Set up the api details
		$this->method     = __FUNCTION__;
		$this->version    = 2;

		// Set up the arguments
		$arguments = [
			'appid' => $appId,
			'count' => $count
		];
		if (!is_null($maxLength)) $arguments['maxlength'] = $maxLength;

		// Get the client
		$client = $this->setUpClient($arguments);

		return $client->appnews;
	}
}
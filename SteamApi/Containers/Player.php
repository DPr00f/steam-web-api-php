<?php
namespace SteamApi\Containers;


class Player {
	public $steamId;

	public $communityVisibilityState;

	public $profileState;

	public $personaName;

	public $lastLogoff;

	public $profileUrl;

	public $avatar;

	public $avatarMedium;

	public $avatarFull;

	public $personaState;

	public $primaryClanId;

	public $timecreated;

	public $personaStateFlags;

	public function __construct($player)
	{
		$this->steamId                  = $player->steamid;
		$this->communityVisibilityState = $player->communityvisibilitystate;
		$this->profileState             = $player->profilestate;
		$this->personaName              = $player->personaname;
		$this->lastLogoff               = date('F jS, Y h:ia', $player->lastlogoff);
		$this->profileUrl               = $player->profileurl;
		$this->avatar                   = $player->avatar;
		$this->avatarMedium             = $player->avatarmedium;
		$this->avatarFull               = $player->avatarfull;
		$this->personaState             = $this->convertPersonaState($player->personastate);
		$this->primaryClanId            = isset($player->primaryclanid) ? $player->primaryclanid : null;
		$this->timecreated              = isset($player->timecreated) ? date('F jS, Y h:ia', $player->timecreated) : null;
		$this->personaStateFlags        = isset($player->personastateflags) ? $player->personastateflags : null;
	}

	protected function convertPersonaState($personaState)
	{
		switch ($personaState) {
			case 0:
				return 'Offline';
			break;
			case 1:
				return 'Online';
			break;
			case 2:
				return 'Busy';
			break;
			case 3:
				return 'Away';
			break;
			case 4:
				return 'Snooze';
			break;
			case 5:
				return 'Looking to Trade';
			break;
			case 6:
				return 'Looking to Play';
			break;
		}
	}

}
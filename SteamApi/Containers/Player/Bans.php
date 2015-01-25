<?php
namespace SteamApi\Containers\Player;


class Bans {
	public $steamId;
	public $communityBanned;
	public $VACBanned;
	public $numberOfVACBans;
	public $daysSinceLastBan;
	public $economyBan;

	public function __construct($player)
	{
		$this->steamId                  = $player->SteamId;
		$this->communityBanned 			= $player->CommunityBanned;
		$this->VACBanned             	= $player->VACBanned;
		$this->numberOfVACBans          = intval($player->NumberOfVACBans);
		$this->daysSinceLastBan         = intval($player->DaysSinceLastBan);
		$this->economyBan               = $player->EconomyBan;
	}

}
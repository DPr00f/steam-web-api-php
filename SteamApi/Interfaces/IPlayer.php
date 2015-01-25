<?php
namespace SteamApi\Interfaces;

interface IPlayer{
	public function GetSteamLevel();

	public function GetPlayerLevelDetails();

	public function GetBadges();

	public function GetCommunityBadgeProgress();
	
	public function GetOwnedGames();

	public function GetRecentlyPlayedGames();
	
	public function IsPlayingSharedGame($appIdPlaying);
}
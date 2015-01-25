<?php
namespace SteamApi\Interfaces\User;

interface IStats{
	public function GetGlobalAchievementPercentagesForApp($gameId);

	public function GetGlobalStatsForGame($appId, array $statsName);

	public function GetNumberOfCurrentPlayers($appId);

	public function GetPlayerAchievements($appId);

	public function GetSchemaForGame($appId);

	public function GetUserStatsForGame($appId);
}
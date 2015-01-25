<?php
namespace SteamApi\Interfaces;

interface IUser{
	public function GetPlayerBans();

	public function GetPlayerSummaries();
	
	public function GetFriendList();
}
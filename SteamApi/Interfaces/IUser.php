<?php
namespace SteamApi\Interfaces;

interface IUser{
	public function GetPlayerBans();

	public function GetPlayerSummaries();
	
	public function GetFriendList();

	public function GetUserGroupList();

	public function ResolveVanityURL($vanityUrl);
}
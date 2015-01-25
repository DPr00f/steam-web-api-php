<?php
namespace SteamApi\Interfaces;

interface IApp{
	public function appDetails($appId);

	public function GetAppList();

	public function GetServersAtAddress($addressOrIp);
	
	public function UpToDateCheck($appId, $version);
}
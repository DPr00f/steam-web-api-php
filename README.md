[![wercker status](https://app.wercker.com/status/b2600b2d77b8d35f086f6554f402739c/m/master "wercker status")](https://app.wercker.com/project/bykey/b2600b2d77b8d35f086f6554f402739c)

# About
PHP Wrapper to communicate with Steam Web API

# SteamID64 Finder
Please refer to [http://steamid.co/](http://steamid.co/) or [http://steamidconverter.com/](http://steamidconverter.com/) to find the user steam id.


# Install
Add to your composer.json

```
{
    "require": {
        "jocolopes/steamapi": "dev-master"
    }
}
```


# Usage

## User Class
```
$user = new \SteamApi\User('YOUR-STEAM-KEY', 'THE-STEAMID64');
```
#### Get Player Bans
```
$user->GetPlayerBans();
// OR
$user->GetPlayerBans('THE-FIRST-STEAMID64,THE-SECOND-STEAMID64,THE-ANY-STEAMID64');
```

#### Get Player Summaries
```
$user->GetPlayerSummaries();
// OR
$user->GetPlayerSummaries('THE-FIRST-STEAMID64,THE-SECOND-STEAMID64,THE-ANY-STEAMID64');
```

#### Get Friend List
```
$user->GetFriendList();
```

#### Get UserGroup List
```
$user->GetUserGroupList();
```

#### ResolveVanityUrl
```
$user->ResolveVanityUrl('id-of-user-to-translate-into-steam-id');
// Example
$user->ResolveVanityUrl('pr00fgames'); // Result: 76561197963455129
```

## Player Class
```
$player = new \SteamApi\Player('YOUR-STEAM-KEY', 'THE-STEAMID64');
```

#### Get Steam Level
```
$player->GetSteamLevel();
```

#### Get Player Level Details
```
$player->GetPlayerLevelDetails();
```

#### Get Badges
```
$player->GetBadges();
```

#### Get Community Badge Progress
```
$player->GetCommunityBadgeProgress();
```

#### Get Owned Games
```
$player->GetOwnedGames();
```

#### Get Recently Played Games
```
$player->GetRecentlyPlayedGames();
```

#### Is Playing Shared Game
```
$player->IsPlayingSharedGame($gameId);
```

## News Class
```
$news = new \SteamApi\News('YOUR-STEAM-KEY');
```

#### Get News For App

```
$news->GetNewsForApp($appId[, $numberOfNews, $maxLength]); // Last 2 arguments are optional
```


## App Class

```
$app = new \SteamApi\App('YOUR-STEAM-KEY');
```

#### Get App Details
```
$app->appDetails($appId);
```

#### Get Servers At Address
```
$app->GetServersAtAddress($address); // Hostname or IP:Port
```

#### Get App List
```
$app->GetAppList();
```


#### Check for up to date application
```
$app->UpToDateCheck($appId, $appVersion);
```

## User Stats
```
$stats = new Stats('YOUR-STEAM-KEY', 'THE-STEAMID64');
```

#### Get Global Stats For Game
```
$stats->GetGlobalStatsForGame($gameId, array('STATS-NAME'));
// Example
$stats->GetGlobalStatsForGame(17740, array('global.map.emp_isle'));
```

#### Get Number Of Current Players
```
$stats->GetNumberOfCurrentPlayers($appId);
```

#### Get Schema For Game
```
$stats->GetSchemaForGame($appId);
```

#### Get Player Achievements
```
$stats->GetPlayerAchievements($appId);
```

#### Get Global Achievement Percentages For App
```
$stats->GetGlobalAchievementPercentagesForApp($appId);
```

#### Get User Stats Fo rGame
```
$stats->GetUserStatsForGame($appId);
```

# More Info
Please Refer to the tests folder to get more information on how to use the library

# Objective
The objective of this library is to wrap the steam web API into a php object.

There are some missing methods that I plan to implement soon.

Feel free to add some missing methods and as for a pull request on this repo.

The missing methods can be found using the [swissapiknife](https://github.com/Lagg/steam-swissapiknife).


# FAQ

## Do I need anything special to use this library?
You do need PHP 5.4+ and composer. You also need to load the `vendor/autoload.php` into your project.

## Will this work on my framework?
This library is framework agnostic, maybe the framework you're using requires some aditional setup.

If your framework uses composer you should be good to go. But let me know if you run into any troubles.

## Found a bug, what should I do?
If you have the capacity to fix it yourself by all means do and create a pull request.

If you don't, raise an issue on github and me or someone else will try to fix it.
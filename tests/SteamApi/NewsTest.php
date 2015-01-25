<?php

namespace SteamApi;

use SteamApi\News;

class NewsTest extends \UnitTestCase {
	
	private $news;

    public function setUp()
    {
        $this->news = new News($this->steamApiKey);
    }

	public function testBuildUrl(){
		$this->assertEquals($this->news->buildUrl(), 'http://api.steampowered.com/ISteamNews/');
	}

    public function testGetNewsForApp() {
    	$totalNews = 2;
    	$appId = 620; // Portal 2
    	$result = $this->news->GetNewsForApp($appId, $totalNews);
    	$this->assertEquals($result->appid, $appId);
    	$this->assertEquals(count($result->newsitems), 2);
    }
}
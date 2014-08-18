<?php
require_once 'TwitterAPIExchange.php';

$feedTweets = array();
$feedMusic = array();

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2344022328-ZNjZD2CVwxxhMmOYLPJb5yhsCXkpsX0harS1xxS",
    'oauth_access_token_secret' => "egXYWXqRAWzCm9qTpBlvXjWD80Z4C3OEOaN0YuDepRDMD",
    'consumer_key' => "5skUNfJBLZvGQpksqdRlw",
    'consumer_secret' => "wMBsig6nOL2LsNS6pW9RkkXYCgfvhdUkNkk8PiLtk"
);

/** Note: Set the GET field BEFORE calling buildOauth(); **/

$blacklist = array(
		'497937362333499392',
	);
	
$blacklist_users = array(
		'twitgdine'
	);

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23boomchickapop%20OR%20%23boomtour';
foreach($blacklist_users as $user){
	$getfield .= "%20-" . $user;
}
$getfield .="&count=100";

$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

$json = $twitter->setGetfield($getfield)
             	->buildOauth($url, $requestMethod)
             	->performRequest();
				
$tweets = json_decode($json, true);
$list = $tweets['statuses'];

foreach($list as $tweet){
	$item = array(
			'type' => 'social',
			'id' => $tweet['id_str'],
			'user' => $tweet['user']['screen_name'],
			'profile_image' => $tweet['user']['profile_image_url'],
			'date' => $tweet['created_at'],
			'text' => $tweet['text']
		);
	if( (! in_array($item['id'], $blacklist)) && (! in_array($item['user'], $blacklist)) ){
		array_push($feedTweets, $item);
	}
}


//Music

/*$getfield = '?q=%23boomtourmusic&count=100&result';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

$json = $twitter->setGetfield($getfield)
             	->buildOauth($url, $requestMethod)
             	->performRequest();
				
$tweets = json_decode($json, true);
$list = $tweets['statuses'];

foreach($list as $tweet){
	$item = array(
			'type' => 'music',
			'id' => $tweet['id_str'],
			'user' => $tweet['user']['screen_name'],
			'date' => $tweet['created_at'],
			'text' => $tweet['text']
		);
	if(! in_array($item['id'], $blacklist)){
		array_push($feedMusic, $item);
	}
}*/


?>
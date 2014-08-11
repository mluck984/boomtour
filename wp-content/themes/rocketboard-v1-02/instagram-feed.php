<?php

$feedInstagram = array();

$url = 'https://api.instagram.com/v1/tags/boomchickapop/media/recent';

$options = array( 
	CURLOPT_URL => $url . '?client_id=1a571293f3fe4e5284bb70659cad7d66',
	CURLOPT_RETURNTRANSFER => true
);

$feed = curl_init();
curl_setopt_array($feed, $options);
$json = curl_exec($feed);
curl_close($feed);
				
$instagram = json_decode($json, true);

$arr = $instagram['data'];

if($arr){
	foreach($arr as $pic){
		$item = array(
				'type' => 'photo',
				'name' => $pic['user']['fullname'],
				'user' => $pic['user']['username'],
				'date' => $pic['created_at'],
				'link' => $pic['link'],
				'tags' => $pic['tags'],
				'caption' => $pic['caption']['text'],
				'thumbnail' => $pic['images']['thumbnail']['url'],
				'low_resolution' => $pic['images']['low_resolution']['url'],
				'image' => $pic['images']['standard_resolution']['url'],
				'lat' => $pic['location']['latitude'],
				'long' => $pic['location']['longitude']
			);
		array_push($feedInstagram, $item);
	}
}

?>
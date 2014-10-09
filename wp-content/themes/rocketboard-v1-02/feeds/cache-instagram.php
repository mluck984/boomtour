<?php


$blacklist = array(
		"http://instagram.com/p/rfy09cD3eu/",
		"http://scontent-b.cdninstagram.com/hphotos-xap1/t51.2885-15/927405_744918015567498_1472371092_n.jpg",
	);

$blacklist_users = array(
		'bdealux',
		'danigoalie92',
		'roozapalooza',
		'roniongpogi13',
		'collectivephotography_',
		'boomfelazi',
		'boomchampions',
		'tylerstyler',
		'boomstationlive',
		'snypa718',
		'energysquadintl',
		'kristen_rocco',
		'shirleyho__',
		'natemichaelis',
		'bigg_burd',
		'pablo____.___'
	);

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
				'user' => $pic['user']['username'],
				'date' => $pic['created_at'],
				'link' => $pic['link'],
				'caption' => $pic['caption']['text'],
				'thumbnail' => $pic['images']['thumbnail']['url'],
				'low_resolution' => $pic['images']['low_resolution']['url'],
				'image' => $pic['images']['standard_resolution']['url'],
				'lat' => $pic['location']['latitude'],
				'long' => $pic['location']['longitude']
			);
			
		if( (! in_array($item['link'], $blacklist) ) && (! in_array($item['user'], $blacklist_users)) && ( strpos(strtolower($item['caption']), '#boomchickapop') > -1 ) ){
			array_push($feedInstagram, $item);
		}
	}
}

$url = 'https://api.instagram.com/v1/tags/boomtour/media/recent';

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
				'user' => $pic['user']['username'],
				'date' => $pic['created_at'],
				'link' => $pic['link'],
				'caption' => $pic['caption']['text'],
				'thumbnail' => $pic['images']['thumbnail']['url'],
				'low_resolution' => $pic['images']['low_resolution']['url'],
				'image' => $pic['images']['standard_resolution']['url'],
				'lat' => $pic['location']['latitude'],
				'long' => $pic['location']['longitude']
			);
			
		if( (! in_array($item['link'], $blacklist) ) && (! in_array($item['user'], $blacklist_users)) && ( strpos(strtolower($item['caption']), '#boomtour') > -1 ) ){
			array_push($feedInstagram, $item);
		}
	}
}

$list = array();
$d = ';';

foreach($feedInstagram as $it){
	$line = $it['type'] . $d .
		$it['user'] . $d .
		$it['date'] . $d .
		$it['link'] . $d .
		$it['caption'] . $d .
		$it['thumbnail'] . $d .
		$it['low_resolution'] . $d .
		$it['image'] . $d .
		$it['lat'] . $d .
		$it['long'];
	array_push($list, $line);
}

$file = fopen('caches/instagram.csv','w');

foreach ($list as $line) {
	fputcsv($file,explode($d,$line), $d);
}

fclose($file);

$data = file_get_contents('caches/instagram.csv');

echo $data;


?>
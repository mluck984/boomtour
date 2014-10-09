<?php

$feedInstagram = array();

$data = file_get_contents('wp-content/themes/rocketboard-v1-02/feeds/caches/instagram.csv');

$lines = explode(PHP_EOL, $data);
$arr = array();

foreach ($lines as $line) {
    $arr[] = str_getcsv($line, ';');
}

if($arr){
	foreach($arr as $pic){
		if($pic[5]){
			$item = array(
					'type' => $pic[0],
					'user' => $pic[1],
					'date' => $pic[2],
					'link' => $pic[3],
					'caption' => $pic[4],
					'thumbnail' => $pic[5],
					'low_resolution' => $pic[6],
					'image' => $pic[7],
					'lat' => $pic[8],
					'long' => $pic[9]
				);
				
			array_push($feedInstagram, $item);
		}
	}
}
?>
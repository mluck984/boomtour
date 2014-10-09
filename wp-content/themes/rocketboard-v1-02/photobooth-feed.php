<?php

$feedPhotobooth = array();

$data = file_get_contents('wp-content/themes/rocketboard-v1-02/assets/photobooth.csv');

$lines = explode(PHP_EOL, $data);
$arr = array();

foreach ($lines as $line) {
    $arr[] = str_getcsv($line);
}

if($arr){
	foreach($arr as $pic){
		if($pic[0]){
			$item = array(
					'type' => 'photobooth',
					'low_resolution' => $pic[0],
					'image' => $pic[1],
					'link' => 'http://photomadicevents.smugmug.com/Other/Gif-Sync/'
				);
			array_push($feedPhotobooth, $item);
		}
	}
}

?>
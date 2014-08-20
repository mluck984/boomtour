<?php

$feedPolls = array();

array_push($feedPolls, array(
		'type' => 'poll',
		'id' => 0,
		'question' => '8 hour road trip, only one genre of music.',
		'answers' => array(
			'Rock N&rsquo;Roll',
			'R&B',
			'Jazz',
			'Music that goes BOOM'
			),
		'results' => array(0,0,0,0),
		'answered' => false
		));
		
array_push($feedPolls, array(
		'type' => 'poll',
		'id' => 1,
		'question' => 'You&rsquo;re stranded on a deserted island. You can only have one flavor of BOOM? Which one is it?',
		'answers' => array(
			'Sweet & Salty',
			'Caramel & Cheddar'
			),
		'results' => array(0,0),
		'answered' => false
		));
		
array_push($feedPolls, array(
		'type' => 'poll',
		'id' => 2,
		'question' => 'New flavor of BOOM coming out, which would you try first?',
		'answers' => array(
			'Lemon Blueberry',
			'Sriracha',
			'Lime & Basil',
			'Sea Salt & Vinegar'			
			),
		'results' => array(0,0,0,0),
		'answered' => false
		));
		
array_push($feedPolls, array(
		'type' => 'poll',
		'id' => 3,
		'question' => 'Where would you rather watch your favorite flick?',
		'answers' => array(
			'Snuggled up at home with your sweetheart',
			'In the park with your friends'
			),
		'results' => array(0,0,0,0),
		'answered' => false
		));
		
array_push($feedPolls, array(
		'type' => 'poll',
		'id' => 4,
		'question' => 'You have a week vacation with your friends.',
		'answers' => array(
			'Fly. More beach time=more beach cocktails',
			'Take an adventurous road trip. We meant to end up in KY, right? RIGHT?'
			),
		'results' => array(0,0),
		'answered' => false
		));
		
array_push($feedPolls, array(
		'type' => 'poll',
		'id' => 5,
		'question' => 'You&rsquo;re going on vacation, all expenses paid. Where would you go?',
		'answers' => array(
			'Thailand',
			'London',
			'Dubai',
			'Paris'
			),
		'results' => array(0,0,0,0),
		'answered' => false
		));
		
array_push($feedPolls, array(
		'type' => 'poll',
		'id' => 6,
		'question' => 'Man, we hate being stuck in traffic. Would you rather be able to fly or teleport?',
		'answers' => array(
			'Flying would be much cooler!',
			'Teleporting would be the best!'
			),
		'results' => array(0,0),
		'answered' => false
		));
		
array_push($feedPolls, array(
		'type' => 'poll',
		'id' => 7,
		'question' => 'There&rsquo;s a new Hollywood drama. You:',
		'answers' => array(
			'Could give a play-by-play of the events that went down',
			'Hollywood is a type of tree that grows holly leaves, right?',
			'Don&rsquo;t even talk to me about that.'
			),
		'results' => array(0,0,0),
		'answered' => false
		));
		
array_push($feedPolls, array(
		'type' => 'poll',
		'id' => 8,
		'question' => 'For one million dollars, I would:',
		'answers' => array(
			'Get a BOOMCHICKAPOP tattoo',
			'Be in a shark tank in a cage',
			'Moon someone on national television',
			'Skinny dip in the Arctic'
			),
		'results' => array(0,0,0,0),
		'answered' => false
		));
		
array_push($feedPolls, array(
		'type' => 'poll',
		'id' => 9,
		'question' => 'Superpower of choice?',
		'answers' => array(
			'Hulk-like strength',
			'Mind Reading',
			'Ability to make BOOM appear whenever you want it'
			),
		'results' => array(0,0,0),
		'answered' => false
		));
		
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$query = "SELECT * FROM poll_answers";

$sql = $mysqli->prepare($query);
$sql->execute();
$sql->bind_result($answer_id, $poll_id, $answer, $user_ip, $user_ip_forward)  or die('Could not perform search: ' . $sql->error);

while ($sql->fetch())
{
	$feedPolls[$poll_id]['results'][$answer]++;
}

$mysqli->close();


$answeredArr = array();

session_start();

if(isset($_SESSION['answered'])){
	$answeredArr = explode(',', $_SESSION['answered']);
}

for($i = 0; $i < count($feedPolls); $i++){
	if(in_array($i, $answeredArr)){
		$feedPolls[$i]['answered'] = true;
	}
}
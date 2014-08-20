<?php
require_once '../../../wp-config.php';

session_start();

$answered = array();

if(isset($_SESSION['answered'])){
	$answered = explode(",", $_SESSION['answered']);
}

if($_SERVER['REMOTE_ADDR']){
	$ip = $_SERVER['REMOTE_ADDR'];
} else{
	$ip = "0";
}

if($_SERVER['HTTP_X_FORWARDED_FOR']){
	$ip_forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else{
	$ip_forward = "0";
}

if ( (isset($_GET['p'])) && (isset($_GET['a'])) ){
		
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	$sql = $mysqli->prepare("INSERT INTO poll_answers (poll_id, answer, user_ip, user_ip_forward) VALUES (?,?,?,?)");
	$sql->bind_param("iiss", $_GET['p'], $_GET['a'], $ip, $ip_forward);
	$sql->execute();
	
	$mysqli->close();

}

array_push($answered, $_GET['p']);
$_SESSION['answered'] = implode(",", $answered);

?>
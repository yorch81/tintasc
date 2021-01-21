<?php
	require './vendor/autoload.php';
	require 'config.php';
	require 'classes/TintaSc.class.php';

	$tinta = TintaSc::getInstance();

	//var_dump($tinta->getInfo('5817a5d2409b60a7738b4575'));

	//$tinta->deleteAllImg();

	//var_dump($tinta->getInfo('qB7oCXhpVY'));

	/*$ini = '2015-07-22T18:00:00-05:00';
	echo $ini . "\n";
	echo $tinta->addHours($ini, 1) . "\n";*/

	/*
	$event_id = $tinta->addEvent(TintaSc::TATOO, '2021-01-21T14:00:00-06:00', '2021-01-21T16:00:00-06:00', 'tattoo date');
	
	echo $event_id . "\n";

	$event_id = $tinta->addEvent(TintaSc::DESING, '2021-01-21T16:00:00-06:00', '2021-01-21T18:00:00-06:00', 'design date');
	
	echo $event_id . "\n";

	$gFileId = $tinta->uploadImg("./img/facebook.png");
	echo $gFileId . "\n";
	*/

	use Medoo\Medoo;
 
	// Initialize
	$db = new Medoo([
	    'database_type' => 'mysql',
	    'database_name' => DB_NAME,
	    'server' => DB_HOST,
	    'username' => DB_USER,
	    'password' => DB_PASSWORD,
	    'charset' => 'utf8',
	    'port' => DB_PORT,
	    'option' => [
	        PDO::ATTR_CASE => PDO::CASE_NATURAL
	    ]
	]);
	 
	//array('' => $eventKey, '' => $gFileId);
	$data = $db->select("TintaEvent", [
		"FBID",
		"FBNAME",
		"EVENTID"
	], [
		"_id" => 14
	]);

	var_dump($data);

	$data = $db->select("TintaImage", [
		"EVENTID",
		"GIMAGEID"
	], [
		"EVENTID" => 14
	]);

	var_dump($data);


	/*if ($event_id != ''){
		$eventKey = $tinta->saveEvent("10153397832791897", $event_id);
		echo $eventKey . "\n";

		$gFileId = $tinta->uploadImg("../numbers.jpg");
		echo $gFileId . "\n";

		$tinta->saveEventImg($eventKey , $gFileId);

		$tinta->addEventUrl($event_id, $eventKey);
	}*/

	
	//var_dump($tinta->getEvents('2015-08-22'));
?>
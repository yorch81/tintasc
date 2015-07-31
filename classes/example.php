<?php
	require './vendor/autoload.php';
	require 'config.php';
	require 'classes/TintaSc.class.php';

	$tinta = TintaSc::getInstance();

	//var_dump($tinta->getInfo('qB7oCXhpVY'));

	$event_id = $tinta->addEvent(TintaSc::TATOO, '2015-07-22T18:00:00-05:00', '2015-07-22T22:00:00-05:00');
	if ($event_id != ''){
		$eventKey = $tinta->saveEvent("10153397832791897", $event_id);
		echo $eventKey . "\n";

		$gFileId = $tinta->uploadImg("../numbers.jpg");
		echo $gFileId . "\n";

		$tinta->saveEventImg($eventKey , $gFileId);

		$tinta->addEventUrl($event_id, $eventKey);
	}
	
	var_dump($tinta->getEvents('2015-07-22'));

?>
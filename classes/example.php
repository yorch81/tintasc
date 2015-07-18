<?php
	require '../vendor/autoload.php';
	require 'TintaSc.class.php';

	$tinta = TintaSc::getInstance();

	$event_id = $tinta->addEvent(1, '2015-07-30T12:00:00-05:00', '2015-07-30T13:00:00-05:00');
	if ($event_id != ''){
		$eventKey = $tinta->saveEvent("FBID", $event_id);
		echo $eventKey . "\n";

		$gFileId = $tinta->uploadImg("../numbers.jpg");
		echo $gFileId . "\n";

		$tinta->saveEventImg($eventKey , $gFileId);

		$tinta->addEventUrl($event_id, $eventKey);
	}
	
	var_dump($tinta->getEvents('2015-07-30'));

?>
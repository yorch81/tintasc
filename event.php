<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require './vendor/autoload.php';
require 'config.php';

try{

   $client = new Google_Client(array('use_objects' => true));

   $client->setApplicationName(PROJECT_ID);
   //$client->setClientId($id_client);
   
   $key = null;
   if (file_exists (P12_FILE))
    $key = file_get_contents(P12_FILE);

   $credentials = new Google_Auth_AssertionCredentials(
				DEVELOPER_EMAIL,
				array("https://www.googleapis.com/auth/calendar", "https://www.googleapis.com/auth/drive.file"),
				$key,
				"notasecret"
				);

   $client->setAssertionCredentials($credentials);

   $service = new Google_Service_Calendar($client);

   $event = new Google_Service_Calendar_Event;

   $event->setDescription('Cita https://www.facebook.com/jorge.ponceturrubiates');
   $event->setSummary('Tatoo Design');
   $event->setLocation('Zaragoza #311 Sur Zona Centro 87000 Ciudad Victoria Tamaulipas');
   $event->setColorId("10");

   $start = new Google_Service_Calendar_EventDateTime();
   $start->setDateTime('2015-07-29T10:00:00');
   $start->setTimeZone('America/Mexico_City');
   $event->setStart($start);

   $end = new Google_Service_Calendar_EventDateTime();
   $end->setDateTime('2015-07-29T11:00:00');
   $end->setTimeZone('America/Mexico_City');
   $event->setEnd($end);

   $new_event = null;
   $new_event_id = "";

   $new_event = $service->events->insert(CALENDAR_ID, $event);

   if($new_event!=null){

      $new_event_id= $new_event->getId();
      $event = $service->events->get(CALENDAR_ID, $new_event_id);

      if ($event != null) {
	   echo "<br/>Inserted:";
	   echo "<br/>EventID=".$event->getId();
	   echo "<br/>Summary=".$event->getSummary();
	   echo "<br/>Status=".$event->getStatus();
      }
	    else{
	   	   echo "No se ha podido obtener la información del evento";
         	}			   
    }else{
         	echo "No se ha podido insertar el evento";
	 }

  /*
    // Print the next 10 events on the user's calendar.
   $calendarId = $id_calendar;

   $optParams = array(
     'maxResults' => 10,
     'orderBy' => 'startTime',
     'singleEvents' => TRUE,
     'timeMin' => date('c'),
   );

   $results = $service->events->listEvents($calendarId, $optParams);

   if (count($results->getItems()) == 0) {
     print "No upcoming events found.\n";
   } else {
     print "Upcoming events:\n";
     foreach ($results->getItems() as $event) {
       $start = $event->start->dateTime;
       if (empty($start)) {
         $start = $event->start->date;
       }
       printf("%s (%s)\n", $event->getSummary(), $start);
     }
   }

   // FreeBusy
   $calendarArray = [];
  
   $calendarArray[] = ['id' => $id_calendar];

   $freebusy = new Google_Service_Calendar_FreeBusyRequest();
   $freebusy->setTimeMin('2015-06-15T08:00:00-05:00');
   $freebusy->setTimeMax('2015-06-15T20:00:00-05:00');
   $freebusy->setTimeZone('America/Mexico_City');
   $freebusy->setItems( $calendarArray );
   $createdReq = $service->freebusy->query($freebusy);

   $mycal = $createdReq->getCalendars($id_calendar);  

   echo var_dump($mycal);
  */
   }
   catch (Google_Auth_Exception $e) {
        echo 'Google_Auth_Exception ' . $e->getMessage();
      //echo var_dump($e);
   } 
   catch (Google_Service_Exception $e) {
        echo 'Google_Service_Exception' . $e->getMessage();
   }
  
?>
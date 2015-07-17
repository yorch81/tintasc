<?php
require_once('config.php');

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * TintaSc 
 *
 * TintaSc Class for Create Events in Google Calendar, upload images to Google Drive 
 * and save operations in Parse.
 *
 * Copyright 2015 Jorge Alberto Ponce Turrubiates
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @category   TintaSc
 * @package    TintaSc
 * @copyright  Copyright 2015 Jorge Alberto Ponce Turrubiates
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 * @version    1.0.0, 2015-07-15
 * @author     Jorge Alberto Ponce Turrubiates (the.yorch@gmail.com)
 */
class TintaSc
{
	/**
     * Instance Handler to Singleton Pattern
     *
     * @var object $_instance Instance Handler
     * @access private
     */
	private static $_instance;

	/**
     * LOG Object to manage error log
     *
     * @var object $_log Log Object
     * @access private
     */
	private $_log = null;

	/**
	 * Default Time Zone
	 */
	const TIME_ZONE = 'America/Mexico_City';

	/**
	 * Default Address
	 */
	const ADDRESS = 'Zaragoza #311 Sur Zona Centro 87000 Ciudad Victoria Tamaulipas';

	/**
	 * Application URL
	 */
	const APP_SITE = 'http://tintaestudio.mx/tintasc/';

	/**
     * Google Client Instance
     * @var object $_gClient Google Client Instance
     *
     * @access private
     */
	private $_gClient;

	/**
     * Google Calendar Service
     * @var object $_gCalendar Google Calendar Service
     *
     * @access private
     */
	private $_gCalendar;

	/**
     * Google Drive Service
     * @var object $_gDrive Google Drive Service
     *
     * @access private
     */
	private $_gDrive;
	
	/**
	 * Initialize TintaScs
	 */
	private function __construct()
	{
		// Create Log
		$logName = 'tintasc_log-' . date("Y-m-d") . '.log';

		$this->_log = new Logger('TintaSc');
		$this->_log->pushHandler(new StreamHandler($logName, Logger::ERROR));

		// Create Google Client
		$this->_gClient = new Google_Client(array('use_objects' => true));

		$this->_gClient->setApplicationName(PROJECT_ID);

		$p12_key = null;

		if (file_exists (P12_FILE))
			$p12_key = file_get_contents(P12_FILE);
		else
			$this->_log->addError("Unable load p12 key file");

		try{
			$credentials = new Google_Auth_AssertionCredentials(
			DEVELOPER_EMAIL,
			array("https://www.googleapis.com/auth/calendar", "https://www.googleapis.com/auth/drive.file"),
			$p12_key,
			"notasecret"
			);

			// Init Google Client
			$this->_gClient->setAssertionCredentials($credentials);

			// Init Google Calendar
			$this->_gCalendar = new Google_Service_Calendar($this->_gClient);

			// Init Google Drive
			$this->_gDrive = new Google_Service_Drive($this->_gClient);

			//Init ParseClient
			ParseClient::initialize(PARSE_ID, REST_KEY, MASTER_KEY);
		}
		catch (Exception $e) {
	        $this->_log->addError($e->getMessage());
	   }
	}

	/**
	 * Singleton Implementation
	 * 
	 * @return TintaSc TintaSc Instance
	 */
	public static function getInstance()
	{
		if(self::$_instance){
			return self::$_instance;
		}
		else{
			$class = __CLASS__;
			self::$_instance = new $class();

			return self::$_instance;
		}
	}

	/**
	 * Gets Type Description
	 * 
	 * @param  int    $type     1 - DESING 2 - TATOO
	 * @return string
	 */
	private function getTypeDescription($type)
	{
		$retValue = 'TATOO';

		if ($type == 1)
			$retValue = 'DESING';

		return $retValue;
	}

	/**
	 * Gets Color Number
	 * 
	 * @param  int    $type     1 - DESING 2 - TATOO
	 * @return string
	 */
	private function getColor($type)
	{
		$retValue = '9';

		if ($type == 1)
			$retValue = '10';

		return $retValue;
	}

	/**
	 * Add Event to Calendar
	 * 
	 * @param int    $type      1 - DESING 2 - TATOO
	 * @param string $startDate Start DateTime ('2015-07-30T10:00:00-05:00')
	 * @param string $endDate   End DateTime
	 * @return string           Google Event Id
	 */
	public function addEvent($type, $startDate, $endDate)
	{
		$new_event_id = "";

		try{
			if ($this->checkAvailability($startDate, $endDate)){
				$event = new Google_Service_Calendar_Event;
				$event->setDescription('');
			   	$event->setSummary($this->getTypeDescription($type));
			   	$event->setLocation(self::ADDRESS);
			   	$event->setColorId($this->getColor($type));

			   	$start = new Google_Service_Calendar_EventDateTime();
			   	$start->setDateTime($startDate);
			   	$start->setTimeZone(self::TIME_ZONE);
			   	$event->setStart($start);

			   	$end = new Google_Service_Calendar_EventDateTime();
			   	$end->setDateTime($endDate);
			   	$end->setTimeZone(self::TIME_ZONE);
			   	$event->setEnd($end);

				$new_event = null;
				
				$new_event = $this->_gCalendar->events->insert(CALENDAR_ID, $event);

				if ($new_event != null){
					$new_event_id = $new_event->getId();
				}
			}
		}
		catch(Google_Service_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}
		catch(Google_Auth_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}

		return $new_event_id;
	}

	/**
	 * Checks Availability
	 * 
	 * @param string $startDate Start DateTime ('2015-07-30T10:00:00-05:00')
	 * @param string $endDate   End DateTime
	 * @return boolean
	 */
	private function checkAvailability($startDate, $endDate)
	{
		$retValue = false;

		try{
			$optParams = array('maxResults' => 24,
								'orderBy' => 'startTime',
								'singleEvents' => TRUE,
								'timeMin' => $startDate,
								'timeMax' => $endDate,
								'timeZone' => self::TIME_ZONE);

			$results = $this->_gCalendar->events->listEvents(CALENDAR_ID, $optParams);

			if (count($results->getItems()) == 0){
				$retValue = true;
			}
		}
		catch(Google_Service_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}
		catch(Google_Auth_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}

		return $retValue;
	}

	/**
	 * Gets Events of a Day
	 * 
	 * @param string $date Start DateTime ('2015-07-30')
	 * @return array
	 */
	public function getEvents($date)
	{
		$_events = array(9 => '0',
						10=> '0',
						11 =>'0',
						12=>'0',
						13=>'0',
						14=>'0',
						15=>'0',
						16=>'0',
						17=>'0',
						18=>'0',
						19=>'0',
						20=>'0',
						21=>'0');

		$startDate = $date . 'T09:00:00-05:00';
		$endDate = $date . 'T21:00:00-05:00';

		try{
			$optParams = array('maxResults' => 24,
								'orderBy' => 'startTime',
								'singleEvents' => TRUE,
								'timeMin' => $startDate,
								'timeMax' => $endDate,
								'timeZone' => self::TIME_ZONE);

			$results = $this->_gCalendar->events->listEvents(CALENDAR_ID, $optParams);

			if (count($results->getItems()) > 0){
				foreach ($results->getItems() as $event) {
					$start = $event->start->dateTime;
					$end = $event->end->dateTime;

					$startIdx = (int) substr($start, 11, 2);
					$endIdx = (int) substr($end, 11, 2);
					$_events[$startIdx] = '1';

					for ($i=$startIdx; $i<$endIdx; $i++)
						$_events[$i] = '1';
				}
			}
		}
		catch(Google_Service_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}
		catch(Google_Auth_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}

		return $_events;
	}

	/**
	 * Add Application URL in Description Event
	 * 
	 * @param string $event_id    Google Event Id
	 * @param string $event_key   Parse Event Key
	 */
	public function addEventUrl($event_id, $event_key)
	{
		try{
			$event = $this->_gCalendar->events->get(CALENDAR_ID, $event_id);

			$description = self::APP_SITE . $event_key;

			$event->setDescription($description);

			$updatedEvent = $this->_gCalendar->events->update(CALENDAR_ID, $event->getId(), $event);
		}
		catch(Google_Service_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}
		catch(Google_Auth_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}
	}

	/**
	 * Upload Image to Google Drive
	 * 
	 * @param  string $imgPath Full Path File
	 * @return string          Google Drive File Id
	 */
	public function uploadImg($imgPath)
	{
		$new_file_id = "";

		try{
			$file = new Google_Service_Drive_DriveFile();
			$file->setTitle('TintaSc Image');
			$file->setDescription('TintaSc Image');
			$file->shared = "public"; 
			$file->setMimeType('image/jpeg');

			$data = file_get_contents($imgPath);

			$new_file = $this->_gDrive->files->insert(
				$file,
				array('data' => $data, 'mimeType' => 'image/jpeg', 'uploadType' => 'multipart'));

			if ($new_file != null){
				$new_file_id = $new_file->getId();
			}

			$permission = new Google_Service_Drive_Permission();
			$permission->setRole( 'reader' );
			$permission->setType( 'anyone' );
			$permission->setValue( '' );

			$this->_gDrive->permissions->insert($new_file_id, $permission);
		}
		catch(Google_Service_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}
		catch(Google_Auth_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}

		return $new_file_id;
	}

	/**
	 * Delete All Images in Google Drive
	 * 
	 * @param  string $imgPath Full Path File
	 * @return string          Google Drive File Id
	 */
	public function deleteAllImg()
	{
		$new_file_id = "";

		try{
			$optParams = array('maxResults' => 100,);

			$results = $this->_gDrive->files->listFiles($optParams);

			if (count($results->getItems()) > 0){
				foreach ($results->getItems() as $file){
					printf("Deleting (%s)\n", $file->getId());
					$this->_gDrive->files->delete($file->getId());
				}
			}
		}
		catch(Google_Service_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}
		catch(Google_Auth_Exception $e)
		{
			$this->_log->addError($e->getMessage());
		}

		return $new_file_id;
	}

	/**
	 * Save Event in Parse
	 * 
	 * @param  string $fbId    Facebook Id
	 * @param  string $eventId Google Event Id
	 * @return string          Parse Key
	 */
	public function saveEvent($fbId, $eventId)
	{
		$new_event_id = "";

		$pEvent = new ParseObject("TintaEvent");
		$pEvent->set("FBID", $fbId);
		$pEvent->set("EVENTID", $eventId);

		try {
			$pEvent->save();
			$new_event_id = $pEvent->getObjectId();
		}
		catch (ParseException $e) {
			$this->_log->addError($e->getMessage());
		}

		return $new_event_id;
	}

	/**
	 * Save Image of Event in Parse
	 * 
	 * @param  string $eventKey Parse Event key
	 * @param  string $gFileId  Google Drive File Id
	 * @return boolean
	 */
	public function saveEventImg($eventKey, $gFileId)
	{

		$retValue = true;

		$pImg = new ParseObject("TintaImage");
		$pImg->set("EVENTID", $eventKey);
		$pImg->set("GIMAGEID", $gFileId);

		try {
			$pImg->save(); 
		}
		catch (ParseException $e) {  
			$retValue = false;
			$this->_log->addError($e->getMessage());
		}

		return $retValue;
	}
}
?>
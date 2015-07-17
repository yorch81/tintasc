<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require './vendor/autoload.php';
require 'config.php';

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

ParseClient::initialize(PARSE_ID, REST_KEY, MASTER_KEY);

$number = 42;
$string = "the number is " . $number;
$date = new DateTime();
$array = [$string, $number];
$object = ["number" => $number, "string" => $string];

$bigObject = new ParseObject(COLLECTION);
$bigObject->set("myNumber", $number);
$bigObject->set("myString", $string);
$bigObject->set("myDate", $date);
$bigObject->setArray("myArray", $array);
$bigObject->setAssociativeArray("myObject", $object);
$bigObject->set("myNull", null);

try {
  $bigObject->save();

  echo 'New object created with objectId: ' . $bigObject->getObjectId();
} catch (ParseException $ex) {  
  // Execute any logic that should take place if the save fails.
  // error is a ParseException object with an error code and message.
  echo 'Failed to create new object, with error message: ' . $ex->getMessage();
}


$query = new ParseQuery(COLLECTION);
try {
  $results = $query->get($bigObject->getObjectId());
  echo "\nObject = " . $results->get("myString");
  //$results->destroy();
} catch (ParseException $ex) {
  // The object was not retrieved successfully.
  // error is a ParseException with an error code and message.
}

$query = new ParseQuery(COLLECTION);
$query->equalTo("myString", $string);
$results = $query->find();
echo "\nSuccessfully retrieved " . count($results) . " results.";
// Do something with the returned ParseObject values
for ($i = 0; $i < count($results); $i++) {
  $object = $results[$i];
  echo "\nObject = " . $object->getObjectId();
  //$object->destroy();
}

?>

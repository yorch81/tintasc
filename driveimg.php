<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require './vendor/autoload.php';
require 'config.php';

try{

   $client = new Google_Client(array('use_objects' => true));

   $client->setApplicationName(PROJECT_ID);
   //$client->setClientId($id_client);
   $key = file_get_contents(P12_FILE);

   $credentials = new Google_Auth_AssertionCredentials(
				DEVELOPER_EMAIL,
				array("https://www.googleapis.com/auth/drive", "https://www.googleapis.com/auth/drive.file"),
				$key,
				"notasecret"
				);

   $client->setAssertionCredentials($credentials);

   $service = new Google_Service_Drive($client);

    //Insert a file
	//$data = file_get_contents('documento.txt');

	$file = new Google_Service_Drive_DriveFile();
	$file->setTitle('numbers.jpg');
	$file->setDescription('A test image');
	$file->shared = "public"; 
	$file->setMimeType('image/jpeg');

    $data = file_get_contents('numbers.jpg');

	$createdFile = $service->files->insert(
	  $file,
	  array(
	    'data' => $data,
	    'mimeType' => 'image/jpeg',
	    'uploadType' => 'multipart'
	  )
	);

	printf("created  %s (%s)\n", $createdFile->getDownloadUrl(), $createdFile->getId());


	$permission = new Google_Service_Drive_Permission();
	$permission->setRole( 'reader' );
	$permission->setType( 'anyone' );
	$permission->setValue( '' );
	$service->permissions->insert( $createdFile->getId(), $permission );

	$optParams = array(
	  'maxResults' => 10,
	);

	$results = $service->files->listFiles($optParams);

	if (count($results->getItems()) == 0) {
	  print "No files found.\n";
	} else {
	  print "Files:\n";
	  foreach ($results->getItems() as $file) {
	    printf("%s (%s)\n", $file->getTitle(), $file->getId());
	    
	    //$service->files->delete($file->getId());
	  }
	}

   } 
   catch (Google_ClientException $e) {
        echo "Caught Google_ClientException:";
		print_r($e);
   }
   catch (Google_ServiceException $e) {
        echo "Caught Google_ServiceException:";
		echo "<pre>".print_r($e,true)."</pre>";
   }

?>

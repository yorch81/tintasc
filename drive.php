<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require './vendor/autoload.php';
require 'config.php';

try{

   $client = new Google_Client(array('use_objects' => true));

   $client->setApplicationName($id_project);
   //$client->setClientId($id_client);
   $key = file_get_contents($p12_file);

   $credentials = new Google_Auth_AssertionCredentials(
				$email_developer,
				array("https://www.googleapis.com/auth/drive.file"),
				$key,
				"notasecret"
				);

   $client->setAssertionCredentials($credentials);

   $service = new Google_Service_Drive($client);

    //Insert a file
	$data = file_get_contents('documento.txt');

	$file = new Google_Service_Drive_DriveFile();
	$file->setTitle('Text Document');
	$file->setDescription('A test document text');
	$file->shared = "public"; 
	$file->setMimeType('text/plain');

	$createdFile = $service->files->insert(
	  $file,
	  array(
	    'data' => $data,
	    'mimeType' => 'application/octet-stream',
	    'uploadType' => 'media'
	  )
	);

	printf("created  %s (%s)\n", $createdFile->getTitle(), $createdFile->getId());

	// Delete files
   	/*try {

	    $service->files->delete('0Byv0gyCG4iHqc0RVREdXbkpCLWs');

	  } catch (Exception $e) {
	    print "An error occurred: " . $e->getMessage();
	  }
	*/
	//Give everyone permission to read and write the file
	$permission = new Google_Service_Drive_Permission();
	$permission->setRole( 'writer' );
	$permission->setType( 'anyone' );
	$permission->setValue( 'me' );
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
	    print "deleting";
	    $service->files->delete($file->getId());
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

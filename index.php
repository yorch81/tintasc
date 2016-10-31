<?php
require "vendor/autoload.php";
require "config.php";
require "classes/TintaSc.class.php";

// TIme Zone
date_default_timezone_set('America/Mexico_City');

// Init Sessions
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$fb = MyLogin::getInstance(MyLogin::FACEBOOK, APP_KEY, APP_SECRET, CALLBACK);

// TintaSc
$app->get(
    '/',
    function () use ($app, $fb) {
        if ($fb->validate()){
            $app->render('vw_index.php');
        }
        else
            $app->redirect('/fb');
    }
);

// Facebook Login
$app->get(
    '/fb',
    function () use ($app, $fb) {
        if ($fb->login())
            $app->redirect('/');
        else{
            $app->redirect($fb->getAuthUrl());
        }
    }
);

// Logout
$app->get(
    '/logout',
    function () use ($app, $fb) {
        session_destroy();
        
        $app->redirect('http://tintaestudio.mx/');
    }
);

// Create Date in Google Calendar
$app->post(
    '/calendar',
    function () use ($app) {        
        $start = $app->request->post('start');
        $hours = (int) $app->request->post('hours');
        $type = (int) $app->request->post('type');
        $comments = $app->request->post('comments');

        $tinta = TintaSc::getInstance();

        // Add Locale mx
        $start = $start . '-05:00';

        try{
            $event_id = '';

            if (! isset($_SESSION['EVENT_KEY'])){
                $end = $tinta->addHours($start,$hours);

                $event_id = $tinta->addEvent($type, $start, $end, $comments);

                $fbId = $_SESSION['SOCIAL_ID'];
                $fbName = $_SESSION['SOCIAL_NAME'];

                if ($event_id != ''){
                    $eventKey = $tinta->saveEvent($fbId, $fbName, $event_id);
                    
                    if ($eventKey != '')
                        $_SESSION['EVENT_KEY'] = $eventKey;

                    $tinta->addEventUrl($event_id, $eventKey);
                }
            }

            $app->response()->status(200);

            echo $event_id;
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

// Upload Images Google Drive
$app->post(
    '/upload',
    function () use ($app) {
        try{
            if (isset($_SESSION['EVENT_KEY'])){
               if (!empty($_FILES)){
                    $tempFile = $_FILES['file']['tmp_name'];

                    echo $tempFile;
                    echo $_SESSION['EVENT_KEY'];

                    // Add Google Drive
                    $tinta = TintaSc::getInstance();

                    $gFileId = $tinta->uploadImg($tempFile);
                    $eventKey = $_SESSION['EVENT_KEY'];
                    $tinta->saveEventImg($eventKey, $gFileId);
                    
                    $app->response()->status(200);
                    echo "OK";
                } 
            }
            else{
                $app->response()->status(400);
                echo "BAD";
            }
        }
        catch (ResourceNotFoundException $e) {
            $app->response()->status(404);
        } 
        catch (Exception $e) {
            $app->response()->status(400);
            $app->response()->header('X-Status-Reason', $e->getMessage());
        }
    }
);

// View Dates
$app->get("/dates/:eventkey", 
    function ($eventkey) use ($app) {
        $tinta = TintaSc::getInstance();

        $app->view()->setData(array('info' => $tinta->getInfo($eventkey)));
        
        $app->render('vw_dates.php');
    }
);

$app->run();

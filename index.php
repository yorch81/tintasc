<?php
require "vendor/autoload.php";
require "config.php";
require "classes/TintaSc.class.php";

// Init Sessions
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$fb = MyLogin::getInstance(MyLogin::FACEBOOK, '1492550914370381', 'e4b0f73cb298a5eaaaba124322be48ee', 'http://tintasc.localhost/fb');

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

$app->post(
    '/check',
    function () use ($app, $dicDb) {
        $ini = $app->request->post('ini');
        $fin = $app->request->post('fin');
    
        $ini = $ini . '-05:00';
        $fin = $fin . '-05:00';

        $tinta = TintaSc::getInstance();

        try{
            
            $event_id = $tinta->addEvent(TintaSc::TATOO, $ini, $fin);

            if ($event_id != ''){
                $eventKey = $tinta->saveEvent("10153397832791897", $event_id);
                
                $tinta->addEventUrl($event_id, $eventKey);
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

$app->run();

<?php
require "vendor/autoload.php";

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
            echo $_SESSION['SOCIAL_TYPE'] . "\n";
            echo $_SESSION['SOCIAL_ID'] . "\n";
            echo $_SESSION['SOCIAL_NAME'] . "\n";
            echo $_SESSION['SOCIAL_LINK'] . "\n";
            echo $_SESSION['SOCIAL_IMG'] . "\n";
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

$app->run();

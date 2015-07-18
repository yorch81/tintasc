<?php
require "vendor/autoload.php";
require 'classes/MyLogin.class.php';

// Init Sessions
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$login = MyLogin::getInstance('MyFaceBook');

// Root
$app->get(
    '/',
    function () use ($app, $login) {
        echo "Hello TintaSc !!!";

        if ($login->validate()){
            echo $_SESSION['SOCIAL_TYPE'] . "\n";
            echo $_SESSION['SOCIAL_ID'] . "\n";
            echo $_SESSION['SOCIAL_NAME'] . "\n";
            echo $_SESSION['SOCIAL_LINK'] . "\n";
        }
        else
            $app->redirect('/fb');
    }
);

$app->get(
    '/fb',
    function () use ($app, $login) {
        if ($login->checkSession())
            $app->redirect('/');
        else{
            $loginUrl = $login->getAuthUrl();
            $app->redirect($loginUrl);
        }
    }
);

$app->get(
    '/tw',
    function () use ($app, $login) {
        if ($login->checkSession())
            $app->redirect('/');
        else{
            $loginUrl = $login->getAuthUrl();
            $app->redirect($loginUrl);
        }
    }
);

$app->get(
    '/logout',
    function () use ($app, $fb) {
        session_destroy();
    }
);

$app->run();

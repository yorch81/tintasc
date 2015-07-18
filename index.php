<?php
require "vendor/autoload.php";

// Init Sessions
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$social = MyLogin::getInstance(MyLogin::FACEBOOK);

// Root
$app->get(
    '/',
    function () use ($app, $social) {
        echo "Hello TintaSc !!!";

        if ($social->validate()){
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

$app->get(
    '/fb',
    function () use ($app, $social) {
        if ($social->login())
            $app->redirect('/');
        else{
            $loginUrl = $social->getAuthUrl();
            $app->redirect($loginUrl);
        }
    }
);

$app->get(
    '/tw',
    function () use ($app, $social) {
        if ($social->login())
            $app->redirect('/');
        else{
            $loginUrl = $social->getAuthUrl();
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
